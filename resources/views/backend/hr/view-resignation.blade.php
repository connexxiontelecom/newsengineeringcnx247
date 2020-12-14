@extends('layouts.app')

@section('title')
    Resignation
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
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

    @livewire('backend.hr.view-resignation')
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\message\message.js"></script>
@stack('print-resign-script')
@endsection
