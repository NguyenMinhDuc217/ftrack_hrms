<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class MenuSeeder extends Seeder
{
    protected string $guard = 'web';

    public function run(): void
    {
        DB::transaction(function () {
            $tree = [
                // Dashboard
                [
                    'label'      => 'Dashboard',
                    'slug'       => 'dashboard',
                    'type'       => 'route',
                    'route'      => 'dashboard.index',
                    'icon'       => 'ti ti-home',
                    'position'   => 1,
                    'menu_perms' => ['menu.dashboard'],
                    'children'   => [],
                ],

                // Users
                [
                    'label'      => 'Users',
                    'slug'       => 'users',
                    'type'       => 'route',
                    'route'      => 'users.index',
                    'icon'       => 'ti ti-users',
                    'position'   => 10,
                    'menu_perms' => ['menu.users'],
                    'children'   => [
                        [
                            'label'    => 'All Users',
                            'slug'     => 'users.index',
                            'type'     => 'route',
                            'route'    => 'users.index',
                            'position' => 1,
                            'perms'    => ['users.view'],
                        ],
                        [
                            'label'    => 'Create User',
                            'slug'     => 'users.create',
                            'type'     => 'route',
                            'route'    => 'users.create',
                            'position' => 2,
                            'perms'    => ['users.create'],
                        ],
                    ],
                ],

                // Departments
                [
                    'label'      => 'Departments',
                    'slug'       => 'departments',
                    'type'       => 'route',
                    'route'      => 'departments.index',
                    'icon'       => 'ti ti-building',
                    'position'   => 20,
                    'menu_perms' => ['menu.departments'],
                    'children'   => [
                        [
                            'label'    => 'All Departments',
                            'slug'     => 'departments.index',
                            'type'     => 'route',
                            'route'    => 'departments.index',
                            'position' => 1,
                            'perms'    => ['departments.view'],
                        ],
                        [
                            'label'    => 'Create Department',
                            'slug'     => 'departments.create',
                            'type'     => 'route',
                            'route'    => 'departments.create',
                            'position' => 2,
                            'perms'    => ['departments.create'],
                        ],
                    ],
                ],

                // Jobs
                [
                    'label'      => 'Jobs',
                    'slug'       => 'jobs',
                    'type'       => 'route',
                    'route'      => 'jobs.index',
                    'icon'       => 'ti ti-briefcase',
                    'position'   => 30,
                    'menu_perms' => ['menu.jobs'],
                    'children'   => [
                        [
                            'label'    => 'All Jobs',
                            'slug'     => 'jobs.index',
                            'type'     => 'route',
                            'route'    => 'jobs.index',
                            'position' => 1,
                            'perms'    => ['jobs.view'],
                        ],
                        [
                            'label'    => 'Create Job',
                            'slug'     => 'jobs.create',
                            'type'     => 'route',
                            'route'    => 'jobs.create',
                            'position' => 2,
                            'perms'    => ['jobs.create'],
                        ],
                    ],
                ],

                // Applications
                [
                    'label'      => 'Applications',
                    'slug'       => 'applications',
                    'type'       => 'route',
                    'route'      => 'applications.index',
                    'icon'       => 'ti ti-file-text',
                    'position'   => 40,
                    'menu_perms' => ['menu.applications'],
                    'children'   => [
                        [
                            'label'    => 'All Applications',
                            'slug'     => 'applications.index',
                            'type'     => 'route',
                            'route'    => 'applications.index',
                            'position' => 1,
                            'perms'    => ['applications.view'],
                        ],
                    ],
                ],

                // User Documents
                [
                    'label'      => 'User Documents',
                    'slug'       => 'user-documents',
                    'type'       => 'route',
                    'route'      => 'user-documents.my',
                    'icon'       => 'ti ti-folder',
                    'position'   => 50,
                    'menu_perms' => ['menu.user_documents'],
                    'children'   => [
                        [
                            'label'    => 'My Documents',
                            'slug'     => 'user-documents.my',
                            'type'     => 'route',
                            'route'    => 'user-documents.my',
                            'position' => 1,
                            'perms'    => ['user_documents.view'],
                        ],
                        [
                            'label'    => 'Upload',
                            'slug'     => 'user-documents.create',
                            'type'     => 'route',
                            'route'    => 'user-documents.create',
                            'position' => 2,
                            'perms'    => ['user_documents.upload'],
                        ],
                    ],
                ],

                // Area Applications
                [
                    'label'      => 'Area Applications',
                    'slug'       => 'area-applications',
                    'type'       => 'route',
                    'route'      => 'area-applications.index',
                    'icon'       => 'ti ti-map-pin',
                    'position'   => 60,
                    'menu_perms' => ['menu.area_applications'],
                    'children'   => [
                        [
                            'label'    => 'All Areas',
                            'slug'     => 'area-applications.index',
                            'type'     => 'route',
                            'route'    => 'area-applications.index',
                            'position' => 1,
                            'perms'    => ['area_applications.view'],
                        ],
                        [
                            'label'    => 'Create Area',
                            'slug'     => 'area-applications.create',
                            'type'     => 'route',
                            'route'    => 'area-applications.create',
                            'position' => 2,
                            'perms'    => ['area_applications.create'],
                        ],
                    ],
                ],

                // Reports
                [
                    'label'      => 'Reports',
                    'slug'       => 'reports',
                    'type'       => 'route',
                    'route'      => 'reports.index',
                    'icon'       => 'ti ti-chart-bar',
                    'position'   => 70,
                    'menu_perms' => ['menu.reports'],
                    'children'   => [],
                ],

                // Settings
                [
                    'label'      => 'Settings',
                    'slug'       => 'settings',
                    'type'       => 'route',
                    'route'      => 'settings.index',
                    'icon'       => 'ti ti-settings',
                    'position'   => 80,
                    'menu_perms' => ['menu.settings'],
                    'children'   => [],
                ],
            ];

            foreach ($tree as $node) {
                $parent = $this->upsertMenu($node);
                $this->attachPermissions($parent, $node['menu_perms'] ?? []);

                foreach ($node['children'] as $child) {
                    $childModel = $this->upsertMenu($child, $parent->id);
                    $this->attachPermissions($childModel, $child['perms'] ?? []);
                }
            }
        });
    }

    protected function upsertMenu(array $data, ?int $parentId = null): Menu
    {
        return Menu::updateOrCreate(
            ['slug' => $data['slug']],
            [
                'label'      => $data['label'],
                'type'       => $data['type'] ?? 'route',
                'route_name' => ($data['type'] ?? 'route') === 'route' ? ($data['route'] ?? null) : null,
                'url'        => ($data['type'] ?? 'route') === 'url'   ? ($data['url'] ?? null)   : null,
                'icon'       => $data['icon'] ?? null,
                'badge'      => $data['badge'] ?? null,
                'parent_id'  => $parentId,
                'position'   => $data['position'] ?? 0,
                'is_active'  => $data['is_active'] ?? true,
                'guard_name' => $this->guard,
            ]
        );
    }

    protected function attachPermissions(Menu $menu, array $permissionNames): void
    {
        if (empty($permissionNames)) {
            return;
        }

        $ids = Permission::query()
            ->whereIn('name', $permissionNames)
            ->where('guard_name', $this->guard)
            ->pluck('id')
            ->all();

        // Gắn mà không làm mất các permission khác đã gắn trước đó
        $menu->permissions()->syncWithoutDetaching($ids);
    }
}
