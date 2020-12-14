@extends('layouts.app')

@section('title')
    Human Resource Dashboard
@endsection

@section('extra-styles')

@endsection

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-widget-card bg-c-blue">
                                <div class="card-block">
                                    <i class="feather icon-users bg-simple-c-blue card1-icon"></i>
                                    <h4>{{ number_format(count($employees))}}</h4>
                                    <p>Employees</p>
                                    <a href="{{ route('employees') }}" class="more-info">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-widget-card bg-c-pink">
                                <div class="card-block">
                                    <i class="icofont icofont-tasks-alt bg-simple-c-pink card1-icon"></i>
                                    <h4><small>{{ number_format(count($attendance)) }}</small>/{{number_format(count($employees))}}</h4>
                                    <p>Attendance</p>
                                    <a href="{{ route('attendance') }}" class="more-info">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-widget-card bg-c-green">
                                <div class="card-block">
                                    <i class="icofont icofont-people bg-simple-c-green card1-icon"></i>
                                    <h4>{{number_format($departments)}}</h4>
                                    <p>Departments</p>
                                    <a href="{{route('hr-configurations')}}" class="more-info">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-widget-card bg-c-yellow">
                                <div class="card-block">
                                    <i class="icofont icofont-files  bg-simple-c-yellow card1-icon"></i>
                                    <h4>{{number_format($leaves)}}</h4>
                                    <p>On Leave</p>
                                    <a href="{{route('leave-management')}}" class="more-info">More Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
   <div class="row">
        <div class="col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Employees</h5>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover  table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Position</th>
                                    <th>Hire Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1;
                                @endphp
                                @foreach ($employees->shuffle()->slice(0,5) as $employee)
                                    <tr>
                                        <td>{{$n++}}</td>
                                        <td>
                                            <a href="{{route('view-profile',$employee->url)}}">
                                                <img src="/assets/images/avatars/thumbnails/{{$employee->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}">
                                                {{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}
                                            </a>

                                        </td>
                                        <td>{{$employee->email ?? '-'}}</td>
                                        <td>{{$employee->mobile}} </td>
                                        <td>{{$employee->position ?? '-'}}</td>
                                        <td class="text-c-blue">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($employee->hire_date))}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            <a href="{{route('employees')}}" class=" b-b-primary text-primary">View all Employees</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div class="row">
        <div class="col-xl-8 col-md-12">
            <div class="card latest-activity-card">
                <div class="card-header">
                    <h5>Latest Announcement</h5>
                </div>
                <div class="card-block">
                    <ul class="list-view">
                        @if (count($announcement) > 0)
                            @foreach($announcement as $announce)
                                <li>
                                    <div class="card list-view-media">
                                        <div class="card-block">
                                            <div class="media">
                                                <a class="media-left pt-3" href="{{route('view-profile', $announce->user->url)}}">
                                                    <img class="media-object card-list-img img-30" src="/assets/images/avatars/thumbnails/{{$announce->user->avatar ?? 'avatar.png'}}" alt="{{$announce->user->first_name ?? ''}} {{$announce->user->surname ?? ''}}">
                                                </a>
                                                <div class="media-body pt-3">
                                                    <div class="text-muted">
                                                        <a href="{{route('view-post-activity-stream', $announce->post_url)}}">

                                                            <h5 class="sub-title">{{$announce->post_title ?? ''}} | <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($announce->created_at))}} @ {{date('h:ia', strtotime($announce->created_at))}}</small></h5>
                                                        </a>
                                                    </div>
                                                    {{ strlen(strip_tags($announce->post_content)) > 80 ? substr(strip_tags($announce->post_content),0,80).'...' : strip_tags($announce->post_content) }}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li>
                                <div class="card list-view-media">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body">
                                               <p>No record found.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <div class="text-right">
                        <a href="{{route('activity-stream')}}" class=" b-b-primary text-primary">View in activity stream</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card feed-card">
                <div class="card-header">
                    <h5>Upcoming Birthdays</h5>
                </div>
                <div class="card-block">
                    @if (count($birthdays) > 0)
                    @foreach ($birthdays as $birthday)
                        <div class="user-box assign-user taskboard-right-users">
                            <div class="media">
                                <div class="media-left media-middle photo-table">
                                    <a href="{{route('view-profile', $birthday->url)}}">
                                        <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$birthday->avatar ?? 'avatar.png'}}" alt="{{$birthday->first_name ?? ''}}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="{{route('view-profile', $birthday->url)}}">{{$birthday->first_name ?? ''}} {{$birthday->surname ?? ''}}</a> <br>
                                    - {{date('d M', strtotime($birthday->birth_date))}}</small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    @else
                        <p class="text-center text-muted">There're no birthdays</p>
                    @endif
                    <div class="text-center">
                        <a href="{{route('employees')}}" class="b-b-primary text-primary">View all employees</a>
                    </div>
                </div>
            </div>
            <div class="card feed-card">
                <div class="card-header">
                    <h5>Today's Attendance</h5>
                </div>
                <div class="card-block">
                    @if (count($attendance) > 0)
                        @foreach ($attendance->take(5) as $attend)
                            <div class="row m-b-30">
                                <div class="col-auto p-r-0">
                                    <a href="{{route('view-profile', $attend->user->url)}}">
                                        <img src="/assets/images/avatars/thumbnails/{{$attend->user->avatar ?? 'avatar.png'}}" alt="{{$attend->user->first_name ?? ''}}" class="img-30">
                                    </a>
                                </div>
                                <div class="col">
                                    <h6 class="m-b-5">
                                        <a href="{{route('view-profile', $attend->user->url)}}">
                                        {{$attend->user->first_name ?? ''}} {{$attend->user->surname ?? ''}}</a> <span class="text-muted f-right f-13">{{$attend->created_at->diffForHumans()}}</span></h6>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-auto p-r-0">
                                <p class="text-center text-muted">No one has clocked in today.</p>
                            </div>
                        </div>
                    @endif
                    <div class="text-center">
                        <a href="{{route('attendance')}}" class="b-b-primary text-primary">View all attendance</a>
                    </div>
                </div>
            </div>
        </div>
   </div>


@endsection

@section('extra-scripts')

@endsection
