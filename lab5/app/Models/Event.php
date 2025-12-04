<?php

// app/Models/Event.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'type',
        'date_time',
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function organizer()
    {
        // Врска: Event belongs to an Organizer
        return $this->belongsTo(Organizer::class);
    }
}
