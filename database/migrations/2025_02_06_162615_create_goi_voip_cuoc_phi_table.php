<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('goi_voip_cuoc_phi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quoc_gia_id')->constrained('quoc_gia')->onDelete('cascade');
            $table->string('nhom_cuoc'); // Ví dụ: 'Nhóm 1', 'Nhóm 2'
            $table->string('ma_vung')->nullable(); // Mã vùng: '66, 67, 68...'
            $table->integer('block_6s_dau')->nullable(); // Giá block 6s đầu
            $table->integer('gia_moi_giay')->nullable(); // Giá mỗi giây tiếp theo
            $table->integer('gia_1_phut_dau')->nullable(); // Giá 1 phút đầu
            $table->integer('gia_1_phut_tiep_theo')->nullable(); // Giá 1 phút tiếp theo (nếu có)
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('goi_voip_cuoc_phi');
    }
};
