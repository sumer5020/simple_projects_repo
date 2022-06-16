@extends('layouts.admin')
@section('title',__('titles.country'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('country.index')}}">{{ __("control.country") }}</a>
</li>
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('country.index').'/'.$country->id}}">{{ __("control.show") }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __("control.show").' '.__("control.country")}}</div>

                <div class="card-body">
                    <section class="container tiket">
                        <div class="row justify-content-center">
                        <div class="col-md-6">
                            <h5 class="text-center">-flag- {{ $country->label }}</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-center">-flag- {{ $country->label_ar }}</h5>
                        </div>
                        </div>
                    </section>
                    <div class="form-group mt-5 mb-0">
                        <button type="button" onclick="window.location='{{route('country.index')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

