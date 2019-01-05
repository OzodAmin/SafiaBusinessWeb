<?php

namespace App\Http\Controllers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Cart;
use App\User;
use Session;
use Auth;
use App;
use DB;

class HomeController extends AppBaseController
{
    private $repository;
    private $catId;

    public function __construct(ProductRepository $repo)
    {
        $this->middleware('auth');
        $this->repository = $repo;
    }

    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $products = $this->repository->paginate(12);
        return view('shop.welcome', compact(['products']));
    }

    public function showProduct($slug)
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $product = Product::whereTranslation('locale', $locale)->whereTranslation('slug', $slug)->first();

        return view('shop.showProduct', compact(['product']));
    }

    public function showCatPro(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $this->catId = $request->catId;
        $this->repository->scopeQuery(
            function ($model) {
                return $model->where('category_id', $this->catId);
            });
        $products = $this->repository->paginate(12);
        return view('shop.welcome', compact(['products']));
    }

    public function getCatName()
    {
        $catName = DB::table('measurement_translations')
            ->select("measure_id", "title")
            ->where("locale", $this->locale)
            ->get();

        return response()->json($catName);
    }

    public function getUser(){
        $user = User::find(auth()->id());
        return view('shop.user', compact(['user']));
    }
}
