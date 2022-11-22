<?php

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
    return view('index');
});

Route::get('/egg/create', [EggController::class, 'create'])->name('egg.create');

Route::get('/mating/create', [MatingController::class, 'create'])->name('mating.create');

Route::get('/reptile/create', [ReptileController::class, 'create'])->name('reptile.create');

Route::get('/type/create', [TypeController::class, 'create'])->name('type.create');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
