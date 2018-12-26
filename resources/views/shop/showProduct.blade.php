@extends('layouts.app')
@section('title')
{{ $product->title }}
@endsection
@section('content')
    <div class="container bgwhite p-b-10">
        <div class="flex-w flex-sb">
            <div class="w-size14 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    @if ($product->featured_image)
                        {{ Html::image('uploads/product/icon_'.$product->featured_image) }}
                    @else
                        {{ Html::image('uploads/product/320x320.jpg') }}
                    @endif
                </div>
            </div>

            <div class="w-size13 p-t-30 respon5">
                <h4 class="product-detail-name m-text16 p-b-13">
                    {{ $product->title }}
                </h4>

                <span class="m-text17">
                    {{ $product->price }} {!! __('product.Sum') !!}
                </span>

                <div class="p-t-33 p-b-60">
                    <div class="flex-w p-t-10">
                        <div class="w-size16 flex-m flex-w">
                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button -->
                                <button class="btnAddCart flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    $state = 'active-dropdown-content';
                    if (isset($product->bases)): 
                ?>
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 <?= $state; ?>">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Base
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-5 p-b-10">
                        <?php foreach ($product->bases as $key => $value): ?>
                            <p class="s-text8">
                                <?= $value->title ?>
                            </p>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php 
                    $state = '';
                    endif 
                ?>
                
                <?php if (isset($product->covers)): ?>
                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14 <?= $state; ?>">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Covers
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <?php foreach ($product->covers as $key => $value): ?>
                            <p class="s-text8">
                                <?= $value->title ?>
                            </p>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php 
                    $state = '';
                    endif 
                ?>

                <?php if (isset($product->creams)): ?>
                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14 <?= $state; ?>">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Creams
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <?php foreach ($product->creams as $key => $value): ?>
                            <p class="s-text8">
                                <?= $value->title ?>
                            </p>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php 
                    $state = '';
                    endif 
                ?>

                <?php if (isset($product->decors)): ?>
                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14 <?= $state; ?>">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Decors
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <?php foreach ($product->decors as $key => $value): ?>
                            <p class="s-text8">
                                <?= $value->title ?>
                            </p>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php 
                    $state = '';
                    endif 
                ?>

                <?php if (isset($product->fillings)): ?>
                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14 <?= $state; ?>">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Fillings
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <?php foreach ($product->fillings as $key => $value): ?>
                            <p class="s-text8">
                                <?= $value->title ?>
                            </p>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php 
                    $state = '';
                    endif 
                ?>
                
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('.btn-addcart-product-detail').each(function(){
        var nameProduct = $('.product-detail-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
</script>
@endsection