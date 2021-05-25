@extends('layouts.app')

@section('title')
	maintenance Types
@endsection

@section('extra-styles')

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<h5 class="mb-2 sub-title">maintenance Types</h5>
					<button class="btn btn-mini btn-primary float-right mb-2" data-toggle="modal" data-target="#assignVehicleModal"><i class="zmdi zmdi-car-taxi mr-2"></i> New maintenance Type</button>

					@if (session()->has('success'))
						<div class="alert alert-success background-success mt-3">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="icofont icofont-close-line-circled text-white"></i>
							</button>
							{!! session()->get('success') !!}
						</div>
					@endif
					@if (session()->has('error'))
						<div class="alert alert-warning background-warning mt-3">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="icofont icofont-close-line-circled text-white"></i>
							</button>
							{!! session()->get('error') !!}
						</div>
					@endif
					<div class="dt-responsive table-responsive">
						<table id="simpletable" class="table table-striped table-bordered nowrap">
							<thead>
							<tr>
								<th>#</th>
								<th>Maintenance Type</th>
								<th>Maintenance Interval</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@php
								$serial = 1;
							@endphp
							@foreach($maintenances as $maintenance)
								<tr>
									<td>{{$serial++}}</td>
									<td>{{$maintenance->maintenance_type_name ?? ''}}</td>
									<td>{{$maintenance->maintenance_type_interval ?? ''}} Month(s)</td>

									<td>
										<button class="btn btn-mini btn-primary" data-toggle="modal" data-target="#update{{$maintenance->id}}"><i class="ti-eye mr-2"></i> Update</button>
									</td>
								</tr>

								<div class="modal fade" id="update{{$maintenance->id}}" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header bg-primary">
												<h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i> Update maintenance Type</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true" class="text-white">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form data-parsley-validate id="assignVehicle" method="post" action="">
													@csrf

													<div class="form-group">
														<label for="">Name of maintenance</label>
														<input type="text" name="maintenance_type_name" placeholder="maintenance Type Name" value="{{$maintenance->maintenance_type_name}}"  class="form-control">
														@error('maintenance_type_name')
														<i class="text-danger">{{$message}}</i>
														@enderror

														<input type="hidden" name="id" value="{{$maintenance->id}}">

													</div>

													<div class="form-group">
														<label for="">Interval</label>
														<input type="number" step="any" name="maintenance_type_interval" placeholder="maintenance Type Name" value="{{$maintenance->maintenance_type_interval}}"  class="form-control">
														@error('maintenance_type_name')
														<i class="text-danger">{{$message}}</i>
														@enderror

													</div>
													<hr>
													<div class="form-group d-flex justify-content-center">
														<div class="btn-group">
															<input type="hidden" id="editPickupId">
															<button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
															<button type="submit" id="assignVehicleBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="ti-check mr-2"></i> Add maintenance Type</button>
														</div>
													</div>

												</form>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							</tbody>

						</table>
					</div>
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
					<h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i> Maintenance Type</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="text-white">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form data-parsley-validate id="assignVehicle" method="post" action="">
						@csrf

						<div class="form-group">
							<label for="">Name of maintenance</label>
							<input type="text" name="maintenance_type_name" placeholder="Maintenance Type Name" value="{{old('maintenance_type_name')}}"  class="form-control">
							@error('maintenance_type_name')
							<i class="text-danger">{{$message}}</i>
							@enderror

						</div>

						<div class="form-group">
							<label for="">Interval (Months)</label>
							<input type="number" step="any"  name="maintenance_type_interval" placeholder="Internal Month(s)" value="{{old('maintenance_type_interval')}}"  class="form-control">
							@error('maintenance_type_name')
							<i class="text-danger">{{$message}}</i>
							@enderror

						</div>
						<hr>
						<div class="form-group d-flex justify-content-center">
							<div class="btn-group">
								<input type="hidden" id="editPickupId">
								<button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
								<button type="submit" id="assignVehicleBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="ti-check mr-2"></i> Add maintenance Type</button>
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
		// $(document).ready(function(){
		//
		// 	$('#assignVehicle').parsley().on('field:validated', function() {
		//
		// 	}).on('form:submit', function() {
		// 		var config = {
		// 			onUploadProgress: function(progressEvent) {
		// 				var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
		// 			}
		// 		};
		// 		var form_data = new FormData();
		// 		form_data.append('driver',$('#assign_driver').val());
		// 		form_data.append('vehicle',$('#vehicleId').val());
		// 		$('#assignVehicleBtn').text('Processing...');
		// 		axios.post('/logistics/vehicle/assign',form_data, config)
		// 			.then(response=>{
		// 				$.notify(response.data.message, 'success');
		// 				$('#assignVehicleBtn').text('Done');
		// 				location.reload();
		// 				$('#assignVehicleModal').modal('hide');
		// 				setTimeout(function () {
		// 					$("#assignVehicleBtn").text("Save");
		// 					$("#simpletable").load(location.href + " #simpletable");
		// 				}, 2000);
		//
		// 			})
		// 			.catch(errors=>{
		// 				var errs = Object.values(errors.response.data.error);
		// 				$.notify(errs, "error");
		// 				$('#assignVehicleBtn').text('Error!');
		// 				setTimeout(function () {
		// 					$("#assignVehicleBtn").text("Save");
		// 				}, 2000);
		// 			});
		// 		return false;
		// 	});
		// });
	</script>
@endsection
