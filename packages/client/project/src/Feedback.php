<?php

namespace Client\Project;

use Access\Subscriber\Comment;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Feedback extends Model
{
    protected $table ='feedbacks';
    protected $fillable=[
        'title',
        'message',
        'file',
        'project_id',
        'status',
    ];
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
