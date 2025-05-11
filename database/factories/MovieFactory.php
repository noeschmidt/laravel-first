<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Country;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(rand(2, 5), true),
            'year' => $this->faker->year(),
            'country_id' => Country::inRandomOrder()->first()->id, 
            'director_id' => Artist::inRandomOrder()->first()->id, 
            'poster_path' => null, 
        ];
    }
}
