<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'image', 'privacy', 'active'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group_events()
    {
        return $this->belongsToMany('App\Event', 'group_events', 'group_id', 'event_id');
    }

    public function group_discussions()
    {
        return $this->belongsToMany('App\Discussion', 'group_discussions', 'group_id', 'discussion_id');
    }

    public function group_posts()
    {
        return $this->belongsToMany('App\Post', 'group_posts', 'group_id', 'post_id');
    }
    //ADD active filed to pivot from doc
    public function group_members()
    {
        return $this->belongsToMany('App\User', 'group_members', 'group_id', 'user_id')->withPivot('active','pending')->withTimestamps();
    }

}
