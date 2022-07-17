<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    ManajemenUserController
};

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
    return view('welcome');
});

Route::middleware('can:administrator')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::middleware('can:are-superAdmin')->group(function(){
        Route::prefix('manajemen-user')->name('manajemen-user.')->group(function(){
            Route::get('/',[ManajemenUserController::class,'index'])->name('index');
            Route::post('/store',[ManajemenUserController::class,'store'])->name('store');
            Route::post('/update',[ManajemenUserController::class,'update'])->name('update');
            Route::post('/destroy/{user}',[ManajemenUserController::class,'destroy'])->name('destroy');
        });

    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
