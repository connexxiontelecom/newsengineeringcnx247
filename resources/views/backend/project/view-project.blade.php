@extends('layouts.app')

@section('title')
    Project Details
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

@endsection

@section('content')
    @livewire('backend.project.view-project')
@endsection
@section('dialog-section')
<div class="modal fade" id="milestoneModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title">Create Project Milestone</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" placeholder="Milestone Title" id="milestone_title">
                        </div>
                        <div class="form-group">
                            <label>Due Date <sup class="text-danger">*</sup></label>
                            <input type="datetime-local" class="form-control" placeholder="Due Date" id="due_date">
                        </div>
                        <div class="form-group">
                            <label>Description <sup class="text-danger">*</sup></label>
                            <textarea class="form-control" name="description" rows="5" style="resize:none;" placeholder="Type description..." id="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="projectId">
                    <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                    <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" id="createMilestone"><i class="ti-check mr-2"></i>Create milestone</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('extra-scripts')
<script>

    $(document).ready(function(){
        $(document).on('click', '.milestone-laucher', function(e){
            var post_id = $(this).data('post-id');
            $('#projectId').val(post_id);
        });

        $(document).on('click', '#createMilestone', function(e){
            e.preventDefault();
            var title = $('#milestone_title').val();
            var due_date = $('#due_date').val();
            var description = $('#description').val();
            if(title == '' || due_date == '' || description == ''){
                $.notify("Ooops! Kindly complete the form to create a new milestone", "error");
            }else{
                axios.post('/project/milestone', {
                    title:title,
                    due_date:due_date,
                    description:description,
                    post_id:$('#projectId').val()
                })
                .then(response=>{
                    $.notify("New project milestone created.", "success");
                    $('#milestone_title').val('');
                    $('#due_date').val('');
                    $('#description').val('');
                    $('#milestoneModal').modal('hide');
                    location.reload();
                })
                .catch(error=>{
                    $.notify("Ooops! Could not create new project milestone. Try again.", "error");
                });
            }
        });
    })
</script>
@stack('project-script')
@endsection
