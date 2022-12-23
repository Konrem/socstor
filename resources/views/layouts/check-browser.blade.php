@php
$browser = new Browser();
@endphp

@if( $browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() <= 56  )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif

@if( $browser->getBrowser() == Browser::BROWSER_FIREFOX && $browser->getVersion() <= 51 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif

@if( $browser->getBrowser() == Browser::BROWSER_OPERA && $browser->getVersion() <= 43 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif


@if( $browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() <= 11 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif

@if( $browser->getBrowser() == Browser::BROWSER_EDGE && $browser->getVersion() <= 15 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif


@if( $browser->getBrowser() == Browser::BROWSER_SAFARI && $browser->getVersion() <= 10 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif


@if( $browser->getBrowser() == Browser::BROWSER_IPHONE && $browser->getVersion() <= 10.2 )
    @component('alert')
        Для коректної роботи сервісу оновіть ваш браузер
    @endcomponent
@endif