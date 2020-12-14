@extends('layouts.app')

@section('title')
    Project Analytics
@endsection

@section('extra-styles')
@endsection

@section('content')
    @livewire('backend.project.project-analytics')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
@endsection
