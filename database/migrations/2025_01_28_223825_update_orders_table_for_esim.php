<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Chạy Migration
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('province')->nullable()->change();
            $table->string('district')->nullable()->change();
            $table->string('ward')->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('delivery_method')->nullable()->change();
        });
    }

    /**
     * Quay lại thay đổi (Rollback)
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('province')->nullable(false)->change();
            $table->string('district')->nullable(false)->change();
            $table->string('ward')->nullable(false)->change();
            $table->text('address')->nullable(false)->change();
            $table->string('delivery_method')->nullable(false)->change();
        });
    }
};

