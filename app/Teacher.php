<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name', 'image', 'address', 'phone', 'email', 'nationality', 'state', 'post_code', 'experience',
    ];
}
