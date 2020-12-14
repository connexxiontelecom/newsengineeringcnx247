@extends('layouts.app')

@section('title')
    All Logs
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
                <h5 class="mb-2 sub-title">Log</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-warning background-warning mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Driver Name</th>
                                <th>Check-in</th>
                                <th>Destination</th>
                                <th>Check-out</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$log->driver->first_name ?? ''}} {{$log->driver->surname ?? ''}}</td>
                                        <td>
                                            <label for="" class="label label-info">{{!is_null($log->check_in) ? date('d F, Y h:ia', strtotime($log->check_in)) : '-' }}</label>
                                        </td>
                                        <td>
                                            {{$log->destination ?? '-'}}
                                        </td>
                                        <td>
                                            <label for="" class="label label-danger">{{!is_null($log->check_out) ? date('d F, Y h:ia', strtotime($log->check_out)) : '-' }}</label>
                                        </td>
                                        <td>
                                            {{ date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($log->created_at))}}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="javascript:void(0);" title="Log Detail" data-toggle="modal" data-driver="{{$log->driver->first_name ?? ''}} {{$log->driver->surname ?? ''}}" data-destination="{{$log->destination ?? ''}}" data-check-in="{{!is_null($log->check_in) ? date('d F, Y', strtotime($log->check_in)) : '-' }}" data-check-out="{{!is_null($log->check_out) ? date('d F, Y', strtotime($log->check_out)) : '-' }}" data-comment="{{$log->comment}}" data-target="#logDetail" class="mr-2 log-handle"> Learn more </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Driver Name</th>
                                    <th>Check-in</th>
                                    <th>Destination</th>
                                    <th>Check-out</th>
                                    <th>Date</th>
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

@section('dialog-section')
<div class="modal fade" id="logDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h6 class="modal-title text-uppercase">Log Details</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p><strong for="">Driver Name:</strong> <span id="driverName"></span></p>
                </div>
                <div class="form-group">
                    <p><strong for="">Destination:</strong> <span id="destination"></span></p>
                </div>
                <div class="form-group">
                    <p><strong for="">Check-in:</strong> <span id="check-in"></span></p>
                </div>
                <div class="form-group">
                    <p><strong for="">Check-out:</strong> <span id="check-out"></span></p>
                </div>
                <div class="form-group">
                    <p><strong for="">Comment:</strong> <span id="comment"></span></p>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
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
<script>
    $(document).ready(function(){
        $(document).on('click', '.log-handle', function(e){
            e.preventDefault();
            var driver = $(this).data('driver');
            var comment = $(this).data('comment');
            var destination = $(this).data('destination');
            var checkIn = $(this).data('check-in');
            var checkOut = $(this).data('check-out');
            $('#comment').text(comment);
            $('#driverName').text(driver);
            $('#destination').text(destination);
            $('#check-in').text(checkIn);
            $('#check-out').text(checkOut);
        });
    });
</script>
@endsection
