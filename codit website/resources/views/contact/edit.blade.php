@extends('layouts.app')
@section('title',__('titles.contact'))
@section('hotLink')
<li>
     <i class="fa fa-chevron-right"></i>
     <a class="nav-item px-1" href="{{route('chat_message.index')}}">{{ trans_choice("words.chat",3) }}</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">contact</div>

                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
