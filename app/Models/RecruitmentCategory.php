<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruitmentCategory extends Model
{
    protected $table = 'recruitment_category';
    protected $fillable = [ 
    	'id_category', 'id_recruitment'
	];
}