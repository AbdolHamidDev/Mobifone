<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->unsignedBigInteger('so_thue_bao_id'); // Khóa ngoại liên kết với bảng so_thue_bao
            $table->unsignedBigInteger('goi_cuoc_id'); // Khóa ngoại liên kết với bảng goicuocs
            $table->string('sim_type'); // Loại SIM (SIM vật lý hoặc eSIM)
            $table->string('customer_name'); // Tên khách hàng
            $table->string('phone'); // Số điện thoại khách hàng
            $table->string('email')->nullable(); // Email khách hàng
            $table->string('province'); // Tỉnh/Thành phố
            $table->string('district'); // Quận/Huyện
            $table->string('ward'); // Phường/Xã
            $table->text('address'); // Địa chỉ cụ thể
            $table->string('delivery_method'); // Phương thức vận chuyển
            $table->string('payment_method'); // Phương thức thanh toán
            $table->decimal('activation_fee', 10, 2); // Phí hòa mạng
            $table->decimal('package_price', 10, 2); // Giá gói cước
            $table->decimal('shipping_fee', 10, 2); // Phí giao hàng
            $table->decimal('total_amount', 10, 2); // Tổng tiền thanh toán
            $table->timestamps();
        
            // Thiết lập khóa ngoại
            $table->foreign('so_thue_bao_id')->references('id')->on('so_thue_bao')->onDelete('cascade');
            $table->foreign('goi_cuoc_id')->references('id')->on('goicuocs')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
