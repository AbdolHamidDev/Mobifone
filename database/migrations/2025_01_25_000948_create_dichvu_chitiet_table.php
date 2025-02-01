<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDichvuChitietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dichvu_chitiet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dichvu_id'); // Liên kết với bảng dichvus
            $table->text('doi_tuong_su_dung')->nullable(); // Đối tượng sử dụng
            $table->text('tinh_nang_chinh')->nullable(); // Các tính năng chính của dịch vụ
            $table->text('quy_dinh')->nullable(); // Quy định
            $table->text('tien_ich')->nullable(); // Tiện ích
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('dichvu_id')->references('id')->on('dichvus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dichvu_chitiet');
    }
}
