<?php

use App\Http\Middleware\CheckTypeNumberRangeMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/{type}/{number}', [PageController::class, 'show'])
    ->middleware(CheckTypeNumberRangeMiddleware::class)
    ->name('qr');
