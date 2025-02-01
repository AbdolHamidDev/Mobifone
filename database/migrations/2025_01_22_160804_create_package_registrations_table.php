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
        Schema::create('package_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number', 15); // Lưu số điện thoại
            $table->unsignedBigInteger('package_id'); // Mã gói cước
            $table->timestamps();
    
            // Thiết lập khóa ngoại
            $table->foreign('package_id')->references('id')->on('goicuocs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_registrations');
    }
};
