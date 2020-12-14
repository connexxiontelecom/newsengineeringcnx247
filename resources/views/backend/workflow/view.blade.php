@extends('layouts.app')

@section('title')
    Request Details
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bower_components\datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css') }}">
@endsection

@section('content')
    @livewire('backend.workflow.view-workflow-task')
@endsection

@section('extra-scripts')
<script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/pages/data-table/extensions/responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
@endsection