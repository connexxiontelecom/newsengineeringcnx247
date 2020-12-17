@extends('layouts.app')

@section('title')
    My Event List
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
                    List Events
                </h5>
                <div class="row mt-3">
                    <div class="col-md-12 btn-add-task">
                        @if (session()->has('success'))
                            <div class="alert alert-success background-success mt-3">
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
                                    <th>Event Name</th>
                                    <th>Host</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if (count($events) > 0)
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <a href="{{route('view-post-activity-stream', $event->post_url)}}">{{$event->post_title}}</a>
																								</td>
																								<td>
																									<a href="{{route('view-profile', $event->user->url)}}">{{$event->user->first_name ?? ''}} {{$event->user->surname ?? ''}}</a>
																								</td>
																								<td>
																									@if ($event->end_date < \Carbon\Carbon::now())
																											<label for="" class="label label-danger">Closed</label>
																									@elseif(\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($event->start_date), \Carbon\Carbon::parse($event->end_date)))
																											<label for="" class="label label-warning">In-progress</label>
																									@else
																											<label for="" class="label label-success">Open</label>
																									@endif

																								</td>
                                                <td><label for="" class="">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($event->start_date))}} @ {{date('h:ia', strtotime($event->start_date))}}</label></td>
                                                <td><label for="" class="">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($event->end_date))}} @ {{date('h:ia', strtotime($event->start_date))}}</label></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">You have no events. <a href="{{route('my-new-event')}}">Create</a> one today</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Event Name</th>
                                    <th>Host</th>
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
