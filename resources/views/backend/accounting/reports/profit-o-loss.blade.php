@extends('layouts.app')

@section('title')
    Profit/Loss
@endsection

@section('extra-styles')

@endsection

@section('content')
    <div class="card">
        <div class="row invoice-contact">

            <div class="col-md-8">
                <div class="invoice-box row">
                    <div class="col-sm-12">
                        <table class="table table-responsive invoice-table table-borderless">
                            <tbody>
                            <tr>
                                <td><img src="/assets/images/logo.png" class="m-b-10" width="82" height="52" alt=""></td>
                            </tr>
                            <tr>
                                <td>Connexxion Telecom</td>
                            </tr>
                            <tr>
                                <td>2A Iller Crescent Maitama, Abuja</td>
                            </tr>
                            <tr>
                                <td><a href="..\..\..\cdn-cgi\l\email-protection.htm#99fdfcf4f6d9fef4f8f0f5b7faf6f4" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[email&nbsp;protected]</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td>+234...</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="card-block">
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6>Account Period:</h6>
                    <h6 class="m-0"><strong class="label label-info">From:</strong> {{date('d F, Y', strtotime($from))}} <strong class="label label-danger">To:</strong> {{date('d F, Y', strtotime($to))}}</h6>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6>Balance Sheet</h6>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Date & Time</h6>
                    <h6 class="text-uppercase">{{date('d F, Y h:ia', strtotime(now()))}}
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <table id="complex-header" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="complex-header_info" style="width: 100%; margin:0px auto;">
                        <thead>
                        <tr role="row">
                            <th rowspan="2" class="sorting_asc text-center" tabindex="0" aria-controls="complex-header" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">S/No.</th>
                            <th rowspan="2" class="sorting_asc text-center" tabindex="0" aria-controls="complex-header" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 227px;">ACCOUNT CODE</th>
                            <th rowspan="2" class="sorting_asc text-center" tabindex="0" aria-controls="complex-header" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 227px;">ACCOUNT NAME</th>
                            <th rowspan="2" class="sorting_asc text-center" tabindex="0" aria-controls="complex-header" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 227px;">DR</th>
                            <th rowspan="2" class="sorting_asc text-center" tabindex="0" aria-controls="complex-header" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 227px;">CR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $a = 1;
                        @endphp
                        <tr role="row" class="odd">
                            <td class="sorting_1"  colspan="9"><strong style="font-size:16px; text-transform:uppercase;">Revenue</strong></td>
                        </tr>
                        @php
                            $aOPDrTotal = 0;
                            $aOPCrTotal = 0;
                            $aPDrTotal = 0;
                            $aPCrTotal = 0;
                            $aCPCrTotal = 0;
                            $aCPDrTotal = 0;
                            $rCb = 0;
                            $eCb = 0;
                        @endphp
                        @foreach($reports as $report)
                            @switch($report->account_type)
                                @case(4)
                                    <tr role="row" class="odd">
                                        <td class="text-center">{{$a++}}</td>
                                        <td class="sorting_1 text-center">{{$report->glcode ?? ''}}</td>
                                        <td class="text-center">{{$report->account_name ?? ''}}</td>
                                        <td class="text-center">{{(($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) > 0 ?  number_format((($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)),2) : 0}}
                                            <small style="display: none;">  {{ $aCPDrTotal +=  (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) > 0 ? (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) : 0  }}</small>
                                        </td>
                                        <td class="text-center">{{(($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) < 0 ? number_format((($bfCr + $report->sumCredit) - ($bfDr + $report->sumDebit)),2) : 0}}
                                            <small style="display: none;">  {{ $aCPCrTotal += (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) < 0 ? (($bfCr + $report->sumCredit) - ($bfDr + $report->sumDebit)) : 0 }}</small>
                                        </td>
                                    </tr>
                                @break
                            @endswitch
                        @endforeach

                        <tr role="row" class="odd">
                            <td class="sorting_1"  colspan="9">
                                <strong style="font-size:16px; text-transform:uppercase;">Expenses</strong>
                            </td>
                        </tr>
                        @foreach($reports as $report)
                            @switch($report->account_type)
                                @case(5)
                                <tr role="row" class="odd">
                                    <td class="text-center">{{$a++}}</td>
                                    <td class="sorting_1 text-center">{{$report->glcode ?? ''}}</td>
                                    <td class="text-center">{{$report->account_name ?? ''}}</td>
                                    <td class="text-center">{{(($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) > 0 ?  number_format((($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)),2) : 0}}
                                        <small style="display: none;">  {{ $aCPDrTotal +=  (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) > 0 ? (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) : 0  }}</small>
                                    </td>
                                    <td class="text-center">{{(($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) < 0 ? number_format((($bfCr + $report->sumCredit) - ($bfDr + $report->sumDebit)),2) : 0}}
                                        <small style="display: none;">  {{ $aCPCrTotal += (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) < 0 ? (($bfCr + $report->sumCredit) - ($bfDr + $report->sumDebit)) : 0 }}</small>
                                    </td>
                                </tr>
                                @break
                            @endswitch
                        @endforeach
                        <tr role="row" class="odd">
                            <td class="sorting_1"  colspan="9"><strong style="font-size:16px; text-transform:uppercase;">Equity</strong></td>
                        </tr>
                        @foreach($reports as $report)
                            @switch($report->account_type)
                                @case(3)
                                <tr role="row" class="odd">
                                    <td class="text-center">{{$a++}}</td>
                                    <td class="sorting_1 text-center">{{$report->glcode ?? ''}}</td>
                                    <td class="text-center">{{$report->account_name ?? ''}}</td>
                                    <td class="text-center">{{(($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) > 0 ?  number_format((($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)),2) : 0}}
                                        <small style="display: none;">  {{ $aCPDrTotal +=  (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) > 0 ? (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) : 0  }}</small>
                                    </td>
                                    <td class="text-center">{{(($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) < 0 ? number_format((($bfCr + $report->sumCredit) - ($bfDr + $report->sumDebit)),2) : 0}}
                                        <small style="display: none;">  {{ $aCPCrTotal += (($bfDr + $report->sumDebit) - ($bfCr + $report->sumCredit)) < 0 ? (($bfCr + $report->sumCredit) - ($bfDr + $report->sumDebit)) : 0 }}</small>
                                    </td>
                                </tr>
                                @break
                            @endswitch
                        @endforeach
                        <tr role="row" class="odd">
                            <td class="text-center">{{$a++}}</td>
                            <td class="sorting_1 text-center">301</td>
                            <td class="text-center">Retained Earning</td>
                            <small style="display: none;">  {{ $rCb +=  $revenue->sum('dr_amount') - $revenue->sum('cr_amount') > 0 ? ($revenue->sum('dr_amount') - $revenue->sum('cr_amount')) : ($revenue->sum('cr_amount') - $revenue->sum('dr_amount'))}}</small>
                            <small style="display: none;">  {{ $eCb +=  $expense->sum('dr_amount') - $expense->sum('cr_amount') }}</small>

                            <td class="text-center">{{ $rCb - $eCb < 0 ? number_format($rCb - $eCb,2) : ''}}
                            </td>
                            <td class="text-center">{{ $rCb - $eCb > 0 ? number_format($rCb - $eCb,2) : ''}}
                                <small style="display: none;">  {{ $aCPCrTotal +=  $rCb - $eCb }}</small>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right"><strong style="font-size:14px; text-transform:uppercase; text-align: right;">Total:</strong></td>
                            <td class="text-center"> {{number_format($aCPDrTotal,2)}}</td>
                            <td class="text-center"> {{number_format($aCPCrTotal,2)}}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
