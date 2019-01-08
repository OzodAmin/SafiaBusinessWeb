<?php ?>
@extends('admin.layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Order #{{ $order->id }}&nbsp;<a href="{!! route('orders.index') !!}" class="btn btn-default">Back to
                list</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class="col-sm-2"></th>
                    <th class="col-sm-4">Product</th>
                    <th class="col-sm-2">Price</th>
                    <th class="col-sm-2">Quantity</th>
                    <th class="col-sm-2">Total</th>
                </tr>
                </thead>
                <tbody>

                @foreach($order->products as $product)
                    <tr class="products-users">
                        <td class="col-sm-2">
                            @if ($product->featured_image)
                                {{ Html::image('uploads/product/admin_'.$product->featured_image) }}
                            @else
                                {{ Html::image('img/320.jpg') }}
                            @endif
                        </td>
                        <td class="col-sm-4">
                            {{ $product->translate('ru')->title }}
                        </td>
                        <td class="col-sm-2">
                            <?= number_format($product->price, 2, '.', ' '); ?>&nbsp;Сум
                        </td>
                        <td class="col-sm-2">
                            {{ $product->pivot->quantity }}
                            &nbsp;
                            {{ $product->measure->translate('ru')->title_short }}
                        </td>
                        <td class="col-sm-2">
                            {{ $product->price * $product->pivot->quantity }}&nbsp;Сум
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="3"></td>
                    <td class="col-sm-2">
                        Total:
                    </td>
                    <td class="col-sm-2">
                        <?= number_format($order->total_price, 2, '.', ' '); ?>&nbsp;Сум
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-2">
                        Prefered time:
                    </td>
                    <td colspan="4">
                        {{ $order->prefered_time }}
                    </td>
                </tr>
                <tr>
                    <td class="col-sm-2">
                        Note:
                    </td>
                    <td colspan="4">
                        {{ $order->note }}
                    </td>
                </tr>
                </tbody>
            </table>
            <a href="{!! route('orders.index') !!}" class="btn btn-default">Back to list</a>
        </div>
    </div>
@endsection