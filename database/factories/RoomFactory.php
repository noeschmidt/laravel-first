<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Cinema;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Room ' . $this->faker->randomNumber(2),
            'capacity' => $this->faker->numberBetween(50, 200),
            'cinema_id' => Cinema::factory(),
        ];
    }
}
