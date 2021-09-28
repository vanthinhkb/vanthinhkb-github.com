<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'project';
    protected $fillable = [
        'name', 'name_en', 'slug' , 'desc' , 'desc_en' , 'content' , 'content_en' , 'image' , 'view',
        'hot' , 'status' , 'meta_title' , 'meta_description' , 'meta_keyword'
	];

}
