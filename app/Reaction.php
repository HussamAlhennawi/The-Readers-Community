<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

//    public function reaction_type()
//    {
//        return $this->belongsTo('App\Reaction_type');
//    }

//    public function post_reactions()
//    {
//        return $this->belongsToMany('App\Post', 'post_reactions', 'reaction_id', 'post_id')->withPivot('user_id');
//    }
//
//    public function event_reactions()
//    {
//        return $this->belongsToMany('App\Event', 'event_reactions', 'reaction_id', 'event_id');
//    }
}
