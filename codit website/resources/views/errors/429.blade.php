@extends('errors::minimal')

@section('title', __('titles.tooManyRequests'))
@section('code', '429')
@section('message', __('titles.tooManyRequests'))
