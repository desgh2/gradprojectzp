<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
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
        // Paginator::useBootstrap();
        Paginator::useBootstrapFive();

        $this->app->bind('setting', function () {
            $setting = \App\Models\Setting::first();
            if (!$setting) {
                $setting = new Setting();
                $setting->work_time = 'ПН-ПТ: 8:00-17:00';
                $setting->address = 'проспект Металургів, 11, м.Запоріжжя';
            }
            return $setting;
        });
    }
}
