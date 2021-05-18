@extends('layouts.app')

@section('title')
    All Events
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.events.common._event-slab')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="m-0 sub-title">
                   All Events
                </h5>
								<div class="dt-responsive table-responsive">
									<table id="simpletable" class="table table-striped table-bordered nowrap">
											<thead>
											<tr>
													<th>#</th>
													<th>Event Name</th>
													<th>Description</th>
													<th>Status</th>
													<th>Start Date</th>
													<th>End Date</th>
											</tr>
											</thead>
											<tbody>
													@php
															$serial = 1;
													@endphp
													@foreach ($events as $event)
															<tr>
																<td>{{$serial++}}</td>
																<td> <a href="{{route('view-post-activity-stream', $event->post_url)}}">{{$event->post_title ?? ''}}</a> </td>
																<td>{{ strlen(strip_tags($event->post_content)) > 50 ? substr(strip_tags($event->post_content), 0,50) : strip_tags($event->post_content)}}</td>
																<td>
																	@if ($event->end_date < \Carbon\Carbon::now())
																			<label for="" class="label label-danger">Closed</label>
																	@else
																			<label for="" class="label label-success">Open</label>
																	@endif
																</td>
																<td>{{!is_null($event->start_date) ? date(Auth::user()->tenant->dateFormat->format, strtotime($event->start_date)) : '-' }}</td>
																<td>{{!is_null($event->end_date) ? date(Auth::user()->tenant->dateFormat->format, strtotime($event->end_date)) : '-' }}</td>

															</tr>
													@endforeach
											</tbody>
											<tfoot>
											<tr>
												<th>#</th>
												<th>Event Name</th>
												<th>Description</th>
												<th>Status</th>
												<th>Start Date</th>
												<th>End Date</th>
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
