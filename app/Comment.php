<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'text', 'active'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post_comments()
    {
        return $this->belongsToMany('App\Post', 'post_comments', 'comment_id', 'post_id');
    }

    public function event_comments()
    {
        return $this->belongsToMany('App\Event', 'event_comments', 'comment_id', 'event_id');
    }


}
