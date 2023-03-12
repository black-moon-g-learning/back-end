<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AddCountries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(Storage::disk('local')->get('data.json'));

        $index = 3;
        foreach ($data as $continent) {

            if (in_array($continent->name, ['Africa', 'Oceania', 'Americas', 'Antarctic'])) {
                foreach ($continent->countries as $country) {
                    Country::factory()->create([
                        'name' => $country->name,
                        'description' => fake()->paragraphs(1, true),
                        'continent_id' => $index,
                        'place' => rand(1, 196),
                        'image' => $country->image
                    ]);
                }
                $index++;
            }
        }
    }
}
