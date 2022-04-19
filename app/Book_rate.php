<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_rate extends Model
{
    protected $table = 'book_rate';

    protected $fillable = [
        'user_id', 'book_id', 'rate'
    ];

    public function book_rate()
    {
        return $this->belongsTo('App\Book');
    }
}
