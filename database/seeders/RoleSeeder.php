<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'Quản trị viên cao cấp', 'created_at' => now()],
            ['name' => 'Guest', 'description' => 'Khách hàng', 'created_at' => now()],
            ['name' => 'Developer', 'description' => 'Phát triển hệ thốnggs', 'created_at' => now()],
            ['name' => 'Content', 'description' => 'Chỉnh sửa nội dung', 'created_at' => now()],
        ]);
    }
}
