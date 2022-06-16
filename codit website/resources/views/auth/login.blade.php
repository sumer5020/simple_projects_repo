@extends('layouts.auth')
@section('title',__('titles.login'))
@section('sm-nav')
     <a class="links" href="{{ route('register') }}">{{ __('words.register') }}</a>
@endsection
@section('side-auth')
    <div class="cover-title">{{ __('words.login') }}</div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <div class="col-md-6 m-auto">
                <input id="email" type="email" placeholder="{{ __('words.email') }}" class="form-control mb-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 m-auto">
                <input id="password" type="password" placeholder="{{ __('words.password') }}" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 m-auto">
                <div class="row col-12 d-flex justify-content-between">
                    <div class="form-check p-1 m-1">
                        <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('words.rememberMe') }}
                        </label>
                    </div>
                    <div class="p-1 m-1">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link p-0" href="{{ route('password.request') }}">
                            {{ __('words.forgotPassword') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 m-auto">
                <button type="submit" class="col-12 btn btn-primary">
                    {{ __('words.login') }}
                </button>
            </div>
        </div>
    </form>
@endsection
