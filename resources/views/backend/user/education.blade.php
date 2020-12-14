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
            @include('livewire.backend.user.common._user-settings-slab')
            <div class="tab-content tabs-left-content card-block col-md-12">
                <div class="tab-pane active"  role="tabpanel">
                    <form action="{{route('education')}}" method="post">
                        @if (session()->has('success'))
                            <div class="alert alert-success background-success mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                {!! session()->get('success') !!}
                            </div>
                        @endif
                        @csrf
                        <div class="form-wrapper">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-mini btn-danger float-right remove_section"  type="button"> <i class="ti-trash"></i> </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Institution Name</label>
                                    <input type="text" name="institution_name[]" placeholder="Institution Name" class="form-control">
                                    @error('institution_name')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Program</label>
                                    <input type="text" name="program[]" placeholder="Program" class="form-control">
                                    @error('program')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Qualification</label>
                                    <select name="qualification[]" class="form-control">
                                        @foreach ($qualifications as $qualification)
                                            <option value="{{$qualification->id}}">{{$qualification->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('qualification')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Start Date</label>
                                    <input type="date" name="start_date[]" placeholder="Start Date" class="form-control">
                                    @error('start_date')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="">End Date</label>
                                    <input type="date" name="end_date[]" placeholder="End Date" class="form-control">
                                    @error('end_date')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="">Address</label>
                                    <input type="address" name="address[]" placeholder="Address" class="form-control">
                                    @error('address')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button class="btn btn-mini btn-success" id="add_section" type="button"> <i class="ti-plus"></i> </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"> <i class="ti-close mr-2"></i> Cancel</a>
                                    <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Save Record</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
