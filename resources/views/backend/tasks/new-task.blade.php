@extends('layouts.app')

@section('title')
    New Task
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/animate.css/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/cus/datetimepicker.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('livewire.backend.task.common._task-slab')
    </div>
</div>
<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-md-12 btn-add-task">
                <h5 class="sub-title">Create New Task</h5>
                <form method="post" action="{{route('new-task')}}" enctype="multipart/form-data">
                    @csrf
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class=" row">
                        <div class="form-group col-md-12">
                            <label class="">Task Title</label>
                            <input type="text" name="task_title" value="{{old('task_title')}}" class="form-control mb-2" placeholder="Task title">
                            @error('task_title')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class=" row">
                        <div class=" form-group col-md-12">
                            <label class="">Task Description</label>
                            <textarea name="task_description"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Task Description">{{old('task_description')}}</textarea>
                            @error('task_description')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="">Start Date</label>
                            <input type="text" id="start_date" name="start_date" value="{{old('start_date')}}" class="form-control form-control-normal" placeholder="dd/mm/yyyy" >
                            @error('start_date')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="">Due Date</label>
                            <input type="text" id="due_date" name="due_date" value="{{old('due_date')}}" class="form-control form-control-normal" placeholder="dd/mm/yyyy" >
                            @error('due_date')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="">Choose Color <abbr title="Quickly identify this task on task board by assigning a color to it.">?</abbr></label>
                            <input type="color" name="color" value="{{old('color')}}" class="form-control form-control-normal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-md-4">
                            <label class="">Responsible Person(s)</label>
                            <select name="responsible_persons[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Responsible Person(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-4">
                            <label class="">Participant(s) <i>(Optional)</i></label>
                            <select name="participants[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Participant(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-4">
                            <label class="">Observer(s) <i>(Optional)</i></label>
                            <select name="observers[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Observer(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="form-group col-md-4">
                            <label class="">Attachment</label>
                            <input type="file" class="form-control-file" name="attachment">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="">Priority</label>
                                <select name="priority" value="{{old('priority')}}" class="form-control form-control-normal">
                                    @foreach ($priorities as $priority)
                                        <option value="{{$priority->id}}">{{$priority->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="">Status</label>
                                <select name="status" value="{{old('status')}}" class="form-control form-control-normal">
                                    @foreach ($statuses as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="btn-group">
                                <a href="{{route('task-board')}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Close</a>
                                <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Submit</button>
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/moment.js"></script>
<script type="text/javascript" src="/assets/js/cus/datetimepicker.js"></script>
<script>
	$(document).ready(function(){
		$('#start_date').datetimepicker();
		$('#due_date').datetimepicker();

	});
</script>
@stack('custom-scripts')
@endsection
