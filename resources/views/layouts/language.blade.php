<?php $currentUrl = Request::url(); ?>
@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
<div class="topbar-language rs1-select2">
    <a rel="alternate" 
        hreflang="{{$localeCode}}" 
        href="{{LaravelLocalization::getLocalizedURL($localeCode, $currentUrl) }}"
        class="dis-block m-l-10">
        <img src="{{ asset('lang/'.$localeCode.'.jpg') }}" class="header-icon1" alt="lang-{{$localeCode}}">
    </a>
</div>
@endforeach