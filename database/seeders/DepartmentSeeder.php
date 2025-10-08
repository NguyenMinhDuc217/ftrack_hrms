<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            //Field force
            [
                'department_name' => 'Sales',
                'description' => 'Nhân viên kinh doanh GT / Nhân viên kinh doanh MT',
                'type' => 'Field Force',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Merchandising',
                'description' => 'Nhân viên trưng bày (Merchandiser)',
                'type' => 'Field Force',
                'status' => 'Active',
            ],
            [
                'department_name' => 'POSM',
                'description' => 'Nhân viên lắp đặt POSM',
                'type' => 'Field Force',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Audit',
                'description' => 'Audit, survey, cencus',
                'type' => 'Field Force',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Activation / PG-PB',
                'description' => 'PG / Brand Ambassador / Activation Staff',
                'type' => 'Field Force',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Mystery Shopper',
                'description' => 'Mystery Shopper',
                'type' => 'Field Force',
                'status' => 'Active',
            ],
            // Back office
            [
                'department_name' => 'Human Resource',
                'description' => 'HR Admin / C&B / Talent Acquisition/ training',
                'type' => 'Back Office',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Admin',
                'description' => 'Nhân viên hành chính / Lễ tân',
                'type' => 'Back Office',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Accounting/Finance',
                'description' => 'Kế toán thanh toán / Kế toán công nợ / Finance Executive',
                'type' => 'Back Office',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Marketing / Trade MKT',
                'description' => 'Trade Marketing Executive / Marketing Executive',
                'type' => 'Back Office',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Client Service & Project',
                'description' => 'Project Assistant / Project, Manager/Account Manager, Sales Admin, DC, QC',
                'type' => 'Back Office',
                'status' => 'Active',
            ],
            [
                'department_name' => 'IT / Data',
                'description' => 'IT Support / Data Analyst/ UX-UI/PHP',
                'type' => 'Back Office',
                'status' => 'Active',
            ],
            [
                'department_name' => 'Design',
                'description' => '2D/ 3D',
                'type' => 'Back Office',
                'status' => 'Active',
            ],
        ]);
    }
}
