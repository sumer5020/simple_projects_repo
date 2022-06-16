<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title',config('app.name', 'Codeit'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="loading" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:9999;color:#fff;font-size:2.2rem;font-weight:700;display:flex;justify-content:center;align-items:center;">
        {{ __("words.loading") }}</div>

    <div id="app">
        <!-- logout form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <main>
            <div class="adm d-flex align-items-stretch">

                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    </button>
                </div>

                <nav id="sidebar">
                    <div class="img bg-wrap text-center py-4" style="background-image: url( {{asset("img/bg_1.jpg") }});">
                        <div class="user-logo">
                            <div class="img" style="background-image: url({{ Auth::user()->profile->img?'/storage/'.Auth::user()->profile->img: asset('img/personal.PNG') }});"></div>
                            <!-- Go to profile -->
                            <a href="{{ route('profile.index') }}"><h3>{{ Auth::user()->name }}</h3></a>
                        </div>
                    </div>
                    @include('layouts.side_menu')
                </nav>

                <!-- Page Content  -->
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light p-3" style="background:#eee">
                        <div class="nav navbar-nav w-100 pl-4">
                            <ul class="navbar-nav mr-auto">
                                <li>
                                    <a class="nav-item px-1" href="{{route('home.index')}}"><i class="fa fa-home"></i> {{ __("words.dashboard") }}</a>
                                </li>
                                @yield('hotLink')
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li>
                                    <a class="py-0 px-2 nav-item" href="{{route('language','ar')}}">Ar</a>
                                </li>
                                <li>
                                    <a class="py-0 px-2 nav-item" href="{{route('language','en')}}">En</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="px-4 px-md-5 pt-3 {{ app()->getLocale()=='en'?'':'dir-rtl text-right'}}">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
