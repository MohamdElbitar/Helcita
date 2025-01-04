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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade'); // العلاقة مع العيادة
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('phone')->nullable(); // إضافة عمود رقم الهاتف
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
