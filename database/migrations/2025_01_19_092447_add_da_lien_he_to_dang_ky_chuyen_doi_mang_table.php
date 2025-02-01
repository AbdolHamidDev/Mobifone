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
        Schema::table('dang_ky_chuyen_doi_mang', function (Blueprint $table) {
            $table->boolean('da_lien_he')->default(false); // Thêm trường "đã liên hệ"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dang_ky_chuyen_doi_mang', function (Blueprint $table) {
            //
        });
    }
};
