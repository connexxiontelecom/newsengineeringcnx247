@extends('layouts.app')

@section('title')
    CRM Dashboard
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
<link rel="stylesheet" href="\assets\pages\chart\radial\css\radial.css" type="text/css" media="all">
@endsection

@section('content')

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card user-widget-card bg-c-yellow text-white">
            <div class="card-block">
                <i class="feather icon-user bg-simple-c-yellow card1-icon"></i>
                <h4>{{number_format($clients)}}</h4>
                <p>Clients</p>
                <a href="{{route('clients')}}" class="more-info">Learn more</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card user-widget-card bg-c-green">
            <div class="card-block">
                <i class="feather icon-credit-card bg-simple-c-green card1-icon"></i>
                <h4>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($income,2)}}</h4>
                <p>Income</p>
                <a href="{{route('receipt-list')}}" class="more-info">Learn more</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card user-widget-card bg-c-pink">
            <div class="card-block">
                <i class="ti-receipt bg-simple-c-pink card1-icon"></i>
                <h4>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($income,2)}}</h4>
                <p>Invoice</p>
                <a href="{{route('invoice-list')}}" class="more-info">Learn more</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card user-widget-card bg-c-blue">
            <div class="card-block">
                <i class="feather icon-user bg-simple-c-blue card1-icon"></i>
                <h4>{{number_format($deals)}}</h4>
                <p>Deals</p>
                <a href="{{route('deals')}}" class="more-info">Learn more</a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Total Leads</h5>
            </div>
            <div class="card-block">
                <p class="text-c-green f-w-500">Lead statistics</p>
                <div class="row">
                    <div class="col-4 b-r-default">
                        <p class="text-muted m-b-5">Overall</p>
                        @if ($clients <= 0)
                            <h5>0%</h5>
                        @else
                            <h5>{{ceil(($leads/$clients)*100)}}%</h5>
                        @endif
                    </div>
                    <div class="col-4 b-r-default">
                        <p class="text-muted m-b-5">Monthly</p>
                        @if ($month_clients <= 0)
                            <h5>0%</h5>
                        @else
                            <h5>{{ceil(($month_leads/$month_clients)*100) }}%</h5>
                        @endif
                    </div>
                    <div class="col-4">
                        <p class="text-muted m-b-5">Daily</p>
                        @if ($today_clients <= 0)
                            <h5>0%</h5>
                        @else
                            <h5>{{ceil(($today_leads/$today_clients)*100) }}%</h5>
                        @endif
                    </div>
                </div>
            </div>
            <canvas id="tot-lead" height="150"></canvas>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Total Deals</h5>
            </div>
            <div class="card-block">
                <p class="text-c-pink f-w-500">Deal statistics</p>
                <div class="row">
                    <div class="col-4 b-r-default">
                        <p class="text-muted m-b-5">Overall</p>
                        @if ($leads <= 0)
                            <h5>0%</h5>
                        @else
                            <h5>{{ceil(($deals/$leads)*100)}}%</h5>
                        @endif
                    </div>
                    <div class="col-4 b-r-default">
                        <p class="text-muted m-b-5">Monthly</p>
                        @if ($month_leads <= 0)
                            <h5>0%</h5>
                        @else
                            <h5>{{($month_deals/$month_leads)*100 }}%</h5>
                        @endif
                    </div>
                    <div class="col-4">
                        <p class="text-muted m-b-5">Daily</p>
                        @if ($today_leads <= 0)
                            <h5>0%</h5>
                        @else
                            <h5>{{($today_deals/$today_leads)*100 }}%</h5>
                        @endif
                    </div>
                </div>
            </div>
            <canvas id="tot-vendor" height="150"></canvas>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card per-task-card">
            <div class="card-header">
                <h5>Your Task</h5>
            </div>
            <div class="card-block">
                <div class="row per-task-block text-center">
                    <div class="col-6">
                        <div data-label="100%" class="radial-bar radial-bar-100 radial-bar-lg radial-bar-primary"></div>
                        <h6 class="text-muted">Total Clients</h6>
                        <p class="text-muted">{{number_format($clients)}}</p>
                        <a href="{{route('clients')}}" class="btn btn-primary btn-round btn-mini">Manage</a>
                    </div>
                    <div class="col-6">
                        @if ($clients <=0 )
                            <div data-label="0%" class="radial-bar radial-bar-0 radial-bar-lg radial-bar-primary"></div>
                        @else
                            <div data-label="{{ceil(($deals/$clients)*100)}}%" class="radial-bar radial-bar-{{ceil(($deals/$clients)*100)}} radial-bar-lg radial-bar-primary"></div>
                        @endif
                        <h6 class="text-muted">Remaining</h6>
                        <p class="text-muted">{{number_format($clients - $deals)}}</p>
                        <a href="{{route('deals')}}" class="btn btn-primary btn-outline-primary btn-round btn-mini">Manage</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-8 col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Recent Tickets</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Category</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$ticket->subject}}</td>
                                <td>
                                    <label for="" class="label label-warning">{{$ticket->ticketCategory->name ?? ''}}</label>
                                </td>
                                <td>{{date('d F, Y', strtotime($ticket->created_at))}} @ {{date('h:ia', strtotime($ticket->created_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right m-r-20">
                        <a href="{{route('admin-support')}}" class=" b-b-primary text-primary">View all tickets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card feed-card">
            <div class="card-header">
                <h5>Activity Log</h5>
            </div>
            <div class="card-block">
                @if (count($client_logs) > 0)
                    @foreach ($client_logs as $log)
                        <div class="row m-b-30">
                            <div class="col-auto p-r-0">
                                <a href="{{ route('view-profile', $log->user->url) }}"><img src="/assets/images/avatars/thumbnails/{{$log->user->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$log->user->first_name ?? ''}} {{$log->user->surname ?? ''}}"></a>
                            </div>
                            <div class="col">
                                <h6 class="m-b-5">{!! strlen($log->log) > 31 ? substr($log->log, 0,31).'...' : $log->log !!} <span class="text-muted f-right f-13">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($log->created_at))}}</span></h6>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row m-b-30">
                        <div class="col">
                            <h6 class="m-b-5">Oops! No recent activity...</h6>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\message\message.js"></script>
<script type="text/javascript" src="\assets\bower_components\chart.js\js\Chart.js"></script>
<script src="\assets\pages\widget\gauge\gauge.min.js"></script>
<script src="\assets\pages\widget\amchart\amcharts.js"></script>
<script src="\assets\pages\widget\amchart\serial.js"></script>
<script src="\assets\pages\widget\amchart\gauge.js"></script>
<script src="\assets\pages\widget\amchart\pie.js"></script>
<script src="\assets\pages\widget\amchart\light.js"></script>
<script type="text/javascript" src="\assets\pages\dashboard\crm-dashboard.min.js"></script>
@endsection
