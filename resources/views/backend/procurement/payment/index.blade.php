@extends('layouts.app')

@section('title')
    Payments
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.procurement.supplier.common._procurement-slab')
    </div>
</div>

    <div>
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

                            @if($errors->any())

                                <div class="alert alert-success background-success mt-3">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {{$errors->first()}}
                                </div>

                            @endif

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h5 class="sub-title">Payments</h5>
                                        <a href="{{route('new-payment')}}" class="btn btn-primary btn-mini float-right mb-3">New Payment</a>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Bank</th>
                                                    <th>Date</th>
                                                    <th> Amount ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                                    <th> Ref. No.</th>
                                                    <th> Memo</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach($payments as $payment)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td>{{$payment->bank_name}}</td>
                                                        <td>{{!is_null($payment->date_inputed ) ? date('d F, Y', strtotime($payment->date_inputed )) : '-'}}</td>
                                                        <td>{{number_format($payment->amount,2) ?? ''}}</td>
                                                        <td>{{$payment->ref_no ?? ''}}</td>
                                                        <td>{{$payment->memo ?? ''}}</td>
                                                        <td>
                                                            <a href="{{route('payment-detail', $payment->slug)}}" class="btn btn-mini btn-info">Learn more</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Bank</th>
                                                    <th>Date</th>
                                                    <th> Amount ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                                    <th> Ref. No.</th>
                                                    <th> Memo</th>
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
    </div>

@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
    <script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

    <script src="\assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="\assets\pages\data-table\js\jszip.min.js"></script>
    <script src="\assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="\assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
    <script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>


@endsection
