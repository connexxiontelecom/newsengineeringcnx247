@extends('layouts.app')

@section('title')
    Renewal Schedule
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
												<h5 class="sub-title">Document Renewal Schedules</h5>

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
													@foreach ($renewal_schedules as $renewal_schedule)
														<tr>
															<td>{{$i++}}</td>
															<td>{{$renewal_schedule->renewal_type_name ?? ''}} {{$item->assignedTo->surname ?? ''}}</td>
															<td>{{ $renewal_schedule->make_model }} {{ $renewal_schedule->registration_no }}</td>
															<td>{{$renewal_schedule->first_name ?? ''}} {{$renewal_schedule->surname ?? ''}}</td>
															<td>{{date('d F, Y', strtotime($renewal_schedule->renewal_schedule_date))}}</td>

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
