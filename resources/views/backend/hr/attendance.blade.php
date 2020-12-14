@extends('layouts.app')

@section('title')
    Attendance
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
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
    <div class="col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <a href="{{ url()->previous() }}" class="btn-mini btn-secondary btn"> <i class="ti-back-left"></i> Back</a>
                <!--<div class="btn-group d-flex justify-content-center mb-4">
                    <button class="btn btn-mini btn-danger"> <i class="icofont icofont-file-excel"></i> Export Excel</button>
                    <button class="btn btn-mini btn-secondary"> <i class="icofont icofont-file-excel"></i> Export CSV</button>
                </div> -->
                <!--<div class="card-header-right form-inline">
                    <label for="">Sort</label>
                    <select name="" id="" class="form-control">
                        <option value="">Today</option>
                        <option value="">This Week</option>
                        <option value="">This Month</option>
                        <option value="">This Year</option>
                    </select>
                </div> -->
                <br>
                <h5>Attendance</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="base-style" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Clocked-in</th>
                                <th>Clocked-out</th>
                                <th>Duration</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $attend)
                                @php
                                    $start = \Carbon\Carbon::parse($attend->clock_in);
                                    $end = \Carbon\Carbon::parse($attend->clock_out);

                                    $diff = $start->diffInMinutes($end);
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('view-profile', $attend->user->url) }}">
                                            <img src="/assets/images/avatars/thumbnails/{{ $attend->user->avatar ?? 'avatar.png' }}" class="img-40" alt="{{$attend->user->first_name ?? ''}} {{ $attend->user->surname ?? '' }}">
                                        </a>
                                        <a href="{{ route('view-profile', $attend->user->url) }}">{{$attend->user->first_name ?? ''}} {{ $attend->user->surname ?? '' }}</a>
                                    </td>
                                    <td>{{date('d F, Y', strtotime($attend->clock_in)) ?? '-'}} @ {{ date('h:i a', strtotime($attend->clock_in)) }} | <small>{{ \Carbon\Carbon::parse($attend->clock_in)->diffForHumans() ?? '-'}}</small> </td>
                                    <td>@if(!is_null($attend->clock_out)){{ date('d F, Y', strtotime($attend->clock_out))}} @ {{ date('h:i a', strtotime($attend->clock_out))}}  <small> | {{  \Carbon\Carbon::parse($attend->clock_out)->diffForHumans() }}</small> @else No record found. @endif</td>
                                    <td> <label for="" class="label label-info">{{number_format($diff) ?? '-'}} <small>minutes</small> </label> </td>
                                    <td>{{ date('d F, Y', strtotime($attend->created_at)) ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Clocked-in</th>
                                <th>Clocked-out</th>
                                <th>Duration</th>
                                <th>Date</th>
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
    <!-- data-table js -->
    <script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
@endsection
