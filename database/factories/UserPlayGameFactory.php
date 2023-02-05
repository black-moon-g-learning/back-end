<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPlayGame>
 */
class UserPlayGameFactory extends Factory
{
    use GeneralFactory;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $countryIds=$this->getCountryIds();

        return [
            'user_id'=>rand(2,3),
            'country_id'=>$this->faker->randomElement($countryIds),
            'percent'=>$this->faker->numberBetween(1,100)
        ];
    }
}
