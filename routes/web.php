<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DownloadQR;

// Event booking routes

Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

//seminar
Route::get('/seminar', [SeminarController::class, 'index'])->name('seminar.index');

Route::get('/',[HomeController::class,'home']);
Route::get('/{eventId}/booking', [HomeController::class, 'booking'])->name('event.booking');
Route::get('/qrdownload/{fileName}',[DownloadQR::class,'download'])->name('qr.qrdownload');