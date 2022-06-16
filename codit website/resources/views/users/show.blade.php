@extends('layouts.admin')
@section('title',__('titles.user'))
@section('hotLink')
<li>
    <i class="fa fa-chevron-right"></i>
    @if($user->rule=='customer')
    <a class="nav-item px-1" href="{{route('user.index')}}">{{ trans_choice("words.user",3) }}</a>
    @else
    <a class="nav-item px-1" href="{{route('supperAdmin')}}">{{ trans_choice("words.admin",3) }}</a>
    @endif
</li>
<li>
    <i class="fa fa-chevron-right"></i>
    <a class="nav-item px-1" href="{{route('user.index').'/'.$user->id}}">{{ __("control.show") }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{ __("control.show").' '.trans_choice("words.user",1)}}</div>
                        <div>{{ __("words.status") }}: <i class="fa fa-circle {{ $user->status?'text-success':'text-muted' }}"></i></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row text-center">
                        <div class="justify-content-center w-100 d-flex">
                            <img style="width:150px;height:150px;" class="img-thumbnail rounded-circle" src="{{ $user->profile->img?asset('/storage/'.$user->profile->img):asset('img/personal.PNG') }}">
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <div>
                            <h5 class="orange"><i style="font-size:smaller;" class="fa fa-circle {{ $user->isActive()?'text-success':'text-muted' }}"></i>
                                {{ $user->name }} @if($user->username)<span class="text-muted">[{{ $user->username }}]</span>@endif</h5>
                        </div>
                        <div class="row form-group pt-2">
                            <h6 class="col-md-4 text-muted">
                                @if($user->phone2 && !$user->phone1)
                                <i class="fa fa-phone"></i> {{ $user->phone2 }}
                                @else
                                @if($user->phone1)
                                <i class="fa fa-phone"></i> {{ $user->phone1 }}
                                @if($user->phone2)
                                {{ ' - '.$user->phone2 }}
                                @endif
                                @endif
                                @endif
                            </h6>
                            <h6 class="col-md-4 text-muted"><i class="fa fa-envelope"></i>
                                {{ $user->email }} @if($user->profile->email && $user->profile->email != $user->email)<br><span>- {{ $user->profile->email }}</span>@endif</h6>
                            <h6 class="col-md-4 text-muted">
                                @if($user->profile->country)
                                <i class="fa fa-map-marker"></i>
                                <img style="width:15px;" src="{{ asset('flags/'.$ccountry->short.'.png') }}">
                                @endif
                                <span style="{{ app()->getLocale()=='en'?'':'direction:rtl;' }}">
                                    @if($user->profile->country && $ccountry)
                                    {{ app()->getLocale()=='en'?$ccountry->label:$ccountry->label_ar }}
                                    @if($user->profile->gov && $cgov)
                                    {{ app()->getLocale()=='en'?', '.$cgov->label:', '.$cgov->label_ar }}
                                    @endif
                                    @if($user->profile->district)
                                    {{ '- '.$user->profile->district }}
                                    @endif
                                    @endif
                                </span>
                            </h6>
                        </div>
                    </div>

                    <div class="form-group row text-center text-muted">
                        <div class="col-md-4">
                            <i class="fa fa-calendar"></i> {{__('words.emailVerifiedDate').': '.($user->email_verified_at?$user->email_verified_at:__('control.notYet')) }}
                        </div>
                        <div class="col-md-4">
                            <i class="fa fa-sliders"></i> {{__('words.rule').': '.$user->rule }}
                        </div>
                        <div class="col-md-4">
                            <i class="fa fa-clock-o"></i> {{__('control.createdAt').': '.$user->created_at }}
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-md-9">
                            <h5 class="orange">
                                {{ __('words.platform').' & '.__('words.browser') }} : <span class="text-muted">[{{$user->profile->platform.' - '.$user->profile->browser }}]</span>
                            </h5>
                        </div>
                        <div class="col-md-3">
                            <h5 class="orange">{{ __('control.gender') }} :
                            <span style="{{ $user->profile->gender==1?'color:#c45ae9':'color:#fe90a3' }}">
                            <i class="fa fa-user"></i>
                            {{ $user->profile->gender==1?__("control.male"):__("control.female") }}
                            </span>
                            </h5>
                        </div>
                    </div>
                    <div class="form-group row text-muted">
                        <div class="col-md-12">
                            <h5 class="orange">{{ __('control.about') }} :</h5>
                            <p>{{$user->profile->about?$user->profile->about:__('control.notYet')}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

