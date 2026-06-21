<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Tắt kiểm tra khóa ngoại để tránh lỗi khi xóa dữ liệu
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa tất cả roles và permissions trước khi seed lại
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Xóa dữ liệu trong các bảng có khóa ngoại
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();

        // Truncate bảng chính
        Permission::truncate();
        Role::truncate();

        // Tạo roles
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['display_name' => 'Quản trị hệ thống']);
        $userRole = Role::firstOrCreate(['name' => 'user'], ['display_name' => 'Người dùng']);

        // Tạo permissions cho các mục hiện có
        $manageGoiCuoc = Permission::firstOrCreate(['name' => 'quản lý gói cước']);
        $manageGoiData = Permission::firstOrCreate(['name' => 'quản lý gói data']);
        $manageMobileServices = Permission::firstOrCreate(['name' => 'quản lý dịch vụ di động']);
        $manageInternationalServices = Permission::firstOrCreate(['name' => 'quản lý dịch vụ quốc tế']);
        $manageSubscriptionTypes = Permission::firstOrCreate(['name' => 'quản lý loại thuê bao']);
        $manageServices = Permission::firstOrCreate(['name' => 'quản lý dịch vụ']);
        $managePhoneNumbers = Permission::firstOrCreate(['name' => 'quản lý số thuê bao']);
        $manageCountries = Permission::firstOrCreate(['name' => 'quản lý quốc gia']);
        $manageOperators = Permission::firstOrCreate(['name' => 'quản lý nhà khai thác']);
        $manageInternationalCharges = Permission::firstOrCreate(['name' => 'quản lý cước quốc tế']);
        
        // Tạo permissions cho các mục bổ sung từ sidebar
        $manageVoIPServices = Permission::firstOrCreate(['name' => 'quản lý gọi VoIP']);
        $manageCustomerRegistrations = Permission::firstOrCreate(['name' => 'quản lý khách hàng đăng ký']);
        $manageSubscriptions = Permission::firstOrCreate(['name' => 'quản lý đăng ký gói cước']);
        $manageDataSubscriptions = Permission::firstOrCreate(['name' => 'quản lý đăng ký gói data']);
        $manageCustomPackages = Permission::firstOrCreate(['name' => 'quản lý gói cước tự tạo']);
        $manageRegistrations = Permission::firstOrCreate(['name' => 'quản lý đăng ký hòa mạng']);
        $manageRecruitment = Permission::firstOrCreate(['name' => 'quản lý tuyển dụng']);
        $manageRecruitmentList = Permission::firstOrCreate(['name' => 'quản lý danh sách tuyển dụng']);
        $manageCV = Permission::firstOrCreate(['name' => 'quản lý CV']);
        $manageNetworkTransfers = Permission::firstOrCreate(['name' => 'quản lý đăng ký chuyển mạng']);
        $manageNews = Permission::firstOrCreate(['name' => 'quản lý tin tức và khuyến mãi']);
        $manageStores = Permission::firstOrCreate(['name' => 'quản lý cửa hàng']);
        $manageContacts = Permission::firstOrCreate(['name' => 'quản lý liên hệ']);
        $manageChat = Permission::firstOrCreate(['name' => 'quản lý chat']);
        $manageCancellations = Permission::firstOrCreate(['name' => 'quản lý hủy gói']);
        $manageStaff = Permission::firstOrCreate(['name' => 'quản lý nhân viên']);
        $manageRoles = Permission::firstOrCreate(['name' => 'quản lý vai trò']);
        
        // Gán permissions cho admin (quyền full)
        $adminRole->givePermissionTo([
            $manageGoiCuoc, $manageGoiData, $manageMobileServices, $manageInternationalServices,
            $manageSubscriptionTypes, $manageServices, $managePhoneNumbers,
            $manageCountries, $manageOperators, $manageInternationalCharges,
            $manageVoIPServices, $manageCustomerRegistrations, $manageSubscriptions,
            $manageDataSubscriptions, $manageCustomPackages, $manageRegistrations,
            $manageRecruitment, $manageRecruitmentList, $manageCV,
            $manageNetworkTransfers, $manageNews, $manageStores,
            $manageContacts, $manageChat, $manageCancellations,
            $manageStaff, $manageRoles
        ]);

        // Gán permissions cho user (quyền hạn chế)
        $userRole->givePermissionTo([
            $manageGoiCuoc, $manageGoiData, $manageMobileServices, $manageInternationalServices,
            $manageVoIPServices, $manageCustomerRegistrations, $manageSubscriptions,
            $manageDataSubscriptions, $manageNetworkTransfers, $manageNews,
            $manageStores, $manageContacts, $manageChat
        ]);

        $this->command->info('Roles and Permissions for Sidebar have been seeded.');

        // Bật lại kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
