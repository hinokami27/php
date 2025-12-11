<?php

// database/factories/EventFactory.php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $eventTypes = ['Семинар', 'Работилница', 'Предавање', 'Конференција'];

        return [
            // Поврзување со постоечки организатор
            'organizer_id' => Organizer::factory(),

            // Име на настанот
            'name' => $this->faker->catchPhrase(),

            // Опис (мин. 20 карактери)
            'description' => $this->faker->sentence(25),

            // Тип на настанот
            'type' => $this->faker->randomElement($eventTypes),

            // Датумот да биде во иднина (за да помине валидацијата)
            'date_time' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
        ];
    }
}
