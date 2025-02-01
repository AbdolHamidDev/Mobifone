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
        Schema::table('dang_ky_chuyen_doi_mang', function (Blueprint $table) {
            $table->boolean('ho_tro_thu_tuc')->default(false);  // Cột hỗ trợ khách hàng làm thủ tục
            $table->boolean('nhan_ket_qua')->default(false);  // Cột khách hàng nhận kết quả chuyển mạng
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('dang_ky_chuyen_doi_mang', function (Blueprint $table) {
        $table->dropColumn('ho_tro_thu_tuc');
        $table->dropColumn('nhan_ket_qua');
    });
}

};
