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
    Route::get('companies/new', [CompaniesController::class, 'create'])->name('companies.create');
    Route::get('companies/{id}', [CompaniesController::class, 'show'])->name('companies.show');
    Route::get('companies/{id}/edit', [CompaniesController::class, 'edit'])->name('companies.edit');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
