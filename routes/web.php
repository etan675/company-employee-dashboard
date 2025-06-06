<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('companies/new', [CompaniesController::class, 'create'])->name('companies.create');
    Route::post('companies', [CompaniesController::class, 'store'])->name('companies.store');
    Route::get('companies/{id}', [CompaniesController::class, 'show'])->name('companies.show');
    Route::get('companies/{id}/edit', [CompaniesController::class, 'edit'])->name('companies.edit');
    Route::patch('companies/{id}', [CompaniesController::class, 'update'])->name('companies.update');

    Route::get('companies/{companyId}/employees/new', [EmployeesController::class, 'create'])->name('employees.create');
    Route::get('companies/{companyId}/employees/{employeeId}', [EmployeesController::class, 'show'])->name('employees.show');
    Route::post('companies/{companyId}/employees', [EmployeesController::class, 'store'])->name('employees.store');
    Route::delete('companies/{companyId}/employees/{employeeId}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
