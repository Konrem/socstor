@php
$browser = new Browser();
$browserVersion = (float)explode('.', $browser->getVersion())[0];
@endphp

@if( $browser->getBrowser() == Browser::BROWSER_CHROME && $browserVersion <= 56  )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif

@if( $browser->getBrowser() == Browser::BROWSER_FIREFOX && $browserVersion <= 51 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif

@if( $browser->getBrowser() == Browser::BROWSER_OPERA && $browserVersion <= 43 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif


@if( $browser->getBrowser() == Browser::BROWSER_IE && $browserVersion <= 11 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif

@if( $browser->getBrowser() == Browser::BROWSER_EDGE && $browserVersion <= 15 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif


@if( $browser->getBrowser() == Browser::BROWSER_SAFARI && $browserVersion <= 10 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif


@if( $browser->getBrowser() == Browser::BROWSER_IPHONE && $browserVersion <= 10.2 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif