@extends('layouts.app')

@section('title')
    Vehicle Details > {{$vehicle->owner_name ?? ''}}
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">

</div>
<div class="row">
    <div class="col-md-12">
        <!-- Product detail page start -->
        <div class="card product-detail-page">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-5 col-xs-12">
                        <div class="port_details_all_img row">
                            <div class="col-lg-12 m-b-15">
                                <div id="big_banner">
                                    <div class="port_big_img">
																			@if($vehicle->image)
                                        <img class="img img-fluid" src="/assets/uploads/logistics/vehicles/{{$vehicle->image ?? 'vehicle.png'}}" alt="{{$vehicle->owner_name ?? ''}}">
																			@else
																				<img class="img img-fluid" src="https://via.placeholder.com/728x600.png?text=No+Image+Available" alt="{{$vehicle->owner_name ?? ''}}">



																			@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xs-12 product-detail" id="product-detail">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
															@if($vehicle->status == 1)
																<button class="btn btn-mini btn-secondary float-right mb-2" data-toggle="modal" data-target="#newSchedule"><i class="zmdi zmdi-car-taxi mr-2"></i> New Maintenance Schedule</button>

																<button class="btn btn-mini btn-primary float-right mb-2" data-toggle="modal" data-target="#assignVehicleModal"><i class="zmdi zmdi-car-taxi mr-2"></i> Assign Vehicle</button>

															<button class="btn btn-mini btn-success float-right mb-2" data-toggle="modal" data-target="#assignmentLogs"><i class="zmdi zmdi-car-taxi mr-2"></i> View Assignment Logs</button>

															<button class="btn btn-mini btn-secondary float-right mb-2" data-toggle="modal" data-target="#newRenewal"><i class="zmdi zmdi-car-taxi mr-2"></i> New Renewal</button>

																 @endif
																<button class="btn btn-mini btn-info float-right mb-2" data-toggle="modal" data-target="#updateVehicle"><i class="zmdi zmdi-car-taxi mr-2"></i> Edit Vehicle</button>
																<table class="table">
                                    <tbody>
																		<tr>
																			<td class="col-lg-2"><strong>Alias:</strong></td>
																			<td class="col-lg-10">{{$vehicle->brand ?? ''}} - {{$vehicle->make_model ?? ''}} - {{$vehicle->year ?? ''}} - {{$vehicle->color ?? ''}} - {{$vehicle->plate_no ?? ''}}</td>
																		</tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Plate No.:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->plate_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Color:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->color}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Year:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->year ?? ''}}</td>
                                        </tr>

                                        <tr>
                                            <td class="col-lg-2"><strong>Assigned To:</strong></td>
                                            <td class="col-lg-10"><label class="label label-success">{{$logs[0]->first_name ?? ''}} {{$logs[0]->surname ?? ''}}</label></td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Added By:</strong></td>
                                            <td class="col-lg-10"><label class="label label-warning">{{$vehicle->addedBy->first_name ?? ''}} {{$vehicle->addedBy->surname ?? ''}}</label></td>
                                        </tr>

																		<tr>
																			<td class="col-lg-2"><strong>Status:</strong></td>
																			<td class="col-lg-10"><label class="label label-info">@if($vehicle->status == 0) {{ 'Disposed' }} @endif @if($vehicle->status == 1) {{ 'Active' }} @endif </label></td>
																		</tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                        <a href="{{route('logistics-vehicles')}}" class="btn btn-mini btn-secondary">Back To Vehicles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-8 col-lg-8 col-sm-12">
		<div class="card">
			<div class="card-block">
				<h5 class="sub-title">Document Renewal Schedules</h5>

				<table class="table table-strip">
					<thead>
					<tr>
						<th>#</th>
						<th>Type</th>
						<th>Employee Responsible</th>
						<th> Renew Date</th>
						<th>Due Date</th>


						<th>Status </th>

					</tr>
					</thead>
					<tbody>
					@php
						$i = 1;
					@endphp
					@foreach ($renewal_schedules as $renewal_schedule)
						<tr @if($renewal_schedule->renewal_schedule_date < date('Y-m-d'))  style="background-color: lightcoral" @endif>
							<td>{{$i++}} </td>
							<td>{{$renewal_schedule->renewal_type_name ?? ''}} {{$item->assignedTo->surname ?? ''}}</td>
							<td>{{$renewal_schedule->first_name ?? ''}} {{$renewal_schedule->surname ?? ''}}</td>
							<td>{{date('d F, Y', strtotime($renewal_schedule->renewal_schedule_renew_date))}} </td>
							<td>{{date('d F, Y', strtotime($renewal_schedule->renewal_schedule_date))}}</td>

							<td> @if($renewal_schedule->renewal_schedule_date > date('Y-m-d')) {{ 'Document Active' }} @else {{ ' Document Expired' }} @endif</td>

						</tr>
					@endforeach
					</tbody>

				</table>

			</div>
		</div>
	</div>
	<div class="col-md-8 col-lg-8 col-sm-12">
		<div class="card">
			<div class="card-block">
				<h5 class="sub-title">Maintenance Schedules</h5>

				<table class="table table-strip">
					<thead>
					<tr>
						<th>#</th>
						<th>Type</th>
						<th>Employee Responsible</th>
						<th>Last Activity Date</th>
						<th>Next Activity Date</th>
						<th> Status</th>

					</tr>
					</thead>
					<tbody>
					@php
						$i = 1;
					@endphp
					@foreach ($maintenance_schedules as $maintenance_schedule)
						<tr @if($maintenance_schedule->maintenance_schedule_due_date > date('Y-m-d'))  style="background-color: lightcoral" @endif>
							<td>{{$i++}}</td>
							<td>{{$maintenance_schedule->maintenance_type_name ?? ''}} {{$item->assignedTo->surname ?? ''}}</td>
							<td>{{$maintenance_schedule->first_name ?? ''}} {{$maintenance_schedule->surname ?? ''}}</td>
							<td>{{date('d F, Y', strtotime($maintenance_schedule->maintenance_schedule_date))}}</td>
							<td>{{date('d F, Y', strtotime($maintenance_schedule->maintenance_schedule_due_date))}}</td>
							<td> @if($maintenance_schedule->maintenance_schedule_due_date > date('Y-m-d')) {{ 'Not Due' }} @else {{ ' Due for Maintenance' }} @endif</td>

						</tr>
					@endforeach
					</tbody>

				</table>

			</div>
		</div>
	</div>
</div>

@endsection

@section('dialog-section')
<div class="modal fade" id="assignVehicleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i> Assign Vehicle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form data-parsley-validate id="assignVehicle">
										<div class="form-group">
											<label for="">Employee</label>
											<select name="assign_employee" id="assign_employee"   class="form-control" required>
												<option selected disabled>Select Responsible Employee</option>
												@foreach ($employees as $employee)
													<option value="{{$employee->id}}">{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</option>
												@endforeach
											</select>
										</div>
                    <div class="form-group">
                        <label for="">Drivers</label>
                        <select name="assign_driver"  id="assign_driver" class="form-control" required>
                            <option selected disabled>Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{$driver->user_id}}">{{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="vehicleId" id="vehicleId" value="{{$vehicle->id}}">
                    </div>

									<div class="form-group">
										<label for="">Reason/Purpose</label>
										<textarea class="form-control" id="reason" name="reason" placeholder="reason"></textarea>

									</div>

									<div class="form-group">
										<label for="">Due Date:</label>
										<input type="date" class="form-control" id="due_date" name="due_date" >

									</div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <input type="hidden" id="editPickupId">
                            <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                            <button type="submit" id="assignVehicleBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="ti-check mr-2"></i> Assign Vehicle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newRenewal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i> New Renewal Type</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-white">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					@csrf
					<div class="form-group">
						<label for="">Renewal Type</label>
						<select name="renewal_schedule_type_id"   class="form-control" required>
							<option selected disabled>Select Renewal Type</option>
							@foreach ($renewals as $renewal)
								<option value="{{$renewal->id}}">{{$renewal->renewal_type_name ?? ''}}</option>
							@endforeach
						</select>

						<label for="">Employee</label>
						<select name="renewal_schedule_user_id"   class="form-control" required>
							<option selected disabled>Select Responsible Employee</option>
							@foreach ($employees as $employee)
								<option value="{{$employee->id}}">{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</option>
							@endforeach
						</select>
						<label for="">Renew Date</label>
						<input type="date" name="renewal_schedule_renew_date" class="form-control" required>

						<label for="">Due Date</label>
						<input type="date" name="renewal_schedule_date" class="form-control" required>



						<input type="hidden" name="post_type" value="1">

						<input type="hidden" name="renewal_schedule_vehicle_id"  value="{{$vehicle->id}}">
					</div>
					<hr>
					<div class="form-group d-flex justify-content-center">
						<div class="btn-group">
							<input type="hidden" id="editPickupId">
							<button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
							<button type="submit" id="assignVehicleBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="ti-check mr-2"></i> Add </button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="newSchedule" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i>Schedule Maintenance</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-white">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					@csrf
					<div class="form-group">

						<label for="">Last Activity Date</label>
						<input type="date" name="maintenance_schedule_date" id="activity_date"  class="form-control" required>

						<label for="">Maintenance Type</label>
						<select name="maintenance_schedule_type_id"  id="maintenance_id" class="form-control" required>
							<option selected>Select Maintenance Type</option>
							@foreach ($maintenances as $maintenance)
								<option value="{{$maintenance->id}}" data-foo="{{$maintenance->maintenance_type_interval}}">{{$maintenance->maintenance_type_name ?? ''}} (Every {{$maintenance->maintenance_type_interval ?? ''}} month(s)</option>
							@endforeach
						</select>

						<label for="">Employee</label>
						<select name="maintenance_schedule_user_id"   class="form-control" required>
							<option selected disabled>Select Responsible Employee</option>
							@foreach ($employees as $employee)
								<option value="{{$employee->id}}">{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</option>
							@endforeach
						</select>


						<label for="">Next Activity Date</label>
						<input type="text" name="maintenance_schedule_due_date" id="next_activity_date" class="form-control" readonly required>

						<input type="hidden" name="post_type" value="2">

						<input type="hidden" name="maintenance_schedule_vehicle_id"  value="{{$vehicle->id}}">
					</div>
					<hr>
					<div class="form-group d-flex justify-content-center">
						<div class="btn-group">
							<input type="hidden" id="editPickupId">
							<button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
							<button type="submit" id="assignVehicleBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="ti-check mr-2"></i> Add </button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>




<div class="modal modal-lg fade" id="assignmentLogs" tabindex="-1" role="dialog">
	<div class="modal-lg modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i> Vehicle Assignment Logs</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-white">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="card">
							<div class="card-block">
								<h5 class="sub-title">Vehicle Assignment Log</h5>

								<table class="table table-strip">
									<thead>
									<tr>
										<th>#</th>
										<th>Driver</th>
										<th> Reason </th>
										<th>Assignment Date</th>
{{--										<th>Assigned By</th>--}}
										<th>Due Date</th>
									</tr>
									</thead>
									<tbody>
									@php
										$i = 1;
									@endphp
									@foreach ($logs as $item)
										<tr>
											<td>{{$i++}}</td>
											<td>{{$item->first_name ?? ''}} {{$item->surname ?? ''}}</td>
											<td>{{$item->reason ?? ''}}</td>
{{--											<td>{{$item->assignedBy->first_name ?? ''}} {{$item->assignedBy->surname ?? ''}}</td>--}}
											<td>{{date('d F, Y', strtotime($item->created_at))}}</td>
											<td>{{date('d F, Y', strtotime($item->due_date))}}</td>
										</tr>
									@endforeach
									</tbody>

								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="updateVehicle" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i> Update Vehicle</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-white">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{route('logistics-new-vehicle')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
{{--						<div class="col-md-6">--}}
{{--							<div class="form-group">--}}
{{--								<label for="">Vehicle Image</label>--}}
{{--								<input type="file" name="image" class="form-control-file">--}}
{{--							</div>--}}
{{--						</div>--}}
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Status</label>
								<select name="status"   class="form-control" required>
									<option selected disabled>Select Status</option>

										<option value="1" @if($vehicle->status == 1) {{ 'selected' }} @endif>Active</option>
									<option value="0" @if($vehicle->status == 0) {{ 'selected' }} @endif>Disposed</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Vehicle Type</label>
								<select name="vehicle_type"   class="form-control" required>
									<option selected disabled>Select Vehicle Type</option>
									@foreach ($vehicles as $veh)
										<option value="{{$veh->id}}" @if($veh->id == $vehicle->type) {{ 'selected' }} @endif>{{$veh->vehicle_type_name ?? ''}}</option>
									@endforeach
								</select>

							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Color<sup class="text-danger">*</sup></label>
								<input type="text" name="color" placeholder="Color" value="{{ $vehicle->color ?? ' ' }}"  class="form-control">
								@error('color')
								<i class="text-danger">{{$message}}</i>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Maker/Model<sup class="text-danger">*</sup></label>
								<input type="text" name="make_model" placeholder="Maker/Model" value="{{ $vehicle->make_model ?? ' ' }}"  class="form-control">
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
								<input type="text" name="brand" placeholder="brand." value="{{ $vehicle->brand ?? ' ' }}"  class="form-control">
								@error('registration_no')
								<i class="text-danger">{{$message}}</i>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Purchase Price<sup class="text-danger">*</sup></label>
								<input type="text" name="purchase_price"  value="{{ $vehicle->purchase_price ?? ' ' }}" placeholder="Purchase Price"  class="form-control">
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
								<input type="text" name="engine_type" placeholder="Engine Type" value="{{ $vehicle->engine_type ?? ' ' }}"  class="form-control">
								@error('engine_type')
								<i class="text-danger">{{$message}}</i>
								@enderror
							</div>
						</div>

						<input type="hidden" name="id" value="{{ $vehicle->id }}">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Year :<sup class="text-danger">*</sup></label>
								<input type="text" name="year"  value="{{ $vehicle->year ?? ' ' }}" placeholder="year"  class="form-control">
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
								<input type="text" name="mileage" placeholder="Mileage" value="{{ $vehicle->mileage ?? ' ' }}"  class="form-control">
								@error('mileage')
								<i class="text-danger">{{$message}}</i>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Policy Number(INSR)<sup class="text-danger">*</sup></label>
								<input type="text" name="policy_number" value="{{ $vehicle->policy_number ?? ' ' }}" placeholder="Policy Number"  class="form-control">
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
								<input type="text" name="plate_no" placeholder="Plate No." value="{{ $vehicle->plate_no ?? ' ' }}"  class="form-control">
								@error('registration_no')
								<i class="text-danger">{{$message}}</i>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Purchase Date<sup class="text-danger">*</sup></label>
								<input type="text" name="purchase_date"  value="{{ $vehicle->purchase_date ?? ' ' }}" placeholder="dd/mm/yyyy"  class="form-control">
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
								<input type="text" name="chassis_no" placeholder="Chassis No." value="{{ $vehicle->chassis_no ?? ' ' }}"  class="form-control">
								@error('chassis_no')
								<i class="text-danger">{{$message}}</i>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Tank Capacity.<sup class="text-danger">*</sup></label>
								<input type="text" name="tank_capacity" placeholder="Tank Capacity." value="{{ $vehicle->tank_capacity ?? ' ' }}"  class="form-control">
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
@endsection

@section('extra-scripts')
<script>

	$(function(){
		$('#maintenance_id').change(function() {
			let activity_date = $('#activity_date').val();
			if (activity_date == null) {
				alert('Please Enter Last Activity Date')
			} else{
				var selected = $(this).find('option:selected');
			var maintenance_interval = selected.data('foo');

			activity_date = new Date(activity_date);
			let next_date = activity_date.setDate(activity_date.getDate() + (maintenance_interval * 30));
			next_date = new Date(next_date)
			$('#next_activity_date').val(next_date.toLocaleDateString())
		}

		});
	});

	// function changeDate(){
	// 	let maintenance_interval = document.getElementById('maintenance_id').data('foo');
	//
	//
	//
	// }
    $(document).ready(function(){

    $('#assignVehicle').parsley().on('field:validated', function() {

    }).on('form:submit', function() {
    var config = {
                onUploadProgress: function(progressEvent) {
                var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                }
        };
        var form_data = new FormData();
        form_data.append('driver',$('#assign_driver').val());
        form_data.append('vehicle',$('#vehicleId').val());
        form_data.append('reason', $('#reason').val());
			form_data.append('due_date', $('#due_date').val());
			form_data.append('assign_employee', $('#assign_employee').val());
        $('#assignVehicleBtn').text('Processing...');
        axios.post('/logistics/vehicle/assign',form_data, config)
        .then(response=>{
            $.notify(response.data.message, 'success');
            $('#assignVehicleBtn').text('Done');
            location.reload();
            $('#assignVehicleModal').modal('hide');
            setTimeout(function () {
                $("#assignVehicleBtn").text("Save");
                $("#simpletable").load(location.href + " #simpletable");
            }, 2000);

        })
        .catch(errors=>{
            var errs = Object.values(errors.response.data.error);
            $.notify(errs, "error");
            $('#assignVehicleBtn').text('Error!');
            setTimeout(function () {
                $("#assignVehicleBtn").text("Save");
            }, 2000);
        });
        return false;
        });
    });
</script>
@endsection
