@extends('layouts.app')
@section('title',__('titles.PrivacyPolicy'))
@section('content')
<section id="end" class="text-light min-100vh" style="background-color: #343a40;">
    <div class="row p-5 {{app()->getLocale()=='en'?'':'text-right'}}">
        <div class="col-md-12">
            <div class="container">
                <h2 class="orange">{{ __("words.PrivacyPolicy") }}</h2>
                <p>{{ __("words.PrivacyPolicyDesc") }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
