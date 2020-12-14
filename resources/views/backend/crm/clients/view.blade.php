@extends('layouts.app')

@section('title')
View Client
@endsection

@section('extra-styles')

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
    @livewire('backend.crm.clients.view')
@endsection

@section('dialog-section')
<div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase">Compose mail</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p><strong>Note:</strong> All fields are required.</p>
                <form id="sendClientEmailForm" data-parsley-validate>
                    <div class="form-group">
                        <label for="">To <sup class="text-danger">*</sup></label>
                        <input type="email" placeholder="To" required id="email" class="form-control" value="{{$client->email ?? ''}}">
                    </div>
                    <div class="form-group">
                        <label for="">Subject<sup class="text-danger">*</sup></label>
                        <input type="text" placeholder="Subject" id="email_subject" required class="form-control">
                        <input type="hidden" id="clientId" value="{{$client->id}}">
                    </div>
                    <div class="form-group">
                        <label for="">Content<sup class="text-danger">*</sup></label>
                        <textarea name="" id="email_message" cols="5" rows="5" class="form-control content" placeholder="Compose mail..."></textarea>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light" id="sendMailBtn"> <i class="icofont icofont-paper-plane text-white mr-2"></i> Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sendSMS" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase">Compose Message</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Mobile Number</label>
                        <input type="text" placeholder="Mobile Number" id="mobile_no" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea style="resize: none;" name="" rows="5" id="sms" class="form-control" placeholder="Compose message here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="sendMail"> <i class="ti-email text-white mr-2"></i> Send SMS</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@stack('client-script')
@endsection
