@extends('layouts.app')
@section('title',__('titles.profile'))
@section('content')
<section style="background-color:#fff" id="end" class="position-relative profile {{app()->getLocale()=='en'?'':'text-right'}}">
    <div class="py-5 pt-130px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" onclick="return false;" data-title="password" data-target="#basicEdit" data-toggle="modal" class=" fa fa-lock pass_change"> Password</a>
                            <a href="#" onclick="return false;" data-title="basic" data-target="#basicEdit" data-toggle="modal" class="fa fa-edit orange edit"></a>
                            {{-- comment --}}

                            {{-- Modal --}}
                            <div class="modal fade" id="basicEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title orange w-100">
                                                {{ __("control.edit").' '.__('control.basicInfo') }}
                                            </h5>
                                            <button type="button" class="close {{app()->getLocale()=="en"?"r-0":""}}" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <h5 class="modal-title orange w-100">
                                                    {{ __("control.badConnectionHeader") }}</h5>
                                                {{ __("control.badConnectionContent") }}
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <a href="#" name="close" onclick="return false;" class="btn-sm" data-dismiss="modal">{{ __("control.back") }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center d-flex justify-content-center mx-5">
                                <div id="personal-img">
                                    <form action="{{ route('profile.index').'/'.Auth::user()->profile->id }}" method="POST" enctype="multipart/form-data">
                                        @method('patch')
                                        @csrf
                                        <img class="img-thumbnail rounded-circle" src="{{ Auth::user()->profile->img?asset('/storage/'.Auth::user()->profile->img):asset('img/personal.PNG') }}">
                                        <input type="file" name="personalPic" id="personalPic" class="custom-file">
                                        <a href="#" onclick="return false;" data-target="subit" class="fa fa-check btn btn-success"></a>
                                        <a href="#" onclick="return false;" data-target="cancle" class="fa fa-close btn btn-danger"></a>
                                    </form>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <h3 class="orange"><i style="font-size:smaller;" class="fa fa-circle {{ Auth::user()->isActive()?'text-success':'text-muted' }}"></i>
                                            {{ Auth::user()->name }}</h3>
                                    </div>
                                    <div class="row form-group pt-2">
                                        <h6 class="col-md-4 text-muted">
                                            @if(Auth::user()->phone2 && !Auth::user()->phone1)
                                            <i class="fa fa-phone"></i> {{ Auth::user()->phone2 }}
                                            @else
                                            @if(Auth::user()->phone1)
                                            <i class="fa fa-phone"></i> {{ Auth::user()->phone1 }}
                                            @if(Auth::user()->phone2)
                                            {{ ' - '.Auth::user()->phone2 }}
                                            @endif
                                            @endif
                                            @endif
                                        </h6>
                                        <h6 class="col-md-4 text-muted"><i class="fa fa-envelope"></i>
                                            {{ Auth::user()->profile->email }}</h6>
                                        <h6 class="col-md-4 text-muted">
                                            @if(Auth::user()->profile->country && $ccountry)
                                            <i class="fa fa-map-marker"></i>
                                            <img style="width:15px;" src="{{ asset('flags/'.$ccountry->short.'.png') }}">
                                            @endif
                                            <span style="{{ app()->getLocale()=='en'?'':'direction:rtl;' }}">
                                                @if(Auth::user()->profile->country)
                                                {{ app()->getLocale()=='en'?$ccountry->label:$ccountry->label_ar }}
                                                @if(Auth::user()->profile->gov && $cgov)
                                                {{ app()->getLocale()=='en'?', '.$cgov->label:', '.$cgov->label_ar }}
                                                @endif
                                                @if(Auth::user()->profile->district)
                                                {{ '- '.Auth::user()->profile->district }}
                                                @endif
                                                @endif
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="min-50vh pt-3 card-body position-relative {{ app()->getLocale()=='ar'?'text-right':'' }}">
                            <a href="#" onclick="return false;" data-title="advanced" data-target="#basicEdit" data-toggle="modal" class="fa fa-edit edit"></a>
                            <div class="row">
                                <h4 class="col-12 py-1 text-center text-muted">{{ __('control.advanceInfo') }}</h4>
                                <div class="col-md-6 b_right pb-4">
                                    @if(Auth::user()->profile->about)
                                    <div class="m-1 card card-header {{ app()->getLocale()=='ar'?'dir-rtl':'' }}">
                                        <h5 class="text-muted">{{ __('control.about') }} :</h5>
                                        <p>{{ Auth::user()->profile->about }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6 b_left pb-4">
                                    @if(Auth::user()->profile->nick_name || Auth::user()->profile->gender)
                                    <div class="{{ app()->getLocale()=='ar'?'dir-rtl':'' }}">
                                        @if(Auth::user()->profile->nick_name)
                                        <div class="m-1 mb-2 card card-header">
                                            <h5 class="text-muted">{{ __('control.nickName') }} :</h5>
                                            <p>{{ Auth::user()->profile->nick_name }}</p>
                                        </div>
                                        @endif
                                        @if(Auth::user()->profile->gender)
                                        <div class="m-1 mb-2 card card-header">
                                            <h5 class="text-muted">{{ __('control.gender') }} :</h5>
                                            <p style="{{ Auth::user()->profile->gender==1?'color:#c45ae9':'color:#fe90a3' }}">
                                            <i class="fa fa-user"></i>
                                            {{ Auth::user()->profile->gender==1?__("control.male"):__("control.female") }}
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-center text-center">
                                <span class="border-b">
                                    <i class="fa fa-child d-block"></i>
                                    {{ __('control.createdAt') }} : {{ substr(Auth::user()->profile->created_at,0,4) }}
                                </span>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#personalPic~a.btn-success').on('click', function() {
                $('#personal-img form').submit();
            });

            var content = $('.modal-content .container-fluid')
                , footer = $('.modal-footer')
                , header = $('.modal-header .modal-title')
                , applayBtn
                , button;

            $('#basicEdit').on('show.bs.modal', event => {
                button = $(event.relatedTarget);

                $("a[name='save']").remove();
                $(footer).append('<a href="#" name="save" class="btn-sm">{{ __("control.save") }}</a>');
                applayBtn = $("a[name='save']");
                $('.modal-footer a[data-dismiss="modal"]').removeClass('grean-full-btn').removeClass('red-full-btn');
                //put data
                if ($(button).attr('data-title') == "basic") {
                    $(header).first().html('{{ __("control.edit")." ".__("control.basicInfo") }}');
                    $(content).html("");
                    $(content).append(
                        '<svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50"><g>' +
                        '<path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6' +
                        'l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3' +
                        'c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5' +
                        'L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z"></path></g></svg>' +
                        '<div id="basic1" class="row form-group"><div class="col-md-6">' +
                        '<label class="w-100" required for="name"><span class="text-danger">* </span>{{ __("words.name") }}</label>' +
                        '<input max="30" required name="name" value="{{ Auth::user()->name?Auth::user()->name:"" }}" class="form-control">' +
                        '</div><div class="col-md-6">' +
                        '<label class="w-100" for="email"><span class="text-danger">* </span>{{ __("words.email") }} <span style="font-size:smaller;" class="text-muted">({{ __("words.contactEmail") }})</span></label>' +
                        '<input max="30" type="email" value="{{ Auth::user()->profile->email?Auth::user()->profile->email:"" }}" name="email" class="form-control">' +
                        '</div></div><div id="basic2" class="row form-group"><div class="col-md-6">' +
                        '<label class="w-100" for="phone1">{{ __("words.phoneNumber")." 1" }}</label>' +
                        '<input min="9" max="12" name="phone1" value="{{ Auth::user()->phone1?Auth::user()->phone1:"" }}" class="form-control">' +
                        '</div><div class="col-md-6">' +
                        '<label class="w-100" for="phone2">{{ __("words.phoneNumber")." 2" }}</label>' +
                        '<input min="9" max="12" name="phone2" value="{{ Auth::user()->phone2?Auth::user()->phone2:""}}" class="form-control">' +
                        '</div></div><div id="basic3" class="row form-group">' +
                        '<div class="col-md-4">' +
                        '<label class="w-100" for="country">{{ __("control.country") }}</label>' +
                        '<select style="background-image: url('+($('h6 img').attr('src')?$("h6 img").attr("src"):"{{ asset('/flags/zz.png') }}")+');background-repeat: no-repeat;background-size: 25px;background-position: left center;padding-left: 25px;" name="country" class="form-control">' +
                        '<option data-flag="zz" value="">{{ __("control.select") }}</option>' +
                        '@foreach($countrys as $country)' +
                        '<option {{ Auth::user()->profile->country==$country->id?"selected":"" }} data-flag="{{ $country->short }}" value="{{ $country->id }}">' +
                        '{{ app()->getLocale()=="en"?$country->label:$country->label_ar }}</option>' +
                        '@endforeach</select></div><div class="col-md-4">' +
                        '<label class="w-100" for="gov">{{ __("control.gov") }}</label>' +
                        '<select name="gov" class="form-control">' +
                        '<option value="">{{ __("control.select") }}</option>' +
                        '@foreach($govs as $gov)' +
                        '@if($gov->country_id == Auth::user()->profile->country)<option {{ Auth::user()->profile->gov==$gov->id?"selected":"" }} value="{{ $gov->id }}">' +
                        '{{ app()->getLocale()=="en"?$gov->label:$gov->label_ar }}</option> @endif @endforeach' +
                        '</select></div><div class="col-md-4">' +
                        '<label class="w-100" for="district">{{ __("control.district") }}</label>' +
                        '<input max="20" value="{{ Auth::user()->profile->district?Auth::user()->profile->district:"" }}" name="district" class="form-control">' +
                        '</div></div>');
                }
                else if($(button).attr('data-title') == "password"){
                    $(header).first().html('{{__("words.resetPassword") }}');
                    $(content).html("");
                    $(content).append('<svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50"><g>' +
                        '<path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6' +
                        'l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3' +
                        'c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5' +
                        'L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z"></path></g></svg>' +
                        '<div id="password" class="row form-group {{ app()->getLocale()=="ar"?"text-right dir-rtl":"" }}"><div class="col-md-6">'+
                        '<label class="w-100" for="password">{{ __("words.password") }}</label>'+
                        '<div class="input-group"><input name="password" class="form-control" type="password">'+
                        '<div class="input-group-prepend show_pass">'+
                        '<button class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></button>'+
                        '</div></div></div><div class="col-md-6">'+
                        '<label class="w-100" for="password_confirmation">{{ __("words.password")." ".__("words.confirm") }}</label>'+
                        '<div class="input-group"><input name="password_confirmation" class="form-control" type="password">'+
                        '<div class="input-group-prepend show_pass">'+
                        '<button class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></button>'+
                        '</div></div></div></div>');
                } else{
                    $(header).first().html('{{ __("control.edit")." ".__("control.advanceInfo") }}');
                    $(content).html("");
                    //advanced
                    $(content).append('<svg xmlns="http://www.w3.org/2000/svg" class="sp" viewBox="0 0 800 50"><g>' +
                        '<path d="M750,8v10c0,0.3,0,0.7,0,1c-0.2,2.4-1.3,4.5-2.9,6.1c-1.8,1.8-4.3,2.9-7.1,2.9H429.1c-2.4,0-4.7,1-6.4,2.6' +
                        'l-15.2,15.2c-4.2,4.2-10.9,4.2-15,0l-15.2-15.2c-1.7-1.7-4-2.6-6.4-2.6H60.3c-5.2,0-9.8-3.9-10.3-9c0-0.1,0-0.2,0-0.3' +
                        'c0-0.3,0-0.5,0-0.7V8h326.6c0.8,0,1.6,0.1,2.4,0.3c1.5,0.4,2.9,1.2,4,2.3l15.9,15.9c0.3,0.3,0.7,0.5,1.1,0.5s0.8-0.2,1.1-0.5' +
                        'L417,10.6c1.7-1.7,4-2.6,6.4-2.6H750z"></path></g></svg>' +
                        '<div id="advanced" class="row form-group {{ app()->getLocale()=="ar"?"text-right dir-rtl":"" }}"><div class="col-md-6">'+
                        '<label class="w-100" for="nick_name">{{ __("control.nickName") }}</label>'+
                        '<input max="50" name="nick_name" value="{{ Auth::user()->profile->nick_name?Auth::user()->profile->nick_name:''}}" class="form-control">'+
                        '</div><div class="col-md-6">'+
                        '<label class="w-100" for="gender">{{ __("control.gender") }}</label>'+
                        '<select name="gender" class="form-control">'+
                        '<option value="">{{ __("control.select") }}</option>'+
                        '<option {{ Auth::user()->profile->gender==1?"selected":"" }} value="1">{{ __("control.male") }}</option>'+
                        '<option {{ Auth::user()->profile->gender==2?"selected":"" }} value="2">{{ __("control.female") }}</option>'+
                        '</select></div><div class="col-md-12">'+
                        '<label class="w-100" for="about">{{ __("control.about") }}</label>'+
                        '<textarea max="500" name="about" class="form-control min-100_200">{{ Auth::user()->profile->about?Auth::user()->profile->about:''}}</textarea>'+
                        '</div></div>');
                }
            });

            $(footer).on('click', 'a[name="save"]', function() {
                //edit is heare to compatable
                $('.container-fluid small').remove();
                $.ajax({
                    headers: {
                        //request X-CSRF-TOKEN header
                        'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                    }
                    , url: '{{ route("profile.index")."/".Auth::user()->profile->id}}'
                    , type: 'POST'
                        // the type of data we expect back
                    , dataType: 'json'
                        //with post must the data have _token input data
                    , data: $(button).attr('data-title') == "basic" ? {
                            name: $('input[name="name"]').val()
                            , email: $('input[name="email"]').val()
                            , phone1: $('input[name="phone1"]').val()
                            , phone2: $('input[name="phone2"]').val()
                            , country: $('select[name="country"]').val()
                            , gov: $('select[name="gov"]').val()
                            , district: $('input[name="district"]').val()
                            , _method: 'patch'
                            , _token: '{{ csrf_token() }}'
                        } : $(button).attr('data-title') == "password" ?{
                            password: $('input[name="password"]').val()
                            , password_confirmation: $('input[name="password_confirmation"]').val()
                            , _method: 'patch'
                            , _token: '{{ csrf_token() }}'
                        } : {
                            nick_name: $('input[name="nick_name"]').val()
                            , gender: $('select[name="gender"]').val()
                            , about: $('textarea[name="about"]').val()
                            , advanced: 'ok'
                            , _method: 'patch'
                            , _token: '{{ csrf_token() }}'
                        }
                        //request success function with responce
                    , success: function(data) {
                            if (data['success'] == '400') {
                            } else if (data['success'] == '401') {
                                $("a[name='save']").remove();
                                $('.modal-footer a[data-dismiss="modal"]').addClass('red-full-btn');
                                $(content).html('<i class="fa fa-frown-o w-100 text-center py-4" style="font-size: 30px;color: #e3342f;"> {{ __("control.fill") }}</i>');
                            }
                            //rate done
                            else if (data['success'] == '200') {
                                $("a[name='save']").remove();
                                $('.modal-footer a[data-dismiss="modal"]').addClass('grean-full-btn');
                                $(content).html('<i class="fa fa-check-square-o w-100 text-center py-4" style="font-size: 30px;color: seagreen;"> {{ __("control.done") }}</i>');
                                if($('#basicEdit form').length==0)
                                $('#basicEdit').append('<form action="{{ route("profile.index") }}" method="GET"></form>');
                                $('#basicEdit form').delay(1000).submit();
                            }
                            else if (data['success'] == '201') {
                                var error = '<small class="w-100 d-block" style="color: #e3342f;">' +'{{ __("words.usedSameOldPass") }}'+ '</small>';
                                    $(error).insertAfter('#password');
                            }
                        }
                        //request error function
                    , error: function(xhr, status) {
                        console.log(xhr);
                        if (xhr['responseJSON']['message'] == 'Unauthenticated.') {
                            if($('#basicEdit form').length==0)
                            $('#basicEdit').append('<form action="{{ route("login") }}" method="GET"></form>');
                            $('#basicEdit form').submit();
                        } else if (xhr['responseJSON']['message'] == 'The given data was invalid.') {
                            if ($(button).attr('data-title') == "basic") {
                                if (xhr['responseJSON']['errors']['name']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['name'][0] + '</small>';
                                    $(error).insertAfter('#basic1');
                                }
                                if (xhr['responseJSON']['errors']['email']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['email'][0] + '</small>';
                                    $(error).insertAfter('#basic1');
                                }
                                if (xhr['responseJSON']['errors']['phone1']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['phone1'][0] + '</small>';
                                    $(error).insertAfter('#basic2');
                                }
                                if (xhr['responseJSON']['errors']['phone2']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['phone2'][0] + '</small>';
                                    $(error).insertAfter('#basic2');
                                }
                                if (xhr['responseJSON']['errors']['country']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['country'][0] + '</small>';
                                    $(error).insertAfter('#basic3');
                                }
                                if (xhr['responseJSON']['errors']['gov']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['gov'][0] + '</small>';
                                    $(error).insertAfter('#basic3');
                                }
                                if (xhr['responseJSON']['errors']['district']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['district'][0] + '</small>';
                                    $(error).insertAfter('#basic3');
                                }
                            }
                            else if($(button).attr('data-title') == "password"){
                                if (xhr['responseJSON']['errors']['password']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['password'][0] + '</small>';
                                    $(error).insertAfter('#password');
                                }
                                if (xhr['responseJSON']['errors']['password_confirmation']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['password_confirmation'][0] + '</small>';
                                    $(error).insertAfter('#password_confirmation');
                                }
                            }
                            else{
                                if (xhr['responseJSON']['errors']['nick_name']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['nick_name'][0] + '</small>';
                                    $(error).insertAfter('#advanced');
                                }
                                if (xhr['responseJSON']['errors']['gender']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['gender'][0] + '</small>';
                                    $(error).insertAfter('#advanced');
                                }
                                if (xhr['responseJSON']['errors']['about']) {
                                    var error = '<small class="w-100 d-block" style="color: #e3342f;">' + xhr['responseJSON']['errors']['about'][0] + '</small>';
                                    $(error).insertAfter('#advanced');
                                }
                            }
                        } else {
                            alert('Sorry,' + xhr['responseJSON']['message']);
                        }
                    }
                });
                return false;
            });

            $(footer).on('click', 'a[name="close"]', function() {
                $('a[name="save"]').remove();
            });

            $('.container-fluid').on('change', '#basic3 div select[name="country"]', function() {
                $('select[name="gov"]').empty();
                $('select[name="gov"]').append('<option value="">{{ __("control.select") }}</option>');
                $.ajax({
                    headers: {
                        //request X-CSRF-TOKEN header
                        'X-CSRF-TOKEN': $('mata[name="csrf-token"]').attr('content')
                    }
                    , url: '{{ route("govsOfCountry") }}'
                    , type: 'POST'
                        // the type of data we expect back
                    , dataType: 'json'
                        //with post must the data have _token input data
                    , data: {
                        country: $('#basic3 div select[name="country"]').val()
                        , _token: '{{ csrf_token() }}'
                    }
                    //request success function with responce
                    , success: function(data) {
                            //rate done
                            if (data['success'] == '200') {
                                console.log('{{ app()->getLocale() }}');
                                for (var i = 0; i < data['govs']['length']; i++) {
                                    if ('{{ app()->getLocale() }}' == 'en')
                                        $('select[name="gov"]').append('<option value="' + data['govs'][i]['id'] + '">' + data['govs'][i]['label'] + '</option>');
                                    else
                                        $('select[name="gov"]').append('<option value="' + data['govs'][i]['id'] + '">' + data['govs'][i]['label_ar'] + '</option>');
                                }
                            }
                        }
                        //request error function
                    , error: function(xhr, status) {
                        if (xhr['responseJSON']['message'] == 'Unauthenticated.') {
                            if($('#basicEdit form').length==0)
                            $('#basicEdit').append('<form action="{{ route("login") }}" method="GET"></form>');
                            $('#basicEdit form').submit();
                        } else {
                            alert('Sorry,' + xhr['responseJSON']['message']);
                        }
                    }
                });
            });

            $('#basicEdit').on('mousedown', '.show_pass', function() {
                $(this).parent().find('input').prop('type','text');
            });

            $('#basicEdit').on('mouseup', '.show_pass', function() {
                $(this).parent().find('input').prop('type','password');
            });
        });

    </script>
</section>
@endsection
