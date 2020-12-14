@extends('layouts.app')

@section('title')
    Tickets
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
@livewire('backend.crm.support.admin.index')
@endsection

@section('dialog-section')
<div class="modal fade" id="ticketCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title sub-title">Add New Ticket Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="" class="label">Category Name</label>
                    <input type="text" class="form-control" placeholder="Category Name" id="category_name" name="category_name">
                    @error('category_name')
                        <i class="text-danger">{{$message}}</i>
                    @enderror
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light btn-mini" id="addCategoryBtn">Add Category</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="/assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="/assets/pages/message/message.js"></script>
@stack('ticket-scripts')
@endsection
