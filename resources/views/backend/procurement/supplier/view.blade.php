@extends('layouts.app')

@section('title')
    Supplier - {{$supplier->company_name ?? ''}}
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
                <h5 class="sub-title">Supplier Profile</h5>

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
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25">
                                            <img src="/assets/images/avatars/thumbnails/avatar.png" class="img-radius img-100" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600">{{$supplier->first_name ?? ''}}</h6>
                                        <p>{{$supplier->position ?? ''}}</p>
                                        <i class="feather icon-edit m-t-10 f-16"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Company Information</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <h6 class="text-muted f-w-400"><a href="mailto:{{$supplier->company_email}}" class="__cf_email__" data-cfemail="1e747b70675e79737f7772307d7173">[{{$supplier->company_email}}]</a></h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Phone</p>
                                                <h6 class="text-muted f-w-400">{{$supplier->company_phone ?? ''}}</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Vendor Account</p>
                                                <h6 class="text-muted f-w-400">{{$account->account_name ?? ''}}</h6>
                                            </div>
                                        </div>
                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Contact Person</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Full Name</p>
                                                <h6 class="text-muted f-w-400">{{$supplier->first_name ?? ''}}</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Mobile No.</p>
                                                <h6 class="text-muted f-w-400">{{$supplier->mobile_no ?? ''}}</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email Address</p>
                                                <h6 class="text-muted f-w-400">{{$supplier->email_address ?? ''}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                           <div class="card-block">
                               <h5 class="sub-title">Reviews & Rating</h5>
                               @foreach($supplier->supplierReviews as $review)
                                    <div class="media">
                                        <a class="media-left" href="{{route('view-profile', $review->user->url)}}">
                                            <img class="img-30" src="/assets/images/avatars/thumbnails/{{$review->user->avatar ?? 'avatar.png'}}" alt="{{$review->first_name ?? ''}}">
                                        </a>
                                        <div class="media-body">
                                            <div class="col-xs-12">
                                                <a href="{{route('view-profile', $review->user->url)}}">
                                                    <h6 class="d-inline-block">
                                                        {{$review->user->first_name ?? ''}} {{$review->user->surname ?? ''}}
                                                    </h6>
                                                </a>
                                            </div>
                                            <div class="f-13 text-muted m-b-15">
                                                @for($i = 1; $i<= $review->rating; $i++)
                                                    <i class="icofont icofont-star text-primary"></i>
                                                @endfor
                                            </div>
                                            <p>{{$review->review ?? ''}} &nbsp; &nbsp; | <small>{{date(Auth::user()->dateFormat->format ?? 'd F,Y', strtotime($review->created_at))}} @ {{date('h:ia', strtotime($review->created_at))}}</small>
                                            </p>
                                        </div>
                                    </div>
                               @endforeach
                            </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Purchase Orders</h5>
                <a href="{{route('new-purchase-order', $supplier->slug)}}" class="btn btn-mini btn-primary float-right mb-4" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Purchase Order"><i class="ti-plus mr-2 "></i> Add New Purchase Order</a>
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
                            @foreach ($supplier->orderSupplier as $supply)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$supply->purchase_order_no}}</td>
                                    <td>-</td>
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
