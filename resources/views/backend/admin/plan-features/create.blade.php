@extends('layouts.app')

@section('title')
    Add New Plan & Features
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
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('backend.admin.common._nav-slab')
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h4 class="sub-title">Add New Plan & Features</h4>
                <div class="btn-group d-flex justify-content-end">
                    <a href="{{route('new-plans-n-features')}}" class="btn btn-primary btn-mini"> <i class="ti-plus mr-2"></i> Add New Plan</a>
                            <a href="{{route('plans-n-features')}}" class="btn btn-danger btn-mini"> <i class="ti-import mr-2"></i> View Plans</a>
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
        <form action="{{route('new-plans-n-features')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">Plan Name</label>
                        <select name="plan_name" class="form-control" value="{{old('plan_name')}}">
                            <option disabled selected>Select plan name</option>
                            @foreach ($plans as $plan)
                                <option value="{{$plan->id}}">{{$plan->name}}</option>
                            @endforeach
                        </select>
                        @error('plan_name')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Duration</label>
                        <input type="number" name="duration" placeholder="Duration" class="form-control" value="{{old('duration')}}">
                        @error('duration')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                        <br>
                        <p><strong class="text-danger">Note:</strong> 0-30 will be regarded as one month, 31-90 as 3 months/quarterly plan while 365 as one year(for annual plan)</p>
                    </div>
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="text" name="amount" placeholder="Amount" class="form-control" value="{{old('amount')}}">
                        @error('amount')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Currency</label>
                        <select name="currency" class="form-control">
                            <option disabled selected>Select currency</option>
                            @foreach ($currencies as $currency)
                              <option value="{{$currency->id}}">{{$currency->name}} ({{$currency->symbol}})</option>
                            @endforeach
                        </select>
                        @error('currency')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="">Number of Emails</label>
                        <input type="number" name="emails" placeholder="Number of Emails" class="form-control" value="{{old('emails')}}">
                        @error('emails')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Number of SMS</label>
                        <input type="number" name="sms" placeholder="Number of SMS" class="form-control" value="{{old('sms')}}">
                        @error('sms')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Call Duration</label>
                        <input type="number" name="call_duration" placeholder="Call Duration" class="form-control" value="{{old('call_duration')}}">
                        @error('call_duration')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Number of Users</label>
                        <input type="number" name="number_of_users" placeholder="Number of Users" class="form-control" value="{{old('number_of_users')}}">
                        @error('number_of_users')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Storage Size</label>
                        <input type="number" name="storage_size" placeholder="Storage Size" class="form-control" value="{{old('storage_size')}}">
                        @error('storage_size')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">CNXStream Duration</label>
                        <input type="number" name="cnxstream_duration" placeholder="CNXStream Duration" class="form-control" value="{{old('cnxstream_duration')}}">
                        @error('cnxstream_duration')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" rows="10" style="resize: none;" placeholder="Brief Description" value="{{old('description')}}"></textarea>
                        @error('description')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="btn-group d-flex justify-content-center">
                            <a href="{{url()->previous()}}" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                            <button type="submit" class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@endsection
