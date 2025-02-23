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
        Schema::table('package_cancellations', function (Blueprint $table) {
            if (!Schema::hasColumn('package_cancellations', 'registration_id')) {
                $table->foreignId('registration_id')->constrained('package_registrations')->onDelete('cascade');
            }
            if (!Schema::hasColumn('package_cancellations', 'phone_number')) {
                $table->string('phone_number')->nullable();
            }
            if (!Schema::hasColumn('package_cancellations', 'package_name')) {
                $table->string('package_name');
            }
            if (!Schema::hasColumn('package_cancellations', 'package_price')) {
                $table->decimal('package_price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('package_cancellations', 'type')) {
                $table->string('type')->nullable();
            }
            if (!Schema::hasColumn('package_cancellations', 'cancel_reason')) {
                $table->string('cancel_reason')->nullable();
            }
            if (!Schema::hasColumn('package_cancellations', 'cancel_by')) {
                $table->string('cancel_by')->nullable();
            }
            if (!Schema::hasColumn('package_cancellations', 'cancelled_at')) {
                $table->timestamp('cancelled_at')->nullable();
            }
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_cancellations', function (Blueprint $table) {
            //
        });
    }
};
