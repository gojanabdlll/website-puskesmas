<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FooterSetting;
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
        View::composer('components.footer', function ($view) {
            $footer = FooterSetting::find(1);

            $view->with('footer', $footer);
        });
    }
}
