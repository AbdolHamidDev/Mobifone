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
    Schema::create('package_cancellations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('registration_id')->constrained('package_registrations')->onDelete('cascade');
        $table->string('phone_number')->nullable();
        $table->string('package_name');
        $table->decimal('package_price', 10, 2)->nullable();
        $table->string('cancel_reason')->nullable();
        $table->string('cancel_by')->nullable(); // admin, user
        $table->timestamp('cancelled_at')->useCurrent();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_cancellations');
    }
};
