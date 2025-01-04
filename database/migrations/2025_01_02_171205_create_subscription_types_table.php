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
        Schema::create('subscription_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Subscription name (e.g. "Daily", "Monthly", "Yearly")
            $table->enum('duration_unit', ['days', 'months', 'years']); // Unit of time (days, months, years)
            $table->integer('duration_value'); // Number of days, months, or years
            $table->decimal('value', 10, 2); // Subscription cost
            $table->decimal('discount', 10, 2)->default(0); // Discount value
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_types');
    }
};
