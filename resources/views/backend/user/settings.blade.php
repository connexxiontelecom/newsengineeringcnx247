@extends('layouts.app')

@section('title')
    User > Administration
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
    @livewire('backend.user.my-profile')
    <div class="card" style="margin-top:-25px;">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Account Settings</h5>
                </div>
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingOne">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Personal Info
                                </a>
                            </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="accordion-content accordion-desc">
                                    @livewire('backend.user.settings.personal-info')
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingTwo">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Work Experience
                                </a>
                            </h3>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="accordion-content accordion-desc">
                                    @livewire('backend.user.settings.experience')
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingThree">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Education
                                </a>
                            </h3>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="accordion-content accordion-desc">
                                    @livewire('backend.user.settings.education')
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingFour">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Emergency Contact
                                </a>
                            </h3>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="accordion-content accordion-desc">
                                    @livewire('backend.user.settings.emergency')
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingFive">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Next of Kin
                                </a>
                            </h3>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="accordion-content accordion-desc">
                                    @livewire('backend.user.settings.next-kin')
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingSix">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Security
                                </a>
                            </h3>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                <div class="accordion-content accordion-desc">
                                    @livewire('backend.user.settings.security.change-password')
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
    @include('backend.user.common._user-modals')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/profile.js"></script>
@stack('profile-script')
@endsection
