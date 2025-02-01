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
            $table->dropColumn(['packageable_type', 'packageable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('package_registrations', function (Blueprint $table) {
            $table->string('packageable_type')->nullable();
            $table->unsignedBigInteger('packageable_id')->nullable();
        });
    }
};
