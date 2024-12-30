<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $table = 'study';
    protected $fillable = [
        'institute',
        'start_date',
        'end_date',
        'cgpa',
        'user_id',
    ];
}
