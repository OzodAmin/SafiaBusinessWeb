@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            @include('layouts.sideFilter')
            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <!-- <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2" name="sorting">
                                <option>Default Sorting</option>
                                <option>Popularity</option>
                                <option>Price: low to high</option>
                                <option>Price: high to low</option>
                            </select>
                        </div>

                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2" name="sorting">
                                <option>Price</option>
                                <option>$0.00 - $50.00</option>
                                <option>$50.00 - $100.00</option>
                                <option>$100.00 - $150.00</option>
                                <option>$150.00 - $200.00</option>
                                <option>$200.00+</option>
                            </select>
                        </div>
                    </div>
                </div> -->
                <!-- Product -->
                <div class="row">
                    @foreach ($products as $key => $product)
                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                @if ($product->featured_image)
                                    {{ Html::image('uploads/product/thumb_'.$product->featured_image) }}
                                @else
                                    {{ Html::image('720x960.jpg') }}
                                @endif

                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <button class="flex-c-m size1 btnAddCart bg4 bo-rad-23 hov1 s-text1 trans-0-4 m-b-10" onclick="addtocart('{{ $product->translate($locale)->title }}', {{ $product->id }})">
                                            Add to Cart
                                        </button>

                                        <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$product->translate($locale)->slug) }}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$product->translate($locale)->slug) }}" class="block2-name dis-block s-text3 p-b-5">
                                    {{ $product->translate($locale)->title }}
                                </a>

                                <span class="block2-price m-text6 p-r-5">
                                    {{ $product->price }} {!! __('product.Sum') !!}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>
        function addtocart(nameProduct, id) {
            $.ajax({
               type:"GET",
               url:"{{url('add-to-cart')}}?id="+id,
               success:function(res){               
                    if(res){
                        swal(nameProduct, "is added to cart !", "success");
                        var cartQty = $('.cartQty').html();
                        cartQty++;
                        $('.cartQty').text(cartQty);
                    }
                }
            });
        };

        $('.block2-btn-addwishlist').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });

        //filter 
        var filterBar = document.getElementById('filter-bar');

        noUiSlider.create(filterBar, {
            start: [ 50, 200 ],
            connect: true,
            range: {
                'min': 50,
                'max': 200
            }
        });
        var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function( values, handle ) {
            skipValues[handle].innerHTML = Math.round(values[handle]) ;
        });
    </script>
@endsection