<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('qr_code')->nullable()->change(); // Chuyển thành TEXT
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('qr_code', 255)->nullable()->change(); // Quay lại VARCHAR(255) nếu rollback
        });
    }
};
