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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade'); // Foreign key to clinics table
            $table->foreignId('subscription_type_id')->constrained('subscription_types')->onDelete('cascade'); // Foreign key to subscription_types table
            $table->enum('status', ['active', 'suspended', 'expired'])->default('active'); // Status of subscription
            $table->date('start_date'); // Subscription start date
            $table->date('end_date'); // Subscription end date
            $table->decimal('amount', 10, 2); // Subscription cost
            $table->decimal('discount', 10, 2)->default(0); // Discount applied to subscription
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
