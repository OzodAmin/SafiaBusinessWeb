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
                                <th class="column-3">Min order</th>
                                <th class="column-5">Quantity</th>
                                <th class="column-4 p-l-70">Total</th>
                            </tr>
                            @foreach($cart->items as $item)
                                <tr class="table-row">
                                    <td class="column-1">
                                        <a href="{{ route('product.remove', ['id' => $item->id]) }}">
                                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                                @if ($item->featured_image)
                                                    {{ Html::image('uploads/product/admin_'.$item->featured_image) }}
                                                @else
                                                    {{ Html::image('img/320.jpg') }}
                                                @endif
                                            </div>
                                        </a>
                                    </td>
                                    <td class="column-2">
                                        <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$item->slug) }}">
                                            {{ $item->title }}
                                        </a>
                                        <p>
                                            <span id="price_{{ $item->id }}">{{ $item->price }}</span>
                                            &nbsp;{!! __('product.Sum') !!}
                                            /&nbsp;{!! __('product.'.$item->measure_id) !!}
                                        </p>
                                    </td>

                                    <td class="column-3">
                                        {{ $item->min_order }}&nbsp;{!! __('product.'.$item->measure_id) !!}
                                    </td>

                                    <td class="column-5">
                                        <div class="flex-w bo5 of-hidden w-size17">
                                            <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                            </button>

                                            <input class="size8 m-text18 t-center num-product" type="number"
                                                   name="num-product2" value="1">
                                            <span class="dis-none">{{ $item->id }}</span>
                                            <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="column-4 p-l-70">
                                        <span id="total_{{ $item->id }}" class="prices">{{ $item->price }}</span>
                                            &nbsp;{!! __('product.Sum') !!}
                                            &nbsp;&nbsp;<a href="{{ route('product.remove', ['id' => $item->id]) }}">
                                                <i class="fa fa-btn fa-trash"></i>
                                            </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <span>In order to remove product from cart press on image</span>
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
						    <span id="cartTotal">{{ $cart->totalPrice }}</span>&nbsp;{!! __('product.Sum') !!}
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
        function calculate() {
            var divs = document.getElementsByClassName("prices");
            var totalCartPrice = 0;
            for (var i = 0; i < divs.length; i += 1) {
                totalCartPrice += Number(divs[i].innerHTML);
            }
            $('#cartTotal').text(totalCartPrice);
        }
        $('.btn-num-product-down').on('click', function(e){
            e.preventDefault();
            var numProduct = Number($(this).next().val());
            if(numProduct > 0){
                var id = $(this).next().next().text();
                var res = numProduct - 1;
                var price = Number($('#price_' + id).text());
                var result = res * price;
                $(this).next().val(res);
                $('#total_' + id).text(result);  
            }
            calculate();
        });

        $('.btn-num-product-up').on('click', function(e){
            e.preventDefault();
            var numProduct = Number($(this).prev().prev().val());
            var id = $(this).prev().text();
            var res = numProduct + 1;
            var price = Number($('#price_' + id).text());
            $('#total_' + id).text(res * price);  
            $(this).prev().prev().val(res);
            calculate();
        });
    </script>
@endsection