<?php

namespace Database\Seeders;

use App\Enums\EmploymentType;
use App\Enums\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(\Faker\Generator::class);

        for ($i = 2; $i < 100; $i++) {
            DB::table('users')->insert([
               'username' => $faker->userName,
               'first_name' => $faker->firstName,
               'last_name' => $faker->lastName,
               'email' => $faker->unique()->email,
               'password' => Hash::make('password'),
               'phone_number' => rand(1000000000, 9999999999),
               'gender' => $faker->randomElement(['Male', 'Female']),
               'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years'),
               'hire_date' => $faker->dateTimeBetween('-10 years', 'now'),
               'department_id' => rand(1,2),
               'manager_id' => rand(1,10),
               'document_id' => rand(1,10),
               'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
               'applicant' => rand(0,1),
               'status' => $faker->randomElement(UserStatus::cases())->value,
           ]);
        }
    }
}
