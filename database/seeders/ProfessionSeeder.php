<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('professions')->insert([
            // Field force
            [
                'profession_name' => 'Sales',
                'slug' => 'sales',
                'description' => 'Nhân viên kinh doanh GT / Nhân viên kinh doanh MT',
                'type' => 'Field Force',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Merchandising',
                'slug' => 'merchandising',
                'description' => 'Nhân viên trưng bày (Merchandiser)',
                'type' => 'Field Force',
                'status' => 'active',
            ],
            [
                'profession_name' => 'POSM',
                'slug' => 'posm',
                'description' => 'Nhân viên lắp đặt POSM',
                'type' => 'Field Force',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Audit',
                'slug' => 'audit',
                'description' => 'Audit, survey, cencus',
                'type' => 'Field Force',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Activation / PG-PB',
                'slug' => 'activation-pg-pb',
                'description' => 'PG / Brand Ambassador / Activation Staff',
                'type' => 'Field Force',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Mystery Shopper',
                'slug' => 'mystery-shopper',
                'description' => 'Mystery Shopper',
                'type' => 'Field Force',
                'status' => 'active',
            ],
            // Back office
            [
                'profession_name' => 'Human Resource',
                'slug' => 'human-resource',
                'description' => 'HR Admin / C&B / Talent Acquisition/ training',
                'type' => 'Back Office',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Nhân viên hành chính / Lễ tân',
                'type' => 'Back Office',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Accounting/Finance',
                'slug' => 'accounting-finance',
                'description' => 'Kế toán thanh toán / Kế toán công nợ / Finance Executive',
                'type' => 'Back Office',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Marketing / Trade MKT',
                'slug' => 'marketing-trade-mkt',
                'description' => 'Trade Marketing Executive / Marketing Executive',
                'type' => 'Back Office',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Client Service & Project',
                'slug' => 'client-service-project',
                'description' => 'Project Assistant / Project, Manager/Account Manager, Sales Admin, DC, QC',
                'type' => 'Back Office',
                'status' => 'active',
            ],
            [
                'profession_name' => 'IT / Data',
                'slug' => 'it-data',
                'description' => 'IT Support / Data Analyst/ UX-UI/PHP',
                'type' => 'Back Office',
                'status' => 'active',
            ],
            [
                'profession_name' => 'Design',
                'slug' => 'design',
                'description' => '2D/ 3D',
                'type' => 'Back Office',
                'status' => 'active',
            ],
        ]);
    }
}
