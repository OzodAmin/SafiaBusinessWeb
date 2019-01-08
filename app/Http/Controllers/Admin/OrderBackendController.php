<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Session;

class OrderBackendController extends AppBaseController
{
    private $repository;

    public function __construct(OrderRepository $repo)
    {
        $this->repository = $repo;
    }

    public function index(Request $request)
    {
        $this->repository->pushCriteria(new RequestCriteria($request));
        $this->repository->scopeQuery(
            function ($model) {
                return $model->orderBy('status');
            });
        $orders = $this->repository->paginate(12);

        return view('admin.order.index', compact(['orders']));
    }

    public function create(){}

    public function productRemove(Request $request){
        $order = Order::findOrFail($request['orderId']);
        $order->products()->detach($request['productId']);
        return response()->json(['status' => $request['orderId']], 200);
    }

    public function store(Request $request){}

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.show', ['order' => $order]);
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.edit', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->total_price = $request['total_price'];
        $order->status = $request['status'];
        $order->save();

        $order->products()->detach();

        foreach ($request['ptoduct_id'] as $key => $value) {
            DB::table('order_product')->insert(
                ['order_id' => $id, 'product_id' => $value, 'quantity' => $request['quantity'][$key]]
            );
        }

        return redirect()->route('orders.show', $id);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->products()->detach();
        $order->delete();
        return redirect(route('orders.index'));
    }
}
