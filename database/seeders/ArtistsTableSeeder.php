<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Artist::factory()
        //     ->count(50)
        //     ->create();
        DB::table('artists')->insert([
            [
                'name' => 'Coppola',
                'firstname' => 'Francis Ford',
                'birthdate' => 1939,
                'country_id' => 1,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lynch',
                'firstname' => 'David',
                'birthdate' => 1946,
                'country_id' => 2,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Carrey',
                'firstname' => 'Jim',
                'birthdate' => 1962,
                'country_id' => 5,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Spielberg',
                'firstname' => 'Steven',
                'birthdate' => 1946,
                'country_id' => 3,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Scorsese',
                'firstname' => 'Martin',
                'birthdate' => 1942,
                'country_id' => 1,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Johansson',
                'firstname' => 'Scarlett',
                'birthdate' => 1984,
                'country_id' => 4,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'DiCaprio',
                'firstname' => 'Leonardo',
                'birthdate' => 1974,
                'country_id' => 6,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Portman',
                'firstname' => 'Natalie',
                'birthdate' => 1981,
                'country_id' => 5,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tarantino',
                'firstname' => 'Quentin',
                'birthdate' => 1963,
                'country_id' => 2,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Streep',
                'firstname' => 'Meryl',
                'birthdate' => 1949,
                'country_id' => 5,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hanks',
                'firstname' => 'Tom',
                'birthdate' => 1956,
                'country_id' => 3,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Winslet',
                'firstname' => 'Kate',
                'birthdate' => 1975,
                'country_id' => 1,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nolan',
                'firstname' => 'Christopher',
                'birthdate' => 1970,
                'country_id' => 4,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lawrence',
                'firstname' => 'Jennifer',
                'birthdate' => 1990,
                'country_id' => 6,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fincher',
                'firstname' => 'David',
                'birthdate' => 1962,
                'country_id' => 5,
                'actor_path' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
