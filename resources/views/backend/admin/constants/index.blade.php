@extends('layouts.app')

@section('title')
    Constants
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="d-inline-block">
                    <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('clients')}}"><i class="icofont icofont-ui-user"></i>  Plans</a>
                    <a href="{{ route('leads') }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-thumbs-up"></i> Features</a>
                </div>
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
                                    <h5 class="card-header-text">Constants</h5>
                                </div>
                                <div class="card-block accordion-block">
                                    <div id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="accordion-panel">
                                            <div class="accordion-heading" role="tab" id="headingOne">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    Currency
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                                                <div class="accordion-content accordion-desc">
                                                    @livewire('backend.constants.currency')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class="accordion-heading" role="tab" id="headingTwo">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Industry
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" style="">
                                                <div class="accordion-content accordion-desc">
                                                    @livewire('backend.constants.industry')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class=" accordion-heading" role="tab" id="headingQualification">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#qualificationCollapse" aria-expanded="true" aria-controls="qualificationCollapse">
                                                    Qualification
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="qualificationCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingQualification" style="">
                                                <div class="accordion-content accordion-desc">
                                                    @livewire('backend.constants.qualification')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class=" accordion-heading" role="tab" id="headingThree">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                    Use Case
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingThree" style="">
                                                <div class="accordion-content accordion-desc">
                                                    <p>
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                                        survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class=" accordion-heading" role="tab" id="headingFour">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                    Date Format
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseFour" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingFour" style="">
                                                <div class="accordion-content accordion-desc">
                                                    @livewire('backend.constants.date-format')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-panel">
                                            <div class=" accordion-heading" role="tab" id="headingFive">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                    Language
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapseFive" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingFive" style="">
                                                <div class="accordion-content accordion-desc">
                                                    <p>
                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                                        survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                    </p>
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
