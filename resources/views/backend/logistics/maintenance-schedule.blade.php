@extends('layouts.app')

@section('title')
    maintenance Schedule
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.logistics.common._logistics-slab')
    </div>
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
												<h5 class="sub-title">maintenance Schedules</h5>

												<table class="table table-strip">
													<thead>
													<tr>
														<th>#</th>
														<th>Type</th>
														<th> Vehicle </th>
														<th>Employee Responsible</th>
														<th>Date</th>

													</tr>
													</thead>
													<tbody>
													@php
														$i = 1;
													@endphp
													@foreach ($maintenance_schedules as $maintenance_schedule)
														<tr>
															<td>{{$i++}}</td>
															<td>{{$maintenance_schedule->maintenance_type_name ?? ''}} {{$item->assignedTo->surname ?? ''}}</td>
															<td>{{$maintenance_schedule->brand ?? ''}} - {{$maintenance_schedule->make_model ?? ''}} - {{$maintenance_schedule->year ?? ''}} - {{$maintenance_schedule->color ?? ''}} - {{$maintenance_schedule->plate_no ?? ''}}</td>
															<td>{{$maintenance_schedule->first_name ?? ''}} {{$maintenance_schedule->surname ?? ''}}</td>
															<td>{{date('d F, Y', strtotime($maintenance_schedule->maintenance_schedule_date))}}</td>

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
