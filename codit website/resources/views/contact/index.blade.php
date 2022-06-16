@extends('layouts.app')
@section('title',__('titles.contact'))
@section('content')
<section id="end" class="text-light min-100vh" style="background-color: #343a40;">
    <div class="row p-5 {{app()->getLocale()=='en'?'':'text-right'}}">
        <div class="col-md-12">
        </div>
    </div>
</section>
@endsection
