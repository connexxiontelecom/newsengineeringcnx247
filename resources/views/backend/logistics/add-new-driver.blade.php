@extends('layouts.app')

@section('title')
    Add New Driver
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
                                <h5 class="sub-title">Add New Driver</h5>
                                <p><strong>NOTE:</strong> All fields marked <sup class="text-danger">*</sup> is requird.</p>
                                <form action="{{route('new-driver')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">First Name<sup class="text-danger">*</sup></label>
                                                <input type="text" name="first_name" placeholder="First Name" value="{{old('first_name')}}"  class="form-control">
                                                @error('first_name')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Surname<sup class="text-danger">*</sup></label>
                                                <input type="text" name="surname" value="{{old('surname')}}" placeholder="Surname"  class="form-control">
                                                @error('surname')
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
                                                <label for="">Email<sup class="text-danger">*</sup></label>
                                                <input type="text" name="email" placeholder="Email address" value="{{old('email')}}"  class="form-control">
                                                @error('email')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Gender<sup class="text-danger">*</sup></label>
                                                <select name="gender" id="" class="form-control">
                                                    <option selected disabled >Select gender</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                                @error('gender')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Location<sup class="text-danger">*</sup></label>
                                                <select name="location" id="" class="form-control">
                                                    <option selected disabled >Select Location</option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{$location->id}}">{{$location->location ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('location')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Driver ID No.<sup class="text-danger">*</sup></label>
                                                <input type="number"  class="form-control" placeholder="Driver ID No." name="driver_no" value="{{old('driver_no')}}">
                                                @error('driver_no')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Means of Identification<sup class="text-danger">*</sup></label>
                                            <select name="means_of_identification" id="" class="form-control col-md-6">
                                                <option selected disabled >Select Means of Identification</option>
                                                <option value="1">International Passport</option>
                                                <option value="2">Driver's license</option>
                                                <option value="3">National ID Card</option>
                                                <option value="4">Others</option>
                                            </select>
                                            @error('means_of_identification')
                                                <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>MOI Attachment<sup class="text-danger">*</sup></label>
                                            <input type="file" class="form-control-file" name="moi_attachment">
                                            @error('moi_attachment')
                                                <i class="text-danger">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <textarea name="address" class="form-control" style="resize: none;" placeholder="Driver address...">{{old('address')}}</textarea>
                                                @error('address')
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
