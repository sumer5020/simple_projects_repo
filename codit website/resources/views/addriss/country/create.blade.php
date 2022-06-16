@extends('layouts.admin')
@section('title',__('titles.country'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('country.index')}}">{{ __("control.country") }}</a>
</li>
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('country.create')}}">{{ __("control.create") }}</a>
</li>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">{{ __("control.create").' '.__('control.country')}}</div>

            <div class="card-body">
                <form method="POST" action="{{ route("country.store") }}">
                    @csrf
                    <div class="mx-2">
                        @include("addriss.country.form")
                        <div class="row form-group mt-5 mb-0">
                            <button type="submit" class="col-md-2 btn btn-outline-primary m-1">{{ __("control.save") }}</button>
                            <button type="button" onclick="window.location='{{route('country.index')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
