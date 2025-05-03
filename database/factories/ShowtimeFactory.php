<?php

namespace Database\Factories;

use App\Models\Showtime;
use App\Models\Room;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Showtime>
 */
class ShowtimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Showtime::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $startTime = Carbon::instance($this->faker->dateTimeBetween('now', '+1 week'))
                        ->minute(0)->second(0);

        // On ajoute 2h à la start time parce qu'un film dure généralement environ 2h.
        $endTime = $startTime->copy()->addHours(2);

        return [
            'room_id' => Room::factory(),
            'movie_id' => Movie::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
