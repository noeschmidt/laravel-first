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
        Artist::factory()
            ->count(50)
            ->create();
        // DB::table('artists')->insert([
        //     [
        //         'name' => 'Coppola',
        //         'firstname' => 'Francis Ford',
        //         'birthdate' => 1939,
        //         'country_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        //     [
        //         'name' => 'Lynch',
        //         'firstname' => 'David',
        //         'birthdate' => 1946,
        //         'country_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        //     [
        //         'name' => 'Carrey',
        //         'firstname' => 'Jim',
        //         'birthdate' => 1962,
        //         'country_id' => 5,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]
        // ]);
    }
}
