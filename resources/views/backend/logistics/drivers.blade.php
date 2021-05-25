@extends('layouts.app')

@section('title')
    Drivers
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<h5 class="mb-2 sub-title">Drivers</h5>
					<a href="{{route('new-driver')}}" class="btn btn-primary btn-mini float-right mb-3"><i class="ti-plus"></i>Add New Driver</a>

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
								<th>Driver Name</th>
								<th>Email</th>
								<th>License Expiry Date</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@php
								$serial = 1;
							@endphp
							@foreach ($drivers as $driver)
								@if($driver->account_status != 2)
								<tr>
									<td>{{$serial++}}</td>
									<td>{{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</td>
									<td>
										{{$driver->email ?? ''}}
									</td>

									<td>
										{{ $driver->license_date }}
									</td>

									<td>
										<div class="btn-group">
											<button class="btn btn-mini btn-primary" data-toggle="modal" data-target="#update{{$driver->user_id}}"><i class="ti-eye mr-2"></i> Update</button>

												</div>
									</td>
								</tr>
								@endif


								<div class="modal fade" id="update{{$driver->id}}" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header bg-primary">
												<h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i> Update {{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true" class="text-white">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="{{route('new-driver')}}" method="post" enctype="multipart/form-data">
													@csrf

													<div class="row">


														<div class="col-md-6">
															<label>Means of Identification<sup class="text-danger">*</sup></label>
															<select name="means_of_identification" id="" class="form-control">

																<option value="2" selected>Driver's license</option>

															</select>
															@error('means_of_identification')
															<i class="text-danger">{{$message}}</i>
															@enderror
														</div>

													</div>

													<div class="row">
														<div class="col-md-6">
															<label>License Expiry Date<sup class="text-danger">*</sup></label>
															<input type="date" name="license_date" value="{{ $driver->license_date }}" class="form-control">
															@error('user_id')
															<i class="text-danger">{{$message}}</i>
															@enderror
														</div>

														<input type="hidden" name="user_id" value="{{ $driver->user_id }}">


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
							@endforeach
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

<script src="\assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
<script src="\assets\pages\data-table\js\jszip.min.js"></script>
<script src="\assets\pages\data-table\js\pdfmake.min.js"></script>
<script src="\assets\pages\data-table\js\vfs_fonts.js"></script>
<script src="\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
<script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
