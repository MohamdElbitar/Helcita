<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
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

        return view('Clinic.medical_records.create', compact('patients'));
    }

    // Store a newly created medical record in the database
    public function store(Request $request)
    {
        $clinicId = auth()->user()->clinicData->id;

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

        $validatedData['clinic_id'] = $clinicId;

        MedicalRecord::create($validatedData);

        return redirect()->route('Clinic.medical_records.index')->with('success', 'Medical record added successfully.');
    }

    // Show a specific medical record
// Show the medical record details by ID
    public function show($id)
    {
        // Find the medical record by ID
        $medicalRecord = MedicalRecord::findOrFail($id);

        return view('Clinic.medical_records.show', compact('medicalRecord'));
    }

// Show the form for editing a medical record by ID
    public function edit($id)
    {
        // Find the medical record by ID
        $medicalRecord = MedicalRecord::findOrFail($id);

        // Get the clinic ID based on the logged-in user's clinic data
        $clinicId = auth()->user()->clinicData->id;

        // Get patients that belong to the clinic
        $patients = Patient::where('clinic_id', $clinicId)->get();

        return view('Clinic.medical_records.edit', compact('medicalRecord', 'patients'));
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
