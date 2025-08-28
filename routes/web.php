<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\Auth\StudentRegistrationController;
use App\Http\Controllers\Auth\ForgotPasswordTicketController;
use App\Http\Controllers\Auth\ForcedPasswordController;
use App\Http\Middleware\EnsurePasswordChanged;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Equipment routes (public)
Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('/equipment/{equipment}', [EquipmentController::class, 'show'])->name('equipment.show');

// Authentication routes - custom student registration and password help
Route::get('/login', fn() => Inertia::render('auth/login'))->name('login'); // view custom, action POST /login tetap bawaan
Route::get('/register-mahasiswa', fn() => Inertia::render('auth/register-mahasiswa'))->name('register.mahasiswa');
Route::post('/register-mahasiswa', [StudentRegistrationController::class, 'store'])->name('register.mahasiswa.store');

Route::get('/bantuan-password', fn() => Inertia::render('auth/forgot-password-ticket'))->name('password.ticket');
Route::post('/tickets-password', [ForgotPasswordTicketController::class, 'store'])->name('tickets-password.store');

// Force password change routes
Route::middleware(['auth'])->group(function () {
    Route::get('/password/force-reset', fn() => Inertia::render('auth/force-password-change'))->name('password.force');
    Route::post('/password/force-reset', [ForcedPasswordController::class, 'update'])->name('password.force.update');
});

Route::middleware(['auth', 'verified', EnsurePasswordChanged::class])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
