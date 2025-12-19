<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'student_name', 'seats_requested', 'status'];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
