<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $clinic_id = auth()->user()->clinicData->id;

        $appointments = Appointment::where('clinic_id', $clinic_id)->where('status', 'pending')
            ->with('patient', 'clinic')
            ->get();
        auth()->user()->assignRole('clinic');
        return view('Clinic.dashboard' ,get_defined_vars());
    }
}
