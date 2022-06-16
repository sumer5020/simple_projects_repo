@extends('layouts.app')
@section('title',__('titles.portfolio'))
@section('content')
<section id="end" class="text-light min-100vh p-4{{ app()->getLocale()=='ar'?' dir-rtl text-right':'' }}" style="background-color: #343a40;">
    <div class="row frm">

        <div class="col-md-9 my-1">
            <div class="o_border mb-3">
                <div class="p_head">
                    <div class="px-3 pt-2">{{ app()->getLocale()=='en'?$portfolio->title:$portfolio->title_ar }}</div>
                    <div class="cati text-center">{{ $portfolio->cati['label'] }}</div>
                </div>
                <div class="p_body pb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50">
                        <g>
                            <path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6
                            l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3
                            c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5
                            L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z" />
                        </g>
                    </svg>
                    <img class="p_img mb-1{{ app()->getLocale()=='ar'?' rtl':'' }}" src="{{ asset('/storage/'.$portfolio->media_pic) }}">
                    <div class="p_detail row text-center{{ app()->getLocale()=='ar'?' rtl dir-ltr':'' }}">
                        <div class="col-5 p-1" id="rate">
                            <div class="row m-0">
                                <a post_no="{{ $portfolio->id }}" class="col-md-5 rate_up btn_orange mx-1 my-1">
                                    <i class="fa fa-thumbs-up"> Up : {{ $portfolio->rate_up }}</i>
                                </a>
                                <a post_no="{{ $portfolio->id }}" class="col-md-5 rate_down btn_orange mx-1 my-1">
                                    <i class="fa fa-thumbs-down"> Down : {{ $portfolio->rate_down }}</i>
                                </a>
                            </div>
                        </div>
                        <div class="col-7 p-1 {{ app()->getLocale()=='ar'?' dir-rtl':'' }}">
                            <div class="row m-0">
                                <small class="col-md-7 my-1">
                                    <i class="fa fa-calendar px-1"></i>{{ __('control.createdAt').': '.substr($portfolio->created_at,0,10) }}
                                    &nbsp;&nbsp;
                                </small>
                                <small class="col-md-5 my-1">
                                    <i class="fa fa-eye px-1 views"> {{ __('control.views').': '.($portfolio->rate_up + $portfolio->rate_down) }}</i>
                                </small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="orange px-3">{{ app()->getLocale()=='en'?$portfolio->title:$portfolio->title_ar }}</h4>
                    @foreach((app()->getLocale()=='en'?$portfolio->post:$portfolio->post_ar) as $content)
                    <p class="px-3">{{ $content }}.</p>
                    @endforeach

                    @if($portfolio->media_vid)
                    <hr>
                    <div class="p_vid{{ app()->getLocale()=='ar'?' rtl dir-rtl':'' }}">
                    </div>
                    <p class="text-center px-3">Video title and description...</p>
                    @endif
                </div>
            </div>
            <div class="o_border">
                <div class="p_head text-center">
                    <div class="row px-2 pt-2">
                        <div class="col-md-3 p-0"><img class="img-thumbnail rounded-circle" style="height:100px;width:100px;" src="{{ asset(($author->profile['img'])?'/storage/'.$author->profile['img']:'img/personal.PNG') }}"></div>
                        <div class="col-md-9 d-flex flex-column {{ app()->getLocale()=='ar'?'text-md-right':'text-md-left' }} justify-content-center">
                            <h4 class="w-100">{{__('words.author')." : ".$author->name}}</h4>
                            <h4 style="color:#4b3219;" class="w-100">{{$author->profile['nick_name']}}</h4>
                        </div>
                    </div>
                </div>
                <div class="p_body py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50">
                        <g>
                            <path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6
                            l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3
                            c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5
                            L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z" />
                        </g>
                    </svg>
                    <div class="px-4">
                        @if ($author->profile->about)
                            <h4 class="orange">{{ __('control.about') }}</h4>
                            <p>{{ $author->profile->about }}</p>
                        @endif
                        @if($author->profile->email)
                            <h4 class="orange">{{ __('words.contactInfo') }}</h4>
                            <p>{{ __('words.email').': '.$author->profile->email }}</p>
                        @endif
                        @if($author->phone1||$author->phone2)
                            <p>{{ __('words.phoneNumber').': '.($author->phone1?$author->phone1:'').($author->phone2?' - '.$author->phone2:'') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <script>
                (function() {
                    'use strict';
                    $.ajax({
                        headers: {
                            //request X-CSRF-TOKEN header
                            'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                        }
                        , url: '{{ route("rates") }}'
                        , type: 'POST'
                            // the type of data we expect back
                        , dataType: 'json'
                            //with post must the data have _token input data
                        , data: {
                            postId: "{{ $portfolio->id }}",
                            _token: '{{ csrf_token() }}'
                        }
                        //request success function with responce
                        , success: function(data) {
                                if (data['success'] == '200') {
                                    if (data['rate']){
                                        if (data['rate']['rate'] == 1)
                                            $("a.rate_up").addClass('chose');
                                        else if(data['rate']['rate'] == -1)
                                            $("a.rate_down").addClass('chose');
                                    }
                                }
                            }
                            //request error function
                        , error: function(xhr, status) {
                            alert('Sorry,' + xhr['responseJSON']['message']);
                        }
                    });
                })();
                $(function() {
                    'use strict';
                    $('#rate a').on('click', function(e) {
                        //event.preventDefault();
                        var rateType, //'up - down - _up - _down'
                            obj = $(this)
                            , postId = $(this).attr("post_no");
                        if ($(this).hasClass('rate_up')) {
                            if ($(this).hasClass('chose')) {
                                rateType = "_up";
                                $("a.btn_orange[post_no='" + postId + "']").removeClass('chose');
                            } else {
                                rateType = "up";
                                $("a.btn_orange[post_no='" + postId + "']").removeClass('chose');
                                $(this).addClass('chose');
                            }
                        } else {
                            if ($(this).hasClass('chose')) {
                                rateType = "_down";
                                $("a.btn_orange[post_no='" + postId + "']").removeClass('chose');
                            } else {
                                rateType = "down";
                                $("a.btn_orange[post_no='" + postId + "']").removeClass('chose');
                                $(this).addClass('chose');
                            }
                        }
                        $.ajax({
                            headers: {
                                //request X-CSRF-TOKEN header
                                'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                            }
                            , url: '{{ route("portfolioRate") }}'
                            , type: 'POST'
                                // the type of data we expect back
                            , dataType: 'json'
                                //with post must the data have _token input data
                            , data: {
                                rateType: rateType
                                , postId: postId
                                , _token: '{{ csrf_token() }}'
                            }
                            //request success function with responce
                            , success: function(data) {
                                    if (data['success'] == '401') {
                                        //$.get('www',{}, function(data) {console.log(data)});
                                        $('.frm').append('<form action="{{ route("login") }}" method="GET"></form>');
                                        $('.frm form').submit();
                                    }
                                    //rate done
                                    if (data['success'] == '200') {
                                        if (rateType == 'down' || rateType == '_down') {
                                            $(obj).find('i').text(" Down : " + data['down']);
                                            $(obj).parent().find('a.rate_up i').text(" Up : " + data['up']);
                                        } else {
                                            $(obj).find('i').text(" Up : " + data['up']);
                                            $(obj).parent().find('a.rate_down i').text(" Down : " + data['down']);
                                        }
                                        $(obj).scale(1);
                                        $(obj).find('i').animate({scale :'+=0.5'},500,function(){
                                            $(obj).find('i').animate({scale :'-=0.5'},500);});
                                        $('i.views').text(" {{ __('control.views') }}"+': '+(data['up']+data['down']));
                                    }
                                }
                                //request error function
                            , error: function(xhr, status) {
                                alert('Sorry, there was ' + 'post' + ' problem!');
                            }
                        });
                        return false;
                    });
                });
            </script>
        </div>
        <div class="col-md-3 my-1">
            <div class="o_border text-center mb-3">
                <div class="p_head sm">{{ __('words.trendRelatedPortfolios').' - '.$portfolio->cati['label'] }}</div>
                <div class="p_body">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50">
                        <g>
                            <path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6
                            l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3
                            c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5
                            L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z" />
                        </g>
                    </svg>
                    <ul class="m-0 px-0 py-2">
                        @if(!$trinds->first())
                            {{ __('words.noMorePortfolios') }}
                        @else
                            @foreach ($trinds as $trind)
                                <li><a href="{{ route('portfolio.index').'/more/'.$trind->id }}">{{ app()->getLocale()=='en'? $trind->title : $trind->title_ar }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="o_border text-center">
                <div class="p_head sm">{{ __('words.LastRelatedPortfolios').' - '.$author->name }}</div>
                <div class="p_body">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50">
                        <g>
                            <path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6
                            l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3
                            c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5
                            L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z" />
                        </g>
                    </svg>
                    <ul class="m-0 px-0 py-2">
                        @if(!$authorLasts->first())
                            {{ __('words.noMorePortfolios') }}
                        @else
                            @foreach ($authorLasts as $authorLast)
                                <li><a href="{{ route('portfolio.index').'/more/'.$authorLast->id }}">{{app()->getLocale()=='en'?(
strlen($authorLast->title)>1?$authorLast->title:''):(strlen($authorLast->title_ar)>1?$authorLast->title_ar:'')}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

