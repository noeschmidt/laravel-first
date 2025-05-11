<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Artist;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artists = Artist::all();

        Movie::factory()->count(15)->create()->each(function ($movie) use ($artists) {
            $movie->director_id = $artists->random()->id;
            $movie->save();

            $randomArtists = $artists->random(rand(1, min(5, $artists->count())));

            foreach ($randomArtists as $artist) {
                $movie->actors()->attach($artist->id, ['role_name' => 'Random Role']);
            }
        });
    }
}
