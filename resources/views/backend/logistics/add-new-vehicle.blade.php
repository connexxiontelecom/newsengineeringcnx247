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
                                <p><strong>NOTE:</strong> All fields marked <sup class="text-danger">*</sup> is required.</p>
                                <form action="{{route('logistics-new-vehicle')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Vehicle Image</label>
                                                <input type="file" name="image" class="form-control-file">
                                            </div>
                                        </div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<label for="">Vehicle Type</label>
																					<select name="vehicle_type"   class="form-control" required>
																						<option selected disabled>Select Vehicle Type</option>
																						@foreach ($vehicles as $vehicle)
																							<option value="{{$vehicle->id}}">{{$vehicle->vehicle_type_name ?? ''}}</option>
																						@endforeach
																					</select>

																						</div>
																			</div>
                                    </div>


																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Color<sup class="text-danger">*</sup></label>
																				<input type="text" name="color" placeholder="Color" value="{{old('color')}}"  class="form-control">
																				@error('color')
																				<i class="text-danger">{{$message}}</i>
																				@enderror
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Maker/Model<sup class="text-danger">*</sup></label>
																				<input type="text" name="make_model" placeholder="Maker/Model" value="{{old('make_model')}}"  class="form-control">
																				@error('make_model')
																				<i class="text-danger">{{$message}}</i>
																				@enderror
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Brand<sup class="text-danger">*</sup></label>
																				<input type="text" name="brand" placeholder="brand." value="{{old('brand')}}"  class="form-control">
																				@error('registration_no')
																				<i class="text-danger">{{$message}}</i>
																				@enderror
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Purchase Price<sup class="text-danger">*</sup></label>
																				<input type="text" name="purchase_price"  value="{{old('purchase_price')}}" placeholder="Purchase Price"  class="form-control">
																				@error('purchase_price')
																				<i class="text-danger">{{$message}}</i>
																				@enderror
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Engine Type<sup class="text-danger">*</sup></label>
																				<input type="text" name="engine_type" placeholder="Engine Type" value="{{old('engine_type')}}"  class="form-control">
																				@error('engine_type')
																				<i class="text-danger">{{$message}}</i>
																				@enderror
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Year :<sup class="text-danger">*</sup></label>
																				<input type="text" name="year"  value="{{old('year')}}" placeholder="year"  class="form-control">
																				@error('year')
																				<i class="text-danger">{{$message}}</i>
																				@enderror
																			</div>
																		</div>
																	</div>


																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Mileage.<sup class="text-danger">*</sup></label>
																				<input type="text" name="mileage" placeholder="Mileage" value="{{old('mileage')}}"  class="form-control">
																				@error('mileage')
																				<i class="text-danger">{{$message}}</i>
																				@enderror
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Policy Number(INSR)<sup class="text-danger">*</sup></label>
																				<input type="text" name="policy_number" value="{{old('policy_number')}}" placeholder="Policy Number"  class="form-control">
																				@error('registration_date')
																				<i class="text-danger">{{$message}}</i>
																				@enderror
																			</div>
																		</div>
																	</div>

																	<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Plate Number <sup class="text-danger">*</sup></label>
                                                <input type="text" name="plate_no" placeholder="Registration No." value="{{old('plate_no')}}"  class="form-control">
                                                @error('registration_no')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Purchase Date<sup class="text-danger">*</sup></label>
                                                <input type="text" name="purchase_date"  value="{{old('purchase_date')}}" placeholder="dd/mm/yyyy"  class="form-control">
                                                @error('purchase_date')
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
                                                <label for="">Tank Capacity.<sup class="text-danger">*</sup></label>
                                                <input type="text" name="tank_capacity" placeholder="Tank Capacity." value="{{old('tank_capacity')}}"  class="form-control">
                                                @error('engine_no')
                                                    <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <button class="btn btn-mini btn-danger" type="reset" ><i class="ti-close mr-2"></i> Cancel</button>
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
