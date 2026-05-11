<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController; 
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TreatmentController;

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

use App\Http\Controllers\KelasController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Dashboard (Akses untuk semua)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    // Akses Penuh (Admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('kelas', KelasController::class);
        Route::resource('student', StudentController::class);
        Route::resource('medicine', MedicineController::class)->except(['index']);
        Route::get('/report', [TreatmentController::class, 'report'])->name('treatment.report');
    });

    // Petugas & Admin (Bisa lihat list obat dan catat kunjungan)
    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine.index');
        Route::resource('treatment', TreatmentController::class);
    });
});
