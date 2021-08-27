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
$path = "App\Http\Controllers\\";
Route::get('login', [$path.AuthController::class, 'index'])->name('login');
Route::get('register',[$path.AuthController::class, 'register'])->name('register');
Route::post('newUser', [$path.AuthController::class, 'newUser'])->name('newUser');
Route::post('logUser', [$path.AuthController::class, 'login'])->name('loginUser');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
