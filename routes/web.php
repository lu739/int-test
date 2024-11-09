<?php

use App\Http\Controllers\AmoController;
use App\Http\Controllers\BindContactController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', MainController::class)->name('main');
Route::get('/bind-contact/{lead_id}', BindContactController::class)->name('bind-contact');
Route::get('/history', HistoryController::class)->name('history');

Route::post('/bind-contact-to-lead', [AmoController::class, 'bindContactToLead'])->name('bind-contact-to-lead');
Route::get('/get-leads', [AmoController::class, 'getLeads'])->name('get-leads');
Route::get('/get-contacts/{lead_id}', [AmoController::class, 'getContacts'])->name('get-contacts');

