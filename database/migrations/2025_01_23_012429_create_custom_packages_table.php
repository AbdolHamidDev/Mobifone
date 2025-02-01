<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomPackagesTable extends Migration
{
    public function up()
    {
        Schema::create('custom_packages', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number', 15); // Số điện thoại (bắt buộc)
            $table->integer('thoai_noi_mang')->default(0); // Số phút thoại nội mạng
            $table->integer('thoai_ngoai_mang')->default(0); // Số phút thoại ngoại mạng
            $table->decimal('dung_luong', 5, 2)->default(0.00); // Dung lượng (GB)
            $table->decimal('gia_tien', 10, 2)->nullable(); // Giá tiền (nếu tính toán)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_packages');
    }
}
