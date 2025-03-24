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
    });
// });




