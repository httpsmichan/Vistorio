<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
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

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/users/add', [AdminController::class, 'create'])->name('admin.users.add');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
});

require __DIR__.'/auth.php';
