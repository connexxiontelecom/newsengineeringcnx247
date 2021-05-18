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
								<th>Mobile No.</th>
								<th>Email</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@php
								$serial = 1;
							@endphp
							@foreach ($drivers as $driver)
								<tr>
									<td>{{$serial++}}</td>
									<td>{{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</td>
									<td>
										{{$driver->mobile_no ?? ''}}
									</td>
									<td>
										{{$driver->email ?? ''}}
									</td>

									<td>
										{{ date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($driver->created_at))}}
									</td>
									<td>
										<div class="btn-group">
											<a href="{{route('driver-profile', $driver->url)}}" data-original-title="View Profile" class="mr-2 viewProfile" data-toggle="tooltip" data-placement="top" > <i class="ti-eye text-primary"></i> </a>
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
