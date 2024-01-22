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
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            //Головне меню
            $primary_menu = Category::getPrimaryMenu();

            $footer_menu = Category::with('subcategories')->whereNull('parent')
                ->where('footer_menu', TRUE)
                ->get();

            //Налаштування сайта (години, адреса)
            $setting = Setting::first();
            if (!$setting) {
                $setting = new Setting();
                $setting->work_time = 'ПН-ПТ: 8:00-17:00';
                $setting->address = 'вул.Зелінського, 3, м.Запоріжжя, 69126';
            }


            $view->with([
                'primary_menu' => $primary_menu,
                'footer_menu' => $footer_menu,
                'setting' => $setting,
            ]);
        });
    }
}
