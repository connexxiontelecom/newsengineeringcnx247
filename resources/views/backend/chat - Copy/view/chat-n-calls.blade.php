@extends('layouts.app')

@section('title')
    Chat-n-calls
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
<style>
    .scrollList{
    scrollbar-width: thin;
    }
</style>
@endsection

@section('content')
    @livewire('backend.chat-n-calls.view.chat-n-calls')
@endsection

@section('dialog-section')
<div class="modal fade" id="call-screen" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="height: 400px; background:#110022; border-radius:5%!important;">
            <div class="modal-body">
                <div class="row d-flex justify-content-center" style="margin-top:100px;">
                    <div class="col-md-3">
                        <img style="border:1px solid #fff;" class="media-object img-radius msg-img-h float-right img-30" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-center" style="letter-spacing: 2px;">
                        <h6 class="text-white mb-2">Calling</h6>
                        <h5 class="text-white mb-2" id="userName" >Name</h5>
                        <h6 class="text-white" id="mobileNo" >Mobile 070</h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 d-flex justify-content-center">
                        <button class="btn btn-danger btn-icon" onclick="callUser()"><i class="zmdi zmdi-phone-end"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\message\message.js"></script>
<script type="text/javascript" src="\assets\js\cus\axios.min.js"></script>
<script type="text/javascript" src="\assets\js\cus\slimscroll.min.js"></script>
@stack('chat-calls-script')
@endsection
