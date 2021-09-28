<?php

namespace App\Helper;

class Backup {

    public static function zip_files( $source, $destination )
    {
        $zip = new \ZipArchive();
        if($zip->open($destination, \ZIPARCHIVE::CREATE) === true) {
            $source = realpath($source);
            if(is_dir($source)) {
            $iterator = new \RecursiveDirectoryIterator($source);
            $iterator->setFlags(\RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
            foreach($files as $file) {
                $file = realpath($file);
                if(is_dir($file)) {
                $zip->addEmptyDir(str_replace($source . DIRECTORY_SEPARATOR, '', $file . DIRECTORY_SEPARATOR));
                }elseif(is_file($file)) {
                $zip->addFile($file,str_replace($source . DIRECTORY_SEPARATOR, '', $file));
                }
            }
            }elseif(is_file($source)) {
            $zip->addFile($source,basename($source));
            }
        }
        return $zip->close();
    }

    public static function backDb($host, $user, $pass, $dbname, $tables = '*'){
		$conn = new \mysqli($host, $user, $pass, $dbname);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		if($tables == '*'){
			$tables = array();
			$sql = "SHOW TABLES";
			$query = $conn->query($sql);
			while($row = $query->fetch_row()){
				$tables[] = $row[0];
			}
		}
		else{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}


		$outsql = '';
		foreach ($tables as $table) {


		    $sql = "SHOW CREATE TABLE $table";
		    $query = $conn->query($sql);
		    $row = $query->fetch_row();

		    $outsql .= "\n\n" . $row[1] . ";\n\n";

		    $sql = "SELECT * FROM $table";
		    $query = $conn->query($sql);

		    $columnCount = $query->field_count;


		    for ($i = 0; $i < $columnCount; $i ++) {
		        while ($row = $query->fetch_row()) {
		            $outsql .= "INSERT INTO $table VALUES(";
		            for ($j = 0; $j < $columnCount; $j ++) {
		                $row[$j] = $row[$j];

		                if (isset($row[$j])) {
		                    $outsql .= '"' . $row[$j] . '"';
		                } else {
		                    $outsql .= '""';
		                }
		                if ($j < ($columnCount - 1)) {
		                    $outsql .= ',';
		                }
		            }
		            $outsql .= ");\n";
		        }
		    }

		    $outsql .= "\n";
		}


	    $backup_file_name = $_SERVER['DOCUMENT_ROOT'] . '/uploads/backup/' . time() . '_' . $dbname . '.sql';
	    $fileHandler = fopen($backup_file_name, 'w+');
	    fwrite($fileHandler, $outsql);
	    fclose($fileHandler);


	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($backup_file_name));
	    ob_clean();
	    flush();
	    readfile($backup_file_name);
	    exec('rm ' . $backup_file_name);

	}
}
?>
