<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupSource extends Model
{
    protected $table = 'backup';

    protected $fillable = [ 'title', 'link', 'type'];
}
