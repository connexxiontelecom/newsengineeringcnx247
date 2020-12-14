@extends('layouts.app')

@section('title')
    Project Calendar
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/fullcalendar/fullcalendar.min.css')}}">
    <style>
        .fc .fc-view-container .fc-view table .fc-body .fc-widget-content .fc-day-grid-container .fc-day-grid .fc-row .fc-content-skeleton table .fc-event-container .fc-day-grid-event.fc-event{
            padding: 9px 16px;
            border-radius: 20px 20px 20px 0px;
}
.fc-title{
    color:white !important;
}
.fc-time{
    color: white !important;
}

.nav-pills .nav-link.active, .nav-pills .show > .nav-link{
        background: #9DCB5C !important;
    }
    .nav-pills .nav-link{
        border-radius: 0px !important;
    }
    .dropdown-menu{
        border:none !important;
    }
    </style>
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-md-12 filter-bar">
                @include('livewire.backend.project.common._project-slab')
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div id='fullcalendar'></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type="text/javascript" src="{{asset('/assets/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/projectCalendar.js')}}"></script>
@endsection
