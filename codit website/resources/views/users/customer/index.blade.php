@extends('layouts.admin')
@section('title',__('titles.home'))
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{ __('words.userList') }} <span class="text-muted">{{ '('.__('words.status').')' }}</span></div>
                        <div class="option">
                            <a href="{{ route('home.index') }}" class="fa fa-external-link py-1 px-2"> {{ __("control.back") }} </a>
                            <a href="#" id="delete_some" class="fa fa-trash py-1 px-2"> {{ __("control.delete") }} </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="display: none;">
                        <form id="action_form" action="" method="">
                            @csrf
                        </form>
                    </div>
                    <table class="table table-bordered table-striped table-responsive-lg">
                        <thead>
                            <tr class="text-center">
                            <th><input type="checkbox" id='check_all' class="form-check mb-1"></th>
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
                        <tbody>
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
                        <div>{{ $users->links() }}</div>
                        <div>
                            <h5 class="d-inline">{{ __("control.total") }} :</h5>
                            <h6 class="d-inline">{{$count.trans_choice("control.row",$count)}} {{$allCount>$count?' '.__("control.of").' '.$allCount:'' }}</h6>
                        </div>
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
                 url: '{{ route("customerDestroySome") }}',
                 type: 'POST',
                 // the type of data we expect back
                 dataType: 'json',
                 //with post must the data have _token input data
                 data:{idList:idList,_token:'{{ csrf_token() }}'},
                 //request success function with responce
                    success: function(data) {
                      //console.log(data);
                    $(forms).prop('method', 'GET');
                        $(forms).prop('action', '{{ route("user.index") }}');
                        $(forms).submit();
                    $("#loading").remove();
                },
                //request error function
                error: function(xhr, status) {
                    alert('Sorry, there was '+status+' problem!');
                }
            });
        });
    });
</script>
</div>
@endsection

