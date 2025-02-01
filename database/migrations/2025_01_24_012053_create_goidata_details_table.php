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
    Schema::create('goidata_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('goidata_id')->constrained('goidatas')->onDelete('cascade'); // Liên kết với bảng goidatas
        $table->string('key'); // Key (ví dụ: Giá, Dung lượng)
        $table->string('value'); // Value (ví dụ: 50.000 VNĐ, 1GB)
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goidata_details');
    }
};
