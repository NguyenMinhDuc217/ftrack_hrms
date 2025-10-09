<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
class MenuSeeder extends Seeder
{
    protected string $guard = 'web';

    public function run(): void
    {
        $tree = [
            // Dashboard
            [
                'label'      => 'Dashboard',
                'slug'       => 'dashboard',
                'type'       => 'route',
                'route_name' => 'admin.dashboard',
                'icon'       => 'ti ti-home',
                'position'   => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Users
            [
                'label'      => 'Users',
                'slug'       => 'users',
                'type'       => 'route',
                'route_name' => 'admin.users',
                'icon'       => 'ti ti-users',
                'position'   => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Roles
            [
                'label'      => 'Roles',
                'slug'       => 'roles',
                'type'       => 'route',
                'route_name' => 'admin.role.index',
                'icon'       => 'ti ti-key',
                'position'   => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Permissions
            [
                'label'      => 'Permission',
                'slug'       => 'permission',
                'type'       => 'route',
                'route_name' => 'admin.permission.index',
                'icon'       => 'ti ti-key',
                'position'   => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],


            // Menus
            [
                'label'      => 'Menus',
                'slug'       => 'menus',
                'type'       => 'route',
                'route_name' => 'admin.menu.index',
                'icon'       => 'ti ti-key',
                'position'   => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Menu::insert($tree);
    }
}
