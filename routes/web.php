<?php

use App\Http\Controllers\BindContactController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', MainController::class)->name('main');
Route::get('/bind-contact', BindContactController::class)->name('bindContact');
Route::get('/history', HistoryController::class)->name('history');

