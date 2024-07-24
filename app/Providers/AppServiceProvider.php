<?php

namespace App\Providers;

use App\Models\Bansos;
use Illuminate\Support\Facades\View;
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
        View::composer('home.navbar', function ($view) {
            $view->with('bansos', Bansos::all());
        });
    }
}
