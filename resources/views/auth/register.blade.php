@extends('layouts.auth-layout')

@section('title')
    Signup
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('main-content')

@livewire('frontend.createsite')

@endsection
