@extends('layouts.app')
@section('title')
    Favourite
@endsection
@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
             style="background-image: url({{ asset('front/images/icons/heading-bg.jpg') }});">
        <h2 class="l-text2 t-center">
            Favourite
        </h2>
    </section>
    <!-- Favourite -->
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <!-- Favourite item -->
            @if(count($products) > 0) 
            <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1"></th>
                            <th class="column-2">Product</th>
                            <th class="column-3">Price</th>
                            <th class="column-4 p-l-70">Add to cart</th>
                            <th class="column-5">Delete</th>
                        </tr>
                        @foreach($products as $item)
                            <tr class="table-row">
                                <td class="column-1">
                                    <a onclick="remove('{{ $item->title }}', {{ $item->id }})">
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
                                </td>

                                <td class="column-3">
                                    {{ $item->price }}&nbsp;{!! __('product.Sum') !!}&nbsp;/&nbsp;{!! __('product.'.$item->measure_id) !!}
                                </td>
                                <td class="column-4 p-l-70">
                                    <button class="flex-c-m size9 bg1 bo-rad-23 hov1 s-text1 trans-0-4"
                                            onclick="addtocart('{{ $item->title }}', {{ $item->id }})">
                                        Add to cart
                                    </button>
                                </td>
                                <td class="column-5">
                                    <button class="flex-c-m size8 bg1 bo-rad-23 hov1 s-text1 trans-0-4"
                                            onclick="remove('{{ $item->title }}', {{ $item->id }})">
                                        <i class="fa fa-btn fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @else
                <h1>Favourites list is empty</h1>
            @endif
            <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                <div class="size15 trans-0-4">
                    <!-- Button -->
                    <a href="{{ route('product.shoppingCart') }}" 
                        class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        View Cart
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script type="text/javascript">
    function addtocart(nameProduct, id) {
        var cartProductId = $("#cartProductId-" + id).html();

        if (typeof cartProductId == 'undefined') {
            $.ajax({
                type: "GET",
                url: "{{url('add-to-cart')}}?id=" + id,
                success: function (res) {
                    if (res) {
                        swal(nameProduct, "is added to cart !", "success");
                        var cartQty = $('.cartQty').html();
                        cartQty++;
                        $('.cartQty').text(cartQty);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    swal("Status: " + textStatus, "Error: " + errorThrown, "error");
                }
            });
        } else {
            swal("Ooops..", "This product already in busket", "error");
        }
    };

    function remove(nameProduct, id) {
        $.ajax({
            type: "GET",
            url: "{{url('remove-favorite')}}?product_id=" + id,
            success: function (response) {
                if (response) {
                    swal(nameProduct, response.text, response.status);
                    location.reload();
                }
            }
        });
    };
</script>
@endsection