@extends('layouts.app')

@section('title')
    Workflow Statistics
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-diamond bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Membership</span>
                <h4>{{number_format($requests)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-yellow f-16 ti-calendar m-r-10"></i>Expiring this month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-diamond bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Membership</span>
                <h4>number_format($expired)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-pink f-16 ti-calendar m-r-10"></i>Expired
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-diamond bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Membership</span>
                <h4>3</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-green f-16 ti-calendar m-r-10"></i>Renewal
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-diamond bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Membership</span>
                <h4>2</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-blue f-16 ti-calendar m-r-10"></i>Renewals this week
                    </span>
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
                                <div class="card-header">
                                    <h5>Memberships</h5>
                                    <span>A run-down of all tenant subscription.</span>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Company Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Plan</th>
                                                <th>Days</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $serial = 1;
                                                @endphp

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Company Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Plan</th>
                                                <th>Days</th>
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
