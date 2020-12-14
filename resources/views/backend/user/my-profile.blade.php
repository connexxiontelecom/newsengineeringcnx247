@extends('layouts.app')

@section('title')
    My Profile
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
    @livewire('backend.user.my-profile')
    <div class="row" style="margin-top:-25px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingOne">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Personal Info
                                </a>
                            </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="accordion-content accordion-desc">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if(Auth::check())
                                                <div class="table-responsive">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Full Name</th>
                                                                <td>{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}} </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Birth Date</th>
                                                                <td>{{date('d F, Y', strtotime(Auth::user()->birth_date))}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Email</th>
                                                                <td>{{Auth::user()->email ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Position</th>
                                                                <td>{{Auth::user()->position ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Hire Date</th>
                                                                <td>{{date('d F, Y', strtotime(Auth::user()->hire_date)) ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Start Date</th>
                                                                <td>{{date('d F, Y', strtotime(Auth::user()->start_date))}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                {{route('signin')}}
                                            @endif

                                        </div>
                                        <div class="col-md-6">
                                            @if(Auth::check())
                                                <div class="table-responsive">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Gender</th>
                                                                <td>
                                                                    @if (Auth::user()->gender == 1)
                                                                        Male
                                                                    @else
                                                                        Female
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Marital Status</th>
                                                                <td>{{Auth::user()->userMaritalStatus->name ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Mobile</th>
                                                                <td>{{Auth::user()->mobile ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Department</th>
                                                                <td>{{Auth::user()->department->department_name ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Confirm Date</th>
                                                                <td>{{date('d M, Y', strtotime(Auth::user()->confirm_date)) ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Address</th>
                                                                <td>{{Auth::user()->address}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                {{route('signin')}}
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="btn-group d-flex justify-content-center">
                                                    <a href="{{route('user-settings')}}" class="btn btn-mini btn-warning"><i class="ti-pencil mr-2"></i> Edit Profile</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingTwo">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Work Experience
                                </a>
                            </h3>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="accordion-content accordion-desc">
                                    @php
                                        $serial = 1;
                                    @endphp

                                    @foreach(Auth::user()->experience as $exp)
                                    <div class="col-md-12">
                                        <ul class="list-view">
                                            <li>
                                                <div class="card list-view-media">
                                                    <div class="card-block">
                                                        <label class="badge badge-primary float-right">{{$serial++}}</label>
                                                        <div class="media">
                                                            <a class="media-left" href="{{route('view-profile', $exp->user->url)}}">
                                                                <img src="/assets/images/avatars/thumbnails/{{$exp->user->avatar ?? 'avatar.png'}}" class="img-60" alt="{{$exp->user->first_name ?? ''}}">
                                                            </a>
                                                            <div class="media-body">
                                                                <div class="col-xs-12">
                                                                    <h6 class="d-inline-block">
                                                                        {{$exp->user->first_name ?? ''}} {{$exp->user->surname ?? ''}}</h6>
                                                                    <label class="label label-info">{{$exp->user->position ?? '-'}}</label>
                                                                </div>
                                                                <div class="f-13 text-muted m-b-15">
                                                                    {{$exp->organisation ?? ''}}
                                                                </div>
                                                                <p>{!! $exp->role_description !!}</p>
                                                                <div class="m-t-15">
                                                                    <div class="btn-group">
                                                                        <label class="label label-primary">Start Date: {{date('d F, Y', strtotime($exp->start_date))}}</label>
                                                                        <label class="label label-danger">End Date: {{date('d F, Y', strtotime($exp->end_date))}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingThree">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                   Education
                                </a>
                            </h3>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="accordion-content accordion-desc">
                                    @php
                                    $index = 1;
                                @endphp

                                @foreach(Auth::user()->education as $edu)
                                <div class="col-md-12">
                                    <ul class="list-view">
                                        <li>
                                            <div class="card list-view-media">
                                                <div class="card-block">
                                                    <label class="badge badge-primary float-right">{{$index++}}</label>
                                                    <div class="media">
                                                        <a class="media-left" href="{{route('view-profile', $edu->user->url)}}">
                                                            <img src="/assets/images/avatars/thumbnails/{{$edu->user->avatar ?? 'avatar.png'}}" class="img-60" alt="{{$edu->user->first_name ?? ''}}">
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="col-xs-12">
                                                                <h6 class="d-inline-block">
                                                                    {{$edu->user->first_name ?? ''}} {{$edu->user->surname ?? ''}}</h6>
                                                                <label class="label label-info">{{$edu->user->position ?? '-'}}</label>
                                                            </div>
                                                            <div class="f-13 text-muted m-b-15">
                                                                {{$edu->institution ?? ''}}
                                                            </div>
                                                            <div class="m-t-15">
                                                                <div class="btn-group">
                                                                    <label class="label label-primary">Start Date: {{date('d F, Y', strtotime($edu->start_date))}}</label>
                                                                    <label class="label label-danger">End Date: {{date('d F, Y', strtotime($edu->end_date))}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingFour">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                   Emergency Contact
                                </a>
                            </h3>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="accordion-content accordion-desc">
                                    <div class="row">
                                        @php
                                            $n = 1;
                                        @endphp
                                        @foreach(Auth::user()->emergencyContact as $contact)
                                            <div class="col-md-6" >
                                                    <label class="badge badge-primary float-right">{{$n++}}</label>
                                                <table class="table m-0" style="border-left:2px solid #ff000;">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Full Name</th>
                                                            <td>{{$contact->full_name ?? ''}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Relationship</th>
                                                            <td>{{$contact->relationship ?? ''}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Email</th>
                                                            <td>{{$contact->email ?? ''}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Mobile No.</th>
                                                            <td>{{$contact->mobile ?? ''}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Address</th>
                                                            <td>{{$contact->address ?? ''}} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingFive">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                   Next of Kin
                                </a>
                            </h3>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="accordion-content accordion-desc">
                                    <div class="row">
                                        @php
                                            $n = 1;
                                        @endphp
                                        @foreach(Auth::user()->nextKin as $contact)
                                            <div class="col-md-6" >
                                                    <label class="badge badge-primary float-right">{{$n++}}</label>
                                                <table class="table m-0" style="border-left:2px solid #ff000;">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Full Name</th>
                                                            <td>{{$contact->full_name ?? ''}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Relationship</th>
                                                            <td>{{$contact->relationship ?? ''}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Email</th>
                                                            <td>{{$contact->email ?? ''}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Mobile No.</th>
                                                            <td>{{$contact->mobile ?? ''}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Address</th>
                                                            <td>{{$contact->address ?? ''}} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
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
