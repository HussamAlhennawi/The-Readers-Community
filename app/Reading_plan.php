<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reading_plan extends Model
{

    protected $fillable = [
        'user_id', 'book_id', 'text', 'rate'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function book()
    {
        return $this->belongsTo('App\Book');
    }

}
