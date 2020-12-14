@extends('layouts.app')

@section('title')
    Suppliers
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card widget-card-1">
                    <div class="card-block-small">
                        <i class="icofont icofont-users bg-c-blue card1-icon"></i>
                        <span class="text-c-blue f-w-600">Suppliers</span>
                        <h6>{{number_format(count($suppliers))}}</h6>
                        <div>
                            <span class="f-left m-t-10 text-muted">
                                <i class="text-c-blue f-16 ti-calendar m-r-10"></i>Overall
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card widget-card-1">
                    <div class="card-block-small">
                        <i class="icofont icofont-money-bag bg-c-pink card1-icon"></i>
                        <span class="text-c-pink f-w-600">Purchase Orders</span>
                        <h6>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($purchase_orders->sum('total'))}}</h6>
                        <div>
                            <span class="f-left m-t-10 text-muted">
                                <i class="text-c-pink f-16 ti-wallet m-r-10"></i>Overall
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card widget-card-1">
                    <div class="card-block-small">
                        <i class="icofont icofont-tasks bg-c-green card1-icon"></i>
                        <span class="text-c-green f-w-600">PO Request(s)</span>
                        <h6>{{number_format($purchase_orders->count())}}</h6>
                        <div>
                            <span class="f-left m-t-10 text-muted">
                                <i class="text-c-green f-16 ti-check m-r-10"></i>Overall
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card widget-card-1">
                    <div class="card-block-small">
                        <i class="icofont icofont-ui-close bg-c-yellow card1-icon"></i>
                        <span class="text-c-yellow f-w-600">Declined</span>
                        <h6>{{number_format($purchase_orders->where('status', 'declined')->count())}}</h6>
                        <div>
                            <span class="f-left m-t-10 text-muted">
                                <i class="text-c-yellow f-16 ti-close m-r-10"></i>Overall
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                    <h5 class="sub-title">Suppliers</h5>
                                    <a href="{{route('new-supplier')}}" class="btn btn-primary btn-mini waves-effect waves-light float-right mb-4"><i class="ti-plus mr-2"></i>Add New Supplier</a>
                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Industry</th>
                                            <th>Contact Person</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serial = 1;
                                            @endphp
                                            @foreach ($suppliers as $supplier)
                                                <tr>
                                                    <td>{{$serial++}}</td>
                                                    <td>{{$supplier->company_name}}</td>
                                                    <td>{{$supplier->company_email}}</td>
                                                    <td>{{$supplier->company_phone}}</td>
                                                    <td>{{$supplier->supplierIndustry->industry}}</td>
                                                    <td>{{$supplier->first_name}}</td>
                                                    <td>{{$supplier->email_address}}</td>
                                                    <td>{{$supplier->mobile_no}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{route('view-supplier', $supplier->slug)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Supplier Account"><i class="ti-eye mr-2 text-info"></i></a>
                                                            <a href="{{route('new-purchase-order', $supplier->slug)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Purchase Order"><i class="ti-plus mr-2 text-primary"></i></a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Industry</th>
                                            <th>Contact Person</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
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
