@extends('layouts.app')

@section('title')
    Appreciation
@endsection

@section('extra-styles')
<link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\switchery\css\switchery.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\bootstrap-tagsinput\css\bootstrap-tagsinput.css">
@endsection

@section('content')
    @livewire('backend.hr.appreciation')
@endsection

@section('extra-scripts')
<!-- Select 2 js -->
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js">
</script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="/assets/js/cus/axios.min.js"></script>
<script type="text/javascript" src="\assets\bower_components\switchery\js\switchery.min.js"></script>

<script type="text/javascript" src="\assets\pages\advance-elements\swithces.js"></script>
<script type="text/javascript" src="\assets\bower_components\bootstrap-tagsinput\js\bootstrap-tagsinput.js"></script>
@stack('appreciation-script')
@endsection