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
        Schema::create('loaithuebao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_type_id')->constrained('subscription_types')->onDelete('cascade');
            $table->text('benefits'); // Lợi ích
            $table->text('pricing'); // Giá cước
            $table->text('instructions'); // Hướng dẫn
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loaithuebao');
    }
};
