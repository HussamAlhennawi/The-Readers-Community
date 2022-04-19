<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'type', 'status', 'text'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post_lists()
    {
        return $this->belongsToMany('App\Lista', 'post_lists', 'post_id', 'listas_id');
    }

    public function post_related_to_author()
    {
        return $this->belongsToMany('App\Author', 'post_related_to_author', 'post_id', 'author_id');
    }

    public function post_related_to_book()
    {
        return $this->belongsToMany('App\Book', 'post_related_to_book', 'post_id', 'book_id');
    }

    public function book_posts()
    {
        return $this->belongsToMany('App\Book', 'book_posts', 'post_id', 'book_id');
    }

    public function group_posts()
    {
        return $this->belongsToMany('App\Group', 'group_posts', 'post_id', 'group_id');
    }

    public function post_comments()
    {
        return $this->belongsToMany('App\Comment', 'post_comments', 'post_id', 'comment_id');
    }

    public function post_reactions()
    {
        return $this->belongsToMany('App\Reaction', 'post_reactions', 'post_id', 'reaction_id')->withPivot('user_id');
    }

    // post reactions but between post & user for toggle reaction
    public function post_reaction_by_user()
    {
        return $this->belongsToMany('App\User', 'post_reactions', 'post_id', 'user_id')->withPivot('reaction_id');
    }

}
