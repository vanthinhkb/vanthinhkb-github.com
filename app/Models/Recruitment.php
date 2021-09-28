<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
   	protected $table = 'recruitments';
    
    protected $fillable = [ 
		'name', 'name_en', 'slug' , 'image' , 'office_area', 'office_area_en', 'salary_from' , 'salary_to', 'address', 'address_en', 'content', 
		'content_en', 'status', 'meta_title', 'meta_description', 'meta_keyword'
	];

	public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'recruitment_category', 'id_recruitment', 'id_category');
    }
}