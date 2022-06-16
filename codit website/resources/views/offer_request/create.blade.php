@extends('layouts.admin')
@section('title',__('titles.offerRequest'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('offer_request.index')}}">{{ trans_choice("words.offerRequest",3) }}</a>
</li>
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('offer_request.create')}}">{{ __("control.create") }}</a>
</li>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">{{ __("control.create").' '.trans_choice("words.offerRequest",1)}}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('offer_request.store') }}">
                    @csrf
                    <div class="mx-2">
                        @include("offer_request.form")
                        <div class="row form-group mt-5 mb-0">
                            <button type="submit" class="col-md-2 btn btn-outline-primary m-1">{{ __("control.save") }}</button>
                            <button type="button" onclick="window.location='{{route('offer.index')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
