<?php

use App\Enums\Premise;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome', ['premises' => Premise::options()]))->name('home');

Route::get('cabinet', [CabinetController::class, 'index'])
    ->middleware('auth')
    ->name('cabinet');

Route::post('bookings/{booking}/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

require __DIR__.'/auth.php';
