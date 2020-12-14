@extends('layouts.app')

@section('title')
    Purchase Orders
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
			<nav class="navbar navbar-light bg-faded m-b-30 p-10 d-flex justify-content-end">

				<div class="nav-item nav-grid">
						<a href="{{route('create-purchase-order')}}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="ti-plus mr-2"></i>Add New Purchase Order</a>
				</div>
		</nav>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Purchase Orders</h5>
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>PO Number</th>
                            <th>Requested By</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach ($orders as $supply)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$supply->purchase_order_no}}</td>
                                    <td>
                                        <a href="{{route('view-profile', $supply->orderedBy->url)}}">
                                            <img src="/assets/images/avatars/thumbnails/{{$supply->orderedBy->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$supply->orderedBy->first_name ?? ''}} {{$supply->orderedBy->surname ?? ''}}"> {{$supply->orderedBy->first_name ?? ''}} {{$supply->orderedBy->surname ?? ''}}</td>
                                        </a>
                                    <td>
                                        {{Auth::user()->tenant->currency->symbol}}{{number_format($supply->total,2)}}
                                    </td>
                                    <td>
                                        @if ($supply->status == 'in-progress')
                                            <label for="" class="label label-warning">{{$supply->status}}</label>
                                        @elseif($supply->status == 'approved')
                                            <label for="" class="label label-success">{{$supply->status}}</label>
                                        @elseif($supply->status == 'declined')
                                            <label for="" class="label label-danger">{{$supply->status}}</label>

                                        @endif

                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('view-purchase-order', $supply->slug)}}" class="btn btn-mini btn-info"> <i class="ti-eye mr-2"></i> View</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>PO Number</th>
                            <th>Requested By</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
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
