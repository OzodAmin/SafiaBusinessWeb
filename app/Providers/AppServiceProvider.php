<?php

namespace App\Providers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Cart;
use Session;
use Auth;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $favorites = DB::select('select product_id from favorites where user_id = :id', ['id' => Auth::id()]);
                $favoritesArray = [];
                foreach($favorites as $item) {
                    $favoritesArray[$item->product_id] = $item->product_id;
                }
                $view->with(compact(['favoritesArray']));
            }
        });

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
