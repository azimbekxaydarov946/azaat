<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::get('/',[HomeController::class,'index'])->name('home');
        Route::get('/create',[HomeController::class,'create'])->name('home.create');
        Route::post('/store',[HomeController::class,'store'])->name('home.store');
        Route::get('/dowload/{id}',[HomeController::class,'dowload'])->name('home.dowload');
        Route::get('/edit/{id}',[HomeController::class,'edit'])->name('home.edit');
        Route::put('/update/{id}',[HomeController::class,'update'])->name('home.update');
        Route::delete('/delete/{id}',[HomeController::class,'destroy'])->name('home.delete');
        Route::get('/status/{id}',[HomeController::class,'status'])->name('home.status');
        Route::get('/canceled/{id}',[HomeController::class,'canceled'])->name('home.canceled');

        Route::get('/category',[CategoryController::class,'index'])->name('category');
        Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
        Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::put('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
        Route::delete('/category/delete/{id}',[CategoryController::class,'destroy'])->name('category.delete');

});
