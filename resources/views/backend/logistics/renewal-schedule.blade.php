@extends('layouts.app')

@section('title')
	Renewal Schedule
@endsection

@section('extra-styles')

@endsection

@section('content')
	<div class="row">
		<nav class="navbar navbar-light bg-faded m-b-30 p-10">
			<div class="row">
				{{--        <div class="d-inline-block">--}}
				{{--            <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('purchase-orders')}}"><i class="icofont icofont-tasks"></i> Purchase Orders</a>--}}
				{{--            <a href="{{ route('suppliers') }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-cart-alt"></i> Suppliers</a>--}}
				{{--        </div>--}}
			</div>
			<div class="nav-item nav-grid">
				<a href="{{}}" class="btn btn-warning btn-mini waves-effect waves-light"><i class="icofont icofont-tasks mr-2"></i>Calendar View</a>

			</div>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- Product detail page start -->
			<div class="card product-detail-page">
				<div class="card-block">
					<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12">
							<div class="card">
								<div class="card-block">
									<h5 class="sub-title">Document Renewal Schedules</h5>

									<table class="table table-strip">
										<thead>
										<tr>
											<th>#</th>
											<th>Type</th>
											<th> Vehicle </th>
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
												<td>{{$i++}}</td>
												<td>{{$renewal_schedule->renewal_type_name ?? ''}} {{$item->assignedTo->surname ?? ''}}</td>
												<td>{{$renewal_schedule->brand ?? ''}} - {{$renewal_schedule->make_model ?? ''}} - {{$renewal_schedule->year ?? ''}} - {{$renewal_schedule->color ?? ''}} - {{$renewal_schedule->plate_no ?? ''}}</td>

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

@endsection
