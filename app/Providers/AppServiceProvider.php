<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once app_path('Helpers/RunnerHelper.php');
        // Register MenuService as a Singleton
    $this->app->singleton(\App\Services\MenuService::class, function ($app) {
        return new \App\Services\MenuService(new \GuzzleHttp\Client());
    });
    }
}
