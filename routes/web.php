<?php

use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\ProgramController;
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
    return view('main');
});
Route::get('/apa', function () {
    return view('auth.welcome');
});

Route::get('/coba', function () {
    return view('auth.home');
});

// Route::middleware('auth')->group(function () {
//     Route::prefix('baznas')->name('baznas.')->middleware('baznas')->group(function () {
//         Route::get('/main', function () {
//             return view('main');
//         })->name('main');
//     });
// });

Route::get('/permohonan', [PermohonanController::class, 'index'])->name('permohonan');
Route::get('/program', [ProgramController::class, 'index'])->name('program');
Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus');

