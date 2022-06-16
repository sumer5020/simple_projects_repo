<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title',config('app.name', 'Codeit'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="loading"
    style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:9999;color:#fff;font-size:2.2rem;font-weight:700;display:flex;justify-content:center;align-items:center;">
    {{ __('words.loading') }}</div>
    <div id="app" class="{{ app()->getLocale()=='Ar'?'dir-rtl':'' }}">
        <main>
            <section class="auth">
                <div class="cover">
                    <!--<video class="paralex" loop muted autoplay>
                        <source src="../vid/bg.mp4" type="video/mp4">
                    </video>-->
                    <img class="paralex" src="{{ asset('/img/bg.jpg')}}">
                </div>
                <div class="sm-nav">
                    @yield('sm-nav')
                    <a class="links" href="{{ route('welcome') }}">{{ __('words.home') }}</a>
                </div>
                <div class="cover-body side-auth">
                    <div class="p-3 w-100">
                        <div class="lang">
                        <li><a href="{{ route('language','ar') }}">Ar</a></li>
                        <li><a href="{{ route('language','en') }}">En</a></li>
                        </div>
                        @yield('side-auth')
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

