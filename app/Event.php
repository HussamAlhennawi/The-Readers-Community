<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id', 'title', 'location', 'start_at', 'end_at', 'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function event_comments()
    {
        return $this->belongsToMany('App\Comment', 'event_comments', 'event_id', 'comment_id');
    }

    public function event_reactions()
    {
        return $this->belongsToMany('App\Reaction', 'event_reactions', 'event_id', 'reaction_id');
    }

    public function event_members()
    {
        return $this->belongsToMany('App\User', 'event_members', 'event_id', 'user_id');
    }

    public function group_events()
    {
        return $this->belongsToMany('App\Group', 'group_events', 'event_id', 'group_id');
    }
}
