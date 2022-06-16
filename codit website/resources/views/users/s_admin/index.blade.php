@extends('layouts.admin')
@section('title',__('titles.home'))
@section('hotLink')
<li>
    <i class="fa fa-chevron-right"></i>
    <a class="nav-item px-1" href="{{route('supperAdmin')}}">{{ trans_choice("words.admin",3).' <\_' }}</a>
</li>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">

        @if(session()->has('msg'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Error!</strong> You can't delete this supper Admin or take his rule.
            </div>
        @endif

        <div class="card mb-5">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>{{ __('words.adminList').' <\_' }} <span class="text-muted">{{ '('.__('words.status').')' }}</span></div>
                    <div class="option">
                        <a href="{{ route('home.index') }}" class="fa fa-external-link py-1 px-2"> {{ __("control.back") }} </a>
                        <a href="#" data-for="1" class="delete_some fa fa-trash py-1 px-2"> {{ __("control.delete") }} </a>
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
                        <tr class="text-center">
                            <th><input type="checkbox" data-target='one' class="check_all form-check mb-1"></th>
                            <th>#</th>
                            <th class="w-25 text-center">{{ __("words.name")}}</th>
                            <th>{{ __("words.userName")}}</th>
                            <th class="w-25 text-center">{{ __("words.email") }}</th>
                            <th class="w-25 text-center">{{ __("words.conEmail") }}</th>
                            <th>{{ __("words.platform")}}</th>
                            <th class="w-25">{{ __("words.browser")}}</th>
                            <th>{{ __("words.status") }}</th>
                            <th>{{ __("words.action") }}</th>
                        </tr>
                    </thead>
                    <tbody class="one">
                        @foreach($users as $user)
                        <tr class="{{ $user->status?'':'text-danger' }}">
                            <td><input type="checkbox" data-for="{{ $user->id }}" class="form-check mt-2"></td>
                            <td scope="row">{{ $user->id }}</td>
                            <td><a href="{{ route('user.index').'/'.$user->id }}">{{ $user->name }}</a></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->profile['email'] }}</td>
                            <td>{{ $user->profile['platform'] }}</td>
                            <td>{{ $user->profile['browser'] }}</td>
                            <td>
                                @if($user->isActive())
                                <i class="fa fa-circle text-success"> On</i>
                                @else
                                <i class="fa fa-circle text-muted"> Off</i>
                                @endif
                            </td>
                            <td class="text-center">
                                <button data-for="{{ $user->id }}" class="user_edit btn btn-sm btn-outline-secondary m-1">{{ __("control.edit") }}</button>
                                <button data-for="{{ $user->id }}" class="user_delete btn btn-sm btn-outline-danger m-1">{{ __("control.delete") }}</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div></div>
                    <div>
                        <h5 class="d-inline">{{ __("control.total") }} :</h5>
                        <h6 class="d-inline">{{$allCount.trans_choice("control.row",$allCount)}}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{ __('words.adminList') }} <span class="text-muted">{{ '('.__('words.status').')' }}</span></div>
                        <div class="option">
                            <a href="{{ route('supperAdmin') }}" class="fa fa-external-link py-1 px-2"> {{ __("control.back") }} </a>
                            <a href="#" data-for="2" class="delete_some fa fa-trash py-1 px-2"> {{ __("control.delete") }} </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-responsive-lg">
                        <thead>
                            <tr class="text-center">
                            <th><input type="checkbox" data-target='two' class="check_all form-check mb-1"></th>
                            <th>#</th>
                            <th class="w-25 text-center">{{ __("words.name")}}</th>
                            <th>{{ __("words.userName")}}</th>
                            <th class="w-25 text-center">{{ __("words.email") }}</th>
                            <th class="w-25 text-center">{{ __("words.conEmail") }}</th>
                            <th>{{ __("words.platform")}}</th>
                            <th class="w-25">{{ __("words.browser")}}</th>
                            <th>{{ __("words.status") }}</th>
                            <th>{{ __("words.action") }}</th>
                        </tr>
                        </thead>
                        <tbody class="two">
                            @foreach($ausers as $auser)
                                <tr class="{{ $auser->status?'':'text-danger' }}">
                            <td><input type="checkbox" data-for="{{ $auser->id }}" class="form-check mt-2"></td>
                            <td scope="row">{{ $auser->id }}</td>
                            <td><a href="{{ route('user.index').'/'.$auser->id }}">{{ $auser->name }}</a></td>
                            <td>{{ $auser->username }}</td>
                            <td>{{ $auser->email }}</td>
                            <td>{{ $auser->profile['email'] }}</td>
                            <td>{{ $auser->profile['platform'] }}</td>
                            <td>{{ $auser->profile['browser'] }}</td>
                            <td>
                                @if($auser->isActive())
                                <i class="fa fa-circle text-success"> On</i>
                                @else
                                <i class="fa fa-circle text-muted"> Off</i>
                                @endif
                            </td>
                            <td class="text-center">
                                <button data-for="{{ $auser->id }}" class="user_edit btn btn-sm btn-outline-secondary m-1">{{ __("control.edit") }}</button>
                                <button data-for="{{ $auser->id }}" class="user_delete btn btn-sm btn-outline-danger m-1">{{ __("control.delete") }}</button>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>{{ $ausers->links() }}</div>
                    <div>
                        <h5 class="d-inline">{{ __("control.total") }} :</h5>
                        <h6 class="d-inline">{{$acount.trans_choice("control.row",$acount)}} {{$aallCount>$acount?' '.__("control.of").' '.$aallCount:'' }}</h6>
                    </div>
                </div>
            </div>
    </div>
</div>
<script>
    $(function() {
        "use strict";
        var forms = $('#action_form');
        $('.user_edit').on('click', function(e) {
            event.preventDefault();
            $(forms).prop('method', 'GET');
            $("#action_form input[name='_token']").remove();
            $(forms).prop('action', '{{ route("user.index") }}/' + $(this).attr("data-for") + "/edit");
            $(forms).submit();
        });

        $('.user_delete').on('click', function(e) {
            event.preventDefault();
            $(forms).prop('method', 'POST');
            $('<input type="hidden" name="_method" value="delete">').insertBefore("#action_form>input");
            $(forms).prop('action', '{{ route("user.index") }}/' + $(this).attr("data-for"));
            $(forms).submit();
        });

        $('.delete_some').on('click', function(e) {
            event.preventDefault();
            $("#action_form input[name='_token']").remove();
            ajaxLoading('{{ __("words.loading") }}');
            var idList = []
                , allChecked = []
                , all;
                if($(this).attr('data-for')==1)
                all = $('tbody.one input[type="checkbox"]');
                else
                all = $('tbody.two input[type="checkbox"]');

            //get all checkbox from tbody
            all.each(function() {
                if (this.checked) {
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
                }
                , url: '{{ route("provDestroySome") }}'
                , type: 'POST',
                // the type of data we expect back
                dataType: 'json',
                //with post must the data have _token input data
                data: {
                    idList: idList
                    , _token: '{{ csrf_token() }}'
                },
                //request success function with responce
                success: function(data) {
                    //console.log(data);
                    $(forms).prop('method', 'GET');
                    $(forms).prop('action', '{{ route("supperAdmin") }}');
                    $(forms).submit();
                    $("#loading").remove();
                },
                //request error function
                error: function(xhr, status) {
                    console.log(xhr);
                    alert('Sorry, there was ' + status + ' problem!');
                }
            });
        });
    });

</script>
</div>
@endsection
