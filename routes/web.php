<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

// Halaman utama - menampilkan semua event boxes
Route::get('/', [EventController::class, 'index'])->name('events.index');

// API untuk create event
Route::post('/events', [EventController::class, 'store'])->name('events.store');

// API untuk delete event
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

// API untuk get detail event (untuk countdown modal)
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');