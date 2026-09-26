<?php

use App\Enums\Premise;
use App\Http\Controllers\CabinetController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome', ['premises' => Premise::options()]))->name('home');

Route::get('cabinet', [CabinetController::class, 'index'])
    ->middleware('auth')
    ->name('cabinet');

require __DIR__.'/auth.php';
