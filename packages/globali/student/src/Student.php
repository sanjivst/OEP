<?php

namespace Globali\Student;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'image', 'address', 'phone', 'email', 'nationality', 'state', 'post_code', 'previous_course', 'selected_course', 'package_selected',
    ];
}
