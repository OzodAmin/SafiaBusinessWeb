@extends('layouts.app')
@section('title')
    Favourite
@endsection
@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
             style="background-image: url({{ asset('front/images/icons/heading-bg.jpg') }});">
        <h2 class="l-text2 t-center">
            Cart
        </h2>
    </section>
    <!-- Cart -->
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <!-- Cart item -->
            @if(count($products) > 0) 
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

                                </td>
                                <td class="column-5"></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @else
                <h1>Favourites list is empty</h1>
            @endif
        </div>
    </section>
@endsection
@section('scripts')
<script type="text/javascript">
    function remove(nameProduct, id, isFavorite) {
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