@extends('layouts.app')

@section('title')
    Phone Group
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
<style>
/* The heart of the matter */

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
                <h4 class="sub-title">Phone Groups</h4>
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
                <div class="card-block ">
                    <a href="{{route('new-phone-group')}}" class="btn btn-mini btn-primary float-right mb-3">Create New Phone Group</a>
                    <h5 class="sub-title">Phone Groups</h5>
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Phone Group Name</th>
                                <th>Phone Numbers</th>
                                <th>Added By</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>
                                            <a href="{{route('show-phone-group', $group->slug)}}">{{$group->phone_group_name ?? ''}}</a>
                                        </td>
                                        <td>
                                            {{strlen($group->phone_numbers) > 25 ? substr($group->phone_numbers,0,22).'...' : '-'}}
                                        </td>
                                        <td>
                                            <label for="" class="label label-info">{{$group->addedBy->first_name ?? '-'}} {{$group->addedBy->surname ?? ''}}</label>
                                        </td>
                                        <td>
                                            {{count(preg_split("/,\s*/",$group->phone_numbers))}}
                                        </td>
                                        <td>
                                            {{date('d F, Y', strtotime($group->created_at))}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Phone Group Name</th>
                                <th>Phone Numbers</th>
                                <th>Added By</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            </tfoot>
                        </table>
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
