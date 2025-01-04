<?php

use App\Http\Controllers\Clinic\AppointmentsController;
use App\Http\Controllers\Clinic\ClinicSettingsController;
use App\Http\Controllers\Clinic\EmployeesController;
use App\Http\Controllers\Clinic\FinancialController;
use App\Http\Controllers\General\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clinic\HomeController;
use App\Http\Controllers\Clinic\PatientController;
use App\Http\Controllers\Clinic\MedicalRecordController;
use Illuminate\Support\Facades\Auth;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web','auth','checkrole:clinic'],
    ],
    function () {
        Route::prefix('clinic')->name('Clinic.')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::resource('appointments', AppointmentsController::class);
            Route::resource('patients', PatientController::class);
            Route::resource('employees', EmployeesController::class);
            Route::post('/appointments/{id}/complete', [AppointmentsController::class, 'complete'])->name('appointments.complete');
            Route::get('financial', [FinancialController::class, 'index'])->name('financial.index');
            Route::get('financial/create', [FinancialController::class, 'create'])->name('financial.create');
            Route::post('financial/expenses', [FinancialController::class, 'addExpense'])->name('financial.expenses.store');
            Route::post('booking/{bookingId}/complete', [FinancialController::class, 'completeBooking'])->name('booking.complete');
            Route::resource('medical_records', MedicalRecordController::class);
            Route::put('/clinic/settings', [ClinicSettingsController::class, 'update'])->name('settings.update');
            Route::put('/clinic/settings/change-password', [ClinicSettingsController::class, 'changePassword'])->name('settings.changePassword');
            Route::get('/clinic/settings', [ClinicSettingsController::class, 'index'])->name('settings.index');

            // Auth::routes();
    });

});
