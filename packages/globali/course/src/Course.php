<?php

namespace Globali\Course;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image', 
        'faculty', 
        'associated_uni', 
        'opportunities', 
        'online_course', 
        'online_exam', 
        'associated_teacher',
    ];    
}
