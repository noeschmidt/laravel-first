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
        // Create the initial 15 movies
        Movie::factory()->count(15)->create();

        // Get all movies and artists
        $movies = Movie::all();
        $artists = Artist::all();

        // Attach random artists as actors to each movie
        foreach ($movies as $movie) {
            // Get a random number of artists (between 1 and 5)
            $randomArtists = $artists->random(rand(1, min(5, $artists->count())));

            // Attach each random artist to the movie with a dummy role name
            foreach ($randomArtists as $artist) {
                $movie->actors()->attach($artist->id, ['role_name' => 'Random Role']);
            }
        }
    }
}
