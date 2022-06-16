@extends('layouts.admin')
@section('title',__('titles.chat'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('chat_message.index')}}">{{ trans_choice("words.chat",3) }}</a>
</li>
@endsection
@section('content')
<div class="row justify-content-center">

    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div><span class="lead text-muted"> {{ __('control.log') }} </span>- {{ trans_choice("words.chat",3) }}</div>
                    <div class="option">
                        <a href="#" onclick="return false;" data-toggle="modal" data-target="#chatDialog" class="fa fa-comments py-1 px-2"> {{ trans_choice("words.chat",3) }} </a>
                        <a href="{{ route('home.index') }}" class="fa fa-external-link py-1 px-2"> {{ __("control.back") }} </a>
                        @if(Auth::user()->isSouperAdmin())
                        <a href="#" id="delete_some" class="fa fa-trash py-1 px-2"> {{ __("control.delete") }} </a>
                        @endif

                    </div>
                </div>
            </div>

            <div class="card-body">
                <div style="display: none;">
                    <form id="action_form" action="" method="">
                        @csrf
                    </form>
                </div>
                <table class="table table-bordered table-hover table-inverse table-striped table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            @if(Auth::user()->isSouperAdmin())
                            <th class="text-center"><input type="checkbox" id="check_all" class="form-check mb-1"></th>
                            @endif
                            <th class="text-center">#</th>
                            <th class="text-center">{{ __("words.sender") }}</th>
                            <th class="w-25 text-center">{{ __("words.receiver") }}</th>
                            <th class="w-50 text-center">{{ __('words.message') }}</th>
                            <th class="w-25 text-center">{{ __('control.startDate') }} </th>
                            @if(Auth::user()->isSouperAdmin())
                            <th class="w-25">{{ __("words.action") }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr class="{{ !$message->status?'text-danger':'' }}">
                            @if(Auth::user()->isSouperAdmin())
                            <td><input type="checkbox" data-for="{{ $message->id }}" class="form-check mt-2"></td>
                            @endif

                            <td>{{ $message->id }}</td>
                            <td>{{ $message->sender_id }}</td>
                            <td>{{ $message->receiver_id }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->created_at }}</td>
                            @if(Auth::user()->isSouperAdmin())
                            <td class="text-center">
                                <button data-for="{{ $message->id }}" class="chat_edit btn btn-sm btn-outline-secondary m-1">{{ __("control.edit") }}</button>
                                <button data-for="{{ $message->id }}" class="chat_delete btn btn-sm btn-outline-danger m-1">{{ __("control.delete") }}</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>{{ $messages->links() }}</div>
                    <div>
                        <h5 class="d-inline">{{ __("control.total") }} :</h5>
                        <h6 class="d-inline">{{$count.trans_choice("control.row",$count)}} {{$allCount>$count?' '.__("control.of").' '.$allCount:'' }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat dialog -->
    <div class="modal fade dir-ltr" id="chatDialog" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content admin_chat">
                <video hidden class="d-none" id="msg_ring">
                    <source src="{{ asset('sound/msg.mp3') }}" type="audio/mp3">
                </video>
                <div class="modal-header bg-dark">
                    <h5 class="modal-title orange w-100">
                        {{ trans_choice("words.chat",3) }}
                    </h5>
                    <button type="button" class="close {{app()->getLocale()=="en"?"r-0":""}}" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50">
                        <g>
                            <path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6
                    l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3
                    c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5
                    L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z"></path>
                        </g>
                    </svg>
                    <div class="d-flex justify-content-center">
                        <div class="option">
                            <a href="#" onclick="return false;" data-dismiss="modal" class="fa fa-external-link py-1 px-2"> {{ __("control.back") }} </a>
                            <a href="#" id="broadcust" class="fa fa-comments-o py-1 px-2"> B.C </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body banel1">
                            <div class="row m-0">
                                <div class="col-9">
                                    <div class="chat_head text-center">
                                        <h1 class="lead mt-1" data-for="0" id="chat_title">Last Chats : Broadcast</h1>
                                        <hr class="w-50 my-0">
                                    </div>
                                    <div class="chat">
                                        <div class="d-flex dir-rtl">
                                            <span class="chat_img" style="background-image:url({{ asset("img/personal.PNG") }});"></span>
                                            <div class="resiver dir-ltr">{{ __("words.chatbot")." : ".__("words.broadcustMessage")}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 list p-0">
                                    <h5 class="text-center">{{ __('words.userList') }}</h5>
                                    <ul id="user_p" class="m-0 pr-3 text-center">
                                        @foreach($users as $user)
                                        <li data-for="{{ $user->id }}">
                                            <img class="img pull-left" src="{{$user->profile['img']?asset('/storage/'.$user->profile['img']): asset('img/personal.PNG') }}">
                                            <span class="username">{{ $user->name }}</span><span class="text-muted"></span>
                                            <span style="border-radius:5px; color:#fff; {{ $user->msgCount()?'':'display:none;' }}" class="mx-2 px-1 bg-dark">{{ $user->msgCount() }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
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
                        <div class="card-footer">
                            <form action="" class="row">
                                <button type="button" class="emoji_toggle"><span class="fa fa-smile-o"></span></button>
                                <input name="messag" class="text-muted form-control col-sm-10 my-1" max="255" placeholder="Send Us">
                                <button id="sendMsg" onclick="return false;" type="submit" class="btn btn_fill_orange my-1 col-sm-2">{{ __('control.send') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                'use strict';
                $('.chat').scrollTop(100 * 100 * 100);

                var user_pannel = $('#user_p li')
                    , clicked_User
                    , last_Dt = "2020-01-01"
                    , st = 0
                    , activechatid = 0;
                $(user_pannel).on('click', function() {
                    st = 0;
                    clicked_User = $(this);
                    $('.chat').empty();
                    $('#chat_title').html('Last Chats : ' + $(this).find('.username').text());
                    $('#chat_title').attr('data-for', $(clicked_User).attr('data-for'));
                    $.ajax({
                        headers: {
                            //request X-CSRF-TOKEN header
                            'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                        }
                        , url: '{{ route("getIdMessage") }}'
                        , type: 'POST'
                            // the type of data we expect back
                        , dataType: 'json'
                            //with post must the data have _token input data
                        , data: {
                            user_id: $(clicked_User).attr('data-for')
                            , _token: '{{ csrf_token() }}'
                        }
                        //request success function with responce
                        , success: function(data) {
                                //done
                                if (data['success'] == '200') {
                                    for (var i = 0; i < data['data']['length']; i++) {
                                        if (data['data'][i]['sender_id'] == '{{Auth::user()->id}}')
                                            $('.chat').append('<div class="d-flex">' +
                                                '<span class="chat_img" style="background-image:url(' + '{{ Auth::user()->profile->img?"/storage/".Auth::user()->profile->img: asset("img/personal.PNG") }}' + ');"></span>' +
                                                '<div class="sender">{{ __("control.me")." : " }}' + data['data'][i]['message'] + '</div></div>');
                                        else {
                                            $('.chat').append('<div class="d-flex dir-rtl">' +
                                                '<span class="chat_img" style="background-image:url(' + $(clicked_User).find('img').prop('src') + ');"></span>' +
                                                '<div class="resiver dir-ltr">' + data['data'][i]['message'] + '</div></div>');
                                        }

                                        last_Dt = data['data'][i]['created_at'];
                                    }
                                    activechatid = $(clicked_User).attr('data-for');
                                }
                                $('.chat').scrollTop(100 * 100 * 100);
                                st = 1;
                            }
                            //request error function
                        , error: function(xhr, status) {
                            console.log(xhr);
                            if (xhr['responseJSON']['message'] == 'Unauthenticated.') {
                                $('#filter').append('<form action="{{ route("login") }}" method="GET"></form>');
                                $('#filter form').submit();
                            } else if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                                $('.chat div').last().remove();
                                $('.card-footer input').val(senderMsg);
                            } else {
                                alert('Sorry,' + xhr['responseJSON']['message']);
                            }
                        }
                    });
                });

                $('#sendMsg').on('click', function() {
                    var senderMsg = $('.card-footer input').val();
                    if (senderMsg.length > 0 && senderMsg.length < 255 && senderMsg != ' ') {
                        $('.chat').append('<div class="d-flex">' +
                            '<span class="chat_img" style="background-image:url(' + '{{ Auth::user()->profile->img?"/storage/".Auth::user()->profile->img: asset("img/personal.PNG") }}' + ');"></span>' +
                            '<div class="sender">' + senderMsg + '</div></div>');
                        $('.card-footer input').val('');
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
                                , to_id: $('#chat_title').attr('data-for')
                                , _token: '{{ csrf_token() }}'
                            }
                            //request success function with responce
                            , success: function(data) {
                                    if (data['success'] == '201') {} else if (data['success'] == '204') {
                                        $('.chat').append('<div class="d-flex dir-rtl">' +
                                            '<span class="chat_img" style="background-image:url(' + '{{ asset("img/personal.PNG") }}' + ');"></span>' +
                                            '<div class="resiver dir-ltr">' + '{{ __("words.chatEndAnswer") }}' + '</div></div>');
                                        $('.chat').scrollTop(100 * 100 * 100);
                                    }
                                    //done
                                    else if (data['success'] == '200') {}
                                }
                                //request error function
                            , error: function(xhr, status) {
                                console.log(xhr);
                                if (xhr['responseJSON']['message'] == 'Unauthenticated.') {
                                    $('#filter').append('<form action="{{ route("login") }}" method="GET"></form>');
                                    $('#filter form').submit();
                                } else if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                                    $('.chat div').last().remove();
                                    $('.card-footer input').val(senderMsg);
                                } else {
                                    alert('Sorry,' + xhr['responseJSON']['message']);
                                }
                            }
                        });
                    }
                });

                $('#broadcust').on('click', function() {
                    event.preventDefault();
                    activechatid = 0;
                    $('.chat').empty();
                    $('#chat_title').html('Last Chats : Broadcast');
                    $('#chat_title').attr('data-for', '0');
                    $('.chat').append('<div class="d-flex dir-rtl">' +
                        '<span class="chat_img" style="background-image:url({{ asset("img/personal.PNG") }});"></span>' +
                        '<div class="resiver dir-ltr">{{ __("words.chatbot")." : ".__("words.broadcustMessage")}}</div></div>');
                });

                //Refresh current Chats not broadcust
                setInterval(function() {
                    'ues strict';
                    if ($('.chat_title').attr('data-for') != '0' && activechatid != 0 && st != 0) {
                        $.ajax({
                            headers: {
                                //request X-CSRF-TOKEN header
                                'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                            }
                            , url: '{{ route("Adminfresh") }}'
                            , type: 'POST'
                                // the type of data we expect back
                            , dataType: 'json'
                                //with post must the data have _token input data
                            , data: {
                                after_date: last_Dt
                                , for_id: activechatid
                                , _token: '{{ csrf_token() }}'
                            }
                            //request success function with responce
                            , success: function(data) {
                                    //done
                                    if (data['success'] == '200') {
                                        if (data['data'] != "uptodate") {
                                            for (var i = 0; i < data['data']['length']; i++) {
                                                if (data['data'][i]['sender_id'] != '{{ Auth::user()->id }}') {
                                                    $('.chat').append('<div class="d-flex dir-rtl">' +
                                                        '<span class="chat_img" style="background-image:url(' + $(clicked_User).find('img').prop('src') + ');"></span>' +
                                                        '<div class="resiver dir-ltr">' + data['data'][i]['message'] + '</div></div>');
                                                }
                                                last_Dt = data['data'][i]['created_at'];

                                            }
                                            $('#msg_ring')[0].play();
                                            $('.chat').scrollTop(100 * 100 * 100);
                                        }
                                    }
                                }
                                //request error function
                            , error: function(xhr, status) {
                                console.log(xhr);
                                if (xhr['responseJSON']['message'] == 'Unauthenticated.') {} else if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                                    $('.chat div').last().remove();
                                    $('.chat_footer input').val(senderMsg);
                                } else {
                                    alert('Sorry,' + xhr['responseJSON']['message']);
                                }
                            }
                        });
                    }
                    $.ajax({
                        headers: {
                            //request X-CSRF-TOKEN header
                            'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                        }
                        , url: '{{ route("freshCounts") }}'
                        , type: 'POST'
                            // the type of data we expect back
                        , dataType: 'json'
                            //with post must the data have _token input data
                        , data: {
                            _token: '{{ csrf_token() }}'
                        }
                        //request success function with responce
                        , success: function(data) {
                                //done
                                if (data['success'] == '200') {
                                    if (data['side_count']) {
                                        $('#msg_count').fadeIn();
                                        $('#msg_count').text(data['side_count']);
                                    } else $('#msg_count').fadeOut();
                                    if (data['users']['length'] > 0) {
                                        $(user_pannel).each(function() {
                                            for (var i = 0; i < data['users']['length']; i++) {
                                                if (data['users'][i]['id'] == $(this).attr('data-for')) {
                                                    if (data['users'][i]['id'] == '{{ Auth::user()->id }}')
                                                        $(this).find('span.username+.text-muted').text(' {{ __("control.me") }}');
                                                    else if (data['user_rules'][$(this).attr('data-for')])
                                                        $(this).find('span.username+.text-muted').text(' *');

                                                    $(this).find('span.username').text(data['users'][i]['name']);
                                                }
                                            }
                                            if (data['user_msg_count'][$(this).attr('data-for')]['count']) {
                                                $(this).find('span.bg-dark').text(data['user_msg_count'][$(this).attr('data-for')]['count']);
                                                $(this).find('span.bg-dark').fadeIn();
                                            } else $(this).find('span.bg-dark').fadeOut();
                                        });
                                    }
                                }
                            }
                            //request error function
                        , error: function(xhr, status) {
                            console.log(xhr);
                            if (xhr['responseJSON']['message'] == 'Unauthenticated.') {} else if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                                $('.chat div').last().remove();
                                $('.chat_footer input').val(senderMsg);
                            } else {
                                alert('Sorry,' + xhr['responseJSON']['message']);
                            }
                        }
                    });
                }, 4000);

            });

        </script>
    </div>
    <!-- End Chat dialog -->
</div>

<script>
    $(function() {
        "use strict";
        var forms = $('#action_form');
        $('.chat_edit').on('click', function(e) {
            event.preventDefault();
            $(forms).prop('method', 'GET');
            $("#action_form input[name='_token']").remove();
            $(forms).prop('action', '{{ route("chat_message.index") }}/' + $(this).attr("data-for") + "/edit");
            $(forms).submit();
        });
        $('.chat_delete').on('click', function(e) {
            event.preventDefault();
            $(forms).prop('method', 'POST');
            $('<input type="hidden" name="_method" value="delete">').insertBefore("#action_form>input");
            $(forms).prop('action', '{{ route("chat_message.index") }}/' + $(this).attr("data-for"));
            $(forms).submit();
        });
        $('#delete_some').on('click', function(e) {
            event.preventDefault();
            $("#action_form input[name='_token']").remove();
            ajaxLoading('{{ __("words.loading") }}');
            var idList=[],
            allChecked=[],
            all = $('tbody input[type="checkbox"]');
            //get all checkbox from tbody
            all.each(function(){
                if(this.checked){
                    //add all checked checkbox id to an array
                    idList.push($(this).attr('data-for'));
                    //add checked row of data to array
                    allChecked.push($(this).parent().parent());
                }
            });
            $.ajax({
                headers: {
                    //request X-CSRF-TOKEN header
                    'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                },
                 url: '{{ route("chatMessageDestroySome") }}',
                 type: 'POST',
                 // the type of data we expect back
                 dataType: 'json',
                 //with post must the data have _token input data
                 data:{idList:idList,_token:'{{ csrf_token() }}'},
                 //request success function with responce
                  success: function(data) {
                      //console.log(data);
                    $(forms).prop('method', 'GET');
                    $(forms).prop('action', '{{ route("chat_message.index") }}');
                    $(forms).submit();
                    $("#loading").remove();
                },
                //request error function
                 error: function(xhr, status) {
                     console.log(xhr);
                    alert('Sorry, there was '+status+' problem!');
                }
            });
        });
    });
</script>
@endsection
