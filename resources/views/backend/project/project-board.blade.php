@extends('layouts.app')

@section('title')
    Project Board
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bower_components\datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css') }}">

@endsection

@section('content')
    @livewire('backend.project.project-board')
@endsection
@section('dialog-section')
<div class="modal fade" id="projectDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title bg-danger">Are you sure?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>This action cannot be undone. Are you sure you want to delete <strong id="projectName"></strong>?</p>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="projectId">
                    <button type="button" class="btn btn-default btn-mini waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-mini waves-effect waves-light" id="deleteProjectBtn">Yes, remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')


    <script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

    <script>

        $('#datatable-task').DataTable();
    </script>
@stack('project-script')
@endsection
