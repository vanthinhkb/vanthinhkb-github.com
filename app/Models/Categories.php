<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
   	protected $table = 'categories';
   	protected $fillable = [ 'name','slug','parent_id','image', 'meta_title', 'meta_description', 'meta_keyword','type','name_en'];
   	public function get_child_cate()
    {
        return $this->where('parent_id', $this->id)->get();
    }

    public function getParent()
    {
        return $this->where('id', $this->parent_id)->first();
    }
   	public function Products()
    {
        return $this->belongsToMany('App\Models\Products', 'product_category', 'id_category', 'id_product');
    }

    public function Recruitments()
    {
        return $this->belongsToMany('App\Models\Recruitment', 'recruitment_category', 'id_category', 'id_recruitment');
    }
}