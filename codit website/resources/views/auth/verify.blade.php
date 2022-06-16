@extends('layouts.auth')
@section('title',__('titles.verify'))
@section('sm-nav')
<a class="links" href="{{ route('login') }}">{{ __('words.login') }}</a>
@endsection
@section('side-auth')
<div class="cover-title">{{ __('words.verify') }}</div>
<div>
    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
    @endif
</div>
<div>
    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},<a href="{{ route('VerifiesEmails.show') }}">{{ __('click here to request another') }}</a>
</div>
@endsection
