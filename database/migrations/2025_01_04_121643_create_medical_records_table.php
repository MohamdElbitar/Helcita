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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinic_id'); // إضافة الحقل الخاص بالعيادة
            $table->unsignedBigInteger('patient_id');
            $table->text('diagnosis');
            $table->text('prescriptions')->nullable();
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamps();
    
            // العلاقات
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade'); // ربط بالعيادات
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade'); // ربط بالمرضى
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
