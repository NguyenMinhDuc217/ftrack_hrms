<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            RolesAndPermissionsSeeder::class,
            MenuSeeder::class
        ]);
        User::factory(100)->create();
    }
}
