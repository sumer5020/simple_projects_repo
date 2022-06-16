@extends('layouts.admin')
@section('title',__('titles.headerCard'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('Cards.index')}}">{{ trans_choice("words.headerCard",3) }}</a>
</li>
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('Cards.index').'/'.$Card->id.'/edit'}}">{{ __("control.edit") }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">{{ __("control.edit").' '.trans_choice("words.headerCard",3)}}</div>

            <div class="card-body">
                <form method="POST" action="{{ route("Cards.index").'/'.$Card->id }}">
                @method('patch')
                    @csrf
                    <div class="mx-2">
                        @include("cards.form")
                        <div class="row form-group mt-5 mb-0">
                            <button type="submit" class="col-md-2 btn btn-outline-primary m-1">{{ __("control.save") }}</button>
                            <button type="button" onclick="window.location='{{route('Cards.index')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
