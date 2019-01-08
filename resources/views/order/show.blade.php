@extends('layouts.app')
@section('title')
    Order #{{ $order->id }}
@endsection
@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
             style="background-image: url({{ asset('front/images/icons/heading-bg.jpg') }});">
        <h2 class="l-text2 t-center">
            Order #{{ $order->id }}
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
                            <th class="column-1"></th>
                            <th class="column-2">Product</th>
                            <th class="column-3">Price</th>
                            <th class="column-5">Quantity</th>
                            <th class="column-4 p-l-70">Total</th>
                        </tr>

                        @foreach($order->products as $product)
                            <tr class="table-row">
                                <td class="column-1">
                                    <div class="b-rad-4 o-f-hidden">
                                        @if ($product->featured_image)
                                            {{ Html::image('uploads/product/admin_'.$product->featured_image) }}
                                        @else
                                            {{ Html::image('img/320.jpg') }}
                                        @endif
                                    </div>
                                </td>
                                <td class="column-2">
                                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$product->translate($locale)->slug) }}">
                                        {{ $product->translate($locale)->title }}
                                    </a>
                                </td>

                                <td class="column-3">
                                    {{ $product->price }}
                                    &nbsp;{!! __('product.Sum') !!}
                                </td>

                                <td class="column-5">
                                    {{ $product->pivot->quantity }}
                                    &nbsp;
                                    {{ $product->measure->translate($locale)->title_short }}
                                </td>

                                <td class="column-4">
                                    {{ $product->price * $product->pivot->quantity }}
                                    &nbsp;{!! __('product.Sum') !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                <div class="flex-w flex-sb-m p-t-10 p-b-10">
                        <span class="m-text22 w-full-sm">
                            Status:
                        </span>
                        @switch($order->status)
                            @case(1)
                            <span class="m-text13 w-full-sm bg-primary">New</span>
                            @break
                            @case(2)
                            <span class="m-text21 w-full-sm bg-success">Accepted</span>
                            @break
                            @case(3)
                            <span class="m-text21 w-full-sm bg-danger">Declined</span>
                            @break
                        @endswitch
                </div>
                <div class="flex-w flex-sb-m p-t-10 p-b-10">
                        <span class="m-text22 w-full-sm">
                            Created:
                        </span>
                    <span class="m-text21 w-full-sm">
                            <?= date("d.m.Y", strtotime($order->created_at)); ?>
                        </span>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection