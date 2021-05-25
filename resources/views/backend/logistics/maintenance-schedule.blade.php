@extends('layouts.app')

@section('title')
    maintenance Schedule
@endsection

@section('extra-styles')
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">

			<!-- Product detail page start -->
        <div class="card product-detail-page">


					<div class="card-block">
						<div class="row">
							<div class="col-3 offset-9">
								<a href="{{route('maintenance-schedule-calender')}}" class="btn btn-primary btn-mini float-right mb-3"><i class="icofont icofont-tasks mr-2"></i>Calender View</a>

							</div>
						</div>
                <div class="row">
									<div class="col-md-12 col-lg-12 col-sm-12">
										<div class="card">
											<div class="card-block">
												<h5 class="sub-title">maintenance Schedules</h5>

												<table id="simpletable" class="table table-striped table-bordered nowrap">

												<thead>
													<tr>
														<th>#</th>
														<th>Type</th>
														<th> Vehicle </th>
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
														<tr @if($maintenance_schedule->maintenance_schedule_due_date < date('Y-m-d'))  style="background-color: lightcoral" @endif>
															<td>{{$i++}}</td>
															<td>{{$maintenance_schedule->maintenance_type_name ?? ''}} {{$item->assignedTo->surname ?? ''}}</td>
															<td>{{$maintenance_schedule->brand ?? ''}} - {{$maintenance_schedule->make_model ?? ''}} - {{$maintenance_schedule->year ?? ''}} - {{$maintenance_schedule->color ?? ''}} - {{$maintenance_schedule->plate_no ?? ''}}</td>
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
                <hr>

            </div>
        </div>
    </div>
</div>


@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
	<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
	<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
	<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
