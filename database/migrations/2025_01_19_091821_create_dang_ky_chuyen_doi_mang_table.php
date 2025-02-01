<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangKyChuyenDoiMangTable extends Migration
{
    public function up()
    {
        Schema::create('dang_ky_chuyen_doi_mang', function (Blueprint $table) {
            $table->id();
            // Thông tin cá nhân người đăng ký
            $table->string('ho_ten'); // Họ tên
            $table->string('so_dien_thoai'); // Số điện thoại
            $table->string('email')->nullable(); // Email (không bắt buộc)
            
            // Địa bàn tiếp nhận
            $table->string('tinh_thanh_pho'); // Tỉnh/thành phố
            $table->string('quan_huyen'); // Quận/huyện
            $table->string('xa_phuong'); // Xã/phường
            
            // Địa chỉ liên hệ
            $table->string('dia_chi_lien_he'); // Địa chỉ liên hệ
            
            // Hình thức xử lý
            $table->enum('hinh_thuc_xu_ly', ['tai_dia_chi_dang_ky', 'den_cua_hang']); // Tại địa chỉ đăng ký hoặc đến cửa hàng
            
            // Người giới thiệu (không bắt buộc)
            $table->string('nguoi_gioi_thieu_ho_ten')->nullable(); // Họ tên người giới thiệu
            $table->string('nguoi_gioi_thieu_so_dien_thoai')->nullable(); // Số điện thoại người giới thiệu
            $table->string('nguoi_gioi_thieu_email')->nullable(); // Email người giới thiệu
            $table->string('nguoi_gioi_thieu_don_vi')->nullable(); // Đơn vị giới thiệu
            $table->string('nguoi_gioi_thieu_don_vi_cap_phong')->nullable(); // Đơn vị cấp phòng
            
            $table->timestamps(); // Các trường created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('dang_ky_chuyen_doi_mang');
    }
}
