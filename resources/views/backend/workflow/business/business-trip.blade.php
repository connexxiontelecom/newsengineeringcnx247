@extends('layouts.app')

@section('title')
    Business Trip
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" type="text/css" href="/assets/pages/notification/notification.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/animate.css/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/animate.css/css/animate.css">
    <link rel="stylesheet" href="{{asset('assets/css/cus/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cus/progressBar.css')}}">
<style>
    .md-content h3{
        border-radius: 0px !important;
    }

</style>
@endsection

@section('content')
    @livewire('backend.workflow.business.business-trip')
@endsection
@section('dialog-section')
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-uppercase">New Business Trip Request</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="requestForm" data-parsley-validate>
                    <fieldset>
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" placeholder="Title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Purpose</label>
                            <input type="text" placeholder="Purpose" id="purpose" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Destination</label>
                            <input type="text" placeholder="Destination" id="destination" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Expense</label>
                            <input type="number" placeholder="Expense" step="0.01" id="expense" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="datetime-local" placeholder="Start Date" id="start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="datetime-local" placeholder="End Date" id="end_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

													@if($storage_capacity == 1)
                            <label for="">Attachment</label>
                            <input type="file" id="uploadAttachment" class="form-control">
                      		@endif

													@if($storage_capacity == 0)

														Drive Capacity Full, Please Upgrade to Upload More Files
													@endif
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="" id="description" cols="5" rows="5" class="form-control content" placeholder="Type here..."></textarea>
                        </div>
                        <hr>
                        <div class="btn-group d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                            <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light" id="requestBtn"><i class="mr-2 ti-check"></i>Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
    <script type="text/javascript" src="/assets/js/modal.js"></script>
    <script type="text/javascript" src="/assets/js/modalEffects.js"></script>
    <script type="text/javascript" src="/assets/js/classie.js"></script>
    <script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

    <script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
    <script src="{{asset('/assets/js/cus/parsley.min.js')}}"></script>
    <script src="{{asset('/assets/js/cus/progressBar.js')}}"></script>
    @stack('business-trip-script')
@endsection
