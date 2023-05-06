<?php

use App\Http\Controllers\UnityAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/test", [UnityAPIController::class, 'test'])->name('test');

Route::post('/checkUser', [UnityAPIController::class, 'checkUser'])->name('api.checkUser');

// Player Cron Save Game
Route::post("/cronSave", [UnityAPIController::class, "cronSave"])->name("api.cronsave");