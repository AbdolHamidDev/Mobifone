<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cv', function (Blueprint $table) {
            $table->id();
            $table->string('họ_và_tên');
            $table->string('cv_hồ_sơ'); // Đường dẫn lưu file PDF
            $table->string('trình_độ');
            $table->string('email')->unique();
            $table->string('số_điện_thoại');
            $table->string('trường_học');
            $table->string('ngành_nghề');
            $table->string('biết_thông_tin_từ_đâu')->nullable();
            $table->text('tóm_tắt_kinh_nghiệm')->nullable();
            $table->boolean('đã_xem')->default(false);
            $table->boolean('đã_duyệt')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cv');
    }
};
