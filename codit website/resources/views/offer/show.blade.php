@extends('layouts.admin')
@section('title',__('titles.offer'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('offer.index')}}">{{ trans_choice("words.offer",3) }}</a>
</li>
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('offer.index').'/'.$offer->id}}">{{ __("control.show") }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{ __("control.show").' '.trans_choice("words.offer",3)}}</div>
                        <div>{{ __("words.status") }}: <i class="fa fa-circle {{ $offer->status?'text-success':'text-muted' }}"></i></div>
                    </div>
                </div>

                <div class="card-body">
                    <section class="container justify-content-center">
                            <!-- offer -->
                            <div class="form-group row">
                            <p class="col-md-6"><span class="orange">{{ __("words.cost") }} : </span>{{ $offer->cost }}$</p>
                             </div>
                            <div class="form-group row">
                            <p class="col-md-6"><span class="orange">{{ __("control.startDate") }} : </span>{{ $offer->start_at }}</p>
                            <p class="col-md-6"><span class="orange">{{ __("control.endDate") }} : </span>{{ $offer->end_at }}</p>
                        </div>

                            <div class="form-group row">
                            <h5 class="my-3 orange col-12">{{ __("words.title") }}</h5>
                            <p class="col-md-6">{{ $offer->title }}</p>
                            <p class="col-md-6">{{ $offer->title_ar }}</p>
                        </div>
                        <div class="form-group row">
                            <h5 class="my-3 orange col-12">{{ __("words.content") }}</h5>
                            <p class="col-md-6">{{ $offer->desc }}</p>
                            <p class="col-md-6">{{ $offer->desc_ar }}</p>
                        </div>
                            <!-- end offer -->
                    </section>
                    <div class="form-group mt-5 mb-0">
                        <button type="button" onclick="window.location='{{route('offer.index')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
