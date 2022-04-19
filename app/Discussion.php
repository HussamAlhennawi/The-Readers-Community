<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [
        'user_id', 'title', 'start_at', 'end_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function book_discussions()
    {
        return $this->belongsToMany('App\Book', 'book_discussions', 'discussion_id', 'book_id');
    }

    public function group_discussions()
    {
        return $this->belongsToMany('App\Group', 'group_discussions', 'discussion_id', 'group_id');
    }
    //ADD active filed to pivot from doc
    public function discussion_members()
    {
        return $this->belongsToMany('App\User', 'discussion_members', 'discussion_id', 'user_id');
    }

    //ADD text filed to pivot from doc
    public function discussion_messages()
    {
        return $this->belongsToMany('App\User', 'discussion_messages', 'discussion_id', 'user_id')->withPivot('text');
    }

    //test
//    public function discussion_messages()
//    {
//        return $this->hasMany('App\Reading_plan');
//    }

}
