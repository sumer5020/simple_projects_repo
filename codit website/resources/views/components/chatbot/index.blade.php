@extends('layouts.admin')
@section('title',__('titles.chat'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('chat.index')}}">{{ __("words.chatbot") }}</a>
</li>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>{{ __('words.chatbot') }}</div>
                    <div class="option">
                        <a href="{{ route("chat.create") }}" class="fa fa-plus py-1 px-2"> {{ __("control.add") }} </a>
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
                <table class="table table-bordered table-hover table-inverse table-striped table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="text-center"><input type="checkbox" id="check_all" class="form-check mb-1"></th>
                            <th class="text-center">#</th>
                            <th class="text-center">{{ __("words.question")}} En</th>
                            <th class="text-center">{{ __("words.question")}} Ar</th>
                            <th class="w-50 text-center">{{ __("words.answer") }} En</th>
                            <th class="w-50 text-center">{{ __("words.answer") }} Ar</th>
                            <th class="">{{ __("words.action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chats as $chat)
                        <tr class="{{ !$chat->status?'text-danger':'' }}">
                            <td><input type="checkbox" data-for="{{ $chat->id }}" class="form-check mt-2"></td>
                            <td>{{ $chat->id }}</td>
                            <td>{{ $chat->q }}</td>
                            <td>{{ $chat->q_ar }}</td>
                            <td>{{ $chat->answer }}</td>
                            <td>{{ $chat->answer_ar }}</td>
                            <td class="text-center">
                                <button data-for="{{ $chat->id }}" class="chat_edit btn btn-sm btn-outline-secondary m-1">{{ __("control.edit") }}</button>
                                <button data-for="{{ $chat->id }}" class="chat_delete btn btn-sm btn-outline-danger m-1">{{ __("control.delete") }}</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>{{ $chats->links() }}</div>
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
        $('.chat_edit').on('click', function(e) {
            event.preventDefault();
            $(forms).prop('method', 'GET');
            $("#action_form input[name='_token']").remove();
            $(forms).prop('action', '{{ route("chat.index") }}/' + $(this).attr("data-for") + "/edit");
            $(forms).submit();
        });
        $('.chat_delete').on('click', function(e) {
            event.preventDefault();
            $(forms).prop('method', 'POST');
            $('<input type="hidden" name="_method" value="delete">').insertBefore("#action_form>input");
            $(forms).prop('action', '{{ route("chat.index") }}/' + $(this).attr("data-for"));
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
                 url: '{{ route("chatDestroySome") }}',
                 type: 'POST',
                 // the type of data we expect back
                 dataType: 'json',
                 //with post must the data have _token input data
                 data:{idList:idList,_token:'{{ csrf_token() }}'},
                 //request success function with responce
                  success: function(data) {
                      //console.log(data);
                    $(forms).prop('method', 'GET');
                    $(forms).prop('action', '{{ route("chat.index") }}');
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
