@extends('layouts.app')

@section('title')
    Project Details
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
<link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
    @livewire('backend.project.view-project')
@endsection
@section('dialog-section')
<div class="modal fade" id="milestoneModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title">Create Project Milestone</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
							<form action="{{route('publish-milestone')}}" method="post">
								@csrf
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Title <sup class="text-danger">*</sup></label>
											<input type="text" name="title" class="form-control" placeholder="Milestone Title" id="milestone_title">
											@error('title') <i class="text-danger mt-2">{{$message}}</i>@enderror
										</div>
										<div class="form-group">
											<label for="">Assign to</label>
											<select name="assign_to[]" multiple="multiple" id="assign_to" class=" form-control">
												@foreach($users as $user)
													<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? '' }}</option>
												@endforeach
											</select>
											@error('assign_to') <i class="text-danger mt-2">{{$message}}</i>@enderror
										</div>
										<div class="form-group">
											<label>Due Date <sup class="text-danger">*</sup></label>
											<input type="datetime-local" name="due_date" class="form-control" placeholder="Due Date" id="due_date">
											@error('due_date') <i class="text-danger mt-2">{{$message}}</i>@enderror
										</div>
										<div class="form-group">
											<label>Description <sup class="text-danger">*</sup></label>
											<textarea  class="form-control" name="description" rows="5" style="resize:none;" placeholder="Type description..." id="description"></textarea>
											@error('description') <i class="text-danger mt-2">{{$message}}</i>@enderror
										</div>

									</div>
								</div>

							</form>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="projectId" name="project" value="{{$project->id}}">
                    <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                    <button type="submit" class="btn btn-primary btn-mini waves-effect waves-light" id="createMilestone"><i class="ti-check mr-2"></i>Create milestone</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="update-status" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Update Status</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-white">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{route('publish-milestone')}}" method="post">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Title <sup class="text-danger">*</sup></label>
								<input type="text" name="title" class="form-control" placeholder="Milestone Title" id="milestone_title">
								@error('title') <i class="text-danger mt-2">{{$message}}</i>@enderror
							</div>
							<div class="form-group">
								<label for="">Assign to</label>
								<select name="assign_to[]" multiple="multiple" id="assign_to" class=" form-control">
									@foreach($users as $user)
										<option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? '' }}</option>
									@endforeach
								</select>
								@error('assign_to') <i class="text-danger mt-2">{{$message}}</i>@enderror
							</div>
							<div class="form-group">
								<label>Due Date <sup class="text-danger">*</sup></label>
								<input type="datetime-local" name="due_date" class="form-control" placeholder="Due Date" id="due_date">
								@error('due_date') <i class="text-danger mt-2">{{$message}}</i>@enderror
							</div>
							<div class="form-group">
								<label>Description <sup class="text-danger">*</sup></label>
								<textarea  class="form-control" name="description" rows="5" style="resize:none;" placeholder="Type description..." id="description"></textarea>
								@error('description') <i class="text-danger mt-2">{{$message}}</i>@enderror
							</div>

						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<div class="btn-group d-flex justify-content-center">
					<input type="hidden" id="projectId" name="project" value="{{$project->id}}">
					<button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
					<button type="submit" class="btn btn-primary btn-mini waves-effect waves-light" id="createMilestone"><i class="ti-check mr-2"></i>Create milestone</button>
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
<script>

    $(document).ready(function(){
        $(document).on('click', '.milestone-laucher', function(e){
            var post_id = $(this).data('post-id');
            $('#projectId').val(post_id);
        });


        /*$(document).on('click', '#createMilestone', function(e){
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
        });*/
    })
</script>
@stack('project-script')
@endsection
