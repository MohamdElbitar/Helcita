<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;


use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\FinancialRecord;
use App\Notifications\AppointmentReminder;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{

    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    // عرض جميع المواعيد الخاصة بالعيادة الحالية
    public function index()
    {
        $clinic_id = Auth::user()->clinicData->id;

        $appointments = Appointment::where('clinic_id', $clinic_id)
            ->with('patient', 'clinic')
            ->get();

        return view('Clinic.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $clinic_id = Auth::user()->clinicData->id;
        $patients = Patient::where('clinic_id', $clinic_id)->get();
        $clinics = Clinic::all();
        return view('Clinic.appointments.create', compact('patients', 'clinics'));
    }



    public function store(Request $request)
    {
        $clinic_id = Auth::user()->clinicData->id;

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        $appointment =Appointment::create([
            'patient_id' => $request->patient_id,
            'clinic_id' => $clinic_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'price' => $request->price,
        ]);

        $patientPhone = $appointment->patient->phone; // Assume patient has a phone field
        $message = "Dear {$appointment->patient->name}, this is a reminder for your appointment on {$appointment->appointment_date} at {$appointment->appointment_time}. Please be on time.";

        $this->twilioService->sendWhatsAppMessage($patientPhone, $message);

        return redirect()->route('Clinic.appointments.index')->with('success', 'Appointment booked successfully');
    }

    public function show($id)
    {
        // Find the medical record by ID
        $appointment = Appointment::findOrFail($id);

        return view('Clinic.appointments.show', get_defined_vars());
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $clinic_id = Auth::user()->clinicData->id;

        if ($appointment->clinic_id != $clinic_id) {
            return redirect()->route('Clinic.appointments.index')->with('error', 'You cannot edit this appointment');
        }

        $patients = Patient::where('clinic_id', Auth::user()->clinicData->id)->get();
        $clinics = Clinic::all();
        return view('Clinic.appointments.edit', compact('appointment', 'patients', 'clinics'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->clinic_id != Auth::user()->clinicData->id) {
            return redirect()->route('Clinic.appointments.index')->with('error', 'You cannot update this appointment');
        }

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        $appointment->update($request->all());

        return redirect()->route('Clinic.appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->clinic_id != Auth::user()->clinicData->id) {
            return redirect()->route('Clinic.appointments.index')->with('error', 'You cannot delete this appointment');
        }

        $appointment->delete();

        return redirect()->route('Clinic.appointments.index')->with('success', 'Appointment cancelled successfully');
    }

    public function complete1($id)
    {
        $appointment = Appointment::findOrFail($id);
        FinancialRecord::create([
            'type' => 'revenue',
            'amount' => $appointment->price, // هنا نفترض أن السعر هو المبلغ
            'description' => 'Booking payment for ' . $appointment->patient->name,
            'clinic_id' => $appointment->clinic_id,
        ]);
        // تحديث الحالة إلى مكتمل
        $appointment->status = 'checked';
        $appointment->save();

        // إعادة التوجيه إلى صفحة المواعيد مع رسالة نجاح
        return redirect()->route('Clinic.appointments.index')->with('success', __('Appointment marked as completed.'));
    }

    public function complete($id)
    {
        $appointment = Appointment::findOrFail($id);

        FinancialRecord::create([
            'type' => 'revenue',
            'amount' => $appointment->price,
            'description' => 'Booking payment for ' . $appointment->patient->name,
            'clinic_id' => $appointment->clinic_id,
        ]);

        $appointment->status = 'checked';
        $appointment->save();

        $nextAppointment = Appointment::where('status', 'pending')
                                      ->where('appointment_date', $appointment->appointment_date) // نفس التاريخ
                                      ->where('appointment_time', '>', $appointment->appointment_time) // بعد الوقت الحالي
                                      ->orderBy('appointment_time', 'asc') // ترتيبهم حسب الوقت
                                      ->first();

        if ($nextAppointment) {
            $nextAppointment->patient->notify(new AppointmentReminder($nextAppointment));
        }

        if ($nextAppointment) {
            $nextAppointment->clinic->notify(new AppointmentReminder($nextAppointment));
        }


        // إعادة التوجيه إلى صفحة المواعيد مع رسالة نجاح
        return redirect()->route('Clinic.appointments.index')->with('success', __('Appointment marked as completed.'));
    }


}
