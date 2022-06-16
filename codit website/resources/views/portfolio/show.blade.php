@extends('layouts.admin')
@section('title',__('titles.portfolio'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('portfolio.index')}}">{{ trans_choice("words.portfolio",3) }}</a>
</li>
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('portfolio.index').'/'.$portfolio->id}}">{{ __("control.show") }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{ __("control.show").' '.trans_choice("words.portfolio",3)}}</div>
                        <div>{{ __("words.status") }}: <i class="fa fa-circle {{ $portfolio->status?'text-success':'text-muted' }}"></i></div>
                    </div>
                </div>

                <div class="card-body">
                    <section class="container">
                        <!-- portfolio -->
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <img class="img-thumbnail" src="{{ $portfolio->media_pic?asset('/storage/'.$portfolio->media_pic): asset('img/card_img.jpg') }}" alt="Portfolio image">
                            </div>
                            <div class="col-md-7">
                                <div class="my-3">
                                    <h5 class="my-4 orange d-inline">{{ __("words.catigury") }}: </h5>{{ $portfolio->cati['label'] }}
                                </div>
                                <div class="my-3">
                                    <h5 class="my-4 orange d-inline">{{ __("words.vid") }}: </h5>{{ $portfolio->media_vid }}
                                </div>
                                <div class="my-3">
                                    <h5 class="orange d-inline">{{ __("words.createDate") }} : </h5><i class="fa fa-clock-o"></i> {{ $portfolio->created_at }}
                                    <h5 class="col-6 orange d-inline">{{ __("words.color") }}:</h5><span class="" style="background:{{$portfolio->color}};border:1px solid {{$portfolio->color}};">{{ $portfolio->color  }}</span>
                                </div>
                                <div class="my-3">
                                    <div class="row">
                                        <h5 class="col-6 orange d-inline"><i class="fa fa-thumbs-up"></i>: {{ $portfolio->rate_up }}</h5>
                                        <h5 class="col-6 orange d-inline"><i class="fa fa-thumbs-down"></i>: {{ $portfolio->rate_down }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <h5 class="my-1 orange col-12">{{ __("words.title") }}</h5>
                            <p class="col-md-6">{{ $portfolio->title }}</p>
                            <p class="col-md-6">{{ $portfolio->title_ar }}</p>
                        </div>
                        <div class="form-group row">
                            <h5 class="my-1 orange col-12">{{ __("words.content") }}:</h5>
                            <p class="col-md-6">{{ $portfolio->post }}</p>
                            <p class="col-md-6">{{ $portfolio->post_ar }}</p>
                        </div>
                        <!-- end portfolio -->
                    </section>
                    <div class="form-group mt-5 mb-0">
                        <button type="button" onclick="window.location='{{route('portfolio.index')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
