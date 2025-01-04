<?php

use App\Http\Controllers\General\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Admin.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route لتحديث حالة الإشعار إلى "مقروء"
Route::get('/notifications/{id}/read', function($id) {
    $notification = auth()->user()->ClinicData->notifications()->findOrFail($id);
    $notification->markAsRead();

    return redirect($notification->data['url']); // توجيه المستخدم إلى رابط الإشعار
})->name('notification.markAsRead');

// Route لعرض جميع الإشعارات
Route::get('/notifications', function() {
    return view('notifications.index', ['notifications' => auth()->user()->ClinicData->notifications]);
})->name('notifications.index');

Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

