@extends('layouts.app')

@section('title')
    Add New Vehicle
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/cus/datetimepicker.min.css">
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
                                <h5 class="sub-title">Add New Vehicle</h5>
                                <p><strong>NOTE:</strong> All fields marked <sup class="text-danger">*</sup> is requird.</p>
                                <form action="{{route('logistics-new-vehicle')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Vehicle Image</label>
                                                <input type="file" name="image" class="form-control-file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Registration No.<sup class="text-danger">*</sup></label>
                                                <input type="text" name="registration_no" placeholder="Registration No." value="{{old('registration_no')}}"  class="form-control">
                                                @error('registration_no')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Registration Date<sup class="text-danger">*</sup></label>
                                                <input type="text" name="registration_date" id="registration_date" value="{{old('registration_date')}}" placeholder="dd/mm/yyyy"  class="form-control">
                                                @error('registration_date')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Chassis No.<sup class="text-danger">*</sup></label>
                                                <input type="text" name="chassis_no" placeholder="Chassis No." value="{{old('chassis_no')}}"  class="form-control">
                                                @error('chassis_no')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Engine No.<sup class="text-danger">*</sup></label>
                                                <input type="text" name="engine_no" placeholder="Engine No." value="{{old('engine_no')}}"  class="form-control">
                                                @error('engine_no')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Owner Name<sup class="text-danger">*</sup></label>
                                                <input type="text" name="owner_name" placeholder="Owner Name" value="{{old('owner_name')}}"  class="form-control">
                                                @error('owner_name')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Maker/Model<sup class="text-danger">*</sup></label>
                                                <input type="text" name="maker_model" placeholder="Maker/Model" value="{{old('maker_model')}}"  class="form-control">
                                                @error('maker_model')
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
<script type="text/javascript" src="/assets/js/cus/moment.js"></script>
<script type="text/javascript" src="/assets/js/cus/datetimepicker.js"></script>
<script>
	$(document).ready(function(){
		$('#registration_date').datetimepicker();
	});
</script>
@endsection
