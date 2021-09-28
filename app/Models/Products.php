<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brands;
use App\Models\Producers;
use App\Models\Origins;
use App\Models\Models;
use App\Models\EnergySources;
class Products extends Model
{
    protected $table = 'products';
       
   	protected $fillable = [ 
        'code', 'slug', 'name', 'name_en' , 'price', 'image' , 'status', 'hot', 'status_product', 'checkprice',
        'content', 'content_en', 'more_image', 'origin', 'origin_en', 'meta_title', 'meta_description', 
        'meta_keyword', 'created_at' , 'updated_at'
    ];
    
   	public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'product_category', 'id_product', 'id_category');
    }   
}