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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('trang_thai')->default('giu_so')->comment('Trạng thái thanh toán: giu_so, hoa_mang');
            $table->boolean('da_nhan_hang')->default(false)->comment('Trạng thái nhận hàng: true - Đã nhận, false - Chưa nhận');
        });
    }
    
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('trang_thai');
            $table->dropColumn('da_nhan_hang');
        });
    }
    
};
