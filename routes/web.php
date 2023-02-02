<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MatingController;
use App\Http\Controllers\ReptileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EggController;
use App\Http\Controllers\HomeController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
       return redirect(url("todo"));
    })->name('home');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('todo', TodoController::class);

    Route::resource('egg', EggController::class);
    Route::resource('mating', MatingController::class);
    Route::get('/reptile/large-create', [ReptileController::class, 'largeCreate'] )
        ->name('reptile.large.create');
    Route::post('/reptile/large-store', [ReptileController::class, 'largeStore'] )
        ->name('reptile.large-store');
    Route::resource('reptile', ReptileController::class);
    Route::resource('type', TypeController::class);

    Route::get('privacy-policy', function () {
        return view('front.privacy-policy');
    })->name('privacy-policy');
});

Route::get('/', [HomeController::class, 'introduction']);
