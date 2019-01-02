@if(isset($isMainMenu))
    <div class="wrap_menu">
        <nav class="menu">
            <ul class="main_menu">
                <li class="sale-noti">
                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, '/') }}">Home</a>
                </li>

                @foreach($categories as $category)
                <li class="sale-noti">
                    <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'category/'.$category->id) }}">{{ $category->title }}</a>
                </li>
                @endforeach

            </ul>
        </nav>
    </div>
@else
    <li class="item-menu-mobile">
        <a href="{{ LaravelLocalization::getLocalizedURL($locale, '/') }}">Home</a>
    </li>
    @foreach($categories as $category)
    <li class="item-menu-mobile">
        <a href="{{ LaravelLocalization::getLocalizedURL($locale, 'category/'.$category->id) }}">{{ $category->title }}</a>
    </li>
    @endforeach
@endif