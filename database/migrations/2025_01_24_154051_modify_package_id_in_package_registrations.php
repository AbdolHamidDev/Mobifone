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
        Schema::table('package_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id')->change(); // Thay đổi kiểu dữ liệu để không có ràng buộc
        });
    }
    
    public function down()
    {
        Schema::table('package_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id')->change();
        });
    }
    
};
