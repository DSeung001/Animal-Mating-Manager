<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MatingController;
use App\Http\Controllers\ReptileController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EggController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url("login"));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('egg', EggController::class);
    Route::resource('mating', MatingController::class);
    Route::resource('reptile', ReptileController::class);
    Route::resource('type', TypeController::class);

    Route::get('privacy-policy', function () {
        return view('front.privacy-policy');
    })->name('privacy-policy');
});
