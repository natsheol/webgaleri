<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SchoolProfile;

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
        // Share School Profile ke semua view
        View::composer('*', function ($view) {
            $schoolProfile = SchoolProfile::first();
            $view->with('schoolProfile', $schoolProfile);
        });
    }
}
