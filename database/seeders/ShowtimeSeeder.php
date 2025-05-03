<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Showtime;
use App\Models\Room;
use App\Models\Movie;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();
        $movies = Movie::all();

        if ($rooms->isEmpty() || $movies->isEmpty()) {
            $this->command->warn('No rooms or movies found, skipping ShowtimeSeeder.');
            return;
        }

        foreach ($rooms as $room) {
            $numberOfShowtimes = rand(5, 15);
            for ($i = 0; $i < $numberOfShowtimes; $i++) {
                Showtime::factory()->create([
                    'room_id' => $room->id,
                    'movie_id' => $movies->random()->id,
                ]);
            }
        }
    }
}
