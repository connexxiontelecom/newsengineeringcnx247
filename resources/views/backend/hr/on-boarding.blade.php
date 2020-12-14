@extends('layouts.app')

@section('title')
    onBoarding
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/bower_components/jquery.steps/css/jquery.steps.css">
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

    @livewire('backend.hr.on-boarding')
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')

@endsection
