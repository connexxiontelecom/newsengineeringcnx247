@extends('layouts.app')

@section('title')
    Workgroups
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\hover-effect\normalize.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\hover-effect\set2.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
    @livewire('backend.workgroup.index')
@endsection

@section('dialog-section')
@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>


@stack('workgroup-script')
@endsection
