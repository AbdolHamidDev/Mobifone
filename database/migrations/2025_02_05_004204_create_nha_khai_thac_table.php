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
        Schema::create('nha_khai_thac', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nha_khai_thac')->unique();
            $table->string('ma_nha_khai_thac')->unique();
            $table->foreignId('quoc_gia_id')->constrained('quoc_gia')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nha_khai_thac');
    }
};
