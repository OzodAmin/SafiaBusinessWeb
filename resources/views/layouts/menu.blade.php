@if(isset($isMainMenu))


    <div class="wrap_menu">
        <nav class="menu">
            <ul class="main_menu">
                <li class="sale-noti">
                    <a href="{{ url('/') }}">Home</a>
                </li>

                @foreach($categories as $category)
                <li class="sale-noti">
                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'category/'.$category->slug) }}">{{ $category->title }}</a>
                </li>
                @endforeach

            </ul>
        </nav>
    </div>
@else
    <li class="item-menu-mobile">
        <a href="{{ url('/') }}">Home</a>
        <ul class="sub-menu">
            <li><a href="{{ url('/') }}">Homepage V1</a></li>
            <li><a href="home-02.html">Homepage V2</a></li>
            <li><a href="home-03.html">Homepage V3</a></li>
        </ul>
        <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
    </li>

    <li class="item-menu-mobile">
        <a href="product.html">Shop</a>
    </li>

    <li class="item-menu-mobile">
        <a href="product.html">Sale</a>
    </li>

    <li class="item-menu-mobile">
        <a href="cart.html">Features</a>
    </li>

    <li class="item-menu-mobile">
        <a href="blog.html">Blog</a>
    </li>

    <li class="item-menu-mobile">
        <a href="about.html">About</a>
    </li>

    <li class="item-menu-mobile">
        <a href="contact.html">Contact</a>
    </li>
@endif