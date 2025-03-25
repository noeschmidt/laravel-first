<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'title' => 'Interstallar',
                'year' => 2018,
                'director_id' => 1,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Oppenheimer',
                'year' => 2023,
                'director_id' => 2,
                'country_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Zoolander',
                'year' => 2002,
                'director_id' => 1,
                'country_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
