@extends('layouts.app')

@section('title')
    Receipt Posting
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="card-header">
                        @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="sub-title">Receipt Posting</h5>
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Date</th>
                                                <th> Amount ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                                <th> Payment Type</th>
                                                <th> Ref. No.</th>
                                                <th>Issued By</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $serial = 1;
                                            @endphp
                                            @foreach($receipts as $receipt)
                                                <tr>
                                                    <td>{{$serial++}}</td>
                                                    <td>{{$receipt->client->first_name ?? ''}} {{$receipt->client->surname ?? ''}}</td>
                                                    <td>{{date('d F, Y', strtotime($receipt->issue_date))}}</td>
                                                    <td>{{number_format($receipt->amount,2)}}</td>
                                                    <td>
                                                        @switch($receipt->payment_type)
                                                            @case(1)
                                                            Cash
                                                            @break
                                                            @case(2)
                                                            Bank Transfer
                                                            @break
                                                            @case(3)
                                                            Cheque
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{$receipt->ref_no ?? ''}}</td>
                                                    <td>{{$receipt->converter->first_name ?? ''}} {{$receipt->converter->surname ?? ''}}</td>
                                                    <td>
                                                        <a href="{{route('receipt-posting-detail', $receipt->slug)}}" class="btn btn-primary btn-mini">Learn more</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Date</th>
                                                <th> Amount ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                                <th> Payment Type</th>
                                                <th> Ref. No.</th>
                                                <th>Issued By</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

<script src="\assets\pages\data-table\js\data-table-custom.js"></script>

@endsection
