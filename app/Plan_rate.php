<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_rate extends Model
{
    protected $table = 'plan_rate';

    protected $fillable = [
        'reading_plan_id', 'user_id', 'rate'
    ];

    public function plan_rate()
    {
        return $this->belongsTo('App\Reading_plan');
    }
}
