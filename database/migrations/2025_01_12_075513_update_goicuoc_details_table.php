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
        Schema::table('goicuoc_details', function (Blueprint $table) {
            // Cập nhật để cho phép giá trị null hoặc giá trị mặc định là chuỗi rỗng
            $table->string('value')->nullable()->default('')->change();
        });
    }
    
    public function down()
    {
        Schema::table('goicuoc_details', function (Blueprint $table) {
            // Quay lại thay đổi ban đầu
            $table->string('value')->nullable(false)->change();
        });
    }
    
};
