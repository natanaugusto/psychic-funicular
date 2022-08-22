<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(callback:function () {
    Route::get(uri:'/', action:fn () => redirect(to:route(name:'dashboard')));
    Route::get(uri:'/dashboard', action:fn () => view('dashboard'))->name('dashboard');
    Route::get(uri:'/companies', action:fn () => view('companies'))->name('companies');
});

require __DIR__.'/auth.php';
