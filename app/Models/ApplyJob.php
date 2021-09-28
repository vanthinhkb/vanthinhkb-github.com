<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    protected $table = 'apply_job';

    protected $fillable = [ 'id_recruitment','name','email','phone', 'dateOfBirth', 'level', 'experience','file_cv'];
}
