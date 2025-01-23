<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    // Display a listing of medical records for the authenticated clinic
    public function index()
    {
        $clinicId = auth()->user()->clinicData->id;

        $medicalRecords = MedicalRecord::where('clinic_id', $clinicId)
            ->with('patient')
            ->get();

        return view('Clinic.medical_records.index', compact('medicalRecords'));
    }

    // Show the form for creating a new medical record
    public function create()
    {
        $clinicId = auth()->user()->clinicData->id;

        $patients = Patient::where('clinic_id', $clinicId)->get();
        $medicines = Medicine::all();

        return view('Clinic.medical_records.create', get_defined_vars());
    }

    // Store a newly created medical record in the database
    public function store(Request $request)
    {
        $clinicId = auth()->user()->clinicData->id;

        // التحقق من البيانات الأساسية
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'required|string',
            'prescriptions' => 'nullable|string',
            'notes' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // حفظ الملف المرفق إذا وجد
        if ($request->hasFile('attachment')) {
            $validatedData['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        // إضافة معرف العيادة إلى البيانات
        $validatedData['clinic_id'] = $clinicId;

        // إنشاء السجل الطبي
        $medicalRecord = MedicalRecord::create($validatedData);

        // إضافة الأدوية إلى السجل الطبي
        if ($request->has('medicines')) {
            foreach ($request->medicines as $medicineId) {
                // التحقق من وجود الجرعات
                $dosageTimes = $request->input("dosage.$medicineId.times");
                $durationDays = $request->input("dosage.$medicineId.days");
                $timeOfIntake = $request->input("dosage.$medicineId.time");

                $medicalRecord->medicines()->attach($medicineId, [
                    'dosage_times' => $dosageTimes,
                    'duration_days' => $durationDays,
                    'time_of_intake' => $timeOfIntake, // إضافة وقت تناول الدواء
                ]);
            }
        }

        return redirect()->route('Clinic.medical_records.index')->with('success', 'Medical record added successfully.');
    }
    public function show($id)
    {
        // Find the medical record by ID
        $medicalRecord = MedicalRecord::findOrFail($id);

        return view('Clinic.medical_records.show', compact('medicalRecord'));
    }

// Show the form for editing a medical record by ID
    public function edit($id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id);

        $clinicId = auth()->user()->clinicData->id;

        $patients = Patient::where('clinic_id', $clinicId)->get();
        $medicines = Medicine::all();

        return view('Clinic.medical_records.edit', get_defined_vars());
    }

    // Update the specified medical record in the database
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $this->authorize('update', $medicalRecord);

        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'required|string',
            'prescriptions' => 'nullable|string',
            'notes' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        if ($request->hasFile('attachment')) {
            $validatedData['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $medicalRecord->update($validatedData);

        return redirect()->route('Clinic.medical_records.index')->with('success', 'Medical record updated successfully.');
    }

    // Delete a medical record
    public function destroy(MedicalRecord $medicalRecord)
    {
        $this->authorize('delete', $medicalRecord);

        $medicalRecord->delete();

        return redirect()->route('Clinic.medical_records.index')->with('success', 'Medical record deleted successfully.');
    }
}
