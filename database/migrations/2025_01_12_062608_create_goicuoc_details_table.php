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
        Schema::create('goicuoc_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goicuoc_id');
            $table->string('key'); // Loại thông tin (ví dụ: cách đăng ký, cách hủy, v.v.)
            $table->text('value'); // Nội dung của thông tin
            $table->timestamps();

            $table->foreign('goicuoc_id')->references('id')->on('goicuocs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('goicuoc_details');
    }
};
