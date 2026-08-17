<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view): void {
            $siteSetting = SiteSetting::current();

            $view->with('siteSetting', $siteSetting);
            $view->with('siteLogoUrl', $siteSetting->logo
                ? asset('storage/' . $siteSetting->logo)
                : asset('images/brand/joya-logo-transparent-dark-text.png'));
            $view->with('siteFaviconUrl', $siteSetting->favicon
                ? asset('storage/' . $siteSetting->favicon)
                : null);
        });
    }
}
