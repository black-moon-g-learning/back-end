<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    use GeneralFactory;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $genders = ['MALE', 'FEMALE', 'OTHER'];
        $characterId = DB::table('characters')->inRandomOrder()->first()->id;
        $targetId = DB::table('targets')->inRandomOrder()->first()->id;

        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '091754' . $this->faker->numberBetween(100, 999),
            'age' => rand(1, 99),
            'gender' => $genders[rand(0, 2)],
            'country_id' => $this->getCountryId(),
            'character_id' => $characterId,
            'target_id' => $targetId,
            'role_id' => rand(1, 3),
            'provider_id' => 2,
            'image' => $this->faker->imageUrl('640', '480', 'animal', true),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
