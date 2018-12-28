<?php
namespace App\Http\Controllers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Cart;
use Session;
use Auth;
use App;

class HomeController extends AppBaseController
{
    private $repository;
    private $locale;

    public function __construct(ProductRepository $repo)
    {
        $this->locale = LaravelLocalization::getCurrentLocale();
        $this->middleware('auth');
        $this->repository = $repo;
        // $this->defaultLocale = $this->locale;
        // App::setLocale($this->defaultLocale);
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
        return view('shop.showProduct', compact(['product']));
    }

    public function showCatPro(Request $request)
    {
        $locale = $this->locale;
        $this->repository->pushCriteria(new RequestCriteria($request));
        $products = $this->repository->paginate(12);
        return view('shop.welcome', compact(['products', 'locale']));
    }

    public function addToCart(Request $request){
        $product = $this->repository->findWithoutFail($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return back();
    }

    public function showCart(){
        if (!Session::has('cart')) {
            return view('shop.cartShow');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.cartShow', ['cart' => $cart]);
    }
}
