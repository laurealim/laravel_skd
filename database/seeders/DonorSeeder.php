<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donor;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

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
        $divArr = [3, 6];
        $distArr = [
            3 => [27, 29],
            6 => [41, 47, 51],
        ];
        $sub_distArr = [
            27 => [207, 211], // khulna
            29 => [224, 228], // jinaidha
            41 => [320, 318], // gazipur
            47 => [365, 369], // Dhaka
            51 => [385, 386, 387, 388, 389], // gopalganj
        ];
        $unionArr = [
            207 => [-1, 0, 1888, 1890],
            211 => [-1, 0, 1909, 1912, 1915, 1917, 1920],
            224 => [-1, 0, 2036, 2033, 2030, 2028, 2024, 2021],
            228 => [-1, 0, 2071, 2074],
            320 => [-1, 0, 2870, 2869, 2872, 2875],
            318 => [-1, 0, 2849, 2852, 2855],
            365 => [-1, 0, 3271, 3282, 3278, 3275, 3273],
            369 => [-1, 0, 3325, 3327, 3330, 3332],
            385 => [-1, 0, 3502, 3503, 3504, 3504, 3505, 3506, 3507, 3508, 3509, 3510, 3511, 3512, 3513, 3514, 3515, 3516, 3517, 3518, 3519, 3520, 3521, 3522],
            386 => [-1, 0, 3523, 3524, 3525, 3526, 3527, 3528, 3529, 3530, 3531, 3532, 3533, 3534, 3535, 3536],
            387 => [-1, 0, 3537, 3538, 3539, 3540, 3541],
            388 => [-1, 0, 3542, 3543, 3544, 3545, 3546, 3547, 3548, 3549, 3550, 3551, 3552],
            389 => [-1, 0, 3553, 3554, 3555, 3556, 3557, 3558, 3559, 3560, 3561, 3562, 3563, 3564, 3565, 3566, 3567, 3568],
        ];

        for ($i = 0; $i < 10000; $i++) {
            $randDiv = $faker->randomElement($divArr);
            $randDist = $faker->randomElement($distArr[$randDiv]);
            $randSubDist = $faker->randomElement($sub_distArr[$randDist]);
            $randUnion = $faker->randomElement($unionArr[$randSubDist]);
            Log::channel('donorlog')->error('Error: ' . $randDiv);
            Log::channel('donorlog')->error('Error: ' . $randDist);
            Log::channel('donorlog')->error('Error: ' . $randSubDist);
            Log::channel('donorlog')->error('Error: ' . $randUnion);
            Donor::create([
                'name' => $faker->name,
                'date_of_birth' => $faker->date('Y-m-d', '2024-12-31'),
                'division' => $randDiv,
                'district' => $randDist,
                'upazilla' => $randSubDist,
                'union' => $randUnion,
                'word' => $faker->numberBetween(1, 30),
                'address' => $faker->buildingNumber . ' ' . $faker->streetName . ' ' . $faker->streetAddress,
                'phone' => $faker->numerify('01#########'),
                'nid_or_birth_certificate' => $faker->randomElement([
                    $faker->numerify('##########'),
                    $faker->numerify('#############'),
                    $faker->numerify('#################')
                ]),
                'blood_group' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
                'gender' => $faker->randomElement(['male', 'female']),
            ]);
        }
    }
}
