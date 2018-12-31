<img src="{{ asset('front/images/icons/icon-header-02.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
<span class="header-icons-noti cartQty">
    <?= Session::has('cart') ? Session::get('cart')->totalQty : 0; ?>  
</span>

<!-- Header cart noti -->
<div class="header-cart header-dropdown">
    @if(isset($cart))
        <ul class="header-cart-wrapitem">
            @foreach($cart->items as $item)
                <li class="header-cart-item">
                    <a href="{{ route('product.remove', ['id' => $item['item']['id']]) }}">
                        <div class="header-cart-item-img">
                            @if ($item['item']['featured_image']) {{ Html::image('uploads/product/admin_'.$item['item']['featured_image']) }}
                            @else {{ Html::image('img/320.jpg') }}
                            @endif
                        </div>
                    </a>

                    <div class="header-cart-item-txt">
                        <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'product/'.$item['item']['slug']) }}"
                           class="header-cart-item-name">
                            {{ $item['item']['title'] }}
                        </a>

                        <span class="header-cart-item-info">
                            {!! $item['qty'].'&nbsp;x&nbsp;'.$item['item']['price'] !!}&nbsp;{!! __('product.Sum') !!}
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="header-cart-total">
            Total: {{ $cart->totalPrice }}&nbsp;{!! __('product.Sum') !!}
        </div>
    @endif
    <div class="header-cart-buttons">
        <a href="{{ route('product.shoppingCart') }}"
           class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
            View Cart
        </a>
    </div>
</div>
