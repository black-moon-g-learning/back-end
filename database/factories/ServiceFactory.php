<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraphs(2,true),
            'image' => $this->faker->imageUrl('640', '480', 'animal', true),
            'price' => $this->faker->numberBetween(1, 321) . '000'
        ];
    }
}
