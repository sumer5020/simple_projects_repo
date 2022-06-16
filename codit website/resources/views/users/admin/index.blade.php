@extends('layouts.admin')
@section('title',__('titles.home'))
@section('hotLink')
<li>
    <i class="fa fa-chevron-right"></i>
    <a class="nav-item px-1" href="{{route('admin')}}">{{ trans_choice("words.admin",3) }}</a>
</li>
@endsection
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div>{{ __('words.adminList') }} <span class="text-muted">{{ '('.__('words.status').')' }}</span></div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-responsive-lg">
                        <thead>
                            <tr class="text-center">
                            <th>#</th>
                            <th class="w-25 text-center">{{ __("words.name")}}</th>
                            <th>{{ __("words.userName")}}</th>
                            <th class="w-25 text-center">{{ __("words.email") }}</th>
                            <th class="w-25 text-center">{{ __("words.conEmail") }}</th>
                            <th>{{ __("words.platform")}}</th>
                            <th class="w-25">{{ __("words.browser")}}</th>
                            <th>{{ __("words.status") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="{{ $user->status?'':'text-danger' }}">
                                <td scope="row">{{ $user->id }}</td>
                                <td><a href="#">{{ $user->name }}</a></td>
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
</div>
@endsection
