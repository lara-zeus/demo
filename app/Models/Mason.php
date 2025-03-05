<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mason extends Model
{
    protected $casts= [
        'content'=>'array'
    ];

    protected $guarded = [];
}
