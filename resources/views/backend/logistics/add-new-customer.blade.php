@extends('layouts.app')

@section('title')
    Add New Customer
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.logistics.common._logistics-slab')
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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Add New Customer</h5>
                                <p><strong>NOTE:</strong> All fields marked <sup class="text-danger">*</sup> is requird.</p>
                                <form action="{{route('store-logistic-customer')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Full Name<sup class="text-danger">*</sup></label>
                                                <input type="text" name="full_name" placeholder="Full Name" value="{{old('full_name')}}"  class="form-control">
                                                @error('full_name')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email Address<sup class="text-danger">*</sup></label>
                                                <input type="email" name="email" value="{{old('email')}}" placeholder="Email"  class="form-control">
                                                @error('email')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Mobile No.<sup class="text-danger">*</sup></label>
                                                <input type="text" name="mobile_no" placeholder="Mobile No." value="{{old('mobile_no')}}"  class="form-control">
                                                @error('mobile_no')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Address<sup class="text-danger">*</sup></label>
                                                <textarea class="form-control" placeholder="Address" name="address" style="resize:none;"></textarea>
                                                @error('address')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Gender<sup class="text-danger">*</sup></label>
                                                <select name="gender" id="" class="form-control col-md-6">
                                                    <option selected disabled >Select gender</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Male</option>
                                                </select>
                                                @error('gender')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <button class="btn btn-mini btn-danger" ><i class="ti-close mr-2"></i> Cancel</button>
                                                <button class="btn btn-mini btn-primary" type="submit" ><i class="ti-check mr-2"></i> Submit</button>
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
    </div>
</div>
@endsection

@section('extra-scripts')

@endsection
