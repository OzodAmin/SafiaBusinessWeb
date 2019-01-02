<?php
namespace App\Http\Controllers;

use App\Cart;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Session;

class CartController extends AppBaseController
{
    private $repository;
    public function __construct(ProductRepository $repo)
    {
        $this->middleware('auth');
        $this->repository = $repo;
    }

    public function addToCart(Request $request)
    {
        $product = $this->repository->findWithoutFail($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if (isset($request->qty))
            $cart->add($product, $product->id, $request->qty);
        else
            $cart->add($product, $product->id, 1);

        $request->session()->put('cart', $cart);
        return back();
    }

    public function showCart()
    {
        if (!Session::has('cart')) {
            return view('shop.cartShow');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.cartShow', ['cart' => $cart]);
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