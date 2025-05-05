<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Person;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = ['Work', 'Friends', 'Others'];

        for ($i = 0; $i < 50; $i++) {
            Person::create([
                'name'=> $faker->name,
                'email'=> $faker->unique()->safeEmail,
                'phone'=> $faker->phoneNumber,
                'category'=> $faker->randomElement($categories)
            ]);
        }
    }
}
