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
    Schema::table('so_thue_bao', function (Blueprint $table) {
        $table->enum('loai_so', ['so_thuong', 'so_vip'])->default('so_thuong'); // Loại số: thường hoặc VIP
        $table->decimal('phi_giu_so', 10, 2)->default(0.00); // Phí giữ số, mặc định là miễn phí
    });
}

    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('so_thue_bao', function (Blueprint $table) {
        $table->dropColumn('loai_so');   
        $table->dropColumn('phi_giu_so');
    });
}
};
