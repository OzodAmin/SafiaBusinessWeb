<?php

namespace App\Http\Controllers;

use App;
use App\Cart;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Auth;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Prettus\Repository\Criteria\RequestCriteria;
use Session;
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

    public function addToCart(Request $request)
    {
        $product = $this->repository->findWithoutFail($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if (isset($request->qty))
            $cart->add($product, $product->id, $request->qty);
        else
            $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return back();
    }

    public function getCatName()
    {
        $catName = DB::table('measurement_translations')
            ->select("measure_id", "title")
            ->where("locale", $this->locale)
            ->get();

        return response()->json($catName);
    }

    public function showCart()
    {
        if (!Session::has('cart')) {
            return view('shop.cartShow');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.cartShow', ['cart' => $cart, 'locale' => $this->locale]);
    }

    public function getRemoveItem(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($request->id);

        if (count($cart->items) > 0)
            $request->session()->put('cart', $cart);
        else
            $request->session()->forget('cart');
        return redirect()->back();
    }
}
