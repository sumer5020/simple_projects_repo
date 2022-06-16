@extends('layouts.app')
@section('title',__('titles.contact'))
@section('content')
<section id="end" class="text-light min-100vh" style="background-color: #343a40;">
    <div class="row p-5 {{app()->getLocale()=='en'?'':'text-right'}}">
        <div class="col-md-7">

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ __('words.contactsuccess').', ' }}</strong> {{ __('words.contactWeWillTakeIt') }}
            </div>
        @endif

            <div class="container">
                <h1 class="orange">{{ __("words.contactUs") }}</h1>
                <p>{{ __("words.contactUsDesc") }}</p>

                <div class="glass p-4">
                    <form method="post" action="{{ route('contact.store') }}">
                        @csrf
                        @include('contact.form')
                        <div class="form-group text-center">
                            <button type="submit" class="btn-white"><i class="fa fa-send-o"></i> {{ __("control.send") }} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="background:url({{ asset('/img/contact.svg') }});background-repeat: no-repeat;width: 100%;" class="col-md-5 overflow-hidden">
        </div>
    </div>
</section>
@endsection
