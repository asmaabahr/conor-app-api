<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');

});
Route::middleware('auth:sanctum')->post('/logout',[App\Http\Controllers\Auth\AuthController::class,'logout']);
Route::post('password/forget-password',[ForgetPasswordController::class,'forgetpassword']);
Route::post('password/reset-password',[ResetPasswordController::class,'paswwordreset']);
Route::post('/upload',[\App\Http\Controllers\UserController::class,'Upload']);
Route::post('/contact_us',[\App\Http\Controllers\UserController::class,'contact']);
