@extends('layouts.app')

@section('title')
    Employees
@endsection

@section('extra-styles')
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

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
		<div class="col-sm-12">
			<div class="card card-border-primary">
				<div class="card-block">
					@if(session()->has('success'))
						<div class="alert alert-success background-success">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="icofont icofont-close-line-circled text-white"></i>
							</button>
							{!! session()->get('success') !!}
						</div>
					@endif
					<div class="dt-responsive table-responsive">
						<table id="simpletable" class="table table-striped table-bordered nowrap">
							<thead>
							<tr>
								<th>#</th>
								<th>Full Name</th>
								<th>Department</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@php
								$serial = 1;
							@endphp
							@if (count($employees) > 0)
								@foreach ($employees as $emp)
									<tr>
										<td>{{$serial++}}</td>
										<td>
											<img height="32" width="32" style="border-radius: 50%;" class="img-fluid img-radius" src="/assets/images/avatars/medium/{{$emp->avatar ?? '/assets/images/avatars/medium/avatar.png'}}" alt="{{$emp->first_name ?? ''}}  {{$emp->surname ?? ''}}">
											<a href="{{route('view-profile', $emp->url)}}">{{$emp->first_name ?? ''}}  {{$emp->surname ?? ''}}</a>
										</td>
										<td>{{$emp->department->department_name ?? ''}}</td>
										<td>{{$emp->email ?? ''}}</td>
										<td>{{$emp->mobile ?? ''}}</td>
										<td>
											<div class="btn-group ">
												<a href="{{route('view-profile', $emp->url)}}" class="btn btn-primary btn-mini mb-2"><i class="icofont icofont-eye-alt"></i></a>
												<a href="javascript:void(0);" data-toggle="modal" data-target="#editProfile_{{$emp->id}}" class="btn btn-warning btn-mini "><i class="icofont icofont-pencil-alt-5"></i></a>
											</div>
											<div class="modal fade" id="editProfile_{{$emp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h6 class="modal-title" id="editProfileTitle_{{$emp->id}}">Edit {{$emp->first_name ?? ''}}'s Details</h6>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form action="{{route('update-employee-record')}}" method="post">
																@csrf
																<div class="row">
																	<div class="col-md-10">
																		<div class="form-group">
																			<label for="">First Name</label>
																			<input type="text" placeholder="First Name" name="first_name" value="{{$emp->first_name ?? ''}}" class="form-control col-md-12">
																		</div>
																	</div>
																	<div class="col-md-10">
																		<div class="form-group">
																			<label for="">Surname</label>
																			<input type="text" placeholder="Surname" name="surname" value="{{$emp->surname ?? ''}}" class="form-control  col-md-12">
																		</div>
																	</div>
																	<div class="col-md-10">
																		<div class="form-group">
																			<label for="">Mobile No.</label>
																			<input type="text" placeholder="Mobile No." name="mobile_no" value="{{$emp->mobile ?? ''}}" class="form-control  col-md-12">
																		</div>
																	</div>
																	<div class="col-md-10">
																		<div class="form-group">
																			<label for="">Department</label>
																			<select name="department" id="department" class="form-control">
																				<option selected disabled>--Select department--</option>
																				@foreach($departments as $department)
																					<option value="{{$department->id}}" {{$department->id == $emp->department_id ? 'selected' : ''}}>{{$department->department_name ?? ''}}</option>
																				@endforeach
																			</select>

																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-10">
																		<div class="form-group">
																			<label for="">Hire Date</label>
																			<input type="date" placeholder="Hire Date" name="hire_date" value="{{$emp->hire_date ?? ''}}" class="form-control  col-md-12">
																			<label for="" class="label label-info">{{!is_null($emp->hire_date) ? date('d M, Y', strtotime($emp->hire_date)) : '' }}</label>
																		</div>
																	</div>
																	<div class="col-md-10">
																		<div class="form-group">
																			<label for="">Confirm Date</label>
																			<input type="date" placeholder="Confirm Date" name="confirm_date" value="{{$emp->confirm_date ?? ''}}" class="form-control  col-md-12">
																			<label for="" class="label label-info">{{!is_null($emp->confirm_date) ? date('d M, Y', strtotime($emp->confirm_date)) : '' }}
																		</div>
																		<input type="hidden" value="{{$emp->id}}" name="employee">
																	</div>
																	<div class="col-md-10">
																		<div class="form-group">
																			<label for="">Birth Date</label>
																			<input type="date" placeholder="Birth Date" name="birth_date" value="{{$emp->birth_date ?? ''}}" class="form-control  col-md-12">
																			<label for="" class="label label-info">{{!is_null($emp->birth_date) ? date('d M, Y', strtotime($emp->birth_date)) : '' }}
																		</div>
																		<input type="hidden" value="{{$emp->id}}" name="employee">
																	</div>
																</div>
																<hr>
																<div class="row float-right">
																	<div class="col-md-12">
																		<div class="btn-group">
																			<button type="button" class="btn btn-secondary btn-mini" data-dismiss="modal">Close</button>
																			<button type="submit" class="btn btn-primary btn-mini">Save changes</button>
																		</div>
																	</div>
																</div>
															</form>

														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
								@endforeach
							@endif
							</tbody>
							<tfoot>
							<tr>
								<th>#</th>
								<th>Full Name</th>
								<th>Department</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Action</th>
							</tr>
							</tfoot>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
	<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
	<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
	<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
