<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Invoice;
use App\Models\SubscriptionType;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubscriptionController extends Controller
{
    public function index()
    {
        $clinics = Clinic::all();
        return view('Admin.clinic.index', compact('clinics'));
    }

    public function create()
    {
        $subscriptionTypes = SubscriptionType::all();
        return view('Admin.clinic.create', compact('subscriptionTypes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'subscription_type_id' => 'required|exists:subscription_types,id',
        ]);

        // Create the user for the clinic owner
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'is_clinic' => 1,
        ]);

        // Create the clinic
        $clinic = Clinic::create([
            'name' => $validatedData['name'],
            'logo' => $request->file('logo')->store('uploads/logos', 'public'),
            'mobile' => $validatedData['mobile'],
            'address' => $validatedData['address'],
            'user_id' => $user->id,
        ]);

        // Get subscription type details
        $subscriptionType = SubscriptionType::findOrFail($validatedData['subscription_type_id']);
        $subscriptionStatus = $subscriptionType->value == 0 ? 'active' : 'pending';

        // Create the subscription
       $subscription= $clinic->subscriptionData()->create([
            'subscription_type_id' => $subscriptionType->id,
            'status' => $subscriptionStatus, // حالة الاشتراك تكون "active" إذا كان المبلغ صفرًا
            'start_date' => now(),
            'end_date' => $this->calculateEndDate($subscriptionType->duration_value, $subscriptionType->duration_unit), // نمرر المدة والوحدة
            'amount' => $subscriptionType->value,
            'discount' => $subscriptionType->discount,
        ]);
        $invoice = Invoice::create([
            'clinic_id' => $clinic->id,
            'subscription_id' => $subscription->id,
            'amount' => $subscriptionType->value,
            'discount' => $subscriptionType->discount,
            'status' => 'unpaid',
        ]);
        $user->assignRole('clinic');

        // $role = Role::findByName('clinic');

        // $permissions = Permission::whereIn('name', ['view_patients', 'manage_appointments', 'edit_patients', 'view_invoices'])->get(); // Replace these with the actual permission names

        // $role->givePermissionTo($permissions);


        return redirect()->route('Admin.Subscribers.index')
            ->with('success', __('Clinic registered successfully and awaiting payment.'));
    }

    protected function calculateEndDate($duration_value, $duration_unit)
    {
        switch ($duration_unit) {
            case 'day':
                return now()->addDays($duration_value); // إذا كانت الوحدة يوم
            case 'month':
                return now()->addMonths($duration_value); // إذا كانت الوحدة شهر
            case 'year':
                return now()->addYears($duration_value); // إذا كانت الوحدة سنة
            default:
                return now(); // افتراضيًا في حالة وجود خطأ في البيانات
        }
    }

    public function show(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        return view('Admin.clinic.show', compact('clinic'));
    }

    public function edit(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $subscriptionTypes = SubscriptionType::all();
        return view('Admin.clinic.edit', compact('clinic', 'subscriptionTypes'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|string|max:20',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'subscription_type_id' => 'required|exists:subscription_types,id',
        ]);

        $clinic = Clinic::findOrFail($id);
        $clinic->update([
            'name' => $validatedData['name'],
            'logo' => $request->file('logo') ? $request->file('logo')->store('uploads/logos', 'public') : $clinic->logo,
            'mobile' => $validatedData['mobile'],
            'address' => $validatedData['address'],
        ]);

        $clinic->subscriptionData->update([
            'subscription_type_id' => $validatedData['subscription_type_id'],
        ]);

        return redirect()->route('Admin.Subscribers.index')
            ->with('success', __('Clinic updated successfully.'));
    }

    public function destroy(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        return redirect()->route('Admin.Subscribers.index')
            ->with('success', __('Clinic deleted successfully.'));
    }
}
