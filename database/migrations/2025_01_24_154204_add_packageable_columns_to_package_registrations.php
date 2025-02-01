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
        Schema::table('package_registrations', function (Blueprint $table) {
            $table->string('packageable_type')->after('phone_number'); // Lưu tên class
            $table->unsignedBigInteger('packageable_id')->after('packageable_type'); // Lưu ID
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_registrations', function (Blueprint $table) {
            //
        });
    }
};
