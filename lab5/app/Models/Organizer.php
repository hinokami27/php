<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
    ];

    public function events()
    {
        // Врска: Organizer has many Events
        return $this->hasMany(Event::class);
    }
}
