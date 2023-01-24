<?php

namespace Database\Factories;

use App\Models\CountryTopic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<CountryTopic>
 */
class CountryTopicFactory extends Factory
{
    use GeneralFactory;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $countryIds = $this->getCountryIds();
        $topicIds = $this->getTopicIds();

        return [
            'country_id' => $this->faker->randomElement($countryIds),
            'topic_id' => $this->faker->randomElement($topicIds)
        ];
    }
}
