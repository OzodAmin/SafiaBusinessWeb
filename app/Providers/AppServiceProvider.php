<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('layouts.menu', function($view) {

            $locale = LaravelLocalization::getCurrentLocale();
            $categories = Category::whereTranslation('locale', $locale)->get();

            $view->with(compact(['locale','categories'])
            );
        });
    }

    public function register()
    {
        //
    }
}
