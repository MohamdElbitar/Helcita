<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\Clinic;
use App\Models\EmployeePermission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the employees for the specific clinic.
     */
    public function index(Request $request)
    {
        // Get the authenticated clinic ID
        $clinicId = auth()->user()->clinicData->id;

        // Get employees for this clinic
        $employees = Employee::with('user')
            ->where('clinic_id', $clinicId)
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->get();

        return view('Clinic.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
            $clinicId = auth()->user()->clinicData->id;
            
            $clinicPermissions = auth()->user()->permissions;
            return view('Clinic.employees.create', get_defined_vars());
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string',
            'status' => 'required|string',
            'permissions' => 'required|array', 
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_secretary' => "1", 
        ]);
    
       $employee= Employee::create([
            'clinic_id' => auth()->user()->clinicData->id, 
            'user_id' => $user->id, 
            'status' => $request->status,
            'phone' => $request->phone,
        ]);
    
        $user->assignRole('secretary');
    
        if ($request->has('permissions') && !empty($request->permissions)) {
            foreach ($request->permissions as $permissionId) {
                EmployeePermission::create([
                    'employee_id' => $employee->id,
                    'permission_id' => $permissionId,
                ]);
            }
        }
    
    
        return redirect()->route('Clinic.employees.index')->with('success', __('Employee added successfully'));
    }
    

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        $clinicId = auth()->user()->clinicData->id;
        $employee = Employee::where('clinic_id', $clinicId)->findOrFail($id);
        $clinicPermissions = auth()->user()->permissions;
        $employeePermissions = $employee->permissions->pluck('id')->toArray(); // استرجاع الصلاحيات المعينة للموظف
    
        return view('Clinic.employees.edit', get_defined_vars());
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->user->update($request->only('name', 'email'));
        $employee->phone = $request->phone;
        $employee->status = $request->status;
        $employee->save();
    
        $employee->permissions()->detach();
    
        if ($request->has('permissions') && !empty($request->permissions)) {
            foreach ($request->permissions as $permissionId) {
                EmployeePermission::create([
                    'employee_id' => $employee->id,
                    'permission_id' => $permissionId,
                ]);
            }
        }
    
        return redirect()->route('Clinic.employees.index')->with('success', __('Employee updated successfully'));
    }
    

    /**
     * Remove the specified employee from storage.
     */
    public function destroy($id)
    {
        $clinicId = auth()->user()->clinicData->id;
        $employee = Employee::where('clinic_id', $clinicId)->findOrFail($id);

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح!');
    }

    /**
     * Change the status of an employee (via AJAX or other request).
     */
    public function changeStatus(Request $request, $id)
    {
        $clinicId = auth()->user()->clinicData->id;
        $employee = Employee::where('clinic_id', $clinicId)->findOrFail($id);

        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $employee->update(['status' => $request->status]);

        return response()->json(['success' => 'تم تحديث الحالة بنجاح!']);
    }
}
