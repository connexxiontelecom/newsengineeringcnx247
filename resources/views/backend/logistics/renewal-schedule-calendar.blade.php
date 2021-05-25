@extends('layouts.app')

@section('title')
    Renewal Schedule
@endsection

@section('extra-styles')

	<link rel="stylesheet" type="text/css" href="{{asset('/assets/fullcalendar/fullcalendar.min.css')}}">
	<script type="text/javascript" src="{{asset('/assets/fullcalendar/fullcalendar.min.js')}}"></script>

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Product detail page start -->
        <div class="card product-detail-page">
					<div class="card">
						<div class="card-block">
							<div class="row">
								<div class="col-3 offset-9">
									<a href="{{route('renewal-schedule')}}" class="btn btn-primary btn-mini float-right mb-3"><i class="icofont icofont-tasks mr-2"></i>List View</a>

								</div>
							</div>
							<h5 class="m-0 sub-title">
								 Calendar
							</h5>
							<div class="row">
								<div class="col-xl-12 col-md-12">
									<div id='fullcalendar'></div>
								</div>
							</div>
						</div>
					</div>
        </div>
    </div>
</div>


@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
	<script type="text/javascript" src="{{asset('/assets/moment/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/assets/fullcalendar/fullcalendar.min.js')}}"></script>
{{--	<script src="{{asset('/assets/js/cus/myEventsCalendar.js')}}"></script>--}}

	<script>

		$(document).ready(function() {

			$('#fullcalendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},

				defaultView: 'month',
				editable: true,
				events: '/renewal-schedule-calender-data'
			});

		});


	</script>
@endsection
