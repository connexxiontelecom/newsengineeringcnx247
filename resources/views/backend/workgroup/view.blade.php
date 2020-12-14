@extends('layouts.app')

@section('title')
    Workgroup Details
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\hover-effect\normalize.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\hover-effect\set2.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
    @livewire('backend.workgroup.view')
@endsection

@section('dialog-section')
<div class="modal fade" id="removeMember-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title bg-danger">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>This action cannot be undone. Are you sure you want to remove <strong id="member-to-remove"></strong> as member from this group?</p>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="memberId">
                    <button type="button" class="btn btn-default btn-mini waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-mini waves-effect waves-light" id="removeMemberBtn">Yes, remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="removeModerator-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title bg-danger">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>This action cannot be undone. Are you sure you want to remove <strong id="moderator-to-remove"></strong> as moderator from this group?</p>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="moderatorId">
                    <button type="button" class="btn btn-default btn-mini waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-mini waves-effect waves-light " id="removeModeratorBtn">Yes, remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="inviteUser-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Invite User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>Kindly select who you'll like to invite to this group in the form below.</p>
                <div class="form-group">
                    <label for="">Employee</label>
                    <select name="employee" id="employeeId" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="groupId">
                    <button type="button" class="btn btn-default btn-mini waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-mini waves-effect waves-light " id="inviteEmployeeBtn">Send Invite</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="/assets/js/cus/axios.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@stack('workgroup-shortcut-script')
@stack('custom-script')
@endsection
