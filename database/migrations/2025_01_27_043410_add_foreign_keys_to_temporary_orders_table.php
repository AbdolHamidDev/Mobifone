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
        Schema::table('temporary_orders', function (Blueprint $table) {
            // Thêm ràng buộc khóa ngoại
            $table->foreign('so_thue_bao_id')->references('id')->on('so_thue_bao')->onDelete('cascade');
            $table->foreign('goi_cuoc_id')->references('id')->on('goicuocs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temporary_orders', function (Blueprint $table) {
            // Xóa ràng buộc khóa ngoại nếu rollback
            $table->dropForeign(['so_thue_bao_id']);
            $table->dropForeign(['goi_cuoc_id']);
        });
    }
};

