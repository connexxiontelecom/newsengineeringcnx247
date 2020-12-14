@extends('layouts.app')

@section('title')
    Edit Task
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/animate.css/css/animate.css">
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
            <div class="col-md-10 offset-md-1 btn-add-task">
                <form method="post" action="{{route('update-task')}}" enctype="multipart/form-data">
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
                        <div class="form-group col-md-10 offset-md-1">
                            <label class="">Task Title</label>
                            <input type="text" name="task_title" value="{{old('task_title', $task->post_title)}}" class="form-control mb-2" placeholder="Task title">
                            @error('task_title')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class=" row">
                        <div class=" form-group col-md-10 offset-md-1">
                            <label class="">Task Description</label>
                            <textarea name="task_description"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Task Description">{{old('task_description', $task->post_content)}}</textarea>
                            @error('task_description')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="">Start Date</label>
                            <input type="datetime-local" name="start_date" value="{{old('start_date', date(Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($task->start_date)))}}" class="form-control form-control-normal" placeholder="Task title">
                            <label for="" class="label label-info">Started Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($task->start_date))}} @ <small>{{date('h:ia', strtotime($task->start_date))}}</small></label>
                            @error('start_date')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="">Due Date</label>
                            <input type="datetime-local" name="due_date" value="{{old('due_date', $task->end_date)}}" class="form-control form-control-normal" placeholder="Due date">
                            <label for="" class="label label-danger">Due Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($task->end_date))}} @ <small>{{date('h:ia', strtotime($task->end_date))}}</small></label>
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
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="btn-group">
                                <input type="hidden" name="url" value="{{$task->post_url}}">
                                <a href="{{route('task-board')}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Close</a>
                                <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Save changes</button>
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
@stack('custom-scripts')
@endsection
