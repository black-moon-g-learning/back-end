<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    use GeneralFactory;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $questionIds= $this->getArrayIds('questions');

        return [
            'content' => $this->faker->sentence(rand(10, 40)),
            'question_id'=>$this->faker->randomElement($questionIds),
            'is_correct'=>$this->faker->boolean(),
            'image' => $this->faker->imageUrl('640', '480', 'animal', true),
        ];
    }
}
