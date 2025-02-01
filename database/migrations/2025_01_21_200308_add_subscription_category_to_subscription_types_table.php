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
        Schema::table('subscription_types', function (Blueprint $table) {
            $table->enum('subscription_category', ['Trả trước', 'Trả sau', 'Fast Connect'])
                  ->default('Trả trước')
                  ->after('title'); // Thêm sau cột 'title'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_types', function (Blueprint $table) {
            $table->dropColumn('subscription_category');
        });
    }
};
