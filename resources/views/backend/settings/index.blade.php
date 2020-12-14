@extends('layouts.app')

@section('title')
    General Settings
@endsection

@section('extra-styles')

<style>
/* The heart of the matter */

.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h4 class="sub-title">General Settings</h4>
                <div class="btn-group d-flex justify-content-end">
                    <a href="{{route('new-email-campaign')}}" class="btn btn-mini btn-primary" type="button"><i class="ti-plus"></i> New Email Campaign</a>
                    <a href="{{route('email-campaigns')}}" class="btn btn-mini btn-danger"><i class="ti-email"></i> Email Campaigns</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-30px;">
    <div class="card-block email-card">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-expanded="false">General</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#finance" role="tab" aria-expanded="false">Finance</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#policy" role="tab" aria-expanded="false">Policy</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#settings5" role="tab" aria-expanded="true">Assets</a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs-left-content card-block col-md-12">
                    <div class="tab-pane active" id="general" role="tabpanel" aria-expanded="false">
                        @livewire('backend.settings.general-settings')
                    </div>
                    <div class="tab-pane" id="finance" role="tabpanel" aria-expanded="false">
                        @livewire('backend.settings.finance')
                    </div>
                    <div class="tab-pane" id="policy" role="tabpanel" aria-expanded="false">
                        <form action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Terms & Conditions</label>
                                        <textarea name="terms_and_conditions" class="form-control content" placeholder="Terms & Conditions"></textarea>
                                        @error('terms_and_conditions')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Upload Downloadable Terms & Conditions</label>
                                        <input type="file" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Privacy Policy</label>
                                        <textarea name="privacy_policy" class="form-control content" placeholder="Privacy Policy"></textarea>
                                        @error('privacy_policy')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Upload Downloadable Privacy Policy</label>
                                        <input type="file" class="form-control-file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button class="btn btn-mini btn-success" type="submit"><i class="ti-check mr-2"></i>Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="settings5" role="tabpanel" aria-expanded="true">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Company Logo</label>
                                        <input type="file" id="logoHandle" class="form-control-file">
                                        @error('company_logo') <span class="error  text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Favicon</label>
                                        <input type="file" id="faviconHandle"  class="form-control-file">
                                        @error('favicon') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Company Logo</label>
                                            <img class="img-fluid ml-5 mt-3" id="logo-preview" src="assets/images/company-assets/logos/{{Auth::user()->tenant->logo ?? '/assets/images/logo.png'}}" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="52" width="82">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Favicon</label>
                                        <img class="img-fluid ml-5 mt-3" id="favicon-preview" src="assets/images/company-assets/logos/{{Auth::user()->tenant->favicon ?? '/assets/images/logo.png'}}" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="52" width="82">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button class="btn btn-mini btn-primary" id="submitCompanyAssets" type="button"> <i class="ti-check"></i> Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('dialog-section')

@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@stack('general-scripts')
<script>
    $(document).ready(function(){
        var logo = '';
        var favicon = ''
        $('#logoHandle').change(function(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                logo='';
                reader.onloadend = (file) =>{
                    logo = reader.result;
                    $('#logo-preview').attr('src', logo);
                }
                reader.readAsDataURL(file);

            });
        $('#faviconHandle').change(function(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                favicon='';
                reader.onloadend = (file) =>{
                    favicon = reader.result;
                    $('#favicon-preview').attr('src', favicon);
                }
                reader.readAsDataURL(file);

            });
        $(document).on('click', '#submitCompanyAssets', function(e){
            e.preventDefault();
                axios.post('/change/company-assets',{logo:logo, favicon:favicon})
                .then(response=>{
                    $.notify(response.data.message, 'success');
                })
                .catch(error=>{
                    $.notify("Error! Could not change assets. Try again.");
                });
        });
    });
</script>
@endsection
