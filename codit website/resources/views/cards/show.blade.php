@extends('layouts.admin')
@section('title',__('titles.headerCard'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('Cards.index')}}">{{ trans_choice("words.headerCard",3) }}</a>
</li>
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('Cards.index').'/'.$Card->id}}">{{ __("control.show") }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __("control.show").' '.trans_choice("words.headerCard",3)}}</div>

                <div class="card-body">
                    <section class="container tiket">
                        <div class="row justify-content-center">
                            <!-- cards -->
                            <div class="col-md-5 mx-3 my-1">
                                <div class="view-card">
                                    <div class="imgBx">
                                        <i class="{{$Card->icon}}"></i>
                                        <h2>{{$Card->title}}</h2>
                                    </div>
                                    <div class="contentBx">
                                        <p class="justify-content-center">{{$Card->desc}}</p>
                                    </div>
                                </div>
                                <div class="my-3 text-center">
                                    <h3>{{$Card->title}}</h3>
                                    <h6>{{$Card->desc}}</h6>
                                </div>
                            </div>
                            <div class="col-md-5 mx-3 my-1">
                                <div class="view-card">
                                    <div class="imgBx">
                                        <i class="{{$Card->icon}}"></i>
                                        <h2>{{$Card->title_ar}}</h2>
                                    </div>
                                    <div class="contentBx">
                                        <p class="justify-content-center">{{$Card->desc_ar}}</p>
                                    </div>
                                </div>
                                <div class="my-3 text-center">
                                    <h3>{{$Card->title_ar}}</h3>
                                    <h6>{{$Card->desc_ar}}</h6>
                                </div>
                            </div>
                            <!-- end cards -->
                        </div>
                    </section>
                    <div class="form-group mt-5 mb-0">
                        <button type="button" onclick="window.location='{{route('Cards.index')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

