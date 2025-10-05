<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
         $permissions = [
            'articles.view',
            'articles.create',
            'articles.edit',
            'articles.publish',
            'articles.delete',
            'users.view',
            'users.manage',
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
        }

        // 2) Tạo roles và gán permissions cho role
        $writer = Role::firstOrCreate(['name' => 'writer']);
        $writer->syncPermissions([
            'articles.view',
            'articles.create',
            'articles.edit',
        ]);

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'articles.view',
            'articles.edit',
            'articles.publish',
        ]);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions($permissions); // full quyền ở trên

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        // super-admin có thể được handle qua Gate::before (tuỳ bạn, ví dụ dưới)

        // 3) (Tuỳ chọn) Tạo vài user mẫu & gán role
        // Giả sử bạn có UserFactory đã hoạt động
        if (User::count() === 0) {
            $u1 = User::factory()->create([
                'name' => 'Alice Writer',
                'email' => 'writer@example.com',
            ]);
            $u1->assignRole('writer');

            $u2 = User::factory()->create([
                'name' => 'Evan Editor',
                'email' => 'editor@example.com',
            ]);
            $u2->assignRole('editor');

            $u3 = User::factory()->create([
                'name' => 'Andy Admin',
                'email' => 'admin@example.com',
            ]);
            $u3->assignRole('admin');

            $u4 = User::factory()->create([
                'name' => 'Sam Super',
                'email' => 'super@example.com',
            ]);
            $u4->assignRole('super-admin');
    }
}
}
