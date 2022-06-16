@extends('layouts.admin')
@section('title',__('titles.home'))
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-responsive-lg">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('words.name') }}</th>
                                <th>{{ __('words.userName') }}</th>
                                <th>{{ __('words.email') }}</th>
                                <th>{{ __('words.conEmail') }}</th>
                                <th>{{ __('words.browser') }}</th>
                                <th>{{ __('words.platform') }}</th>
                                <th>{{ __('words.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td scope="row">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->profile['email'] }}</td>
                                <td>{{ $user->profile['browser'] }}</td>
                                <td>{{ $user->profile['platform'] }}</td>
                                <td>
                                    @if($user->isActive())
                                    <i class="fa fa-circle text-success"> Online</i>
                                    @else
                                    <i class="fa fa-circle text-muted"> Offline</i>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
