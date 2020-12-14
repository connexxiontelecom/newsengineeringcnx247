@extends('layouts.app')

@section('title')
    Journal Entries
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')


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
                                        <a href="{{route('new-journal-entry')}}" class="btn btn-primary btn-mini float-right mb-3">New Journal Entry</a>
                                        <h5 class="sub-title">Journal Vouchers</h5>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Account</th>
                                                    <th>Narration</th>
                                                    <th> DR Amount</th>
                                                    <th> CR Amount</th>
                                                    <th> Ref. No.</th>
                                                    <th> JV Date</th>
                                                    <th>Entry By</th>
                                                    <th>Entry Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach($entries as $entry)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td>{{$entry->account_name ?? ''}} - ({{$entry->glcode}})</td>
                                                        <td>{{$entry->narration ?? ''}}</td>
                                                        <td>N{{number_format($entry->dr_amount,2) ?? ''}}</td>
                                                        <td>N{{number_format($entry->cr_amount,2) ?? ''}}</td>
                                                        <td>{{$entry->ref_no ?? ''}}</td>
                                                        <td>{{!is_null($entry->jv_date ) ? date('d F, Y', strtotime($entry->jv_date )) : '-'}}</td>
                                                        <td>{{$entry->first_name ?? ''}} {{$entry->surname ?? ''}}</td>
                                                        <td>{{!is_null($entry->entry_date ) ? date('d F, Y', strtotime($entry->entry_date )) : '-'}}</td>
                                                        <td>
                                                            <a href="{{route('view-journal-entry', $entry->slug)}}" class="btn btn-mini btn-info">Learn more</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Account</th>
                                                    <th>Narration</th>
                                                    <th> DR Amount</th>
                                                    <th> CR Amount</th>
                                                    <th> Ref. No.</th>
                                                    <th> JV Date</th>
                                                    <th>Entry By</th>
                                                    <th>Entry Date</th>
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

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>


@endsection
