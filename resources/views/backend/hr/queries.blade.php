@extends('layouts.app')

@section('title')
    Queries
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

<div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.hr.common._slab-menu')
                </div>
            </div>
        </div>
   </div>

    <div class="card p-3" style="margin-top:-20px;">
        <div class="card-block ">
            <div class="row">
                <div class="col-sm-12">
                        <h5 class="sub-title">Queries</h5>
                        <span>All queries issued to employees</span>
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Issued by</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @if (count($queries) > 0)
                                    @foreach ($queries as $query)
                                        <tr>
                                            <td>{{$serial++}}</td>
                                            <td><a href="{{route('view-profile', $query->queriedEmployee->url)}}"> <img src="/assets/images/avatars/thumbnails/{{$query->queriedEmployee->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$query->queriedEmployee->first_name ?? ''}} {{$query->queriedEmployee->surname ?? ''}}"> {{$query->queriedEmployee->first_name ?? ''}} {{$query->queriedEmployee->surname ?? ''}}</a></td>
                                            <td><a href="{{route('view-query', $query->slug)}}">{{$query->subject}}</a> </td>
                                            <td>
                                                @if ($query->status == 1)
                                                    <label for="" class="label label-success">Open</label>
                                                @else
                                                    <label for="" class="label label-danger">Closed</label>

                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('view-profile', $query->issuedBy->url)}}"> <img src="/assets/images/avatars/thumbnails/{{$query->issuedBy->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$query->issuedBy->first_name ?? ''}} {{$query->issuedBy->surname ?? ''}}"> {{$query->issuedBy->first_name ?? ''}} {{$query->issuedBy->surname ?? ''}}</a>
                                            </td>
                                            <td>
                                                @if ($query->query_type == 0)
                                                    <label for="" class="label label-warning">Warning</label>
                                                @else
                                                    <label for="" class="label label-danger">Query</label>
                                                @endif
                                            </td>
                                            <td><label for="" class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($query->created_at))}}</label></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">There're no queries.</td>
                                    </tr>
                                @endif

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Issued by</th>
                                <th>Type</th>
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
@endsection
