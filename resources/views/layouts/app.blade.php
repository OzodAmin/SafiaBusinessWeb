<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================-->
    <link rel="icon" type="image/png" href="{{ asset('front/images/icons/index.ico') }}"/>
    <!--===============================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/front_css.css') }}">
    @yield('css')
</head>
<body>

<!-- header fixed -->
<div class="wrap_header fixed-header2 trans-0-4">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <img src="{{ asset('front/images/icons/logo.png') }}" alt="IMG-LOGO">
    </a>

    <!-- Menu -->
@include('layouts.menu', ['isMainMenu' => true])


<!-- Header Icon -->
    <div class="header-icons">
        @include('layouts.user')

        <span class="linedivide1"></span>

        <div class="header-wrapicon2 m-r-5">
            <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'favourites') }}">
                <img src="{{ asset('front/images/icons/favourite.png') }}" class="header-icon1" alt="ICON">
            </a>
        </div>

        <span class="linedivide1"></span>

        <div class="header-wrapicon2">
            @include('layouts.cart')
        </div>
    </div>
</div>

<!-- Header -->
<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2">
            <div class="topbar-social">
                <a href="#" class="topbar-social-item fa fa-facebook"></a>
                <a href="#" class="topbar-social-item fa fa-instagram"></a>
                <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>

            <!-- Logo2 -->
            <a href="{{ LaravelLocalization::getLocalizedURL($locale, '/') }}" class="logo2">
                <img src="{{ asset('front/images/icons/logo.png') }}" alt="IMG-LOGO">
            </a>

            <div class="topbar-child2">
                    <span class="topbar-email">
                        fashe@example.com
                    </span>
            @include('layouts.language')
            <!--  -->
                <span class="linedivide1"></span>

                @include('layouts.user')

                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-5">
                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'favourites') }}">
                        <img src="{{ asset('front/images/icons/favourite.png') }}" class="header-icon1" alt="ICON">
                    </a>
                </div>

                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-5">
                    @include('layouts.cart')
                </div>
            </div>
        </div>

        <div class="wrap_header">

            <!-- Menu -->
        @include('layouts.menu', ['isMainMenu' => true])

        <!-- Header Icon -->
            <div class="header-icons">

            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="{{ url('/') }}" class="logo-mobile">
            <img src="{{ asset('front/images/icons/logo.png') }}" alt="IMG-LOGO">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                @include('layouts.user')

                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-5">
                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'favourites') }}">
                        <img src="{{ asset('front/images/icons/favourite.png') }}" class="header-icon1" alt="ICON">
                    </a>
                </div>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    @include('layouts.cart')
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu">
        <nav class="side-menu">
            <ul class="main-menu">
                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                        <span class="topbar-child1">
                            Free shipping for standard order over $100
                        </span>
                </li>

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
                            <span class="topbar-email">
                                fashe@example.com
                            </span>

                        @include('layouts.language')
                    </div>
                </li>
                @include('layouts.menu', ['isMainMenu' => false])
            </ul>
        </nav>
    </div>
</header>

@yield('content')

<footer class="bg6 p-t-15 p-b-15 p-l-45 p-r-45">
    <div class="t-center p-l-15 p-r-15">
        <div class="t-center s-text8 p-t-20">
            Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o"
                                                                                  aria-hidden="true"></i> by <a
                    href="https://colorlib.com" target="_blank">Colorlib</a>
        </div>
    </div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>

<script type="text/javascript" src="{{ asset('front/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script type = "text/javascript" src = "{{ asset('front/vendor/animsition/js/animsition.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('front/vendor/bootstrap/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendor/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendor/daterangepicker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendor/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/slick-custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendor/noui/nouislider.min.js') }}"></script>
<script src="{{ asset('front/js/main.js') }}"></script>
@yield('scripts')
</body>
</html>
