<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Креираме 10 курсеви
        Course::factory(10)->create()->each(function ($course) {
            // За секој курс креираме од 3 до 7 уписи
            Enrollment::factory(rand(3, 7))->create([
                'course_id' => $course->id
            ]);
        });
    }
}
