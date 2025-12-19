<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition()
    {
        return [
            'course_id' => Course::factory(), // Креира нов курс ако не е наведен
            'student_name' => $this->faker->name(),
            'seats_requested' => $this->faker->numberBetween(1, 3),
            'status' => $this->faker->randomElement(['pending', 'approved', 'dropped']),
        ];
    }
}
