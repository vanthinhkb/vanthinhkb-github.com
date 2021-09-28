<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Backup;
use App\Models\BackupSource;

class BackupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBackup(Request $request)
    {
        $data = BackupSource::all();
        return view("backend.backup.list", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function backupSource()
    {
        ini_set('max_execution_time', 1200);
        ini_set('memory_limit','1024M');
        $source = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR;
        $fileName = time() . '_' ."hichem_new.zip";
        $destination = $source . DIRECTORY_SEPARATOR . '/uploads/backup/'  . $fileName;

        $link = '/uploads/backup/'  . $fileName;

        BackupSource::create(['title' => $fileName, 'link' => $link , 'type' => 'code']);

        Backup::zip_files($source , $destination);

        flash('Backup Source thành công.')->success();

        return redirect()->back();
    }

    public function backupDB(Request $request) {
        $this->validate($request,
            [
                'host'  => 'required',
                'username'  => 'required',
                'dbname'  => 'required',
            ],
            [
                'host.required'   => 'Server không được bỏ trống',
                'username.required' => 'Username không được bỏ trống',
                'dbname.required'   => 'dbname không được bỏ trống',
            ]
        );

        $backup_file_name = time() . '_' . $request->dbname . '.sql';

        $link = '/uploads/backup/' . $backup_file_name;

        BackupSource::create(['title' => $backup_file_name, 'link' => $link , 'type' => 'db']);

        Backup::backDb($request->host, $request->username, $request->password, $request->dbname);

        flash('Backup DB thành công.')->success();

        return redirect()->back();
    }

    public function destroy($id)
    {
        flash('Xóa thành công.')->success();

        BackupSource::destroy($id);

        return redirect()->back();
    }

}
