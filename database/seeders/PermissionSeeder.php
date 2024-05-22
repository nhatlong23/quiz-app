<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name' => 'Quản lý bài viết', 'description' => 'Quản lý bài viết', 'parent_id' => '0', 'created_at' => now()],
            ['name' => 'Thêm bài viết', 'description' => 'Thêm bài viết', 'parent_id' => '1', 'created_at' => now()],
            ['name' => 'Sửa bài viết', 'description' => 'Sửa bài viết', 'parent_id' => '1', 'created_at' => now()],
            ['name' => 'Xóa bài viết', 'description' => 'Xóa bài viết', 'parent_id' => '1', 'created_at' => now()],
            ['name' => 'Quản lý người dùng', 'description' => 'Quản lý người dùng', 'parent_id' => '0', 'created_at' => now()],
            ['name' => 'Thêm người dùng', 'description' => 'Thêm người dùng', 'parent_id' => '5', 'created_at' => now()],
            ['name' => 'Sửa người dùng', 'description' => 'Sửa người dùng', 'parent_id' => '5', 'created_at' => now()],
            ['name' => 'Xóa người dùng', 'description' => 'Xóa người dùng', 'parent_id' => '5', 'created_at' => now()],
            ['name' => 'Quản lý vai trò', 'description' => 'Quản lý vai trò', 'parent_id' => '0', 'created_at' => now()],
            ['name' => 'Thêm vai trò', 'description' => 'Thêm vai trò', 'parent_id' => '9', 'created_at' => now()],
            ['name' => 'Sửa vai trò', 'description' => 'Sửa vai trò', 'parent_id' => '9', 'created_at' => now()],
            ['name' => 'Xóa vai trò', 'description' => 'Xóa vai trò', 'parent_id' => '9', 'created_at' => now()],
        ]);
    }
}
