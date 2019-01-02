<?php

namespace App\Http\Controllers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Repositories\ProductRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class FavoriteController extends AppBaseController
{
    private $repository;

    public function __construct(ProductRepository $repo)
    {
        $this->middleware('auth');
        $this->repository = $repo;
    }

    public function addToFavorite(Request $request)
    {
        try {
            DB::insert('insert into favorites (user_id, product_id) values (?, ?)', [auth()->id(), $request->product_id]);
            return response()->json(['status' => 'success', 'text' => 'is added to favourite!'], 200);
        } catch (QueryException $ex) {
            return response()->json(['status' => 'error', 'text' => 'is already in favourite list!'], 200);
        }

    }

    public function removeFavorite(Request $request)
    {
        $affected = DB::delete('DELETE FROM favorites WHERE user_id = :u_id AND product_id = :p_id',
            ['u_id' => auth()->id(), 'p_id' => $request->product_id]);
        if ($affected > 0)
            return response()->json(['status' => 'success', 'text' => 'is removed from favourite!'], 200);
        else
            return response()->json(['status' => 'error', 'text' => 'Internal Server Error'], 200);


    }

    public function getFavourites()
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $products = DB::table('favorites')
            ->join('product', 'favorites.product_id', '=', 'product.id')
            ->join('product_translations', 'favorites.product_id', '=', 'product_translations.product_id')
            ->select('product.price', 'product.id', 'product.measure_id', 'product.featured_image', 'product_translations.title', 'product_translations.slug')
            ->where('favorites.user_id', auth()->id())
            ->where('product_translations.locale', $locale)
            ->get();
        return view('shop.favourite', compact(['products']));
    }
}