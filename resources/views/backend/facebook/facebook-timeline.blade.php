@extends('layouts.app')

@section('title')
    {{Auth::user()->tenant->company_name}}'s Facebook Account
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\social-timeline\timeline.css">
@endsection

@section('content')
    @livewire('backend.crm.social-media.facebook-timeline')
@endsection

@section('extra-scripts')

@endsection
