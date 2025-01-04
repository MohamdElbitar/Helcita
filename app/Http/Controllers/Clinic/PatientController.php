<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;

use App\Models\Patient;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    // عرض جميع المرضى الخاصين بالعيادة الحالية
    public function index()
    {
        $clinic_id = Auth::user()->clinicData->id;

        $patients = Patient::where('clinic_id', $clinic_id)->get();
        return view('Clinic.patients.index', compact('patients'));
    }

    // عرض نموذج إضافة مريض في العيادة الحالية
    public function create()
    {
        $clinics = Clinic::all(); // يمكنك تخصيصه ليعرض فقط العيادات التي تخص المستخدم الحالي
        return view('Clinic.patients.create', compact('clinics'));
    }

    // تخزين مريض جديد
    public function store(Request $request)
    {
        $clinic_id = Auth::user()->clinicData->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:patients,phone',
            'address' => 'required|string|max:255',
        ]);

        Patient::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'clinic_id' => $clinic_id, // تحديد العيادة الحالية
        ]);

        return redirect()->route('Clinic.patients.index')->with('success', 'Patient added successfully');
    }

    // عرض نموذج تعديل مريض
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $clinic_id = Auth::user()->clinicData->id;

        // التحقق من أن المريض يخص العيادة الحالية
        if ($patient->clinic_id != $clinic_id) {
            return redirect()->route('Clinic.patients.index')->with('error', 'You cannot edit this patient');
        }

        $clinics = Clinic::all();
        return view('Clinic.patients.edit', compact('patient', 'clinics'));
    }

    // تحديث بيانات المريض
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $clinic_id = Auth::user()->clinicData->id;

        // التحقق من أن المريض يخص العيادة الحالية
        if ($patient->clinic_id != $clinic_id) {
            return redirect()->route('Clinic.patients.index')->with('error', 'You cannot update this patient');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:patients,phone,' . $id,
            'address' => 'required|string|max:255',
        ]);

        $patient->update($request->all());

        return redirect()->route('Clinic.patients.index')->with('success', 'Patient updated successfully');
    }

    // حذف مريض
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $clinic_id = Auth::user()->clinicData->id;

        // التحقق من أن المريض يخص العيادة الحالية
        if ($patient->clinic_id != $clinic_id) {
            return redirect()->route('Clinic.patients.index')->with('error', 'You cannot delete this patient');
        }

        $patient->delete();

        return redirect()->route('Clinic.patients.index')->with('success', 'Patient deleted successfully');
    }
}
