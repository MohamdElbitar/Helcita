<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\FinancialRecord;
use App\Models\Booking;
use App\Models\Clinic;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    // Display financial records (revenues and expenses)
    public function index()
    {
        $clinicId = auth()->user()->clinicData->id;

        $revenueRecords = FinancialRecord::where('clinic_id', $clinicId)->where('type', 'revenue')->get();
        $expenseRecords = FinancialRecord::where('clinic_id', $clinicId)->where('type', 'expense')->get();
        $totalRevenue = $revenueRecords->sum('amount');
        $totalExpense = $expenseRecords->sum('amount');
        $netProfit = $totalRevenue - $totalExpense;

        return view('Clinic.financial.index', get_defined_vars());
    }

    public function create()
    {
        return view('Clinic.financial.create');
    }

    public function addExpense(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        FinancialRecord::create([
            'type' => 'expense',
            'amount' => $request->amount,
            'description' => $request->description,
            'clinic_id' => auth()->user()->clinicData->id,
        ]);

        return redirect()->route('Clinic.financial.index')->with('success', __('Expense added successfully'));
    }

    public function completeBooking($bookingId)
    {
        $booking = Appointment::findOrFail($bookingId);

        if ($booking->status != 'completed') {
            FinancialRecord::create([
                'type' => 'revenue',
                'amount' => $booking->price, 
                'description' => 'Booking payment for ' . $booking->patient_name,
                'clinic_id' => $booking->clinic_id,
            ]);

            $booking->update(['status' => 'completed']);

            return redirect()->back()->with('success', __('Booking completed successfully'));
        }

        return redirect()->back()->with('error', __('Booking is already completed'));
    }
}
