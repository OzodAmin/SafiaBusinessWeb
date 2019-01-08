<?php

namespace App\Http\Controllers;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use Session;

class OrderController extends AppBaseController
{
    private $repository;

    public function __construct(OrderRepository $repo){
        $this->repository = $repo;
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $this->repository->scopeQuery(
            function ($model) {
                return $model->where('user_id', auth()->id());
            });
        $orders = $this->repository->paginate(12);

        return view('order.index', compact(['orders']));
    }

    public function getOrderCountAjax()
    {
        $orders = DB::table('orders')->where('status', 1)->count();
        return response()->json(['orders' => $orders], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'prefered_time' => 'required',
            'total_price'   => 'numeric|required|not_in:0',
        ]);
        if ($request['total_price'] < 150000){
            return redirect()->back()->withErrors('error');
        }
        $cart = Session::has('cart') ? Session::get('cart') : null;
        if (empty($cart)) {
            return redirect('/')->with('isError', true);
        }

        $new = new Order();
        $new->user_id = auth()->id();
        $new->total_price = $request['total_price'];
        $new->prefered_time = $request['prefered_time'];
        $new->note = $request['note'];
        $new->status = Order::NEW_ORDER;
        $new->save();

        // $new->products()->attach($request['ptoduct_id'], ['quantity' => $request['quantity']]);
        $order_id = DB::getPdo()->lastInsertId();
        foreach ($request['ptoduct_id'] as $key => $value) {
            DB::table('order_product')->insert(
                ['order_id' => $order_id, 'product_id' => $value, 'quantity' => $request['quantity'][$key]]
            );
        }
        Session::forget('cart');
        return redirect()->route('order.show', $order_id);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        if (!$order->user_id == auth()->id()) {
            $order = null;
        }
        return view('order.show', ['order' => $order]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
