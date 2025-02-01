<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Tự động tăng ID
            $table->string('name', 100); // Họ và Tên
            $table->string('email', 100); // Email
            $table->string('phone', 15); // Số điện thoại
            $table->string('reason')->nullable(); // Lý do liên hệ
            $table->boolean('status')->default(false); // Trạng thái liên hệ (false: chưa liên hệ, true: đã liên hệ)
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
