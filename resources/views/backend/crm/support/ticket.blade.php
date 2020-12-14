@extends('layouts.app')

@section('title')
    Ticket
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="/assets/pages/j-pro/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/pages/j-pro/css/j-pro-modern.css">
@endsection

@section('content')
    @livewire('backend.crm.support.ticket')
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
@endsection
