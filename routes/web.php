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
Route::group(['middleware' => 'checkAccess'], function(){
    // Get Methods
    Route::get('login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::get('register',[\App\Http\Controllers\AuthController::class, 'register'])->name('register');

    // Post Methods
    Route::post('newUser', [\App\Http\Controllers\AuthController::class, 'newUser'])->name('newUser');
    Route::post('logUser', [\App\Http\Controllers\AuthController::class, 'login'])->name('loginUser');
});

Route::group(['middleware' => 'adminAccess'],function(){
    // Get Methods
    Route::get('admin/dashboard', [\App\Http\Controllers\AdminController::class,'index'])->name('admin.index');
    Route::get('admin/users', [\App\Http\Controllers\AdminController::class,'users'])->name('admin.users');
    Route::get('admin/users/edit', [\App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
    Route::get('admin/users/add_user/{token}', [\App\Http\Controllers\AdminController::class,'add_user'])
        ->name('admin.add_user');

    // Post Methods
    Route::post('admin/users/edit/edit_user',[\App\Http\Controllers\AdminController::class,'editUser'])
        ->name('admin.edit.user');
    Route::post('admin/users/set_admin', [\App\Http\Controllers\AdminController::class, 'set_admin'])
        ->name('set_admin');
    Route::post('admin/users/check_password', [\App\Http\Controllers\AdminController::class, 'check_password'])
        ->name('check_password');
    Route::post('admin/users/remove_admin', [\App\Http\Controllers\AdminController::class, 'remove_admin'])
        ->name('remove_admin');
    Route::post('admin/users/edit/edit_user',[\App\Http\Controllers\AdminController::class,'addUser'])
        ->name('admin.add.user');

});
Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
