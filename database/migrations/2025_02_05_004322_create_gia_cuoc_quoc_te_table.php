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
        Schema::create('gia_cuoc_quoc_te', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quoc_gia_id')->constrained('quoc_gia')->onDelete('cascade');
            $table->foreignId('nha_khai_thac_id')->constrained('nha_khai_thac')->onDelete('cascade');
            $table->string('loai_thue_bao'); // Tra truoc / Tra sau
            $table->decimal('cuoc_goi_trong_mang', 10, 3)->nullable();
            $table->decimal('cuoc_goi_ve_vn', 10, 3)->nullable();
            $table->decimal('cuoc_quoc_te', 10, 3)->nullable();
            $table->decimal('cuoc_ve_tinh', 10, 3)->nullable();
            $table->decimal('cuoc_nhan_goi', 10, 3)->nullable();
            $table->decimal('cuoc_sms', 10, 3)->nullable();
            $table->decimal('cuoc_data', 10, 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gia_cuoc_quoc_te');
    }
};
