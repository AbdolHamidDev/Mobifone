<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('goicuocs', function (Blueprint $table) {
        $table->id();
        $table->string('ten_goicuoc'); // Tên gói cước (ví dụ: D5)
        $table->decimal('gia', 10, 2); // Giá gói cước (Ví dụ: 5000)
        $table->integer('thoi_gian'); // Thời gian sử dụng gói cước (ví dụ: 1 ngày)
        $table->decimal('dung_luong', 10, 2); // Dung lượng (ví dụ: 1.00 GB)
        $table->string('don_vi_dung_luong'); // Đơn vị dung lượng (GB, MB, v.v.)
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goicuocs');
    }
};
