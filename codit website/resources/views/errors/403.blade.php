@extends('errors::minimal')

@section('title', __('titles.forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'titles.forbidden'))
