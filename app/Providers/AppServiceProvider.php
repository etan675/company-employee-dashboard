<?php

namespace App\Providers;

use App\Services\CompanyService;
use App\Services\Interfaces\CompanyServiceInterface;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
