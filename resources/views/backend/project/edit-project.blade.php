@extends('layouts.app')

@section('title')
    Edit Project
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('livewire.backend.project.common._project-slab')
    </div>
</div>
<div class="card">
    <div class="card-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 btn-add-task">
                    <h5 class="sub-title">Edit New Project</h5>
                            @if(session()->has('success'))
                                <div class="alert alert-success border-success" style="padding:5px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled"></i>
                                    </button>
                                    <strong>Success!</strong> {!! session('success') !!}
                                </div>
                            @endif
                    <form action="{{route('update-project')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="">Project Name <sup class="text-danger" style="cursor: pointer;"> <abbr title="Required">*</abbr> </sup></label>
                            <input type="text" name="project_name" value="{{old('project_name', $project->post_title)}}" class="form-control form-control-normal mb-2" placeholder="Project Name">
                            @error('project_name')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Project Sponsor/Owner </label>
                                    <input type="text" name="project_sponsor" value="{{old('project_sponsor', $project->sponsor)}}" class="form-control form-control-normal mb-2" placeholder="Project Sponsor/Owner">
                                    @error('project_sponsor')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Project Manager </label>
                                    <select  name="project_manager" value="{{old('project_manager',$project->user->id)}}" class="form-control form-control-normal mb-2">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name}} {{$user->surname ?? ''}}</option>

                                        @endforeach
                                    </select>
                                        @error('project_manager')
                                            <i class="text-danger">{{$message}}</i>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Due Date <sup class="text-danger" style="cursor: pointer;"> <abbr title="Required">*</abbr> </sup></label>
                                <input type="datetime-local" value="{{old('due_date', $project->end_date)}}" name="due_date" class="form-control form-control-normal" placeholder="Due date">
                                <label for="" class="label label-danger">Due Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($project->end_date))}} @ <small>{{date('h:ia', strtotime($project->end_date))}}</small></label>
                                @error('due_date')
                                    <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label >Start Date</label>
                                        <input type="datetime-local" value="{{old('start_date', $project->start_date)}}" name="start_date" class="form-control form-control-normal" placeholder="Start Date">
                                        <label for="" class="label label-info">Started Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($project->start_date))}} @ <small>{{date('h:ia', strtotime($project->start_date))}}</small></label>
                                @error('start_date')
                                    <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label >Color</label>
                                        <input type="color" value="{{old('color', $project->color)}}" name="color" class="form-control form-control-normal" placeholder="Choose color">
                                @error('color')
                                    <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Priority </label>
                                    <select name="priority" value="{{old('priority')}}" class="form-control form-control-normal">
                                        <option value="1">Highest priority</option>
                                        <option value="2">High priority</option>
                                        <option value="3">Normal priority</option>
                                        <option value="4">Low priority</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Status </label>
                                    <select name="status" value="{{old('status')}}" class="form-control form-control-normal">
                                        <option value="1">Open</option>
                                        <option value="2">on Hold</option>
                                        <option value="3">Resolved</option>
                                        <option value="4">Closed</option>
                                        <option value="5">At Risk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Project Description </label>
                                    <textarea name="project_description"  cols="5" rows="5" id="project_description" class="content form-control form-control-normal mb-2" placeholder="Your description may include project goals, objective, scope, risk, issues, timescale, etc.">{{old('project_description', $project->post_content)}}</textarea>
                                    @error('project_description')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="btn-group d-flex justify-content-center">
                                    <input type="hidden" name="url" value="{{$project->post_url}}"/>
                                    <a href="{{route('project-board')}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('project-scripts')

@endpush
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@endsection
