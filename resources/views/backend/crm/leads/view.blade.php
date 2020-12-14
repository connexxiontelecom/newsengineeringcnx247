@extends('layouts.app')

@section('title')
View Lead
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
    @livewire('backend.crm.leads.view')
@endsection

@section('dialog-section')
<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase">Compose mail</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">To</label>
                        <input type="email" placeholder="To" id="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" placeholder="Subject" id="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="" id="resignation_content" cols="5" rows="5" class="form-control content" placeholder="Compose mail..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="sendMail"> <i class="ti-email text-white mr-2"></i> Send</button>
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
                        <input type="email" placeholder="Mobile Number" id="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea style="resize: none;" name="" rows="5" id="message" class="form-control" placeholder="Compose message here..."></textarea>
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
@endsection
