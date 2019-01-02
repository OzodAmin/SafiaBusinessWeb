<?php

namespace App\Http\Controllers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Cart;
use Session;
use Auth;
use App;
use DB;

class HomeController extends AppBaseController
{
    private $repository;
    private $catId;
    private $locale;

    public function __construct(ProductRepository $repo)
    {
        $this->locale = LaravelLocalization::getCurrentLocale();
        $this->middleware('auth');
        $this->repository = $repo;
    }

    public function index(Request $request)
    {
        $locale = $this->locale;
        $this->repository->pushCriteria(new RequestCriteria($request));
        $products = $this->repository->paginate(12);
        return view('shop.welcome', compact(['products', 'locale']));
    }

    public function showProduct($slug)
    {
        $product = Product::whereTranslation('locale', $this->locale)->whereTranslation('slug', $slug)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        if (isset($oldCart)) {
            if (array_key_exists($product->id, $oldCart->items)) {
                $quantity = $oldCart->items[$product->id]['qty'];
                return view('shop.showProduct', compact(['product', 'quantity']));
            }
        }
        return view('shop.showProduct', compact(['product']));
    }

    public function showCatPro(Request $request)
    {
        $locale = $this->locale;
        $this->repository->pushCriteria(new RequestCriteria($request));
        $this->catId = $request->catId;
        $this->repository->scopeQuery(
            function ($model) {
                return $model->where('category_id', $this->catId);
            });
        $products = $this->repository->paginate(12);
        return view('shop.welcome', compact(['products', 'locale']));
    }

    public function getCatName()
    {
        $catName = DB::table('measurement_translations')
            ->select("measure_id", "title")
            ->where("locale", $this->locale)
            ->get();

        return response()->json($catName);
    }
}
