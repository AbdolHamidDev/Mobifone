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
        Schema::create('so_thue_bao', function (Blueprint $table) {
            $table->id();
            $table->string('so_thue_bao', 20)->unique(); // Số thuê bao
            $table->enum('loai_thue_bao', ['tra_truoc', 'tra_sau'])->default('tra_truoc'); // Loại thuê bao
            $table->string('khu_vuc')->default('Toàn quốc'); // Khu vực hòa mạng
            $table->decimal('phi_hoa_mang', 10, 2)->default(0.00); // Phí hòa mạng
            $table->enum('trang_thai', ['chua_su_dung', 'giu_so', 'hoa_mang'])->default('chua_su_dung'); // Trạng thái
            $table->timestamps(); // Ngày tạo và cập nhật
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('so_thue_bao');
    }
};
