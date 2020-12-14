@extends('layouts.app')

@section('title')
    User > Administration
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
    @livewire('backend.user.my-profile')
    <div class="card" style="margin-top:-25px;">
        <div class="card-block accordion-block ">
            @if (session()->has('success'))
                <div class="alert alert-success background-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="icofont icofont-close-line-circled text-white"></i>
                    </button>
                    {!! session()->get('success') !!}
                </div>
            @endif
            <div id="accordion" role="tablist" aria-multiselectable="true">
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="queryAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#queryCollapse" aria-expanded="false" aria-controls="queryCollapse">
                            Query
                        </a>
                    </h3>
                    </div>
                    <div id="queryCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="queryAccordion">
                        <div class="accordion-content accordion-desc">
                            <div class="card mt-3">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-green m-r-10">{{number_format(count($queries))}}</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">All Time</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">{{number_format($queriesLastMonth)}}</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">Last Month</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">{{number_format($queriesThisMonth)}}</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">This Month</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Queries</h5>
                                                    <span>All queries issued to employees</span>

                                                </div>
                                                <div class="card-block">
                                                    <div class="dt-responsive table-responsive">
                                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Employee</th>
                                                                <th>Subject</th>
                                                                <th>Status</th>
                                                                <th>Issued by</th>
                                                                <th>Type</th>
                                                                <th>Date</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $serial = 1;
                                                                @endphp
                                                                @if (count($queries) > 0)
                                                                    @foreach ($queries as $query)
                                                                        <tr>
                                                                            <td>{{$serial++}}</td>
                                                                            <td><a href="{{route('view-profile', $query->queriedEmployee->url)}}"> <img src="/assets/images/avatars/thumbnails/{{$query->queriedEmployee->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$query->queriedEmployee->first_name ?? ''}} {{$query->queriedEmployee->surname ?? ''}}"> {{$query->queriedEmployee->first_name ?? ''}} {{$query->queriedEmployee->surname ?? ''}}</a></td>
                                                                            <td><a href="{{route('view-query', $query->slug)}}">{{$query->subject}}</a> </td>
                                                                            <td>
                                                                                @if ($query->status == 1)
                                                                                    <label for="" class="label label-success">Open</label>
                                                                                @else
                                                                                    <label for="" class="label label-danger">Closed</label>

                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                               <a href="{{route('view-profile', $query->issuedBy->url)}}"> <img src="/assets/images/avatars/thumbnails/{{$query->issuedBy->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$query->issuedBy->first_name ?? ''}} {{$query->issuedBy->surname ?? ''}}"> {{$query->issuedBy->first_name ?? ''}} {{$query->issuedBy->surname ?? ''}}</a>
                                                                            </td>
                                                                            <td>
                                                                                @if ($query->query_type == 0)
                                                                                    <label for="" class="label label-warning">Warning</label>
                                                                                @else
                                                                                    <label for="" class="label label-danger">Query</label>
                                                                                @endif
                                                                            </td>
                                                                            <td><label for="" class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($query->created_at))}}</label></td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="9">There're no queries.</td>
                                                                    </tr>
                                                                @endif

                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Employee</th>
                                                                <th>Subject</th>
                                                                <th>Status</th>
                                                                <th>Issued by</th>
                                                                <th>Type</th>
                                                                <th>Date</th>
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
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="attendanceAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#attendanceCollapse" aria-expanded="false" aria-controls="attendanceCollapse">
                            Attendance
                        </a>
                    </h3>
                    </div>
                    <div id="attendanceCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="attendanceAccordion">
                        <div class="accordion-content accordion-desc">
                            <div class="card mt-3">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-green m-r-10">{{number_format(count($attendance))}}</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">All Time</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">{{number_format($attendanceLastMonth)}}</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">Last Month</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">{{number_format($attendanceThisMonth)}}</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">This Month</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Clock-in</th>
                                                    <th>Clock-out</th>
                                                    <th>Date</th>
                                                </thead>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach ($attendance as $attend)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td> <label for="" class="label label-primary">{{date('d M, Y', strtotime($attend->clock_in))}}</label> @ <label for="" class="label label-inverse">{{date('h:i a', strtotime($attend->clock_in))}}</label> </td>
                                                        <td> <label for="" class="label label-primary">{{date('d M, Y', strtotime($attend->clock_out))}}</label> @ <label for="" class="label label-inverse">{{date('h:i a', strtotime($attend->clock_out))}}</label> </td>
                                                        <td> {{date('d F, Y', strtotime($attend->created_at))}}</td>
                                                    </tr>

                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="resignationAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#resignationCollapse" aria-expanded="false" aria-controls="resignationCollapse">
                            Resignation
                        </a>
                    </h3>
                    </div>
                    <div id="resignationCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="resignationAccordion">
                        <div class="accordion-content accordion-desc">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Content</th>
                                    <th>Effective Date</th>
                                    <th>Date</th>
                                </thead>
                                @php
                                    $n = 1;
                                @endphp
                                @foreach ($resignations as $resign)
                                    <tr>
                                        <td>{{$n++}}</td>
                                        <td>
                                            <a href="{{route('view-resignation', $resign->slug)}}">
                                                {!! strlen($resign->subject) > 25 ? substr($resign->subject, 0, 25).'...' : $resign->subject !!}
                                            </a>
                                        </td>
                                        <td> <label for="" class="label label-info">{{$resign->status}}</label> </td>
                                        <td>{!! strlen($resign->content) > 25 ? substr($resign->content, 0, 25).'...' : $resign->content !!}</td>
                                        <td>{{ date('d F, Y', strtotime($resign->effective_date)) }}</td>
                                        <td>{{ date('d F, Y', strtotime($resign->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="supervisorAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#supervisorCollapse" aria-expanded="false" aria-controls="supervisorCollapse">
                            Employee Appraisal <i><small>( acting as  Supervisor)</small></i>
                        </a>
                    </h3>
                    </div>
                    <div id="supervisorCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="supervisorAccordion">
                        <div class="accordion-content accordion-desc">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Appraisal Period</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>
                                @php
                                    $app = 1;
                                @endphp
                                @foreach ($supervisors as $appraisal)
                                    <tr>
                                        <td>{{$app++}}</td>
                                        <td>
                                            <a href="{{route('view-profile', $appraisal->takenBy->url)}}">
                                                <img src="/assets/images/avatars/thumbnails/{{$appraisal->takenBy->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$appraisal->takenBy->surname ?? ''}}">
                                                {{$appraisal->takenBy->first_name ?? ''}} {{$appraisal->takenBy->surname ?? ''}}
                                                @if($appraisal->employee_status == 0)
                                                <sup class="badge badge-warning badge-top-right text-white ml-3">in-progress</sup>
                                                @else
                                                    <sup class="badge badge-success badge-top-right ml-3">Done</sup>

                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            {{date('M, Y', strtotime($appraisal->start_date))}} <label class="badge badge-info">to</label>
                                            {{date( 'M, Y', strtotime($appraisal->end_date))}}
                                        </td>
                                        <td>
                                            @if($appraisal->appraisal_status == 0)
                                                <label class="label label-warning">Pending</label>
                                            @else
                                                <label class="label label-success">Completed</label>
                                            @endif
                                        </td>
                                        <td>
                                            {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($appraisal->created_at))}}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @if($appraisal->appraisal_status == 0)
                                                    <a href="{{route('employee-supervisor-appraisal', $appraisal->appraisal_id)}}" class="btn btn-mini btn-danger"> <i class="ti-key"></i> Start</a>
                                                @endif

                                                @if($appraisal->appraisal_status == 1)
                                                    <a href="{{route('appraisal-result', $appraisal->appraisal_id)}}" class="btn btn-mini btn-info"> <i class="icofont icofont-eye-alt"></i> View Result</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="appraiseeAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#appraiseeCollapse" aria-expanded="false" aria-controls="appraiseeCollapse">
                            Employee Appraisal <i><small>(  acting as Appraisee)</small></i>
                        </a>
                    </h3>
                    </div>
                    <div id="appraiseeCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="appraiseeAccordion">
                        <div class="accordion-content accordion-desc">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <th>#</th>
                                    <th>Supervisor</th>
                                    <th>Appraisal Period</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>
                                @php
                                    $app = 1;
                                @endphp
                                @foreach ($myAppraisals as $appraisal)
                                    <tr>
                                        <td>{{$app++}}</td>
                                        <td>
                                            <a href="{{route('view-profile', $appraisal->supervisedBy->url)}}">
                                                <img src="/assets/images/avatars/thumbnails/{{$appraisal->supervisedBy->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$appraisal->supervisedBy->surname ?? ''}}">
                                                {{$appraisal->supervisedBy->first_name ?? ''}} {{$appraisal->supervisedBy->surname ?? ''}}
                                                @if($appraisal->supervisor_status == 0)
                                                <sup class="badge badge-warning badge-top-right text-white ml-3">in-progress</sup>
                                                @else
                                                    <sup class="badge badge-success badge-top-right ml-3">Done</sup>

                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            {{date('M, Y', strtotime($appraisal->start_date))}} <label class="badge badge-info">to</label>
                                            {{date( 'M, Y', strtotime($appraisal->end_date))}}
                                        </td>
                                        <td>
                                            @if($appraisal->appraisal_status == 0)
                                                <label class="label label-warning">Pending</label>
                                            @else
                                                <label class="label label-success">Completed</label>
                                            @endif
                                        </td>
                                        <td>
                                            {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($appraisal->created_at))}}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @if($appraisal->appraisal_status == 1)
                                                    <a href="{{route('appraisal-result', $appraisal->appraisal_id)}}" class="btn btn-mini btn-info"> <i class="icofont icofont-eye-alt"></i> View Result</a>
                                                @endif
                                                @if($appraisal->employee_status == 0)
                                                    <a href="{{route('employee-self-appraisal', $appraisal->appraisal_id)}}" class="btn btn-mini btn-info"> <i class="icofont icofont-eye-alt"></i> Start</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')
    @include('backend.user.common._user-modals')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/profile.js"></script>
@stack('profile-script')
@endsection
