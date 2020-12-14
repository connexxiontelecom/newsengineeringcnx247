@extends('layouts.app')

@section('title')
    Job Role ({{$role->role_name ?? ''}})
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
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-header-text">{{$role->role_name ?? ''}}</h5>
                                </div>
                                <div class="card-block accordion-block">
                                    <div class="accordion-box ui-accordion ui-widget ui-helper-reset" id="single-open" role="tablist">
                                        <div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content ui-accordion-content-active" style="" id="ui-id-2" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                                            <button class="btn btn-mini btn-primary float-right mb-2 quantitativeAssessLauncher" type="button" data-toggle="modal" data-target="#quantitativeQuestionModal"><i class="ti-plus mr-2"></i> Add New Question</button>
                                            <p>
                                                {!! $role->role_description !!}
                                            </p>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="quantitativeAssessmentTable">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Questions</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach($questions as $question)
                                                        <tr>
                                                            <td>{{$i++}}</td>
                                                            <td>{!! strip_tags($question->question ?? '')  !!}</td>
                                                            <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($question->created_at))}}</td>
                                                            <td>
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#quantitativeQuestionModal" data-question="{{$question->question ?? ''}}" class="roleDetailLauncherClass"> <i class="text-info ti-eye"></i> </a>
                                                            </td>
                                                        </tr>
                                                   @endforeach
                                                    </tbody>
                                                </table>
                                                <input type="hidden" name="roleId" id="roleId" value="{{$id}}">
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
