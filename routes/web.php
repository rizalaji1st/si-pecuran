<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    ManajemenUserController,
    ManajemenWilayahController,
    ManajemenCurahHujanController,
    PublikController
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
    Route::prefix('manajemen-wilayah')->name('manajemen-wilayah.')->group(function(){
        Route::get('/',[ManajemenWilayahController::class,'index'])->name('index');
        Route::post('/store',[ManajemenWilayahController::class,'store'])->name('store');
        Route::post('/update',[ManajemenWilayahController::class,'update'])->name('update');
        Route::post('/destroy/{wilayah}',[ManajemenWilayahController::class,'destroy'])->name('destroy');
    });
    Route::prefix('manajemen-curah-hujan')->name('manajemen-curah-hujan.')->group(function(){
        Route::get('/',[ManajemenCurahHujanController::class,'index'])->name('index');
        Route::post('/update',[ManajemenCurahHujanController::class,'update'])->name('update');
        Route::post('/get-data',[ManajemenCurahHujanController::class,'getData'])->name('get-data');
    });
});


Route::prefix('publik')->name('publik.')->group(function () {
    Route::prefix('data-curah-hujan')->name('data-curah-hujan.')->group(function(){
        Route::get('/',[PublikController::class,'index'])->name('index');
        Route::post('/get-data',[PublikController::class,'getData'])->name('get-data');
    });
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

