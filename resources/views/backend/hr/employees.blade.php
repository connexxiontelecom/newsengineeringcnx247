@extends('layouts.app')

@section('title')
    Employees
@endsection

@section('extra-styles')
{{-- <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css"> --}}
@endsection

@section('content')
    @livewire('backend.hr.employees')
@endsection

@section('extra-scripts')

@endsection
