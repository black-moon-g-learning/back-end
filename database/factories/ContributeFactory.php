<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contribute>
 */
class ContributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $countryIds = DB::table('countries')->pluck('id');
        $userIds = DB::table('users')->pluck('id');

        return [
            'title' => $this->faker->text(200),
            'description' => $this->faker->paragraphs(2, true),
            'image' => 'https://i.ytimg.com/vi/FJH_nn1rMoI/maxresdefault.jpg',
            'video' => 'https://www.youtube.com/watch?v=og_1u8RFmuI&ab_channel=Voogie',
            'country_id' => $this->faker->randomElement($countryIds),
            'owner_id' => $this->faker->randomElement($userIds)
        ];
    }
}
