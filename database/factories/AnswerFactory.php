<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait GeneralFactory
{

    /**
     * @return Collection
     */
    public function getCountryIds(): Collection
    {
        return DB::table('countries')->pluck('id');
    }

    public function getCountryId(): int
    {
        return DB::table('countries')->inRandomOrder()->first()->id;
    }

    /**
     * @return Collection
     */
    public function getTopicIds(): Collection
    {
        return DB::table('topics')->pluck('id');
    }

    /**
     * @return Collection
     */
    public function getVideosId(): Collection
    {
        return DB::table('videos')->pluck('id');
    }

    /**
     * @param string $tableName
     * @return Collection
     */
    public function getArrayIds(string $tableName):Collection{
        return DB::table($tableName)->pluck('id');
    }

}

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
