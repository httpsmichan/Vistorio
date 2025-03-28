<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
        'purpose',
        'preferred_date_time',
        'host',
    ];
}
