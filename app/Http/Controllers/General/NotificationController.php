<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        return view('General.Notifications.index');
    }

    public function markAsRead($id)
    {
        // جلب الإشعار بناءً على المعرف
        $notification = DatabaseNotification::find($id);

        // التحقق من أن المستخدم الحالي يملك الإشعار
        if ($notification && $notification->notifiable_id == auth()->id()) {
            $notification->markAsRead();
            return redirect($notification->data['url']); 
        }

        return redirect()->back()->with('error', 'Notification not found or unauthorized.');
    }
}
