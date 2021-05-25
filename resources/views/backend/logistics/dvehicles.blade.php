@extends('layouts.app')

@section('title')
	Vehicles
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
					<h5 class="mb-2 sub-title">Disposed Vehicles</h5>
					<a href="{{route('logistics-new-vehicle')}}" class="btn btn-primary btn-mini float-right mb-3"><i class="ti-plus"></i>Add New Vehicle</a>

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
								<th>Alias</th>
								<th>Chassis No.</th>
								<th>Purchase Date</th>
								<th>Plate No</th>
								<th>Vehicle Type</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@php
								$serial = 1;
							@endphp
							@foreach($vehicles as $vehicle)
								<tr @if($vehicle->status == 0) style="background-color: lightcoral" @endif>
									<td>{{$serial++}}</td>
									<td>{{$vehicle->brand ?? ''}} - {{$vehicle->make_model ?? ''}} - {{$vehicle->year ?? ''}} - {{$vehicle->color ?? ''}} - {{$vehicle->plate_no ?? ''}}</td>
									<td>{{$vehicle->chassis_no ?? ''}}</td>
									<td>{{$vehicle->purchase_date ?? ''}}</td>
									<td>{{$vehicle->plate_no ?? ''}}</td>
									<td>{{$vehicle->vehicle_type_name ?? ''}}</td>
									<td>
										<a class="btn btn-mini btn-primary" href="{{route('logistics-view-vehicle', $vehicle->slug)}}"><i class="ti-eye mr-2"></i> View</a>
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
