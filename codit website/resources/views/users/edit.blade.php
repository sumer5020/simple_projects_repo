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
     <a class="nav-item px-1" href="{{route('user.index').'/'.$user->id.'/edit'}}">{{ __("control.edit") }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">{{ __("control.edit").' '.trans_choice("words.user",3)}}</div>

            <div class="card-body">
                <form method="POST" action="{{ route("user.index").'/'.$user->id }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="mx-2">
                        @include("users.form")
                        <div class="row form-group mt-5 mb-0">
                            <button type="submit" class="col-md-2 btn btn-outline-primary m-1">{{ __("control.save") }}</button>
                            <button type="button" onclick="window.location='{{$user->rule=='customer'?route('user.index'):route('supperAdmin')}}'" class="col-md-2 btn btn-outline-secondary m-1">{{ __("control.back") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <script>
        $('div select[name="country"]').on('change', function() {
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
                    country: $('div select[name="country"]').val()
                    , _token: '{{ csrf_token() }}'
                }
                //request success function with responce
                , success: function(data) {
                        //rate done
                        if (data['success'] == '200') {
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
                        $('#basicEdit').append('<form action="{{ route("login") }}" method="GET"></form>');
                        $('#basicEdit form').submit();
                    } else {
                        alert('Sorry,' + xhr['responseJSON']['message']);
                    }
                }
            });
        });
    </script>
</div>
@endsection
