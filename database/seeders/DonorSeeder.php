<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donor;
use Faker\Factory as Faker;

class DonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 7000; $i++) {
            Donor::create([
                'name' => $faker->name,
                'date_of_birth' => $faker->date('Y-m-d', '2024-12-31'),
                'division' => $faker->numberBetween(1, 8),
                'district' => $faker->numberBetween(1, 64),
                'upazilla' => $faker->numberBetween(1, 491),
                'union' => $faker->numberBetween(1, 4539),
                'word' => $faker->numberBetween(1, 30),
                'house_no' => $faker->buildingNumber,
                'road_no' => $faker->streetAddress,
                'phone' => $faker->numerify('01#########'),
                'nid_or_birth_certificate' => $faker->randomElement([
                    $faker->numerify('##########'),
                    $faker->numerify('#############'),
                    $faker->numerify('#################')
                ]),
                'blood_group' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            ]);
        }
    }
}
