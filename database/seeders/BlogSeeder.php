<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(\Faker\Generator::class);
        $user_ids = DB::table('users')->pluck('user_id')->where('role_id', '!=', '3')->toArray() ?? [1,2];

        for ($i = 1; $i < 10; $i++) {
            DB::table('blogs')->insert([
                'title' => $faker->jobTitle,
                'content' => $faker->paragraphs(2, true),
                'slug' => $faker->slug,
                'user_id' => $faker->randomElement($user_ids),
                'category_id' => $faker->randomElement([1, 2, 3]),
                'image' => $faker->imageUrl,
                'view_count' => $faker->numberBetween(0, 1000),
                'status' => $faker->randomElement([0,1]),
            ]);
        }
    }
}
