<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Downloads extends Model
{
	   protected $table = 'downloads';

	   protected $fillable = [
            'name', 'name_en', 'slug' , 'desc' , 'desc_en' , 'content' , 'content_en' , 'image' , 'view', 'file_download',
            'hot' , 'status' , 'meta_title' , 'meta_description' , 'meta_keyword'
        ];
}
