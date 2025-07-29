<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Faker\Factory as Faker;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Faker::create();

        // 3 Past Events
        foreach (range(1, 3) as $i) {
            Event::create([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'date' => Carbon::now()->subDays(rand(1, 10))->toDateString(),
                'time' => $faker->time(),
                'location' => $faker->city,
            ]);
        }

        // 3 Today's Events
        foreach (range(1, 3) as $i) {
            Event::create([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'date' => Carbon::today()->toDateString(),
                'time' => $faker->time(),
                'location' => $faker->city,
            ]);
        }

        // 3 Future Events
        foreach (range(1, 3) as $i) {
            Event::create([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'date' => Carbon::now()->addDays(rand(1, 10))->toDateString(),
                'time' => $faker->time(),
                'location' => $faker->city,
            ]);
        }
    }
}
