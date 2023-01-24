<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
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
        $videoIds = $this->getVideosId();
        $typeIds = $this->getArrayIds('types');
        $levelIds = $this->getArrayIds('levels');

        return [
            'content' => $this->faker->sentence(rand(10, 40)),
            'country_id' => $this->faker->randomElement($countryIds),
            'video_id' => $this->faker->randomElement($videoIds),
            'type_id' => $this->faker->randomElement($typeIds),
            'level_id' => $this->faker->randomElement($levelIds),
            'image' => $this->faker->imageUrl('640', '480', 'animal', true),
        ];
    }
}
