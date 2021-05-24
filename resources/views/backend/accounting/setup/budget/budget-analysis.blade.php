@extends('layouts.app')

@section('title')
    Budget Performance Analysis
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <h5 class="sub-title">Budget Performance Analysis</h5>
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Budget Profile</th>
                                <th>Budget Title</th>
                                <th>Account</th>
                                <th>Budgeted Amount</th>
                                <th>Amount Used</th>
                                <th>Balance</th>
                                <th>% Utilized</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $serial = 1;
                            @endphp
															@foreach($budgets as $budget)
																<tr>
																	<td>{{$serial++}}</td>
																	<td>{{$budget->title ?? ''}}</td>
																	<td>{{$budget->budget_title ?? ''}}</td>
																	<td>{{$budget->glcode ?? ''}} - {{$budget->account_name ?? ''}}</td>
																	<td class="text-right">{{ number_format($budget->total ?? 0,2) }}</td>
																	<td class="text-right">{{ number_format($budget->budget_spent ?? 0,2) }}</td>
																	<td class="text-right">{{ number_format(($budget->total - $budget->budget_spent),2) }}</td>
																	<td>
																		{{round($budget->budget_spent/$budget->total*100).'%' }}
																	</td>
																</tr>
															@endforeach
                            </tbody>
                            <tfoot>
                            <tr>
															<th>#</th>
															<th>Budget Profile</th>
															<th>Budget Title</th>
															<th>Account</th>
															<th>Budgeted Amount</th>
															<th>Amount Used</th>
															<th>Balance</th>
															<th>% Utilized</th>
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
    <script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>

@endsection
