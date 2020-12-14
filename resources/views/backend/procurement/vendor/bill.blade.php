@extends('layouts.app')

@section('title')
    Bill
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title mb-3">Vendor Bills</h5>
										<a href="{{route('new-vendor-bill')}}" class="btn mb-4 btn-primary btn-mini"><i class="ti-plus mr-2"></i>New Vendor Bill</a>
										@if (session()->has('success'))
												<div class="alert alert-success background-success" role="alert">
														{!! session()->get('success') !!}
												</div>
										@endif
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Vendor</th>
                                <th>Date Issued</th>
                                <th>Amount ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                <th>VAT Amount ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                <th>VAT Charge</th>
                                <th>Paid ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                <th>Balance ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                            @foreach($bills as $bill)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$bill->getVendor->company_name ?? ''}}</td>
                                    <td>{{date('d F, Y', strtotime($bill->bill_date))}}</td>
                                    <td>{{number_format($bill->bill_amount,2)}}</td>
                                    <td>{{number_format($bill->vat_amount,2)}}</td>
                                    <td>{{$bill->vat_charge}}%</td>
                                    <td>{{number_format($bill->paid_amount,2)}}</td>
                                    <td>{{number_format($bill->bill_amount - $bill->paid_amount,2)}}</td>
                                    <td>{{date('d F, Y', strtotime($bill->created_at))}}</td>
                                    <td>
                                        <a href="{{route('view-bill', $bill->slug)}}" class="btn btn-mini btn-info"><i class="ti-eye mr-2"></i>View</a>
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
