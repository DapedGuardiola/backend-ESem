<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/home', function () {
    return view('homepage');
})->name('home');