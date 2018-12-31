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
                        {{ Html::image('img/1200.jpg') }}
                    @endif
                </div>
            </div>

            <div class="w-size13 p-t-30 respon5">
                <h4 class="product-detail-name m-text16 p-b-13">
                    {{ $product->title }}
                </h4>

                <span class="m-text17">
                    {{ $product->price }}&nbsp;{!! __('product.Sum') !!}
                </span>

                <p class="m-text15 p-t-10">
                    Min order:&nbsp;
                    <span id="min_order">{{$product->min_order}}</span>
                    &nbsp;<span id="measure">{{ $product->measure->title }}</span>
                </p>

                <div class="p-t-33 p-b-60">
                    <div class="flex-w p-t-10">
                        <div class="w-size16 flex-m flex-w">
                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input id="qty" class="size8 m-text18 t-center num-product" type="number"
                                       name="num-product" value="<?= isset($quantity) ? $quantity : 1?>">
                                <div class="input-group-addon">{{ $product->measure->title_short }}</div>

                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button -->
                                <button class="btnAddCart flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4"
                                        onclick="addtocart('{{ $product->title }}', {{ $product->id }})">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $state = 'active-dropdown-content';
                if (count($product->bases) > 0):
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

                <?php if (count($product->covers) > 0): ?>
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

                <?php if (count($product->creams) > 0): ?>
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

                <?php if (count($product->decors) > 0): ?>
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

                <?php if (count($product->fillings) > 0): ?>
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
        function addtocart(nameProduct, id) {
            var diffProduct = parseFloat($('#min_order').text());
            var qty = parseFloat($('#qty').val().replace(",", "."));
            if (Number(qty % diffProduct) == 0 && qty > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('add-to-cart')}}?id=" + id + "&qty=" + qty,
                    success: function (res) {
                        if (res) {
                            swal(nameProduct, "is added to cart !", "success");
                            var cartQty = Number($('.cartQty').html()) + qty;
                            $('.cartQty').text(cartQty);
                        }
                    }
                });
            } else {
                var measure = $('#measure').text();
                swal("Wrong product quantity input", "Min order is " + diffProduct + " " + measure, "error");
            }

        };

        /*[ +/- num product ]*/
        $('.btn-num-product-down').on('click', function (e) {
            e.preventDefault();
            var qty = parseFloat($('#qty').val().replace(",", "."));
            var diffProduct = parseFloat($('#min_order').text());
            var resultProduct = Number(qty - diffProduct);
            if (Number(resultProduct % diffProduct) == 0) {
                if (resultProduct > 0) $(this).next().val(resultProduct);
            } else {
                var measure = $('#measure').text();
                swal("Wrong product quantity input", "Min order is " + diffProduct + " " + measure, "error");
                $(this).next().val(Math.floor(qty));
            }
        });

        $('.btn-num-product-up').on('click', function (e) {
            e.preventDefault();
            var qty = parseFloat($('#qty').val().replace(",", "."));
            var diffProduct = parseFloat($('#min_order').text());
            var resultProduct = Number(qty + diffProduct);
            // alert(1.1 % 0.1);
            if (Number(resultProduct % diffProduct) == 0) {
                $(this).prev().prev().val(resultProduct);
            } else {
                var measure = $('#measure').text();
                swal("Wrong product quantity input", "Min order is " + diffProduct + " " + measure, "error");
                $(this).prev().prev().val(Math.floor(qty));
            }
        });
    </script>
@endsection