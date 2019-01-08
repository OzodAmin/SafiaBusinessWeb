@extends('layouts.app')
@section('title')
    Orders
@endsection
@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
             style="background-image: url({{ asset('front/images/icons/heading-bg.jpg') }});">
        <h2 class="l-text2 t-center">
            Orders
        </h2>
    </section>
    <!-- Order -->
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <!-- Order item -->
            <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1">Order</th>
                            <th class="column-3">Status</th>
                            <th class="column-2">Total price</th>
                            <th class="column-4">Created date</th>
                            <th class="column-5">View</th>
                        </tr>

                        @foreach($orders as $order)
                            <tr class="table-row">
                                <td class="column-1">
                                    <div class="b-rad-4 o-f-hidden">
                                        <a href="{{ route('order.show',$order->id) }}">
                                            <span class="m-text15 w-full-sm">#{{ $order->id }}</span>
                                        </a>
                                    </div>
                                </td>
                                <td class="column-3">
                                    @switch($order->status)
                                        @case(Order::NEW_ORDER)
                                        <label class="label label-primary">New</label>
                                        @break
                                        @case(Order::ACCEPTED_ORDER)
                                        <label class="label label-success">Accepted</label>
                                        @break
                                        @case(Order::DECLINED_ORDER)
                                        <label class="label label-danger">Declined</label>
                                        @break
                                    @endswitch
                                </td>

                                <td class="column-2">
                                    {{ $order->total_price }}&nbsp;{!! __('product.Sum') !!}
                                </td>

                                <td class="column-4">
                                    <?= date("d.m.Y", strtotime($order->created_at)); ?>
                                </td>

                                <td class="column-5">
                                    <a href="{{ route('order.show',$order->id) }}" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                        <span class="glyphicon glyphicon-eye-open p-t-10 p-b-10" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            {{ $orders->links() }}
        </div>
        </div>
    </section>
@endsection