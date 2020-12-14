<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 col-xl-3">
                    <div class="card widget-statstic-card">
                        <div class="card-header">
                            <div class="card-header-left">
                                <h5>Statistics</h5>
                                <p class="p-t-10 m-b-0 text-c-yellow">All-time</p>
                            </div>
                        </div>
                        <div class="card-block">
                            <i class="feather icon-sliders st-icon bg-c-yellow"></i>
                            <div class="text-left">
                                <h3 class="d-inline-block">{{number_format($statistics)}}</h3>
                                <i class="icofont icofont-tasks f-30 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card widget-statstic-card">
                        <div class="card-header">
                            <div class="card-header-left">
                                <h5>Leave Request</h5>
                                <p class="p-t-10 m-b-0 text-c-pink">{{ ceil(($thisYear/$employees) * 100) }}% This Year</p>
                            </div>
                        </div>
                        <div class="card-block">
                            <i class="icofont icofont-ui-calendar st-icon bg-c-pink txt-lite-color"></i>
                            <div class="text-left">
                                <h3 class="d-inline-block">{{number_format($thisYear)}}</h3>
                                <i class="icofont icofont-calendar text-info f-30 "></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card widget-statstic-card">
                        <div class="card-header">
                            <div class="card-header-left">
                                <h5>Leave Request</h5>
                                <p class="p-t-10 m-b-0 text-c-blue">{{ ceil(($lastMonth/$employees) * 100)}}% Last Month</p>
                            </div>
                        </div>
                        <div class="card-block">
                            <i class="icofont icofont-ui-calendar st-icon st-icon bg-c-blue"></i>
                            <div class="text-left">
                                <h3 class="d-inline-block">{{number_format($lastMonth)}}</h3>
                                @if ($lastMonth > $thisMonth)
                                    <i class="feather icon-arrow-down text-danger f-30 "></i>
                                @elseif($thisMonth > $lastMonth)
                                    <i class="feather icon-arrow-up text-success f-30 "></i>
                                @else
                                    <i class="ti-more-alt text-warning f-30 "></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card widget-statstic-card">
                        <div class="card-header">
                            <div class="card-header-left">
                                <h5>Leave Request</h5>
                                <p class="p-t-10 m-b-0 text-c-blue">{{ceil( ($thisMonth/$employees) * 100)}}% This Month</p>
                            </div>
                        </div>
                        <div class="card-block">
                            <i class="icofont icofont-ui-calendar st-icon st-icon bg-c-blue"></i>
                            <div class="text-left">
                                <h3 class="d-inline-block">{{number_format($thisMonth)}}</h3>
                                @if ($lastMonth > $thisMonth)
                                    <i class="feather icon-arrow-down text-danger f-30 "></i>
                                @elseif($thisMonth > $lastMonth)
                                    <i class="feather icon-arrow-up text-success f-30 "></i>
                                @else
                                    <i class="ti-more-alt text-warning f-30 "></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">

                        <div class="col-sm-6 col-md-6">
                            <h2 class="d-inline-block text-c-green m-r-10">{{number_format($allTimeApproved)}}</h2>
                            <div class="d-inline-block">
                                <p class="m-b-0"><i class="icofont icofont-thumbs-up m-r-10 text-success"></i>{{ ceil(($allTimeApproved/$employees) *100) }}%</p>
                                <p class="text-muted m-b-0">All-time Approved</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <h2 class="d-inline-block text-c-pink m-r-10">{{number_format($allTimeDeclined)}}</h2>
                            <div class="d-inline-block">
                                <p class="m-b-0"><i class="icofont icofont-thumbs-down m-r-10 text-danger"></i>{{ ceil(($allTimeDeclined/$employees) *100) }}%</p>
                                <p class="text-muted m-b-0">All-time Declined</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>

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
    <div class="col-md-9 col-xl-9">
        <div class="card table-card">
            <div class="card-header">
                <h5>Employees on Leave</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover  table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Applicant</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach($employeesOnLeave as $leave)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td><img src="/assets/images/avatars/thumbnails/{{$leave->user->avatar ?? 'avatar.png'}}" class="img-40" alt="{{$leave->user->first_name}}">
                                        <a href="/activity-stream/profile/{{ $leave->user->url}}">{{$leave->user->first_name }} {{$leave->user->surname ?? ''}}</a>
                                    </td>
                                    <td>{{$leave->post_status ?? ''}}</td>
                                    <td>{{date('d F, Y', strtotime($leave->created_at)) }}</td>
                                    <td>
                                        <a href="{{route('view-workflow-task', $leave->post_url)}}" class="btn btn-mini btn-info text-white">Learn more</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
            <div class="card user-card2">
                <div class="card-block text-center">
                    <h6 class="m-b-15">Company's Health</h6>
                    <div class="{{ ($employees - $onLeave) > ($onLeave - $employees) ? 'risk-rate-success' : 'risk-rate-danger' }} ">
                    <span><b>{{ number_format($employees - $onLeave) }}</b></span>
                    </div>
                    <h6 class="m-b-10 m-t-10">Rating</h6>
                    <a href="#!" class="text-c-red b-b-warning">{{($employees - $onLeave)/$employees * 100}}%</a>
                    <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                        <div class="col m-t-15 b-r-default">
                            <h6 class="text-muted">Present</h6>
                            <h6 class="{{ ($employees - $onLeave) > ($onLeave - $employees) ? 'text-success' : 'text-danger' }}">{{ number_format($employees - $onLeave) }}</h6>
                        </div>
                        <div class="col m-t-15">
                            <h6 class="text-muted">Absent</h6>
                            <h6 class="{{ ($employees - $onLeave) < ($onLeave - $employees) ? 'text-danger' : 'text-info' }}">{{ number_format($onLeave) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>
