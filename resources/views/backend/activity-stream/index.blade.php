@extends('layouts.app')

@section('title')
    Activity Stream
@endsection

@section('extra-styles')
<link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\switchery\css\switchery.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\bootstrap-tagsinput\css\bootstrap-tagsinput.css">
    <link rel="stylesheet" href="{{asset('assets/css/cus/parsley.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/cus/progressBar.css')}}">
		<link rel="stylesheet" type="text/css" href="/assets/css/cus/datetimepicker.min.css">
@endsection

@section('content')

			@livewire('backend.activity-stream.shortcut')

@endsection

@section('dialog-section')
<div class="modal fade" id="inviteUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-uppercase">Invite Users</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="tab-pane active" id="byEmail" role="tabpanel">
                <p class="m-0">Okay... Let's get more people to join you. Simply fill the form below. We'll send an email to the concerned person informing him/her of this action.</p>
                <div class="container mt-3">
                    <form id="invitationDialogForm" data-parsley-validate>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" id="invitation_first_name" required placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Email address</label>
                                    <input type="email" class="form-control" id="invitation_email" required placeholder="Email address">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Message <i>(Optional)</i> </label>
                                    <textarea name="invitation_message" id="invitation_message" rows="5" class="form-control" placeholder="Compose message" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 d-flex justify-content-center">
                                <button class="btn btn-mini btn-primary" id="sendInvitationByEmail"><i class="ti-check mr-2"></i>Send Invitation</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default btn-mini waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<!-- Select 2 js -->
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js">
</script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="/assets/js/cus/axios.min.js"></script>
<script type="text/javascript" src="\assets\bower_components\switchery\js\switchery.min.js"></script>

<script type="text/javascript" src="\assets\pages\advance-elements\swithces.js"></script>
<script type="text/javascript" src="\assets\bower_components\bootstrap-tagsinput\js\bootstrap-tagsinput.js"></script>
<script src="{{asset('/assets/js/cus/parsley.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/progressBar.js')}}"></script>
<script type="text/javascript" src="/assets/js/cus/moment.js"></script>
<script type="text/javascript" src="/assets/js/cus/datetimepicker.js"></script>
<script>
	$(document).ready(function(){

			$('#start_date').datetimepicker();
			$('#due_date').datetimepicker();
			$('#event_start_date').datetimepicker();
			$('#event_end_date').datetimepicker();
	});
</script>
@stack('activity-stream-exception')

@endsection
