@extends('layouts.app')

@section('title')
    HR Configurations
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
                                    <h5 class="card-header-text">HR Configurations</h5>
                                </div>
                                <div class="card-block accordion-block">
                                    <div id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="accordion-panel">
                                            <div class="accordion-heading" role="tab" id="headingDepartment">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDepartment" aria-expanded="false" aria-controls="collapseDepartment">
                                                    Departments
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseDepartment" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingDepartment" style="">
                                                <div class="accordion-content accordion-desc">
                                                    @livewire('backend.hr.common.department')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class="accordion-heading" role="tab" id="headingSupervisors">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSupervisors" aria-expanded="false" aria-controls="collapseSupervisors">
                                                    Supervisors
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseSupervisors" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSupervisors" style="">
                                                <div class="accordion-content accordion-desc">
                                                    @livewire('backend.hr.common.supervisors')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class=" accordion-heading" role="tab" id="headingJobRole">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseJobRole" aria-expanded="true" aria-controls="collapseJobRole">
                                                    Job Role
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

@section('extra-scripts')

@endsection
