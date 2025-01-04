<?php 
namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;;
use Illuminate\Support\Facades\Auth;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicSettingsController extends Controller
{


    public function index()
    {
        // الحصول على بيانات العيادة من المستخدم الحالي
        $user = auth()->user();
        $clinic = auth()->user()->clinicData;

        return view('Clinic.settings.index', get_defined_vars());
    }

    // تحديث معلومات العيادة
    public function update(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'clinic_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);
    
        $clinic = auth()->user()->clinicData;
        $user = auth()->user(); 
        // Update clinic data
        $clinic->name = $request->clinic_name;
        $clinic->mobile = $request->phone; 
        $clinic->save(); 
        $user->email = $request->email;
        $user->save(); 
    
        return redirect()->back()->with('success', 'Clinic information updated successfully.');
    }
    
    

    // تحديث كلمة المرور
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed', // 'confirmed' will automatically validate new_password_confirmation
        ]);
    
        $user = auth()->user();
    
        // Check if the current password is correct
        if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
    
        // Update the user's password
        $user->password = \Hash::make($request->new_password);
        $user->save();
    
        return redirect()->back()->with('success', 'Password changed successfully.');
    }
    
}
