<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $countryTopicIds = DB::table('countries_topics')->pluck('id');
        $userIds = DB::table('users')->where('role_id', '=', 2)->pluck('id');

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraphs(2, true),
            'country_topic_id' => $this->faker->randomElement($countryTopicIds),
            'url' => 'https://www.youtube.com/watch?v=6NdqgBzFEsM&ab_channel=AseanCity',
            'owner_id' => $this->faker->randomElement($userIds),
            'time' => rand(5, 300),
            'image' => 'https://study.com/cimages/videopreview/p3c2j8y73a.jpg'
        ];
    }
}
