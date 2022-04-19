<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'user_id', 'name', 'nationality', 'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function books()
    {
        return $this->hasMany('App\Book');
    }

    public function author_lists()
    {
        return $this->belongsToMany('App\Lista', 'author_lists', 'author_id', 'listas_id');
    }

    public function post_related_to_author()
    {
        return $this->belongsToMany('App\Post', 'post_related_to_author', 'author_id', 'post_id');
    }
}
