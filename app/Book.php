<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id', 'author_id', 'title', 'publish_year', 'age_range', 'description', 'cover_image', 'rate'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function reading_plan()
    {
        return $this->hasMany('App\Reading_plan');
    }

    public function reading_pre_info()
    {
        return $this->hasMany('App\Reading_pre_info');
    }

    public function book_lists()
    {
        return $this->belongsToMany('App\Lista', 'book_lists', 'book_id', 'listas_id');
    }

    public function book_discussions()
    {
        return $this->belongsToMany('App\Discussion', 'book_discussions', 'book_id', 'discussion_id');
    }

    public function book_posts()
    {
        return $this->belongsToMany('App\Post', 'book_posts', 'book_id', 'post_id');
    }

    public function book_category()
    {
        return $this->belongsToMany('App\Category', 'book_category', 'book_id', 'category_id');
    }

    public function post_related_to_book()
    {
        return $this->belongsToMany('App\Post', 'post_related_to_book', 'book_id', 'post_id');
    }

    public function book_rate()
    {
        return $this->hasMany('App\Book_rate');
    }

}
