<?php

namespace App\Providers;

use App\Cart;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Session;
use Illuminate\Support\Facades\Schema;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('layouts.menu', function ($view) {

            $locale = LaravelLocalization::getCurrentLocale();
            $categories = Category::whereTranslation('locale', $locale)->get();

            $view->with(compact(['locale', 'categories'])
            );
        });

        view()->composer('layouts.cart', function ($view) {
            $cart = null;
            $locale = LaravelLocalization::getCurrentLocale();
            if (Session::has('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
            }

            $view->with(compact(['locale', 'cart'])
            );
        });
    }

    public function register()
    {
        //
    }
}
