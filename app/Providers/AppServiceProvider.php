<?php

namespace App\Providers;

use App\Services\CompanyService;
use App\Services\EmployeeService;
use App\Services\Interfaces\CompanyServiceInterface;
use App\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyServiceInterface::class, function () {
            return new CompanyService();
        });

        $this->app->bind(EmployeeServiceInterface::class, function () {
            return new EmployeeService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
