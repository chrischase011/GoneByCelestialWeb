<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsUpdatesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
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
    Route::get('forgot_password', [\App\Http\Controllers\AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::get('/passwordUpdate/{email}/{token}', [AuthController::class, 'passwordUpdate'])->name('passwordUpdate');

    // Post Methods
    Route::post('newUser', [\App\Http\Controllers\AuthController::class, 'newUser'])->name('newUser');
    Route::post('logUser', [\App\Http\Controllers\AuthController::class, 'login'])->name('loginUser');
    Route::post('checkEmail', [AuthController::class, 'checkEmail'])->name("checkEmail");
    Route::post('newPassword', [AuthController::class, 'newPassword'])->name("newPassword");
});

Route::group(['middleware' => 'adminAccess'],function(){
    // Get Methods
    Route::get('admin/dashboard', [\App\Http\Controllers\AdminController::class,'index'])->name('admin.index');
    Route::get('admin/users', [\App\Http\Controllers\AdminController::class,'users'])->name('admin.users');
    Route::get('admin/users/edit', [\App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
    Route::get('admin/users/add_user/{token}', [\App\Http\Controllers\AdminController::class,'add_user'])
        ->name('admin.add_user');
    Route::get('admin/news', [\App\Http\Controllers\NewsUpdatesController::class,'index'])->name('admin.news');
    Route::get('admin/news/add_news', [\App\Http\Controllers\NewsUpdatesController::class, 'add_news'])
        ->name('admin.add.news');
    Route::get('admin/news/edit', [\App\Http\Controllers\NewsUpdatesController::class, 'edit_news'])
        ->name('admin.edit.news');

    // Post Methods
    Route::post('admin/users/edit/edit_user_account',[\App\Http\Controllers\AdminController::class,'editUser'])
        ->name('admin.edit_user');
    Route::post('admin/users/set_admin', [\App\Http\Controllers\AdminController::class, 'set_admin'])
        ->name('set_admin');
    Route::post('admin/users/check_password', [\App\Http\Controllers\AdminController::class, 'check_password'])
        ->name('check_password');
    Route::post('admin/users/remove_admin', [\App\Http\Controllers\AdminController::class, 'remove_admin'])
        ->name('remove_admin');
    Route::post('admin/users/edit/edit_user',[\App\Http\Controllers\AdminController::class,'addUser'])
        ->name('admin.add.user');
    Route::post('admin/users/delete_user', [\App\Http\Controllers\AdminController::class, 'delete_user'])
        ->name('delete_user');
    Route::post('admin/news/add_news/submit_news', [\App\Http\Controllers\NewsUpdatesController::class, 'addNews'])
        ->name('submit_news');
    Route::post('admin/news/edit/edit_news', [\App\Http\Controllers\NewsUpdatesController::class, 'editNews'])
        ->name('edit_news');
    Route::post('admin/news/deleteArticle', [NewsUpdatesController::class, 'deleteArticle'])->name("deleteArticle");
});

// Is User Logged in
Route::group(['middleware' => 'isLoggedIn'],function(){

    // Get Method
    Route::get('/account', [ProfileController::class, 'index'])->name('account');

    Route::post("/fetchUser", [ProfileController::class, "fetchUser"])->name("profile.fetch");

    Route::post("/sendEmailVerification", [ProfileController::class, "sendVerification"])->name("profile.sendVerification");

    Route::get("/verifyEmail/{token}", [ProfileController::class, "verifyEmail"])->name('profile.verifyEmail');

    Route::post("/updateUserInfo", [ProfileController::class, 'updateUserInfo'])->name('profile.updateUserInfo');

    
    Route::post("passwordUserUpdate", [ProfileController::class, 'passwordUpdate'])->name("user.passwordUpdate");
});

// Routes with no required middleware

Route::get('news/{n_id}',[\App\Http\Controllers\NewsUpdatesController::class,'preview_news'])
    ->name('preview_news');
Route::get('updates/{n_id}',[\App\Http\Controllers\NewsUpdatesController::class,'preview_updates'])
    ->name('preview_updates');
Route::get("/article", [NewsUpdatesController::class, 'articles'])->name('articles');
Route::get('/game_info', [HomeController::class, 'game_info'])->name("game_info");

Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', [TestController::class, 'index'])->name('test');