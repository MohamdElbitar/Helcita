<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    // علاقة مع المريض
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicines()
{
    return $this->belongsToMany(Medicine::class, 'medical_record_medicine')
                ->withPivot('dosage_times', 'duration_days', 'time_of_intake')
                ->withTimestamps();
}

}
