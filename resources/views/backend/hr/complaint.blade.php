@extends('layouts.app')

@section('title')
    Complaints
@endsection

@section('extra-styles')

@endsection

@section('content')
    @livewire('backend.hr.complaints')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/js/cus/axios.min.js"></script>

@endsection