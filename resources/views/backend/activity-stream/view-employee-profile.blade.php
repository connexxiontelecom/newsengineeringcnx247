@extends('layouts.app')

@section('title')
    {{$user->first_name ?? ''}} {{$user->surname ?? '' }}'s Profile
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
<div class="card">

    <div class="row">
        <div class="col-lg-12">
            <div class="cover-profile">
                <div class="profile-bg-img">
                    <img class="profile-bg-img img-fluid" src="/assets/images/cover-photos/{{$user->cover ?? 'cover.jpeg'}}" width="1202" height="217" alt="{{$user->first_name ?? ''}}">
                    <div class="card-block user-info">
                        <div class="col-md-12">
                            <div class="media-left">
                                <a href="{{url()->current()}}" class="profile-image">
                                    <img height="108" width="108" class="user-img img-radius" src="/assets/images/avatars/medium/{{$user->avatar ?? 'avatar.png'}}" alt="{{$user->first_name ?? ''}}">
                                </a>
                            </div>
                            <div class="media-body row">
                                <div class="col-lg-12">
                                    <div class="user-title">
                                        <h2>{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</h2>
                                        <span class="text-white">{{$user->position ?? ''}}</span>
                                        @if ($user->account_status == 2)
                                            <label class="label label-danger">Terminated</label>
                                        @elseif($user->account_status == 1)
                                            <label class="label label-success">Active</label>
                                        @endif
                                    </div>
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
            <div class="btn-group ml-3">
                <a href="{{route('chat-n-calls')}}" class="btn btn-mini btn-light"><i class="ti-comments"></i>  Chat</a>
                <a href="{{url()->previous()}}" class="btn btn-mini btn-secondary text-white"><i class="ti-back-left"></i>  Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#personalInfo" role="tab">Personal Info</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#administration" role="tab">Contacts</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    @if ($user->account_status != 2)
                        <div class="btn-group">
                        <a href="{{route('query-employee', $user->url)}}" data-toggle="tooltip" data-placement="top" title="Query {{$user->first_name}}"> <i class="ti-help-alt mr-4 text-danger"></i></a>
                        <a href="{{route('assign-permission-to-employee', $user->url)}}" data-toggle="tooltip" data-placement="top" title="Assign Role to {{$user->first_name}}"> <i class="icofont icofont-chart-flow-alt-1 mr-4 text-warning"></i></a>
                            <a href="javascript:void(0);" data-toggle="modal" class="terminate-employment" data-user="{{$user->id}}" data-target="#terminateEmploymentModal" title="Terminate {{$user->first_name}}'s employement"> <i class="ti-na mr-4 text-danger"></i></a>
                        </div>
                    @endif
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content card-block">
                <div class="tab-pane active" id="personalInfo" role="tabpanel">
                    @if(Auth::check())
                    <div class="table-responsive">
                        <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Full Name</th>
                                        <td>{{$user->first_name ?? ''}} {{$user->surname ?? ''}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Gender</th>
                                        <td>@if ($user->gender == 1)
                                            Male
                                        @else
                                            Female
                                        @endif</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Birth Date</th>
                                        <td>{{date('d F', strtotime($user->birth_date))}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Marital Status</th>
                                        <td>{{$user->userMaritalStatus->name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Email</th>
                                        <td>{{$user->email ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Mobile</th>
                                        <td>{{$user->mobile ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Position</th>
                                        <td>{{$user->position ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Department</th>
                                        <td>{{$user->department->departmenet_name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Hire Date</th>
                                        <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd M, Y', strtotime($user->hire_date)) ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Confirm Date</th>
                                        <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd M, Y', strtotime($user->confirm_date)) ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Address</th>
                                        <td>{{$user->address}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{route('signin')}}
                    @endif
                </div>
                <div class="tab-pane mt-3" id="administration" role="tabpanel">
                    <div class="card" style="margin-top:-25px;">
                        <div class="card-block accordion-block ">
                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="accordion-panel">
                                    <div class="accordion-heading" role="tab" id="nextOfKin">
                                        <h3 class="card-title accordion-title">
                                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapsenextOfKin" aria-expanded="true" aria-controls="collapsenextOfKin">
                                            Next of Kin
                                        </a>
                                    </h3>
                                    </div>
                                    <div id="collapsenextOfKin" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="nextOfKin">
                                        <div class="accordion-content accordion-desc">
                                            <div class="row">
                                                @php
                                                    $n = 1;
                                                @endphp
                                                @foreach($user->nextKin as $contact)
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
                                    <div class="accordion-heading" role="tab" id="emergencyContact">
                                        <h3 class="card-title accordion-title">
                                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseemergencyContact" aria-expanded="true" aria-controls="collapseemergencyContact">
                                           Emergency Contact
                                        </a>
                                    </h3>
                                    </div>
                                    <div id="collapseemergencyContact" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="emergencyContact">
                                        <div class="accordion-content accordion-desc">
                                            <div class="row">
                                                @php
                                                    $n = 1;
                                                @endphp
                                                @foreach($user->emergencyContact as $contact)
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
        </div>
    </div>
</div>
@endsection

@section('dialog-section')
<div class="modal fade" id="terminateEmploymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title text-uppercase">Are you sure?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>This action cannot be undone.
                Are you sure you want to terminate <i>{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</i>'s employment?</p>
                <form action="">
                    <div class="form-group">
                        <input type="hidden"  id="selectedUser">
                    </div>
                    <div class="btn-group d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>No, cancel</button>
                        <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="terminateEmploymentBtn"><i class="mr-2 ti-check"></i>Yes, please</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/profile.js"></script>
@stack('profile-script')
@endsection
