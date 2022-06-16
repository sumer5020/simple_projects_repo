@extends('errors::minimal')

@section('title', __('titles.serviceUnavailable'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'titles.serviceUnavailable'))
