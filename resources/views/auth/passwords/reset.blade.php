@extends('layouts.frontend-layout')

@section('title')
    Reset Password
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')

    @livewire('frontend.reset-password')

@endsection
