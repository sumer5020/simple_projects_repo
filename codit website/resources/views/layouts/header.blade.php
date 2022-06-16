<header>
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="logo">
                    <figure>C</figure>
                    <figure>O</figure>
                    <figure>D</figure>
                    <figure>E</figure>
                </div>
                <span class="px-5">{{ config('app.name', 'Codeit') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('welcome') }}">{{ __('words.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">{{ __('words.contact') }}</a>
                        </li>
                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('words.login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('words.register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">{{ __('words.home') }}</a>
                    </li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.index') }}">{{ __('words.dashboard') }}</a>
                        </li>
                    @endif
                    {{--
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ trans_choice("words.blog",1) }}</a>
                    </li>
                    --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index') }}">{{ __('words.contact') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.index') }}">{{ __('words.profile') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('words.logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    {{--<li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-gear"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">{{ __('words.profile') }}</a>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('words.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>--}}
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
