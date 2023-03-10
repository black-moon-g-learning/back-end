<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $continentIDs = DB::table('continents')->pluck('id');

        return [
            'name' => $this->faker->country(),
            'description' => $this->faker->paragraphs(2, true),
            'continent_id' => $this->faker->randomElement($continentIDs),
            'place' => $this->faker->numberBetween(1, 195),
            'image' => $this->faker->imageUrl('640', '480', 'country', true)
        ];
    }
}
