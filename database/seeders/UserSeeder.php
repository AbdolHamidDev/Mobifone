<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo tài khoản Admin
        $admin = User::create([
            'name' => 'Nguyễn Văn Admin',
            'email' => 'admin@mobifone.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Tạo tài khoản Nhân viên
        $staff1 = User::create([
            'name' => 'Trần Thị Nhân Viên',
            'email' => 'nhanvien@mobifone.com',
            'password' => Hash::make('nv123456'),
            'email_verified_at' => now(),
        ]);
        $staff1->assignRole('user');

        $staff2 = User::create([
            'name' => 'Lê Văn Bảo',
            'email' => 'baole@mobifone.com',
            'password' => Hash::make('bao123456'),
            'email_verified_at' => now(),
        ]);
        $staff2->assignRole('user');

        // Tạo tài khoản Khách hàng mẫu
        $customer1 = User::create([
            'name' => 'Phạm Minh Tuấn',
            'email' => 'tuanpham@gmail.com',
            'password' => Hash::make('tuan123'),
            'email_verified_at' => now(),
        ]);

        $customer2 = User::create([
            'name' => 'Hoàng Thị Hương',
            'email' => 'huonghoang@gmail.com',
            'password' => Hash::make('huong123'),
            'email_verified_at' => now(),
        ]);

        $customer3 = User::create([
            'name' => 'Vũ Văn Nam',
            'email' => 'namvu@gmail.com',
            'password' => Hash::make('nam123'),
            'email_verified_at' => now(),
        ]);

        $customer4 = User::create([
            'name' => 'Đặng Thị Lan',
            'email' => 'landang@gmail.com',
            'password' => Hash::make('lan123'),
            'email_verified_at' => now(),
        ]);

        $customer5 = User::create([
            'name' => 'Bùi Văn Hùng',
            'email' => 'hungbui@gmail.com',
            'password' => Hash::make('hung123'),
            'email_verified_at' => now(),
        ]);
    }
}