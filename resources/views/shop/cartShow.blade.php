@extends('layouts.app')
@section('title')
    Cart
@endsection
@section('content')
        <!-- Title Page -->
        <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
                 style="background-image: url({{ asset('front/images/icons/heading-bg.jpg') }});">
            <h2 class="l-text2 t-center">
                Cart
            </h2>
        </section>
        @if (Session::has('cart'))
        <!-- Cart -->
        <section class="cart bgwhite p-t-70 p-b-100">
            <div class="container">
                <!-- Cart item -->
                <div class="container-table-cart pos-relative">
                    <div class="wrap-table-shopping-cart bgwhite">
                        <table class="table-shopping-cart">
                            <tr class="table-head">
                                <th class="column-1"></th>
                                <th class="column-2">Product</th>
                                <th class="column-3">Price</th>
                                <th class="column-4 p-l-70">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>
                            @foreach($cart->items as $item)
                                <tr class="table-row">
                                    <td class="column-1">
                                        <a href="{{ route('product.remove', ['id' => $item['item']['id']]) }}">
                                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                                @if ($item['item']['featured_image'])
                                                    {{ Html::image('uploads/product/admin_'.$item['item']['featured_image']) }}
                                                @else
                                                    {{ Html::image('img/320.jpg') }}
                                                @endif
                                            </div>
                                        </a>
                                    </td>
                                    <td class="column-2">
                                        <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$item['item']['slug']) }}">
                                            {{ $item['item']['title'] }}
                                        </a>
                                    </td>

                                    <td class="column-3">{{ $item['item']['price'] }}
                                        &nbsp;{!! __('product.Sum') !!}</td>
                                    <td class="column-4 p-l-70">
                                        {{ $item['qty'] }}&nbsp;<span
                                                class="measure">{{ $item['item']['measure_id']}}</span>
                                    </td>
                                    <td class="column-5">{{ $item['price'] }}&nbsp;{!! __('product.Sum') !!}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <!-- Total -->
                <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                    <h5 class="m-text20 p-b-24">
                        Cart Totals
                    </h5>
                    <div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>
                        <span class="m-text21 w-size20 w-full-sm">
						{{ $cart->totalPrice }}&nbsp;{!! __('product.Sum') !!}
					</span>
                    </div>

                    <div class="size15 trans-0-4">
                        <!-- Button -->
                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                            Proceed to Checkout
                        </button>
                    </div>
                </div>
            </div>
        </section>
    @else
            <h1>Cart is empty</h1>
    @endif
@endsection
@section('scripts')
    <script>
        $(function () {
            $.ajax({
                type: "GET",
                url: "{{url('getCatName')}}",
                success: function (res) {
                    if (res) {
                        var divs = document.getElementsByClassName("measure");
                        for (var i = 0; i < divs.length; i += 1) {
                            $.each(res, function (key, value) {
                                if (value['measure_id'] == divs[i].innerHTML) {
                                    divs[i].innerHTML = value['title'];
                                }
                            });
                        }
                    }
                }
            });
        });
    </script>
@endsection