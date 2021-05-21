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
																			<label>Employees<sup class="text-danger">*</sup></label>
																			<select name="user_id" id="" class="form-control">
																				<option selected disabled >Select Employee</option>
																			@foreach($employees as $employee)
																				<option value="{{$employee->id}}"> {{ $employee->first_name }} {{ $employee->surname }}</option>
																				@endforeach
																			</select>
																			@error('user_id')
																			<i class="text-danger">{{$message}}</i>
																			@enderror
																		</div>

																		<div class="col-md-6">
																			<label>Means of Identification<sup class="text-danger">*</sup></label>
																			<select name="means_of_identification" id="" class="form-control">
																				<option selected disabled >Select MOI</option>
																				<option value="1">International Passport</option>
																				<option value="2">Driver's license</option>
																				<option value="3">National ID Card</option>
																				<option value="4">Others</option>
																			</select>
																			@error('means_of_identification')
																			<i class="text-danger">{{$message}}</i>
																			@enderror
																		</div>

																	</div>

																	<div class="row">
																		<div class="col-md-6">
																			<label>License Expiry Date<sup class="text-danger">*</sup></label>
																			<input type="date" name="license_date" class="form-control">
																			@error('user_id')
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
