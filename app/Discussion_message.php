<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion_message extends Model
{
    protected $fillable = [
        'user_id', 'discussion_id', 'text'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
