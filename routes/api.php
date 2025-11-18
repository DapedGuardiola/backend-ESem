<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;

Route::get('/ping',[TestController::class,'ping']);