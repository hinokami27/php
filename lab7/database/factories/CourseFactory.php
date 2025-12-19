<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'summary' => $this->faker->paragraph(),
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'start_date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'seats' => $this->faker->numberBetween(10, 50),
        ];
    }
}
