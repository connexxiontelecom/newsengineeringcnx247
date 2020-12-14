@extends('layouts.app')

@section('title')
    Task Board
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css') }}">

@endsection

@section('content')
    @livewire('backend.task.task-board')
@endsection

@section('dialog-section')
<div class="modal fade" id="taskDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title bg-danger">Are you sure?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>This action cannot be undone. Are you sure you want to delete <strong id="taskName"></strong>?</p>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="taskId">
                    <button type="button" class="btn btn-default btn-mini waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-mini waves-effect waves-light" id="deleteTaskBtn">Yes, remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="/assets/pages/data-table/extensions/responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script>
$('#datatable-tasks').DataTable();
$('#datatable-my-tasks').DataTable();
$('#datatable-observing-tasks').DataTable();
$('#datatable-participating-tasks').DataTable();
</script>

@stack('task-script')
@endsection
