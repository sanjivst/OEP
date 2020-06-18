<?php

namespace Client\Project;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    protected $fillable=[
        'name',
        'slug',
        'type',
        'logo',
        'thumbnail',
        'banner',
        'featured_image',
        'excerpt',
        'detail',
        'web',
        'platform',
        'designed',
        'tools',
        'address',
        'email',
        'phone',
        'mobile',
        'work_progress',
        'user_id',
        'status',
        'other',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function feedback(){
        return $this->hasMany(Feedback::class);
    }
}
