<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notification';
    
    protected $fillable = ['title', 'title_en', 'image', 'content', 'content_en', 'status'];
}
