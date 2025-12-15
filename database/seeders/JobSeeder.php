<?php

namespace Database\Seeders;

use App\Enums\EmploymentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(\Faker\Generator::class);
        $profession_ids = DB::table('professions')->pluck('profession_id')->toArray() ?? [1, 2];
        $province_ids = DB::table('provinces')->pluck('id')->toArray() ?? [1, 2];
        $ward_ids = DB::table('wards')->pluck('id')->toArray() ?? [1, 2];

        DB::table('jobs_hrms')->insert([
            'name' => 'NHÂN VIÊN TREO BANNER - HANGER - POSTER TẾT KÊNH TẠP HÓA, QUÁN ĂN',
            'profession_id' => $faker->randomElement($profession_ids),
            'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
            'description_md' => '💰 LƯƠNG từ 500k lên tới 1 TRIỆU/ Ngày hoặc hơn chỉ với 3 bước đơn giản:
                    👉 Bước 1: Treo banner/hanger/dán poster tại cửa hàng (khoảng 30–50 cửa hàng/ngày trong khu vực được phân công)
                    👉 Bước 2: Tặng quà cho cửa hàng
                    👉 Bước 3: Chụp hình cửa hàng và báo cáo trên điện thoại
                    ⏰THỜI GIAN LÀM VIỆC: trong khung giờ 8h30-18h hàng ngày và làm thêm cuối tuần.
                    - Có nhận Cộng tác viên thực hiện theo dự án hàng tháng
                    - Phù hợp cho các bạn: sinh viên, tài xế công nghệ, shipper hoặc các bạn đang muốn có thu nhập ngoài công việc chính.
                    * Ưu tiên ứng viên hiện đang là nhân viên thị trường (có thể là sale của các nhãn hàng) ứng tuyển.',
            'requirements_md' => '- Không yêu cầu kinh nghiệm - được đào tạo, hướng dẫn
                    - Có xe máy và điện thoại smartphone hệ điều hành Android
                    - Thông thạo đường xá địa bàn
                    - Nhanh nhẹn, trung thực, siêng năng và chịu khó (ưu tiên có kinh nghiệm thị trường)',
            'min_salary' => $faker->numberBetween(1000000, 100000000),
            'max_salary' => $faker->numberBetween(1000000, 100000000),
            'currency' => $faker->randomElement(['VND', 'USD']),
            'start_date' => $faker->date('Y-m-d'),
            'end_date' => $faker->date('Y-m-d'),
            'experience' => $faker->randomElement(['Dưới 1 năm', '1-2 năm', '2-3 năm', '3-5 năm', '5-10 năm', 'Trên 10 năm']),
            'status' => $faker->randomElement([0, 1]),
        ]);
        DB::table('jobs_hrms')->insert([
            'name' => 'CHUYÊN VIÊN KHẢO SÁT THỊ TRƯỜNG',
            'profession_id' => $faker->randomElement($profession_ids),
            'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
            'description_md' => '- Khảo sát thông tin tại các cửa hàng & NPP theo tuyến được giao
                    - Thực hiện khảo sát theo checklist/hướng dẫn của quản lý
                    - Báo cáo kết quả trên hệ thống
                    - Có thể đi công tác các tỉnh lân cận',
            'requirements_md' => '- Từ 5 năm kinh nghiệm liên quan ngành FMCG
                    - Chủ động, di chuyển linh hoạt, làm việc độc lập
                    - Có xe máy & điện thoại smartphone',
            'min_salary' => $faker->numberBetween(1000000, 100000000),
            'max_salary' => $faker->numberBetween(1000000, 100000000),
            'currency' => $faker->randomElement(['VND', 'USD']),
            'start_date' => $faker->date('Y-m-d'),
            'end_date' => $faker->date('Y-m-d'),
            'experience' => $faker->randomElement(['Dưới 1 năm', '1-2 năm', '2-3 năm', '3-5 năm', '5-10 năm', 'Trên 10 năm']),
            'status' => $faker->randomElement([0, 1]),
        ]);
        DB::table('jobs_hrms')->insert([
            'name' => 'COMMUNITY SPECIALIST (CS) - NGÀNH ĐIỆN TỬ TIÊU DÙNG',
            'profession_id' => $faker->randomElement($profession_ids),
            'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
            'description_md' => '– Quản lý & hỗ trợ bán hàng tại cụm 8–14 cửa hàng
                    – Đảm bảo KPI Non-Phone & phụ kiện
                    – Huấn luyện đội ngũ bán hàng, báo cáo và đề xuất giải pháp',
            'requirements_md' => ' Độ tuổi từ: 24 - 38 tuổi
                    - Nắm chắc kiến thức Brand ecosystem & Non-Phone
                    - Thành thạo SEED (training) và công cụ báo cáo (Google Sheet, Excel, PowerPoint)
                    - Biết lập kế hoạch tuyến, quản lý thời gian & lịch trình
                    - Giao tiếp & phối hợp tốt với quản lý cửa hàng',
            'min_salary' => $faker->numberBetween(1000000, 100000000),
            'max_salary' => $faker->numberBetween(1000000, 100000000),
            'currency' => $faker->randomElement(['VND', 'USD']),
            'start_date' => $faker->date('Y-m-d'),
            'end_date' => $faker->date('Y-m-d'),
            'experience' => $faker->randomElement(['Dưới 1 năm', '1-2 năm', '2-3 năm', '3-5 năm', '5-10 năm', 'Trên 10 năm']),
            'status' => $faker->randomElement([0, 1]),
        ]);
        DB::table('jobs_hrms')->insert([
            'name' => 'NHÂN VIÊN KINH DOANH THỨC ĂN THÚ CƯNG KÊNH GT',
            'profession_id' => $faker->randomElement($profession_ids),
            'employment_type' => $faker->randomElement(EmploymentType::cases())->value,
            'description_md' => '– Tư vấn sản phẩm tại điểm bán (Các cửa hàng thú cưng chuyên biệt như phòng khám thú y, spa, khách sạn thú cưng, v.v.)
                    – Nhận đơn hàng & nhập liệu hệ thống
                    – Mở rộng điểm bán & chăm sóc khách hàng',
            'requirements_md' => '– Nam, tuổi dưới 35
                    – Có kinh nghiệm Sales FMCG kênh GT ít nhất 1 năm
                    – Có kinh nghiệm đi thị trường, thông thạo địa bàn
                    – Sẵn sàng di chuyển và đi công tác (có hỗ trợ phí)',
            'min_salary' => $faker->numberBetween(1000000, 100000000),
            'max_salary' => $faker->numberBetween(1000000, 100000000),
            'currency' => $faker->randomElement(['VND', 'USD']),
            'start_date' => $faker->date('Y-m-d'),
            'end_date' => $faker->date('Y-m-d'),
            'experience' => $faker->randomElement(['Dưới 1 năm', '1-2 năm', '2-3 năm', '3-5 năm', '5-10 năm', 'Trên 10 năm']),
            'status' => $faker->randomElement([0, 1]),
        ]);

        // Area application
        for ($i = 1; $i < 10; $i++) {
            DB::table('job_areas')->insert([
                'job_id' => $faker->randomElement([1, 4]),
                'province_id' => $faker->randomElement($province_ids),
                'ward_id' => $faker->randomElement($ward_ids),
                'headcount' => $faker->numberBetween(0, 1000),
                'status' => $faker->randomElement(['active', 'inactive']),
            ]);
        }
    }
}
