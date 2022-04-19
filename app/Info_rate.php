<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_rate extends Model
{
    protected $table = 'info_rate';

    protected $fillable = [
        'reading_pre_info_id', 'user_id', 'rate'
    ];
}
