<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cinema;
use App\Models\Room;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer 10 cinemas
        // Pour chaque ciné créer entre 3 et 8 rooms
        Cinema::factory()
            ->count(10)
            ->has(Room::factory()->count(rand(3, 8)), 'rooms')
            ->create();
    }
}
