@extends('layouts.app')

@section('title')
    Ticket Details
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/pages/message/message.css">
@endsection

@section('content')
    @livewire('backend.crm.support.view-ticket')
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
@endsection
