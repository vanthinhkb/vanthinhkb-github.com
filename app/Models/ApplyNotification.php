<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyNotification extends Model
{
    protected $table = 'apply_notification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_token'
    ];


}
