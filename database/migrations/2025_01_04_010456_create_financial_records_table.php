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
        Schema::create('financial_records', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['revenue', 'expense']); // تحديد نوع السجل (إيرادات / مصروفات)
            $table->decimal('amount', 10, 2); // المبلغ المالي
            $table->string('description')->nullable(); // وصف العملية (مثل الحجز أو المصروف)
            $table->unsignedBigInteger('clinic_id'); // العيادة المرتبطة
            $table->timestamps();

            // تعريف العلاقة مع العيادة (في حالة وجود جدول Clinics)
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_records');
    }
};
