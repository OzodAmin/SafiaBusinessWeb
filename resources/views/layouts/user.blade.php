<div class="header-wrapicon2 m-r-13">
    
    <!-- Header cart noti -->
    
    @guest
        <a href="{{ url('/login') }}">
            <img src="{{ asset('front/images/icons/icon-header-01.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
        </a>
    @else
    <img src="{{ asset('front/images/icons/icon-header-01.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
    <div class="header-cart header-dropdown">
        <ul class="header-cart-wrapitem">
            <li class="header-cart-item">
                <h4>{{ Auth::user()->name }}</h4>
            </li>
        </ul>
        <div class="header-cart-buttons">
            <!-- User Orders -->
            <a href="{{ route('order.index') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4 m-b-10">
                Orders
            </a>
            <!-- User Account -->
            <a href="{{ route('user.show') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4 m-b-10">
                Account
            </a>
            <!-- User Logout -->
            <a class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" 
                href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    @endguest  
</div>