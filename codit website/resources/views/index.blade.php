@extends('layouts.app')
@section('title',__('titles.home'))
@section('content')
<div class="paralex">
    <img src="{{ asset('/img/cover.jpg') }}">
</div>
<div class="paralex-body {{app()->getLocale()=='en'?'':'text-right'}}">

    <section class="container tiket min-100vh py-5">
        <div class="row justify-content-center">
            <!-- cards -->
            @foreach($cards as $card)
            <div class="col-md-3 mx-3 my-5">
                <div class="view-card">
                    <div class="imgBx">
                        <i class="{{$card->icon}}"></i>
                        <h2>{{app()->getLocale() == 'en'?$card->title:$card->title_ar }}</h2>
                    </div>
                    <div class="contentBx">
                        <p class="justify-content-center">{{app()->getLocale() == 'en'?$card->desc:$card->desc_ar}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- end cards -->
        </div>
        <div class="container text-center pt-4">
            <h2 class="orange">{{ __("words.cardTitle") }}</h2>
            <p>{{ __("words.cardDisc") }}</p>
        </div>
    </section>

    <!-- portfolio -->
    <section class="bg-dark text-light min-100vh position-relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50">
            <g>
                <path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6
                        l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3
                        c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5
                        L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z" />
            </g>
        </svg>
        <div class="container py-5">
            <div class="section_title s_light">{{ trans_choice("words.portfolio",3) }}</div>
            <h1 class="orange">{{ __("words.cardTitle") }}</h1>
            <p>{{ __("words.cardDisc") }}</p>
            <!-- filter_block -->
            <div class="col-md-12" id="filter">
                <a class="btn current" href="#filter" onclick="return false;" id="all">All Works</a>
                @foreach($catis as $cati)
                <a class="btn" href="#filter" onclick="return false;" id="{{ 'f_'.$cati->id }}">{{ $cati->label }}</a>
                @endforeach
            </div>
            <!-- end filter_block -->

            <div class="container text-dark">
                <div class="row">

                    @foreach($portfolios as $portfolio)
                    <div class="col-lg-3 col-md-4 col-sm-12 post {{ 'f_'.$portfolio->cati_id }}">
                        <div class="card mb-4">
                            <a class="more" href="{{ route('portfolio.index').'/more/'.$portfolio->id }}">
                                <img class="card-img-top" src="{{ $portfolio->media_pic? asset('/storage/'.$portfolio->media_pic): asset('/img/card_img.jpg')}}" alt="Portfolio image">
                            </a>
                            <div class="card-body" style="background:{{ $portfolio->color }}">

                                <h4 class="mb-3 orange">{{ app()->getLocale()=='en'?$portfolio->title:$portfolio->title_ar }}</h4>

                                <p class="card-text">
                                    {{ app()->getLocale()=='en'?$portfolio->post:$portfolio->post_ar }}...
                                    <span class="text-muted text-sm"><i class="fa fa-calendar"></i> {{ substr($portfolio->created_at,0,10) }}</span>
                                </p>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div id="rate" class="btn-group">
                                        <button type="button" post_no="{{ $portfolio->id }}" class="rate_down btn btn-sm btn_orange">
                                            <i class="fa fa-thumbs-down"></i> Down
                                        </button>
                                        <button type="button" post_no="{{ $portfolio->id }}" class="rate_up btn btn-sm btn_orange">
                                            <i class="fa fa-thumbs-up"></i> Up
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script>
            $(function() {
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
                            _token: '{{ csrf_token() }}'
                        }
                        //request success function with responce
                        , success: function(data) {
                                if (data['success'] == '200') {
                                    for (var i = 0; i < data['rates']['length']; i++) {
                                        if (data['rates'][i]['rate'] == 1)
                                            $("button.rate_up.btn_orange[post_no='" + data['rates'][i]['portfolio_id'] + "']").addClass('chose')
                                        else
                                            $("button.rate_down.btn_orange[post_no='" + data['rates'][i]['portfolio_id'] + "']").addClass('chose')
                                    }
                                }
                            }
                            //request error function
                        , error: function(xhr, status) {
                            alert('Sorry,' + xhr['responseJSON']['message']);

                        }
                    });
                })();
                $('#rate button').on('click', function(e) {
                    //event.preventDefault();
                    var rateType, //'up - down - _up - _down'
                        obj = $(this)
                        , postId = $(this).attr("post_no");

                    if ($(this).hasClass('rate_up')) {
                        if ($(this).hasClass('chose')) {
                            rateType = "_up";
                            $("button.btn_orange[post_no='" + postId + "']").removeClass('chose');
                        } else {
                            rateType = "up";
                            $("button.btn_orange[post_no='" + postId + "']").removeClass('chose');
                            $(this).addClass('chose');
                        }
                    } else {
                        if ($(this).hasClass('chose')) {
                            rateType = "_down";
                            $("button.btn_orange[post_no='" + postId + "']").removeClass('chose');
                        } else {
                            rateType = "down";
                            $("button.btn_orange[post_no='" + postId + "']").removeClass('chose');
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
                                    $('#filter').append('<form action="{{ route("login") }}" method="GET"></form>');
                                    $('#filter form').submit();
                                }
                                //rate done
                                if (data['success'] == '200') {
                                    var rate = rateType == 'down' ? data['down'] : data['up']
                                        , str = '<span class="' + postId + ' rate_pub"><i class="fa fa-thumbs-' + (rateType == "down" ? "down" : "up") + '"></i>' + rate + '</span>'
                                    $(obj).parent().parent().append(str);
                                    $('.' + postId).fadeIn().delay(500).fadeOut(400, function() {
                                        $('.' + postId).remove();
                                    });
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
    </section>
    <!-- end portfolio -->

    <!-- offers -->
    <section class="min-100vh position-relative">
        <div class="container p-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50">
                <g>
                    <path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6
                            l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3
                            c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5
                            L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z" />
                </g>
            </svg>
            <div class="section_title">{{ trans_choice("words.offer",3) }}</div>
            <h1 class="orange">{{ __("words.cardTitle") }}</h1>
            <p>{{ __("words.cardDisc") }}</p>
            <div class="row offer">
                @foreach($offers as $offer)
                <div class="col-md-4">
                    <div class="card my-5">
                        <div class="card-body text-center">
                            <div class="price">{{$offer->cost}}$</div>
                            <h4 class="mb-3 orange w-100">{{ app()->getLocale()=='en'?$offer->title:$offer->title_ar }}</h4>

                            <p>{{ app()->getLocale()=='en'?$offer->desc:$offer->desc_ar }}</p>
                            <div>
                                <!-- Button trigger modal -->
                                @if(Auth::check())
                                <a href="#" data-for="{{$offer->id}}" class="btn btn_orange" data-toggle="modal" data-target="#offer_details">{{ __('words.moreDetails') }}</a>
                                @else
                                <a href="{{ route('login') }}" class="btn btn_orange">{{ __('words.loginToApplay') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Modal -->
            <div class="modal fade" id="offer_details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title orange w-100">{{ __("control.badConnectionHeader") }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                {{ __("control.badConnectionContent") }}
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <a href="#" name="close" onclick="return false;" class="btn-sm" data-dismiss="modal">{{ __("control.back") }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(function() {
                    'use strict';
                    var headaer = $('.modal-content .modal-header')
                        , content = $('.modal-content .container-fluid')
                        , footer = $('.modal-footer')
                        , applayBtn;
                    $('#offer_details').on('show.bs.modal', event => {
                        $("a[name='applay']").remove();
                        $(footer).append('<a href="#" name="applay" class="btn-sm">{{ __("words.takeItNow") }}</a>');
                        applayBtn = $("a[name='applay']");
                        $('.modal-footer a[data-dismiss="modal"]').removeClass('grean-full-btn').removeClass('red-full-btn');
                        var button = $(event.relatedTarget);
                        //put data
                        $(applayBtn).attr('data-for', $(button).attr('data-for'));
                        $(headaer).html($(button).parent().parent().find('.orange').clone());
                        $(headaer).append(
                            '<button type="button" class="close {{app()->getLocale()=="en"?"r-0":""}}" data-dismiss="modal" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button>');
                        $(content).html($(button).parent().parent().find('p').clone());
                        $(content).append(
                            '<svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50"><g>' +
                            '<path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6' +
                            'l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3' +
                            'c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5' +
                            'L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z"></path></g></svg>' +
                            '<div class="row form-group">' +
                            '<label class="w-100" for="detais">{{ __("words.extraDetails") }}</label>' +
                            '<textarea row="4" id="detais" class="form-control min-100_200"></textarea></div>');
                    });
                    $(footer).on('click', 'a[name="applay"]', function() {
                        $('.container-fluid small').remove();
                        $.ajax({
                            headers: {
                                //request X-CSRF-TOKEN header
                                'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                            }
                            , url: '{{ route("offerNotify") }}'
                            , type: 'POST'
                                // the type of data we expect back
                            , dataType: 'json'
                                //with post must the data have _token input data
                            , data: {
                                details: $('#detais').val()
                                , offer_id: $(applayBtn).attr('data-for')
                                , _token: '{{ csrf_token() }}'
                            }
                            //request success function with responce
                            , success: function(data) {
                                    if (data['success'] == '401' || data['success'] == '400') {
                                        //console.log(data);
                                        $("a[name='applay']").remove();
                                        $('.modal-footer a[data-dismiss="modal"]').addClass('red-full-btn');
                                        $(content).html('<i class="fa fa-frown-o w-100 text-center py-4" style="font-size: 30px;color: #e3342f;"> {{ __("words.applyFail") }}</i>');
                                    }
                                    //rate done
                                    else if (data['success'] == '200') {
                                        $("a[name='applay']").remove();
                                        $('.modal-footer a[data-dismiss="modal"]').addClass('grean-full-btn');
                                        $(content).html('<i class="fa fa-check-square-o w-100 text-center py-4" style="font-size: 30px;color: seagreen;"> {{ __("words.applyDone") }}</i>');
                                    }
                                }
                                //request error function
                            , error: function(xhr, status) {
                                if (xhr['responseJSON']['message'] == 'Unauthenticated.') {
                                    $('#filter').append('<form action="{{ route("login") }}" method="GET"></form>');
                                    $('#filter form').submit();
                                } else if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                                    var error = '<small class="w-100" style="color: #e3342f;">' + xhr['responseJSON']['errors']['details'][0] + '</small>';
                                    $(error).insertAfter('#detais');
                                } else {
                                    alert('Sorry,' + xhr['responseJSON']['message']);

                                }
                            }
                        });
                        return false;
                    });

                    $(footer).on('click', 'a[name="close"]', function() {
                        $('a[name="applay"]').remove();
                    });
                });

            </script>
        </div>
    </section>
    <!-- end offers -->
</div>

@auth
<!-- chat -->
<div class="chat_box">
    <video hidden class="d-none" id="msg_ring">
        <source src="{{ asset('sound/msg.mp3') }}" type="audio/mp3"></video>
    <div class="chat_btn">Chat</div>
    <div class="banel">
        <div class="chat_head text-center">
            <h1 class="lead mt-1">{{ __('words.chatTitle') }}</h1>
            <hr class="w-50 my-0">
        </div>
        <div class="chat">
            <div class="d-flex">
                <span class="chat_img" style="background-image: url({{ Auth::user()->profile->img? asset("/storage/".Auth::user()->profile->img): asset('img/personal.PNG') }});"></span>
                <div class="sender">{{ __('words.chatStart') }}</div>
            </div>
            <div class="d-flex dir-rtl">
                <span class="chat_img" style="background-image: url({{ asset('img/personal.PNG') }});"></span>
                <div class="resiver dir-ltr">{{ __('words.chatStartAnswer') }}</div>
            </div>
            @foreach($messages as $message)
            @if($message->sender_id == Auth::user()->id)
            <div class="d-flex">
                <span class="chat_img" style="background-image: url({{ Auth::user()->profile->img? asset("/storage/".Auth::user()->profile->img): asset('img/personal.PNG') }});"></span>
                <div class="sender">{{ __("control.me").' : '.$message->message }}</div>
            </div>
            @else
            <div class="d-flex dir-rtl">
                <span class="chat_img" style="background-image: url({{ asset('img/personal.PNG') }});"></span>
                <div class="resiver dir-ltr">{{ $message->message }}</div>
            </div>
            @endif
            @endforeach
        </div>
        <div class="chat_footer">
            <div class="emoji">
                <div class="emoji_tab">
                    <span data-for="1" class="fa fa-smile-o e_group active"></span>
                    <span data-for="2" class="fa fa-pagelines e_group"></span>
                    <span data-for="3" class="fa fa-glass e_group"></span>
                    <span data-for="4" class="fa fa-paw e_group"></span>
                    <span data-for="5" class="fa fa-heart e_group"></span>
                    <span data-for="6" class="fa fa-briefcase e_group"></span>
                    <span data-for="7" class="fa fa-mortar-board e_group"></span>
                    <span data-for="8" class="fa fa-floppy-o e_group"></span>
                </div>
                <div class="emoji_btn">
                </div>
            </div>
            <form action="" class="d-flex">
                <button type="button" class="emoji_toggle"><span class="fa fa-smile-o"></span></button>
                <input name="messag" class="text-muted form-control col-sm-10" max="255" placeholder="Send Us">
                <button id="sendMsg" onclick="return false;" type="submit" class="btn btn_fill_orange col-sm-2">{{ __('control.send') }}</button>
            </form>
        </div>
    </div>
    <script>
        var lastMessageDate='{{ count($messages)>0?$messages->last()->created_at:"2020-01-01" }}';
        $(function() {
            'use strict';
            $('.chat').scrollTop(100 * 100 * 100);
            //Refresh Chats
            setInterval(function(){
            'ues strict';
            if($('.chat_btn').hasClass('open')){
            $.ajax({
                        headers: {
                            //request X-CSRF-TOKEN header
                            'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                        }
                        , url: '{{ route("fresh") }}'
                        , type: 'POST'
                            // the type of data we expect back
                        , dataType: 'json'
                            //with post must the data have _token input data
                        , data: {
                            after_date:lastMessageDate
                            , _token: '{{ csrf_token() }}'
                        }
                        //request success function with responce
                        , success: function(data) {
                                //done
                                if (data['success'] == '200') {
                                    if(data['data']!="uptodate")
                                    {
                                        for(var i=0;i<data['data']['length'];i++){
                                            if(data['data'][i]['sender_id'] != '{{ Auth::user()->id }}'){
                                                $('.chat').append('<div class="d-flex dir-rtl">' +
                                                '<span class="chat_img" style="background-image:url(' + '{{ asset("img/personal.PNG") }}' + ');"></span>' +
                                                '<div class="resiver dir-ltr">' + data['data'][i]['message'] + '</div></div>');
                                                lastMessageDate=data['data'][i]['created_at'];
                                            }
                                        }
                                        //$('#msg_ring')[0].play();
                                        console.log(lastMessageDate);
                                        $('.chat').scrollTop(100 * 100 * 100);
                                    }
                                }
                            }
                            //request error function
                        , error: function(xhr, status) {
                            console.log(xhr);
                            if (xhr['responseJSON']['message'] == 'Unauthenticated.') {
                                $('#filter').append('<form action="{{ route("login") }}" method="GET"></form>');
                                $('#filter form').submit();
                            } else if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                                $('.chat div').last().remove();
                                $('.chat_footer input').val(senderMsg);
                            } else {
                                alert('Sorry,' + xhr['responseJSON']['message']);
                            }
                        }
                    });
            }
            }, 4000);

            $('#sendMsg').on('click', function() {
                var senderMsg = $('.chat_footer input').val();
                if (senderMsg.length > 0 && senderMsg.length < 255 && senderMsg != ' ') {
                    $('.chat').append('<div class="d-flex">' +
                        '<span class="chat_img" style="background-image:url(' + '{{ Auth::user()->profile->img? asset("/storage/".Auth::user()->profile->img): asset("img/personal.PNG") }}' + ');"></span>' +
                        '<div class="sender">' +'{{ __("control.me")." : " }}'+ senderMsg + '</div></div>');
                    $('.chat_footer input').val('');
                    $('#msg_ring')[0].play();
                    $('.chat').scrollTop(100 * 100 * 100);

                    $.ajax({
                        headers: {
                            //request X-CSRF-TOKEN header
                            'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                        }
                        , url: '{{ route("Messaging") }}'
                        , type: 'POST'
                            // the type of data we expect back
                        , dataType: 'json'
                            //with post must the data have _token input data
                        , data: {
                            message: senderMsg
                            , _token: '{{ csrf_token() }}'
                        }
                        //request success function with responce
                        , success: function(data) {
                                if (data['success'] == '201') {
                                    /*$('.chat').append('<div class="d-flex dir-rtl">' +
                                        '<span class="chat_img" style="background-image:url(' + '{{ asset("img/personal.PNG") }}' + ');"></span>' +
                                        '<div class="resiver dir-ltr">' + '{{ __("words.chatAnswerDelay") }}' + '</div></div>');
                                    $('.chat').scrollTop(100 * 100 * 100);
                                    $('#msg_ring')[0].play();*/
                                } else if (data['success'] == '204') {
                                    $('.chat').append('<div class="d-flex dir-rtl">' +
                                        '<span class="chat_img" style="background-image:url(' + '{{ asset("img/personal.PNG") }}' + ');"></span>' +
                                        '<div class="resiver dir-ltr">' + '{{ __("words.chatEndAnswer") }}' + '</div></div>');
                                    $('.chat').scrollTop(100 * 100 * 100);
                                }
                                //done
                                else if (data['success'] == '200') {
                                    $('.chat').append('<div class="d-flex dir-rtl">' +
                                        '<span class="chat_img" style="background-image:url(' + '{{ asset("img/personal.PNG") }}' + ');"></span>' +
                                        '<div class="resiver dir-ltr">' + data['data'] + '</div></div>');
                                    $('.chat').scrollTop(100 * 100 * 100);
                                }
                            }
                            //request error function
                        , error: function(xhr, status) {
                            console.log(xhr);
                            if (xhr['responseJSON']['message'] == 'Unauthenticated.') {
                                $('#filter').append('<form action="{{ route("login") }}" method="GET"></form>');
                                $('#filter form').submit();
                            } else if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                                $('.chat div').last().remove();
                                $('.chat_footer input').val(senderMsg);
                            } else {
                                alert('Sorry,' + xhr['responseJSON']['message']);
                            }
                        }
                    });
                }
            });
        });

    </script>
</div>
<!-- end chat-->
@endauth
@endsection
