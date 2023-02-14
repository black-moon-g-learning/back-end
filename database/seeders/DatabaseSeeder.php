<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Constants\Role as ConstantsRole;
use App\Models\Answer;
use App\Models\Character;
use App\Models\Continent;
use App\Models\Contribute;
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
use Illuminate\Support\Facades\Storage;

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

        $data = json_decode(Storage::disk('local')->get('dev-data.json'));

        $index = 1;

        foreach ($data as $continent) {
            Continent::factory()->create([
                'name' => $continent->name,
                'description' => fake()->paragraphs(2, true),
                'image' => fake()->imageUrl('640', '480', 'animal', true),
                'quantity_countries' => rand(2, 100),
                'quantity_regions' => rand(1, 8)
            ]);
            foreach ($continent->countries as $country) {

                Country::factory()->create([
                    'name' => $country->name,
                    'description' => fake()->paragraphs(2, true),
                    'continent_id' => $index,
                    'place' => rand(1, 196),
                    'image' => $country->image
                ]);
            }
            $index++;
        }


        $data = ["Africa", "Oceania", "Americas", "Antarctic"];

        foreach ($data as $continent) {
            Continent::factory()->create([
                'name' => $continent,
                'description' => fake()->paragraphs(2, true),
                'image' => fake()->imageUrl('640', '480', 'animal', true),
                'quantity_countries' => rand(2, 100),
                'quantity_regions' => rand(1, 8)
            ]);
        }

        Role::factory()->create([
            'name' => 'admin',
        ]);
        Role::factory()->create([
            'name' => 'contributor',
        ]);
        Role::factory()->create([
            'name' => 'user',
        ]);

        User::factory()->create([
            'username' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role_id' => ConstantsRole::ADMIN_ROLE
        ]);
        User::factory(100)->create();

        Topic::factory(5)->create();

        for ($j = 1; $j <= Topic::count(); $j++) {
            for ($i = 1; $i <= Country::count(); $i++) {
                CountryTopic::factory()->create([
                    'country_id' => $i,
                    'topic_id' => $j
                ]);
            }
        }

        for ($i = 1; $i <= CountryTopic::count() / 3; $i++) {
            Video::factory(5)->create(
                ['country_topic_id' => $i]
            );
        }


        Type::factory(6)->create();
        GameLevel::factory(3)->create();
        Question::factory(200)->create();
        Answer::factory(140)->create();
        UserPlayGame::factory(131)->create();

        Contribute::factory(200)->create();
    }
}
