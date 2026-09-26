<?php

use App\Http\Controllers\CabinetController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('cabinet', [CabinetController::class, 'index'])
    ->middleware('auth')
    ->name('cabinet');

require __DIR__.'/auth.php';
