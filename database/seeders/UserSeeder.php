<?php

namespace Database\Seeders;

use App\Enums\EmploymentType;
use App\Enums\Gender;
use App\Enums\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(\Faker\Generator::class);
        $province_ids = DB::table('provinces')->pluck('id')->toArray() ?? [1, 2, 3, 4, 5];

        for ($i = 2; $i < 100; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail(),
                'username' => $faker->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'province_ids' => $faker->randomElement($province_ids),
                'phone_number' => $faker->numerify('09########'),
                'password' => Hash::make('password'),
                'height' => $faker->randomNumber(3),
                'gender' => $faker->randomElement(Gender::cases())->value,
                'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years'),
                'hire_date' => $faker->dateTimeBetween('-10 years', 'now'),
                'manager_id' => rand(1, 10),
                'document_default_id' => rand(1, 10),
                'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
                'applicant' => rand(0, 1),
                'status' => $faker->randomElement(UserStatus::cases())->value,
            ]);
        }
    }
}
