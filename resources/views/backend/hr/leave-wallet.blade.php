@extends('layouts.app')

@section('title')
    Leave Wallet
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\j-pro\css\demo.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\j-pro\css\font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\j-pro\css\j-forms.css">
@endsection

@section('content')
    @livewire('backend.hr.leave-wallet')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\j-pro\js\jquery.ui.min.js"></script>
<script type="text/javascript" src="\assets\pages\j-pro\js\jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="\assets\pages\j-pro\js\jquery-cloneya.min.js"></script>
@endsection