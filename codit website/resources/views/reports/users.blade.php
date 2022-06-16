@extends('layouts.admin')
@section('title',__('titles.user'))
@section('hotLink')
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 report">

        <div class="card mb-4">
            <div class="card-header">{{ App()->getLocale()=='en'?(trans_choice('words.user',3).' '.trans_choice('words.report',1)):(trans_choice('words.report',1).' '.trans_choice('words.user',3)) }}</div>
            <div class="card-body">
                <table class="table table-bordered table-inverse table-striped table-responsive">
                    <thead class="thead-inverse">
                        <tr class="text-center">
                            <th class="w-50">{{ __("words.reportName")}}</th>
                            <th class="w-50 text-center">{{ __("words.fillter")}}</th>
                            <th class="w-25 text-center" style="min-width:100px">{{ __("words.action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">{{ __('ch_rep.UserBasicAndProfileInfo') }}</td>
                            <td>
                                <div class="input-group f_group">
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" checked data-filter="0" name="fillter"> {{ __('control.all') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="1" name="fillter"> {{ __('control.active') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="2" name="fillter"> {{ __('control.unActive') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="3" name="fillter"> {{ trans_choice('words.admin',3) }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('userExport','0') }}" data-id="export_ex" class="fa fa-file-excel-o"></a>
                                <a href="#" class="fa fa-file-pdf-o"></a>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">{{ App()->getLocale()=='en'?(trans_choice('words.offer',3).' '.trans_choice('words.report',1)):(trans_choice('words.report',1).' '.trans_choice('words.offer',3)) }}</div>
            <div class="card-body">
                <table class="table table-bordered table-inverse table-striped table-responsive">
                    <thead class="thead-inverse">
                        <tr class="text-center">
                            <th class="w-50">{{ __("words.reportName")}}</th>
                            <th class="w-50 text-center">{{ __("words.fillter")}}</th>
                            <th class="w-25 text-center" style="min-width:100px">{{ __("words.action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">{{ __('ch_rep.userOfferRequestsRep') }}</td>
                            <td>
                                <div class="input-group f_group">
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" checked data-filter="0" name="fillter2"> {{ __('control.all') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="1" name="fillter2"> {{ __('control.complete') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="2" name="fillter2"> {{ __('control.unComplete') }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('offerExport','0') }}" data-id="export_ex" class="fa fa-file-excel-o"></a>
                                <a href="#" class="fa fa-file-pdf-o"></a>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">{{ __('ch_rep.offerRep') }}</td>
                            <td>
                                <div class="input-group f_group">
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" checked data-filter="3" name="fillter3"> {{ __('control.all') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="4" name="fillter3"> {{ __('control.active') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="5" name="fillter3"> {{ __('control.unActive') }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('offerExport','3') }}" data-id="export_ex" class="fa fa-file-excel-o"></a>
                                <a href="#" class="fa fa-file-pdf-o"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">{{ App()->getLocale()=='en'?(__('words.chatbot').' '.trans_choice('words.report',1)):(trans_choice('words.report',1).' '.__('words.chatbot')) }}</div>
            <div class="card-body">
                <table class="table table-bordered table-inverse table-striped table-responsive">
                    <thead class="thead-inverse">
                        <tr class="text-center">
                            <th class="w-50">{{ __("words.reportName")}}</th>
                            <th class="w-50 text-center">{{ __("words.fillter")}}</th>
                            <th class="w-25 text-center" style="min-width:100px">{{ __("words.action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">{{ __('ch_rep.chatBotAutoAnswering') }}</td>
                            <td>
                                <div class="input-group f_group">
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" checked data-filter="0" name="fillter4"> {{ __('control.all') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="1" name="fillter4"> {{ __('control.fire') }}
                                    </span>
                                    <span class="input-group-addon mx-1">
                                        <input type="radio" data-filter="2" name="fillter4"> {{ __('control.whiting') }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('chatBotExport','0') }}" data-id="export_ex" class="fa fa-file-excel-o"></a>
                                <a href="#" class="fa fa-file-pdf-o"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
