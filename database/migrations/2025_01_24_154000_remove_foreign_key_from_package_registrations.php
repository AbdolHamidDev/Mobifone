<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('package_registrations', function (Blueprint $table) {
            $table->dropForeign(['package_id']); // Xóa khóa ngoại
        });
    }
    
    public function down()
    {
        Schema::table('package_registrations', function (Blueprint $table) {
            $table->foreign('package_id')->references('id')->on('goicuocs')->onDelete('cascade');
        });
    }
    
};
