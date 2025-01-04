<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Clinic extends Model
{
    use HasFactory,Notifiable;
    protected $guarded = [];


    public function userData()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function subscriptionData()
    {
        return $this->hasOne(Subscription::class, 'clinic_id');
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
