<?php

return [
    'supportedLocales' => [
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
        'uz' => ['name' => 'Uzbek (Cyrillic)', 'script' => 'Cyrl', 'native' => 'Ўзбек', 'regional' => 'uz_UZ'],
        'ru'=> ['name' => 'Russian','script' => 'Cyrl', 'native' => 'Русский', 'regional' => 'ru_RU'],
    ],
    'useAcceptLanguageHeader' => true,
    'hideDefaultLocaleInURL' => true,
    'localesOrder' => [],
    'localesMapping' => [],
    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),
    'urlsIgnored' => ['/skipped'],
];
