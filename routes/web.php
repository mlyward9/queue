<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-connection', [ConnectionController::class, 'check'])->name('check.connection');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Form Routes
    Route::prefix('form')->group(function () {
        Route::get('/', [FormController::class, 'showForm'])->name('form.show');
        Route::post('/', [FormController::class, 'submitForm'])->name('form.submit');
    });

    // Queue Routes
    Route::prefix('queue')->group(function () {
        Route::get('/', [FormController::class, 'viewQueue'])->name('queue.view');
        Route::get('/display', [FormController::class, 'showQueue'])->name('queue.display');
        Route::put('/update-status/{id}', [FormController::class, 'updateStatus'])->name('queue.updateStatus');
        Route::get('/{id}/edit', [FormController::class, 'edit'])->name('queue.edit');
        Route::put('/{id}', [FormController::class, 'update'])->name('queue.update');
        Route::delete('/{id}', [FormController::class, 'destroy'])->name('queue.destroy');
    });
});

// Authentication Routes
require __DIR__.'/auth.php';