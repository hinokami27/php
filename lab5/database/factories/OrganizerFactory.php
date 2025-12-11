<?php

// database/factories/OrganizerFactory.php

namespace Database\Factories;

use App\Models\Organizer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizerFactory extends Factory
{
    protected $model = Organizer::class;

    public function definition(): array
    {
        return [
            // Име и презиме
            'full_name' => $this->faker->name(),

            // Уникатен email
            'email' => $this->faker->unique()->safeEmail(),

            // Телефонски број
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
