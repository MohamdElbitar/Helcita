<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionTypeController extends Controller
{
    /**
     * Display a listing of the subscription types.
     */
    public function index()
    {
        $subscriptionTypes = SubscriptionType::paginate(10);
        return view('Admin.subscriptionTypes.index', compact('subscriptionTypes'));
    }

    /**
     * Show the form for creating a new subscription type.
     */
    public function create()
    {
        return view('Admin.subscriptionTypes.create');
    }

    /**
     * Store a newly created subscription type in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration_unit' => 'required|in:day,month,year',
            'duration_value' => 'required|integer|min:1',
            'value' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        SubscriptionType::create($validated);

        return redirect()->route('Admin.subscriptionTypes.index')
                         ->with('success', __('Subscription type added successfully!'));
    }

    /**
     * Show the form for editing the specified subscription type.
     */
    public function edit(SubscriptionType $subscriptionType)
    {
        return view('Admin.subscriptionTypes.edit', compact('subscriptionType'));
    }

    /**
     * Update the specified subscription type in storage.
     */
    public function update(Request $request, SubscriptionType $subscriptionType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration_unit' => 'required|in:days,months,years',
            'duration_value' => 'required|integer|min:1',
            'value' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $subscriptionType->update($validated);

        return redirect()->route('Admin.subscriptionTypes.index')
                         ->with('success', __('Subscription type updated successfully!'));
    }

    /**
     * Remove the specified subscription type from storage.
     */
    public function destroy(SubscriptionType $subscriptionType)
    {
        $subscriptionType->delete();

        return redirect()->route('Admin.subscriptionTypes.index')
                         ->with('success', __('Subscription type deleted successfully!'));
    }
}
