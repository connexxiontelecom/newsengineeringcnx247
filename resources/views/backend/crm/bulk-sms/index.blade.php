@extends('layouts.app')

@section('title')
    Bulk SMS
@endsection

@section('extra-styles')

<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
<style>
.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('livewire.backend.crm.common._slab-menu')
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h4 class="sub-title">Bulk SMS</h4>
                <div class="btn-group d-flex justify-content-end">
                    <a class="btn btn-mini btn-primary" href="{{route('compose-sms')}}"><i class="ti-plus"></i> Compose Message</a>
                    <a href="{{route('new-phone-group')}}" class="btn btn-mini btn-danger"><i class="ti-email"></i> Create New Phone Group</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-30px;">
    <div class="card-block email-card">
        <div class="row">
            <div class="col-lg-3 col-xl-3 col-sm-4 col-md-4">
                @include('backend.crm.bulk-sms.common._navigation')
            </div>
            <div class="col-lg-9 col-xl-9 col-sm-8 col-md-8">

                <div class="table-responsive mt-5">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phone Numbers</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @if (count($sms) > 0)
                                @foreach ($sms as $message)
                                    <tr class="unread">
                                        <td>{{$i++}}</td>
                                        <td><a href="javascript:void(0);" class="email-name">{{$message->mobile_no}}</a></td>
                                        <td>{{ strlen($message->message) > 81 ? substr($message->message, 0,81).'...' : $message->message ?? ''}}</td>
                                        <td class="email-attch">
                                            @if ($message->status == 0)
                                            <label for="" class="label label-warning text-white">In-progress</label>
                                            @else
                                                <label for="" class="label label-success">Sent</label>
                                            @endif
                                        </td>
                                        <td class="email-time">{{date('d F, Y', strtotime($message->created_at))}} @ <small>{{date('h:i a', strtotime($message->created_at))}}</small></td>
                                    </tr>
                                @endforeach
                            @else
                                <p class="text-center">No records found</p>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Phone Numbers</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Date</th>
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
