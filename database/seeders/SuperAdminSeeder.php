<?php

namespace Database\Seeders;

use App\Enums\EmploymentType;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $faker = app(\Faker\Generator::class);
        $user = User::firstOrCreate(
            [
                'username' => 'admin',
                'first_name' => 'Admin',
                'last_name' => 'Super',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'phone_number' => rand(1000000000, 9999999999),
                'gender' => 'Female',
                'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years'),
                'hire_date' => $faker->dateTimeBetween('-10 years', 'now'),
                'department_id' => rand(1, 2),
                'manager_id' => rand(1, 10),
                'document_id' => rand(1, 10),
                'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
                'applicant' => rand(0, 1),
                'status' => 'Active',
            ]
        );

        $user->assignRole($superAdminRole);
    }
}
