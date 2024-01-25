<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\RegisterController;

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

Route::get('',[HomeController::class, 'index'])->name('index');
Route::post('',[HomeController::class, 'storeProduct'])->name('storeProduct');

Route::get('register',[RegisterController::class, 'registerForm'])->name('registerForm')->middleware('guest');
Route::post('register',[RegisterController::class, 'register'])->name('register')->middleware('guest');

Route::post('login',[AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('logout',[AuthController::class, 'logout'])->name('logout')->middleware('auth');
