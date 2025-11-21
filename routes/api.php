<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;

Route::get('/', function() {
    return 'Laravel is running!';
});

Route::post('/register', [AuthController::class,'Register']);
Route::post('/login',[AuthController::class,'Login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'User']);
    Route::post('/logout', [AuthController::class, 'logout']);
});