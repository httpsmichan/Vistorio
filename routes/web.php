<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
    
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'visitor'])->name('dashboard');
Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified', 'admin'])->name('admin');
Route::get('/receptionist', function () {
    return view('receptionist');
})->middleware(['auth', 'verified', 'receptionist'])->name('receptionist');
Route::get('/host', function () {
    return view('host');
})->middleware(['auth', 'verified', 'host'])->name('host');

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin');

Route::get('/admin/appointments', [AdminController::class, 'appointments'])
    ->middleware(['auth', 'admin'])
    ->name('admin.appointments');

Route::get('/receptionist/appointments/lookup', [AppointmentController::class, 'lookup'])
    ->middleware(['auth', 'receptionist'])
    ->name('receptionist.appointments.lookup');

Route::post('/appointments/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');


Route::get('/host/manage-appointments', [HostController::class, 'manageAppointments'])->name('manage.appointments');
Route::post('/host/update-appointment-status', [HostController::class, 'updateStatus'])->name('update.appointment.status');
Route::get('/appointment-logs', [HostController::class, 'showAppointmentLogs'])->name('appointment.logs');
Route::get('/host/visitor-logs', [HostController::class, 'showVisitorLogs'])->name('host.visitor-logs');
Route::get('/host/calendar', [HostController::class, 'calendarView'])->name('host.calendar');
Route::get('/host/notifications', [HostController::class, 'showNotifications'])->name('host.notifications');


Route::get('/walk-in', [VisitorController::class, 'create'])->name('walk-in.create');
Route::post('/walk-in', [VisitorController::class, 'store'])->name('walk-in.store');
Route::get('/log-out', [VisitorController::class, 'search'])->name('log-out.search');
Route::patch('/log-out/{id}', [VisitorController::class, 'logout'])->name('log-out.update');

Route::get('/visit-history', [VisitorController::class, 'visitHistory'])->middleware('auth')->name('visit.history');
Route::get('/visitor/notifications', [VisitorController::class, 'notifications'])->name('visitor.notifications');

Route::get('/receptionist/notifications', [NotificationController::class, 'index'])->name('receptionist.notifications');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/users/add', [AdminController::class, 'create'])->name('admin.users.add');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/visitor-logs', [AdminController::class, 'adminVisitorLogs'])->name('admin.visitor.logs');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');


     // Employee Management
     Route::get('/employees', [AdminController::class, 'showEmployeeForm'])->name('admin.employees');
     Route::post('/employees/save', [AdminController::class, 'storeEmployee'])->name('admin.saveEmployee');
     Route::get('/employees/{id}/edit', [AdminController::class, 'editEmployee'])->name('admin.employees.edit');
    Route::put('/employees/{id}', [AdminController::class, 'updateEmployee'])->name('admin.employees.update');
    Route::delete('/employees/{id}', [AdminController::class, 'destroyEmployee'])->name('admin.employees.destroy');
});



require __DIR__.'/auth.php';
