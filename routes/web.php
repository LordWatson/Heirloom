<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])
            ->name('admin-dashboard');

        Route::resource('user', \App\Http\Controllers\UserController::class);
        Route::resource('item', \App\Http\Controllers\ItemController::class);
        Route::resource('will', \App\Http\Controllers\WillController::class);
    });
});

require __DIR__.'/auth.php';
