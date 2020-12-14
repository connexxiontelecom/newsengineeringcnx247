@extends('layouts.app')

@section('title')
    Leave Management
@endsection

@section('extra-styles')
<style>
.user-card2 .risk-rate-success {
    display: inline-block;
    margin: 0 auto;
}
.user-card2 .risk-rate-success span {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    border: 6px dashed #d6d6d6;
    border-top-color: #fe9365;
    border-bottom-color: transparent;
    padding: 45px;
    display: block;
    position: relative;
}

.user-card2 .risk-rate-success span b {
    font-size: 20px;
    color: #fff;
    z-index: 2;
    position: relative;
}
.user-card2 .risk-rate-success span:after {
    content: "";
    width: 90px;
    height: 90px;
    background-color: rgba(46, 204, 113, 0.5);
    border-radius: 50%;
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 1;
}
.user-card2 .risk-rate-danger span:after {
    content: "";
    width: 90px;
    height: 90px;
    background-color: rgba(231, 76, 60, 0.5);
    border-radius: 50%;
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 1;
}
.user-card2 .risk-rate-danger {
    display: inline-block;
    margin: 0 auto;
}
.user-card2 .risk-rate-danger span {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    border: 6px dashed #d6d6d6;
    border-top-color: #fe9365;
    border-bottom-color: transparent;
    padding: 45px;
    display: block;
    position: relative;
}

.user-card2 .risk-rate-danger span b {
    font-size: 20px;
    color: #fff;
    z-index: 2;
    position: relative;
}
</style>
@endsection

@section('content')
    @livewire('backend.hr.leave-management')

@endsection

@section('extra-scripts')

@endsection