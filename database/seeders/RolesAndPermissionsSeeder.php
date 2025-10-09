<?php

namespace Database\Seeders;

use App\Enums\EmploymentType;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Faker $faker */
        $faker = app(Faker::class);


        // Xóa cache permission/role trước khi seed
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $guard = 'web';

        $menu_permission = [
            'admin.dashboard',
            'admin.user',
        ];

        foreach ($menu_permission as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => $guard]);
        }

        $super_admin        = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => $guard]);
        $hr_manager         = Role::firstOrCreate(['name' => 'hr_manager', 'guard_name' => $guard]);

        $super_admin->syncPermissions(['admin.dashboard', 'admin.user']);
        $hr_manager->syncPermissions(['admin.user']);


        $superAdminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'username'       => 'admin',
                'first_name'     => 'Admin',
                'last_name'      => 'Super',
                'password'       => Hash::make('password'),
                'phone_number'   => $faker->numerify('09########'),
                'gender'         => 'Female',
                'date_of_birth'  => $faker->dateTimeBetween('-50 years', '-18 years'),
                'hire_date'      => $faker->dateTimeBetween('-10 years', 'now'),
                'department_id'  => 1,
                'manager_id'     => 1,
                'document_id'    => 1,
                'role_id'        => 1,
                'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
                'applicant'      => 0,
                'status'         => 'Active',
            ]
        );

        $superAdminUser->assignRole('super_admin');


        $hrManager = User::firstOrCreate(
            ['email' => 'hr@example.com'],
            [
                'username'       => 'hr',
                'first_name'     => 'hr',
                'last_name'      => '(test)',
                'password'       => Hash::make('password'),
                'phone_number'   => $faker->numerify('09########'),
                'gender'         => 'Female',
                'date_of_birth'  => $faker->dateTimeBetween('-50 years', '-18 years'),
                'hire_date'      => $faker->dateTimeBetween('-10 years', 'now'),
                'department_id'  => 1,
                'manager_id'     => 1,
                'document_id'    => 1,
                'role_id'        => 2,
                'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
                'applicant'      => 0,
                'status'         => 'Active',
            ]
        );

        $hrManager->assignRole('hr_manager');

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
