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
        Schema::create('tuyendung', function (Blueprint $table) {
            $table->id();
            $table->string('vi_tri'); // Vị trí công việc
            $table->text('mo_ta'); // Mô tả công việc
            $table->text('yeu_cau'); // Yêu cầu công việc
            $table->integer('luong')->nullable(); // Mức lương
            $table->date('thoi_gian_ung_tuyen'); // Thời gian ứng tuyển
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuyendung');
    }
};
