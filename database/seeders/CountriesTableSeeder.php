<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            [
                'name' => 'Japan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'France',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'United States',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Switzerland',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Germany',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Canada',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Australia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'India',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
