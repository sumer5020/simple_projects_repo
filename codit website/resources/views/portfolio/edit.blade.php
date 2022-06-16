@extends('layouts.admin')
@section('title',__('titles.portfolio'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('portfolio.index')}}">{{ trans_choice("words.portfolio",3) }}</a>
</li>
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('portfolio.index').'/'.$portfolio->id.'/edit'}}">{{ __("control.edit") }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">{{ __("control.edit").' '.trans_choice("words.portfolio",3)}}</div>

            <div class="card-body">
                <form method="POST" action="{{ route("portfolio.index").'/'.$portfolio->id }}" enctype="multipart/form-data">
                @method('patch')
                    @csrf
                    <div class="mx-2">
                        @include("portfolio.form")
                        <div class="row form-group mt-5 mb-0">
                            <button type="submit" class="col-md-2 btn btn-outline-primary m-1">{{ __("control.save") }}</button>
                            <button type="button" onclick="window.location='{{route('portfolio.index')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
