<?php

use App\Enums\Premise;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome', ['premises' => Premise::options()]))->name('home');

Route::get('cabinet', [CabinetController::class, 'index'])
    ->middleware('auth')
    ->name('cabinet');

Route::get('bookings/create', [BookingController::class, 'create'])
    ->middleware('auth')
    ->name('bookings.create');

Route::post('bookings', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('bookings.store');

Route::post('bookings/{booking}/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [AdminBookingController::class, 'index'])->name('bookings.index');

        Route::patch('bookings/{booking}', [AdminBookingController::class, 'update'])->name('bookings.update');
    });

require __DIR__.'/auth.php';
