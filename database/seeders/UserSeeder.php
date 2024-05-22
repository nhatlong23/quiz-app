<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Root', 'email' => 'root@gmail.com', 'password' => Hash::make('root@ABC'), 'created_at' => now()],
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('admin@ABC'), 'created_at' => now()],
        ]);
    }
}
