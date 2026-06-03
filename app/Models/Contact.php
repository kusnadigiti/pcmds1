<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'email',
        'operational_days_start',
        'operational_days_end',
        'working_hours_start',
        'working_hours_end',
        'google_maps_url',
    ];
}
