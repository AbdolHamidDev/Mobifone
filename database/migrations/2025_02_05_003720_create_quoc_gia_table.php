<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('quoc_gia', function (Blueprint $table) {
            $table->id();
            $table->string('ten_quoc_gia')->unique();
            $table->string('ma_quoc_gia', 10)->unique();
            $table->string('co_quoc_gia')->nullable(); // URL cờ quốc gia hoặc Unicode flag
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('quoc_gia');
    }
};
