<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('companies', [CompaniesController::class, 'index'])->name('companies');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
