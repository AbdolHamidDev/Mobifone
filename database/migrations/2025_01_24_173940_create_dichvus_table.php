<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDichvusTable extends Migration
{
    public function up()
    {
        Schema::create('dichvus', function (Blueprint $table) {
            $table->id();
            $table->string('ten_dich_vu');
            $table->string('anh')->nullable(); // Đường dẫn ảnh
            $table->string('noi_dung'); // Nội dung ngắn
            $table->string('loai_dich_vu'); // Loại dịch vụ
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dichvus');
    }
}
