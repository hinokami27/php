<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'mechanic_name',
        'client_name',
        'vehicle_make',
        'vehicle_model',
        'license_plate',
        'description',
        'price',
        'date_received',
        'date_completed',
    ];
    protected $casts = [
        'date_received' => 'date',
        'date_completed' => 'date',
    ];
}
