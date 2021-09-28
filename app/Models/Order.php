<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   	protected $table = 'orders';
    
    protected $fillable = [ 
        'id_account', 'type' , 'total_price' , 'content', 'status'
    ];

    public function Customers()
    {
    	return $this->hasOne('App\Models\Account', 'id', 'id_account');
    }

    public function OrderDetail()
    {
    	return $this->hasMany('App\Models\OrderDetail', 'id_order', 'id');
    }
}
