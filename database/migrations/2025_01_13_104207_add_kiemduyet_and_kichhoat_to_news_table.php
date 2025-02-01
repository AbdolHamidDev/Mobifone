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
        Schema::table('news', function (Blueprint $table) {
            $table->boolean('kiemduyet')->default(0); // Cột kiểm duyệt, mặc định là 0
            $table->boolean('kichhoat')->default(0);  // Cột kích hoạt, mặc định là 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('kiemduyet');
            $table->dropColumn('kichhoat');
        });
    }
};
