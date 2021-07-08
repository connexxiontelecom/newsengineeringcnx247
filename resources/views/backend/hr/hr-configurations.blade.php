@extends('layouts.app')

@section('title')
	HR Configurations
@endsection

@section('extra-styles')

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12 col-xl-12">
			<div class="card">
				<div class="card-block">
					@include('livewire.backend.hr.common._slab-menu')
				</div>
			</div>
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
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-header-text">HR Configurations</h5>
								</div>
								<div class="card-block accordion-block">
									<div id="accordion" role="tablist" aria-multiselectable="true">
										<div class="accordion-panel">
											<div class="accordion-heading" role="tab" id="headingDepartment">
												<h3 class="card-title accordion-title">
													<a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDepartment" aria-expanded="false" aria-controls="collapseDepartment">
														Departments
													</a>
												</h3>
											</div>
											<div id="collapseDepartment" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingDepartment" style="">
												<div class="accordion-content accordion-desc">
													<div class="row">
														<div class="col-md-4">
															<div class="card">
																<div class="card-header">
																	<h5 class="sub-title">Add New Department</h5>
																</div>
																<div class="card-block">
																	<form action="{{route('add-new-department')}}" method="post">
																		@csrf
																		<div class="form-group">
																			<label for="">Department Name</label>
																			<input type="text" class="form-control" placeholder="Department Name" name="department_name">
																			@error('department_name')
																			<i class="text-danger mt-2">{{$message}}</i>
																			@enderror
																		</div>
																		<div class="form-group d-flex justify-content-center">
																			<button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> Submit</button>
																		</div>
																	</form>

																</div>
															</div>
														</div>
														<div class="col-md-8">
															<div class="card">
																<div class="card-header">
																	<h5 class="sub-title">Departments</h5>
																</div>
																<div class="card-block">
																	<div class="table-responsive">
																		<table class="table table-bordered">
																			<thead>
																			<th>#</th>
																			<th>Departments</th>
																			<th>Date</th>
																			<th>Action</th>
																			</thead>
																			<tbody>
																			@php
																				$i = 1;
																			@endphp
																			@foreach ($departments as $depart)
																				<tr>
																					<td>{{$i++}}</td>
																					<td>{{$depart->department_name ?? ''}}</td>
																					<td>{{date('d F, Y', strtotime($depart->created_at)) ?? ''}} @ <small>{{date('h:ia', strtotime($depart->created_at))}}</small></td>
																					<td>
																						<a href="javascript:void(0);" data-toggle="modal" data-target="#editDepartment_{{$depart->id}}"> <i class="ti-pencil text-warning"></i> </a>
																						<div class="modal fade" id="editDepartment_{{$depart->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																							<div class="modal-dialog" role="document">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h5 class="modal-title" id="exampleModalLabel">Edit {{$depart->department_name ?? ''}}</h5>
																										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																											<span aria-hidden="true">&times;</span>
																										</button>
																									</div>
																									<div class="modal-body">
																										<form action="{{route('update-department')}}" method="post">
																											@csrf
																											<div class="form-group">
																												<label for="">Department Name</label>
																												<input type="text" class="form-control" value="{{$depart->department_name ?? ''}}" placeholder="Department Name" name="department_name">
																												@error('department_name')
																												<i class="text-danger mt-2">{{$message}}</i>
																												@enderror
																												<input type="hidden" name="department" value="{{$depart->id}}">
																											</div>
																											<div class="form-group d-flex justify-content-center">
																												<button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> Save changes</button>
																											</div>
																										</form>
																									</div>
																								</div>
																							</div>
																						</div>
																					</td>
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
										<div class="accordion-panel">
											<div class="accordion-heading" role="tab" id="headingSupervisors">
												<h3 class="card-title accordion-title">
													<a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSupervisors" aria-expanded="false" aria-controls="collapseSupervisors">
														Supervisors
													</a>
												</h3>
											</div>
											<div id="collapseSupervisors" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSupervisors" style="">
												<div class="accordion-content accordion-desc">
													<div class="row">
														<div class="col-md-4">
															<div class="card">
																<div class="card-header">
																	<h5 class="sub-title">Add New Supervisor</h5>
																</div>
																<div class="card-block">
																	<form action="{{route('add-new-supervisor')}}" method="post">
																		@csrf
																		<div class="form-group">
																			<label for="">Department</label>
																			<select name="department" class="form-control">
																				<option disabled selected>Select department</option>
																				@foreach ($departments as $department)
																					<option value="{{$department->id}}">{{$department->department_name ?? '' }}</option>
																				@endforeach
																			</select>
																			@error('department')
																			<i class="text-danger mt-2">{{$message}}</i>
																			@enderror
																		</div>
																		<div class="form-group">
																			<label for="">Employee</label>
																			<select name="supervisor" class="form-control">
																				<option disabled selected>Select supervisor</option>
																				@foreach ($employees as $employee)
																					<option value="{{$employee->id}}">{{$employee->first_name }} {{$employee->surname ?? ''}}</option>
																				@endforeach
																			</select>
																			@error('department')
																			<i class="text-danger mt-2">{{$message}}</i>
																			@enderror
																		</div>
																		<div class="form-group d-flex justify-content-center">
																			<button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> Submit </button>
																		</div>
																	</form>

																</div>
															</div>
														</div>
														<div class="col-md-8">
															<div class="card">
																<div class="card-header">
																	<h5 class="sub-title">Supervisors</h5>
																</div>
																<div class="card-block">
																	<div class="table-responsive">
																		<table class="table table-bordered">
																			<thead>
																			<th>#</th>
																			<th>Supervisor</th>
																			<th>Department</th>
																			<th>Action</th>
																			</thead>
																			<tbody>
																			@php
																				$i = 1;
																			@endphp
																			@foreach ($supervisors as $super)
																				<tr>
																					<td>{{$i++}}</td>
																					<td>{{$super->user->first_name ?? ''}} {{$super->user->surname ?? ''}}</td>
																					<td>{{$super->department->department_name ?? ''}}</td>
																					<td>
																						<a href="javascript:void(0);" data-toggle="modal" data-target="#editSupervisorModal_{{$super->id}}" > <i class="ti-pencil text-warning"></i> </a>
																						<div class="modal fade" id="editSupervisorModal_{{$super->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																							<div class="modal-dialog" role="document">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h5 class="modal-title" id="exampleModalLabel">Edit Supervisor</h5>
																										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																											<span aria-hidden="true">&times;</span>
																										</button>
																									</div>
																									<div class="modal-body">
																										<form action="{{route('update-supervisor')}}" method="post">
																											@csrf
																											<div class="form-group">
																												<label for="">Department</label>
																												<select name="department" class="form-control">
																													<option disabled selected>Select department</option>
																													@foreach ($departments as $department)
																														<option value="{{$department->id}}" {{$department->id == $super->department->id ? 'selected' : ''}}>{{$department->department_name ?? '' }}</option>
																													@endforeach
																												</select>
																												@error('department')
																												<i class="text-danger mt-2">{{$message}}</i>
																												@enderror
																											</div>
																											<div class="form-group">
																												<label for="">Employee</label>
																												<select name="supervisor" class="form-control">
																													<option disabled selected>Select supervisor</option>
																													@foreach ($employees as $employee)
																														<option value="{{$employee->id}}" {{$employee->id == $super->user->id ? 'selected' : ''}}>{{$employee->first_name }} {{$employee->surname ?? ''}}</option>
																													@endforeach
																												</select>
																												@error('department')
																												<i class="text-danger mt-2">{{$message}}</i>
																												@enderror
																												<input type="hidden" name="position" value="{{$super->id}}">
																											</div>
																											<div class="form-group d-flex justify-content-center">
																												<button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> Save changes </button>
																											</div>
																										</form>
																									</div>
																								</div>
																							</div>
																						</div>
																					</td>
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
										<div class="accordion-panel">
											<div class=" accordion-heading" role="tab" id="headingJobRole">
												<h3 class="card-title accordion-title">
													<a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseJobRole" aria-expanded="true" aria-controls="collapseJobRole">
														Job Role
													</a>
												</h3>
											</div>
											<div id="collapseJobRole" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingJobRole" style="">
												<div class="accordion-content accordion-desc">
													<div class="row">
														<div class="col-md-4">
															<div class="card">
																<div class="card-header">
																	<h5 class="sub-title">Add New Job Role</h5>
																</div>
																<div class="card-block">
																	<form action="{{route('add-new-job-role')}}" method="post">
																		@csrf
																		<div class="form-group">
																			<label for="">Job Role</label>
																			<input type="text" name="job_role" class="form-control" placeholder="Job Role">
																			@error('job_role')
																			<i class="text-danger mt-2">{{$message}}</i>
																			@enderror
																		</div>
																		<div class="form-group">
																			<label for="">Department</label>
																			<select name="department" class="form-control">
																				<option disabled selected>Select department</option>
																				@foreach ($departments as $department)
																					<option value="{{$department->id}}">{{$department->department_name ?? '' }}</option>
																				@endforeach
																			</select>
																			@error('department')
																			<i class="text-danger mt-2">{{$message}}</i>
																			@enderror
																		</div>
																		<div class="form-group">
																			<label for="">Role Description</label>
																			<textarea name="role_description" placeholder="Job description" style="resize: none;" cols="30" rows="10" class="form-control"></textarea>
																			@error('role_description')
																			<i class="text-danger mt-2">{{$message}}</i>
																			@enderror
																		</div>
																		<div class="form-group d-flex justify-content-center">
																			<button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> Submit</button>
																		</div>
																	</form>

																</div>
															</div>
														</div>
														<div class="col-md-8">
															<div class="card">
																<div class="card-header">
																	<h5 class="sub-title">Job Roles</h5>
																</div>
																<div class="card-block">
																	<div class="table-responsive">
																		<table class="table table-bordered">
																			<thead>
																			<th>#</th>
																			<th>Job Role</th>
																			<th>Department</th>
																			<th>Action</th>
																			</thead>
																			<tbody>
																			@php
																				$i = 1;
																			@endphp
																			@foreach ($job_roles as $role)
																				<tr>
																					<td>{{$i++}}</td>
																					<td>{{$role->role_name}}</td>
																					<td>{{$role->department->department_name}}</td>
																					<td>
																						<a href="javascript:void(0);" data-toggle="modal" data-target="#jobRole_{{$role->id}}"> <i class="ti-pencil text-warning"></i> </a>
																						<div class="modal fade" id="jobRole_{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																							<div class="modal-dialog" role="document">
																								<div class="modal-content">
																									<div class="modal-header">
																										<h5 class="modal-title" id="exampleModalLabel">Edit Job Role</h5>
																										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																											<span aria-hidden="true">&times;</span>
																										</button>
																									</div>
																									<div class="modal-body">
																										<form action="{{route('update-job-role')}}" method="post">
																											@csrf
																											<div class="form-group">
																												<label for="">Job Role</label>
																												<input type="text" name="job_role" value="{{$role->role_name ?? ''}}" class="form-control" placeholder="Job Role">
																												@error('job_role')
																												<i class="text-danger mt-2">{{$message}}</i>
																												@enderror
																											</div>
																											<div class="form-group">
																												<label for="">Department</label>
																												<select name="department" class="form-control">
																													<option disabled selected>Select department</option>
																													@foreach ($departments as $department)
																														<option value="{{$department->id}}" {{$department->id == $role->department_id ? 'selected' : '' }}>{{$department->department_name ?? '' }}</option>
																													@endforeach
																												</select>
																												@error('department')
																												<i class="text-danger mt-2">{{$message}}</i>
																												@enderror
																											</div>
																											<div class="form-group">
																												<label for="">Role Description</label>
																												<textarea name="role_description" placeholder="Job description" style="resize: none;" cols="30" rows="10" class="form-control">{{$role->role_description ?? ''}}</textarea>
																												@error('role_description')
																												<i class="text-danger mt-2">{{$message}}</i>
																												@enderror
																												<input type="hidden" name="role" value="{{$role->id}}">
																											</div>
																											<div class="form-group d-flex justify-content-center">
																												<button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> Save changes</button>
																											</div>
																										</form>
																									</div>
																								</div>
																							</div>
																						</div>
																					</td>
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
									</div>
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
