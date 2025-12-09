<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Organization::create([
            'name' => 'Demo Organization',
            'slug' => 'demo',
            'description' => 'Demo organization for testing',
            'email' => 'demo@organization.com',
            'phone_number' => '0900000000',
            'address' => 'Demo Address',
            'logo' => 'demo-logo.png',
            'status' => 'active',
        ]);
    }
}
