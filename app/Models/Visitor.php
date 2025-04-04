<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_number',
        'full_name',
        'age',
        'floor',
        'host',
        'visit_time',
        'logged_out_at',
    ];
}

