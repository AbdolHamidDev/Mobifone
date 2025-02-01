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
        Schema::create('subscription_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên loại thuê bao
            $table->string('title'); // Tiêu đề thông tin thuê bao
            $table->string('image')->nullable(); // Hình ảnh loại thuê bao
            $table->boolean('is_approved')->default(false); // Trạng thái kiểm duyệt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_types');
    }
};
