<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $fillable = [
        'user_id', 'name', 'type', 'privacy'
    ];

    public function books()
    {
        return $this->belongsToMany('App\Book', 'book_lists', 'listas_id', 'book_id');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_lists', 'listas_id', 'post_id');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Author', 'author_lists', 'listas_id', 'author_id');
    }
}
