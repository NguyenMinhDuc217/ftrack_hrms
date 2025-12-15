<?php

namespace Database\Seeders;

use App\Enums\EmploymentType;
use App\Enums\Gender;
use App\Enums\UserRoles;
use App\Models\User;
use Artisan;
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
            'admin.users',
            'admin.users.show',
            'admin.users.update',
            'admin.users.changeDepartment',
            'admin.professions',
            'admin.role.index',
            'admin.permission.index',
            'admin.menu.index',
        ];

        foreach ($menu_permission as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => $guard]);
        }

        $super_admin = Role::firstOrCreate(['name' => UserRoles::SUPER_ADMIN->value, 'guard_name' => $guard]);
        $admin = Role::firstOrCreate(['name' => UserRoles::ADMIN->value, 'guard_name' => $guard]);
        $hr_manager = Role::firstOrCreate(['name' => UserRoles::HR_MANAGER->value, 'guard_name' => $guard]);

        $permissionAdmin = [
            'admin.dashboard',
            'admin.users.show',
            'admin.users.update',
            'admin.users.changeDepartment',
            'admin.users',
            'admin.professions',
            'admin.role.index',
            'admin.permission.index',
            'admin.menu.index',
        ];
        $super_admin->syncPermissions($permissionAdmin);
        $admin->syncPermissions($permissionAdmin);
        $hr_manager->syncPermissions([
            'admin.users.show',
            'admin.users.update',
            'admin.users.changeDepartment',
            'admin.users',
        ]);

        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'username' => 'admin',
                'first_name' => 'Admin',
                'last_name' => 'Super',
                'password' => Hash::make('password'),
                'phone_number' => $faker->numerify('09########'),
                'gender' => $faker->randomElement(Gender::cases())->value,
                'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years'),
                'hire_date' => $faker->dateTimeBetween('-10 years', 'now'),
                'manager_id' => 1,
                'document_default_id' => 1,
                'role_id' => 1,
                'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
                'applicant' => 0,
                'status' => 'active',
            ]
        );
        $superAdminUser->assignRole('super_admin');

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'username' => 'admin',
                'first_name' => 'Admin',
                'last_name' => 'Super',
                'password' => Hash::make('password'),
                'phone_number' => $faker->numerify('09########'),
                'gender' => $faker->randomElement(Gender::cases())->value,
                'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years'),
                'hire_date' => $faker->dateTimeBetween('-10 years', 'now'),
                'manager_id' => 1,
                'document_default_id' => 1,
                'role_id' => 1,
                'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
                'applicant' => 0,
                'status' => 'active',
            ]
        );

        $adminUser->assignRole('admin');

        $hrManager = User::firstOrCreate(
            ['email' => 'hr@example.com'],
            [
                'username' => 'hr',
                'first_name' => 'hr',
                'last_name' => '(test)',
                'password' => Hash::make('password'),
                'phone_number' => $faker->numerify('09########'),
                'gender' => $faker->randomElement(Gender::cases())->value,
                'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years'),
                'hire_date' => $faker->dateTimeBetween('-10 years', 'now'),
                'manager_id' => 1,
                'document_default_id' => 1,
                'role_id' => 2,
                'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
                'applicant' => 0,
                'status' => 'active',
            ]
        );

        $hrManager->assignRole('hr_manager');

        Artisan::call('permissions:sync-routes --assign-to-admin --middleware=check.permission');

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
