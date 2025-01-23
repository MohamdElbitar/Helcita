<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'medicine_id', 'times_per_day', 'days'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
