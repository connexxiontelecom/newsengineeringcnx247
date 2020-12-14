@extends('layouts.app')

@section('title')
    Performance Indicators
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('livewire.backend.hr.common._slab-menu')
            </div>
        </div>
    </div>
</div>
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="card-header">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-header-text">Performance Indicators</h5>
                                </div>
                                <div class="card-block accordion-block">
                                    <div id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="accordion-panel">
                                            <div class="accordion-heading" role="tab" id="headingDepartment">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDepartment" aria-expanded="false" aria-controls="collapseDepartment">
                                                    Self-Performance Assessment
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseDepartment" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingDepartment" style="">
                                                <div class="accordion-content accordion-desc">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-block">
                                                                    <h5 class="sub-title">Self-Performance Assessment Questions</h5>
                                                                    <button class="btn btn-mini btn-primary float-right mb-2 selfAssessLauncher" type="button" data-toggle="modal" data-target="#selfQuestionModal"><i class="ti-plus mr-2"></i> Add New Question</button>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered" id="selfAssessmentTable">
                                                                            <thead>
                                                                                <th>#</th>
                                                                                <th>Question</th>
                                                                                <th>Added By</th>
                                                                                <th>Date</th>
                                                                                <th>Action</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php
                                                                                    $i = 1;
                                                                                @endphp
                                                                               @foreach($self as $question)
                                                                                    <tr>
                                                                                        <td>{{$i++}}</td>
                                                                                        <td>{!! strlen($question->question) > 81 ? substr($question->question,0,81).'...' : $question->question !!}</td>
                                                                                        <td>
                                                                                            <a href="{{route('view-profile', $question->user->url)}}">{{$question->user->first_name ?? ''}} {{$question->user->surname ?? ''}}</a>
                                                                                        </td>
                                                                                        <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($question->created_at))}}</td>
                                                                                        <td>
                                                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#selfQuestionModal" data-self-question="{{$question->question}}" data-sqid="{{$question->id}}" class="selfQuestionLauncherClass"> <i class="text-warning ti-pencil"></i> </a>
                                                                                        </td>
                                                                                    </tr>
                                                                               @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class="accordion-heading" role="tab" id="headingSupervisors">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSupervisors" aria-expanded="false" aria-controls="collapseSupervisors">
                                                    Quantitatives Assessment <i><small>(for supervisor)</small></i>
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseSupervisors" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSupervisors" style="">
                                                <div class="accordion-content accordion-desc">
                                                    <button class="btn btn-mini btn-primary float-right mb-2 quantitativeAssessLauncher" type="button" data-toggle="modal" data-target="#quantitativeQuestionModal"><i class="ti-plus mr-2"></i> Add New Question</button>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="quantitativeAssessmentTable">
                                                            <thead>
                                                                <th>#</th>
                                                                <th>Department</th>
                                                                <th>Job Role</th>
                                                                <th>Date</th>
                                                                <th>Action</th>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach($roles as $role)
                                                                <tr>
                                                                    <td>{{$i++}}</td>
                                                                    <td>{{ $role->department->department_name ?? '' }}</td>
                                                                    <td>{{ $role->role_name ?? '' }}</td>
                                                                    <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($role->created_at))}}</td>
                                                                    <td>
                                                                        <a href="{{route('job-role-questions', $role->id)}}" class="btn btn-primary btn-mini"> <i class="mr-2 ti-eye"></i> View Questions</a>
                                                                    </td>
                                                                </tr>
                                                           @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class=" accordion-heading" role="tab" id="headingLeaveType">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseLeaveType" aria-expanded="true" aria-controls="collapseLeaveType">
                                                    Qualitatives Assessment <i><small>(for supervisor)</small></i>
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseLeaveType" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingLeaveType" style="">
                                                <div class="accordion-content accordion-desc">
                                                    <button class="btn btn-mini btn-primary float-right mb-2 qualitativeAssessLauncher" type="button" data-toggle="modal" data-target="#qualitativeQuestionModal"><i class="ti-plus mr-2"></i> Add New Question</button>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="qualitativeAssessmentTable">
                                                            <thead>
                                                                <th>#</th>
                                                                <th>Question</th>
                                                                <th>Added By</th>
                                                                <th>Date</th>
                                                                <th>Action</th>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach($qualitatives as $question)
                                                                <tr>
                                                                    <td>{{$i++}}</td>
                                                                    <td>{!! strlen($question->question) > 81 ? substr($question->question,0,81).'...' : $question->question !!}</td>
                                                                    <td>
                                                                        <a href="{{route('view-profile', $question->user->url)}}">{{$question->user->first_name ?? ''}} {{$question->user->surname ?? ''}}</a>
                                                                    </td>
                                                                    <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($question->created_at))}}</td>
                                                                    <td>
                                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#qualitativeQuestionModal" data-qualitative-question="{{$question->question}}" data-lid="{{$question->id}}" class="qualitativeQuestionLauncherClass"> <i class="text-warning ti-pencil"></i> </a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class=" accordion-heading" role="tab" id="headingJobRole">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseJobRole" aria-expanded="true" aria-controls="collapseJobRole">
                                                    Employee Appraisal Parameters
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseJobRole" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingJobRole" style="">
                                                <div class="accordion-content accordion-desc">
                                                    @livewire('backend.hr.common.job-role')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection
@section('dialog-section')
<div class="modal fade" id="selfQuestionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title bg-primary">Add New Self-Assessment Question</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Question</label>
                    <textarea class="form-control content" placeholder="Type question here..." name="question" id="selfQuestion"></textarea>
                    @error('question')
                        <i>{{$message}}</i>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                    <button type="button" class="btn btn-warning btn-mini waves-effect waves-light" id="selfAssessChangesBtn"><i class="ti-pencil mr-2"></i>Save changes</button>
                    <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" id="selfAssessBtn"><i class="ti-check mr-2"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="quantitativeQuestionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title bg-primary">Add New Quantitative Question</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Question</label>
                    <textarea class="form-control content" id="quantitativeQuestion" placeholder="Type question here..." wire:model.debounce.90000ms="question"></textarea>
                    @error('question')
                        <i>{{$message}}</i>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="projectId">
                    <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                        <button type="submit" class="btn btn-warning btn-mini waves-effect waves-light" id="quantitativeAssessChangesBtn"><i class="ti-pencil mr-2"></i>Save changes</button>
                        <button type="submit" class="btn btn-primary btn-mini waves-effect waves-light" id="quantitativeAssessBtn"><i class="ti-check mr-2"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="qualitativeQuestionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title bg-primary">Add New Qualitative Question</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Question</label>
                    <textarea class="form-control content" id="qualitativeQuestion" placeholder="Type question here..." wire:model.debounce.90000ms="question"></textarea>
                    @error('question')
                        <i>{{$message}}</i>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="projectId">
                    <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                        <button type="submit" class="btn btn-primary btn-mini waves-effect waves-light" id="qualitativeAssessChangesBtn"><i class="ti-check mr-2"></i>Save changes</button>
                        <button type="submit" class="btn btn-primary btn-mini waves-effect waves-light" id="qualitativeAssessBtn"><i class="ti-check mr-2"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/self-assess.js"></script>
<script type="text/javascript" src="/assets/js/cus/quantitative-assess.js"></script>
<script type="text/javascript" src="/assets/js/cus/qualitative-assess.js"></script>
@endsection
