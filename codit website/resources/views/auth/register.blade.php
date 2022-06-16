@extends('layouts.auth')
@section('title',__('titles.register'))
@section('sm-nav')
     <a class="links" href="{{ route('login') }}">{{ __('words.login') }}</a>
@endsection
@section('side-auth')
    <div class="cover-title">{{ __('words.register') }}</div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-6 m-auto">
                        <input id="name" placeholder="{{ __('words.name') }}" class="form-control mb-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 m-auto">
                        <input id="username" placeholder="{{ __('words.userName') }}" class="form-control mb-2 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 m-auto">
                        <input id="email" type="email" placeholder="{{ __('words.email') }}" class="form-control mb-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 m-auto">
                        <input id="password"  placeholder="{{ __('words.password') }}" type="password"  class="form-control mb-2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 m-auto">
                        <input id="password-confirm"  placeholder="{{ __('words.confirm').' '.__('words.password') }}" type="password" class="form-control mb-2 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 m-auto">
                        <button type="submit" class="col-12 btn btn-primary">
                           {{ __('words.register') }}
                        </button>
                    </div>
                </div>
            </form>
@endsection
