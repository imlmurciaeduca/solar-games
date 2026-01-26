<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'synopsis' => fake()->text(),
            'developer' => fake()->company(),
            'publisher' => fake()->company(),
            'release_year' => fake()->year(),
            'genre_id' => Genre::inRandomOrder()->first()->id
        ];
    }
}
