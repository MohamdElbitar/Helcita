<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function index()
    {
        $invoices = Invoice::with(['clinic', 'subscription'])->paginate(10);

        return view('Admin.clinic.invoices.index',get_defined_vars());
    }

    public function create()
    {
        return view('Admin.invoices.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'clinic_id' => 'required|exists:clinics,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
        ]);

        $invoice = Invoice::create($validatedData);

        return redirect()->route('Admin.invoice.index')->with('success', 'Invoice created successfully!');
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('Admin.clinic.invoices.show', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('Admin.invoice.edit', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $validatedData = $request->validate([
            'clinic_id' => 'required|exists:clinics,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
        ]);

        $invoice->update($validatedData);

        return redirect()->route('Admin.invoice.index')->with('success', 'Invoice updated successfully!');
    }

    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();
        return back()->with('success', 'Invoice deleted successfully!');
    }
}
