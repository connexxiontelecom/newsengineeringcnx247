@extends('layouts.frontend-layout')

@section('title')
    Settings
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
       @include('frontend.procurement.partials._header-menu')
        <section class="section mt-60">
            <div class="container mt-lg-3">
                <div class="row">
                    <div class="col-lg-12 col-12">

                        <div class="border-bottom pb-4">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <h5>Company Settings</h5>
                                    @if (session()->has("success"))
                                        {!! session()->get('success') !!}
                                    @endif
                                    <form action="{{route('supplier-settings')}}" method="post">
                                        @csrf
                                        <div class="mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Office Email <span class="text-danger">*</span></label>
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input name="office_email" id="office_email" type="email" class="form-control pl-5" value="{{old('company_email', Auth::user()->company_email)}}" placeholder="Office Email">
                                                    @error('office_email')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                    <small class="text-muted"><span class="text-danger">Note: </span> This email address will be required to login.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Office Phone <span class="text-danger">*</span></label>
                                                    <i data-feather="phone" class="fea icon-sm icons"></i>
                                                    <input name="office_phone" id="office_phone" type="text" class="form-control pl-5" placeholder="Office Phone" value="{{old('company_phone', Auth::user()->company_phone)}}">
                                                    @error('office_phone')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Website<span class="text-danger">*</span></label>
                                                    <i data-feather="globe" class="fea icon-sm icons"></i>
                                                    <input name="website" id="website" type="text" class="form-control pl-5" placeholder="Website" value="{{old('website', Auth::user()->website)}}">
                                                    @error('website')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Tagline<span class="text-danger">*</span></label>
                                                    <i data-feather="message-square" class="fea icon-sm icons"></i>
                                                    <textarea name="tagline" id="tagline" type="text" class="form-control pl-5" style="resize: none;" placeholder="Tagline">{{old('tagline', Auth::user()->tagline)}}</textarea>
                                                    @error('tagline')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Office Address<span class="text-danger">*</span></label>
                                                    <i data-feather="map-pin" class="fea icon-sm icons"></i>
                                                    <textarea name="office_address" id="office_address" type="text" class="form-control pl-5" style="resize: none;" placeholder="Office Address">{{old('office_address', Auth::user()->company_address)}}</textarea>
                                                    @error('office_address')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="btn-group">
                                                    <a href="{{url()->previous()}}" class="btn btn-outline-dark mt-2 mr-2">Cancel</a>
                                                    <button type="submit" class="btn btn-outline-primary mt-2 mr-2">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-6 mt-4 pt-2 pt-sm-0">
                                    <h5>Contact Person Settings</h5>
                                    @if (session()->has("contact_success"))
                                        {!! session()->get('contact_success') !!}
                                    @endif
                                    <form action="{{route('supplier-update-contact-person')}}" method="post">
                                        @csrf
                                        <div class="mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Full Name <span class="text-danger">*</span></label>
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                    <input name="full_name" id="full_name" type="text" class="form-control pl-5" value="{{old('full_name', Auth::user()->first_name)}}" placeholder="Full Name">
                                                    @error('full_name')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Mobile Number <span class="text-danger">*</span></label>
                                                    <i data-feather="phone" class="fea icon-sm icons"></i>
                                                    <input name="mobile_no" id="mobile_no" type="text" class="form-control pl-5" placeholder="Mobile Number" value="{{old('mobile_no', Auth::user()->mobile_no)}}">
                                                    @error('mobile_no')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Email Address <span class="text-danger">*</span></label>
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input name="email_address" id="mobile_no" type="email" class="form-control pl-5" placeholder="Email Address" value="{{old('email_address', Auth::user()->email_address)}}">
                                                    @error('email_address')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Position<span class="text-danger">*</span></label>
                                                    <i data-feather="briefcase" class="fea icon-sm icons"></i>
                                                    <input name="position" id="website" type="text" class="form-control pl-5" placeholder="Position" value="{{old('position', Auth::user()->position)}}">
                                                    @error('position')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="btn-group">
                                                    <a href="{{url()->previous()}}" class="btn btn-outline-dark mt-2 mr-2">Cancel</a>
                                                    <button type="submit" class="btn btn-outline-primary mt-2 mr-2">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <h5 class="mt-4">Change Password</h5>
                                        @if (session()->has("security_success"))
                                            {!! session()->get('security_success') !!}
                                        @endif
                                        @if (session()->has("warning"))
                                            {!! session()->get('warning') !!}
                                        @endif
                                    <form action="{{route('supplier-change-password')}}" method="post">
                                        @csrf
                                        <div class="mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Current Password <span class="text-danger">*</span></label>
                                                    <i data-feather="lock" class="fea icon-sm icons"></i>
                                                    <input name="current_password" id="current_password" type="password" class="form-control pl-5"  placeholder="Current Password">
                                                    @error('current_password')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>New Password <span class="text-danger">*</span></label>
                                                    <i data-feather="lock" class="fea icon-sm icons"></i>
                                                    <input name="password" id="password" type="password" class="form-control pl-5"  placeholder="Choose Password">
                                                    @error('password')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Re-type Password <span class="text-danger">*</span></label>
                                                    <i data-feather="lock" class="fea icon-sm icons"></i>
                                                    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control pl-5"  placeholder="Re-type Password">
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="btn-group">
                                                    <a href="{{url()->previous()}}" class="btn btn-outline-dark mt-2 mr-2">Cancel</a>
                                                    <button type="submit" class="btn btn-outline-primary mt-2 mr-2">Change Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
