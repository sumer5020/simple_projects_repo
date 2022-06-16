@extends('layouts.auth')
@section('title',__('titles.restPassword'))
@section('title',__('titles.login'))
@section('sm-nav')
     <a class="links" href="{{ route('register') }}">{{ __('words.login') }}</a>
@endsection
@section('side-auth')
    <div class="cover-title">{{ __('words.resetPassword') }}</div>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group row">
            <div class="col-md-6 m-auto">
                <input id="email" type="email" placeholder="{{ __('words.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 m-auto">
                <button type="submit" class="col-12 btn btn-primary">
                    {{ __('control.send')." ".__("words.passwordResetLink") }}
                </button>
            </div>
        </div>
    </form>
@endsection
