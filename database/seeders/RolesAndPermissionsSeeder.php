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
        // Xóa cache permission/role trước khi seed
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $guard = 'web';

        /**
         * ===========================================================
         * 1) KHAI BÁO PERMISSIONS
         * ===========================================================
         */

        // Domain permissions
        $domainPermissions = [
            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'users.manage_status',
            'users.reset_password',
            'users.assign_role',

            // Departments
            'departments.view',
            'departments.create',
            'departments.edit',
            'departments.delete',

            // User Documents
            'user_documents.view',
            'user_documents.upload',
            'user_documents.edit',
            'user_documents.delete',
            'user_documents.approve',
            'user_documents.download',

            // Job Management
            'jobs.view',
            'jobs.create',
            'jobs.edit',
            'jobs.delete',
            'jobs.publish',
            'jobs.archive',

            // Applications
            'applications.view',
            'applications.manage',
            'applications.approve',
            'applications.reject',
            'applications.delete',

            // Area Applications
            'area_applications.view',
            'area_applications.create',
            'area_applications.edit',
            'area_applications.delete',

            // System & Settings
            'system.view_logs',
            'system.manage_settings',
            'system.manage_permissions',
            'system.backup',
            'system.restore',


            // Menu permissions (để điều khiển hiển thị menu)
            'menu.dashboard',
            'menu.users',
            'menu.departments',
            'menu.jobs',
            'menu.applications',
            'menu.user_documents',
            'menu.area_applications',
            'menu.reports',
            'menu.settings',
        ];



        // Tạo tất cả permissions (domain + menu)
        $allPermissions = array_values(array_unique($domainPermissions));
        foreach ($allPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => $guard]);
        }

        /**
         * ===========================================================
         * 2) KHAI BÁO ROLE & GÁN PERMISSIONS
         * ===========================================================
         */

        // a) super-admin: full quyền (domain + menu)
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => $guard]);
        $superAdminRole->syncPermissions($allPermissions);

        // b) admin: giống super-admin (tuỳ bạn có thể thu hẹp sau)
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => $guard]);
        $adminRole->syncPermissions($allPermissions);

        // c) HR Manager: quyền quản lý tuyển dụng (không có system.* & menu.settings)
        $hrManagerPermissions = [
            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.manage_status',

            // Departments
            'departments.view',
            'departments.create',
            'departments.edit',

            // User Documents
            'user_documents.view',
            'user_documents.upload',
            'user_documents.edit',
            'user_documents.delete',
            'user_documents.approve',
            'user_documents.download',

            // Job
            'jobs.view',
            'jobs.create',
            'jobs.edit',
            'jobs.delete',
            'jobs.publish',
            'jobs.archive',

            // Applications
            'applications.view',
            'applications.manage',
            'applications.approve',
            'applications.reject',
            'applications.delete',

            // Area Applications
            'area_applications.view',
            'area_applications.create',
            'area_applications.edit',

            // Menu
            'menu.dashboard',
            'menu.jobs',
            'menu.applications',
            'menu.user_documents',
            'menu.departments',
            'menu.reports',
        ];
        $hrManager = Role::firstOrCreate(['name' => 'hr_manager', 'guard_name' => $guard]);
        $hrManager->syncPermissions($hrManagerPermissions);

        // d) user: quyền cơ bản (own-data) + menu tối thiểu
        $userPermissions = [
            // Users (own)
            'users.view',
            'users.edit',

            // Departments
            'departments.view',

            // User Documents (own)
            'user_documents.view',
            'user_documents.upload',
            'user_documents.edit',
            'user_documents.delete',
            'user_documents.download',

            // Jobs & Applications (own)
            'jobs.view',
            'applications.view',

            // Area Applications
            'area_applications.view',

            // Menu
            'menu.dashboard',
            'menu.jobs',
            'menu.applications',
            'menu.user_documents',
            'menu.departments',
        ];
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => $guard]);
        $userRole->syncPermissions($userPermissions);

        /**
         * ===========================================================
         * 3) TẠO SUPER ADMIN USER MẶC ĐỊNH & GÁN ROLE
         * ===========================================================
         */
        /** @var Faker $faker */
        $faker = app(Faker::class);

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
                'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
                'applicant'      => 0,
                'status'         => 'Active',
            ]
        );

        if (!$superAdminUser->hasRole($superAdminRole->name)) {
            $superAdminUser->assignRole($superAdminRole);
        }

        // Clear cache lần cuối để chắc chắn ghi nhận thay đổi
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
