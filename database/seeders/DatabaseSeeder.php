<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Character;
use App\Models\Continent;
use App\Models\Country;
use App\Models\CountryTopic;
use App\Models\GameLevel;
use App\Models\Question;
use App\Models\Role;
use App\Models\Service;
use App\Models\Target;
use App\Models\Topic;
use App\Models\Type;
use App\Models\User;
use App\Models\UserPlayGame;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Character::factory(3)->create();
        Target::factory(10)->create();

        Service::factory(1)->create();
        Continent::factory(5)->create();
        Country::factory(100)->create();

        Role::factory()->create([
            'name' => 'admin',
        ]);
        Role::factory()->create([
            'name' => 'contributor',
        ]);
        Role::factory()->create([
            'name' => 'user',
        ]);

        User::factory(100)->create();

        Topic::factory(30)->create();
        CountryTopic::factory(200)->create();
        Video::factory(300)->create();
        Type::factory(6)->create();
        GameLevel::factory(3)->create();
        Question::factory(67)->create();
        Answer::factory(140)->create();
        UserPlayGame::factory(131)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
