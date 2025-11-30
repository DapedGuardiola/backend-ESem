<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;

// Event booking routes
Route::get('/event/{eventId}/booking', [EventController::class, 'showBooking'])->name('event.booking');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

Route::get('/home', function () {
    return view('homepage');
})->name('home');