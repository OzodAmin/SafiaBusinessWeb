<div class="row">
    <div class="col-sm-6 col-sm-offset-3 social-login">
        <div class="social-login-buttons">
            <?php $currentUrl = Request::url(); ?>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a class="btn btn-link-2" 
                hreflang="{{$localeCode}}" 
                href="{{LaravelLocalization::getLocalizedURL($localeCode, $currentUrl) }}">
                <img src="{{ asset('lang/'.$localeCode.'.jpg') }}" alt="lang-{{$localeCode}}">
            </a>
            @endforeach
        </div>
    </div>
</div>