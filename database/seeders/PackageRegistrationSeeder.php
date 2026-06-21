<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PackageRegistration;
use App\Models\GoiCuoc;
use Carbon\Carbon;

class PackageRegistrationSeeder extends Seeder
{
    public function run()
    {
        $goiCuocs = GoiCuoc::all();

        if ($goiCuocs->isEmpty()) {
            return;
        }

        $registrations = [];
        $customerPhones = [
            '0912345678', '0987654321', '0909123456', '0912345800',
            '0987654400', '0909123500', '0912346000', '0987654500',
            '0909123600', '0912347000', '0987655000', '0909124000'
        ];

        // Tạo 30 đăng ký gói cước trong 15 ngày gần đây
        for ($i = 0; $i < 30; $i++) {
            $goiCuoc = $goiCuocs->random();
            $phone = $customerPhones[array_rand($customerPhones)];
            
            $daysAgo = rand(0, 15);
            $createdAt = Carbon::now()->subDays($daysAgo);

            $registrations[] = [
                'phone_number' => $phone,
                'package_id' => $goiCuoc->id,
                'type' => 'goicuoc',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        foreach ($registrations as $registration) {
            PackageRegistration::updateOrCreate(
                [
                    'phone_number' => $registration['phone_number'],
                    'package_id' => $registration['package_id'],
                    'type' => $registration['type']
                ],
                $registration
            );
        }
    }
}