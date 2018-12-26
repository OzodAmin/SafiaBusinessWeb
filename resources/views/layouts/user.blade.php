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
            <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Account
                </a>
            </div>

            <div class="header-cart-wrapbtn">
                <!-- Button -->
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
    </div>
    @endguest  
</div>