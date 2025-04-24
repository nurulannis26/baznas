<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Auth;
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

// Route::middleware(['web'])->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', function () {
            // dd('as');
            return view('auth.welcome');
        })->name('login');
        Route::get('/', function () {
            return view('auth.welcome');
        });
        Route::post('/login_ver', [LoginController::class, 'verifikasi'])->name('login.action');
    });
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/home', [LoginController::class, 'home'])->name('home');
        Route::get('/permohonan', [PermohonanController::class, 'index'])->name('permohonan');
        Route::get('/program', [ProgramController::class, 'index'])->name('program');
        Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus');
        Route::get('/detail-permohonan/{permohonan_id}', [PermohonanController::class, 'detail_permohonan'])->name('permohonan.detail');
        Route::post('/filter_permohonan_post', [PermohonanController::class, 'filter_permohonan_post']);
        Route::get('/filter_permohonan/{c_filter_daterange}/{c_filters_fo}/{c_filters_atasan}/{c_filters_survey}/{c_filters_pencairan}/{c_filters_lpj}', [PermohonanController::class, 'filter_permohonan']);
        // Route::get('/print_permohonan/{filter_daterange}/{filters_fo}/{filters_atasan}/{filters_pencairan}/{filters_survey}/{filters_lpj}', [PermohonanController::class, 'print_permohonan_pdf'])->name('print_permohonan_pdf');
        Route::get('/print_permohonan', [PermohonanController::class, 'print_permohonan_pdf'])
        ->name('print_permohonan_pdf');

    });
// });




