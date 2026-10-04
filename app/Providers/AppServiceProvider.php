<?php

namespace App\Providers;

use App\Services\SiteSettings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SiteSettings::class);
    }

    public function boot(): void
    {
        View::composer(['layouts.public', 'layouts.admin', 'components.public.*'], function ($view): void {
            try {
                if (! Schema::hasTable('site_settings')) {
                    $view->with('siteSettings', []);

                    return;
                }

                $view->with('siteSettings', app(SiteSettings::class)->all());
            } catch (\Throwable) {
                $view->with('siteSettings', []);
            }
        });
    }
}
