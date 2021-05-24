@extends('layouts.app')

@section('title')
    maintenance Schedule
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
									<a href="{{route('maintenance-schedule')}}" class="btn btn-primary btn-mini float-right mb-3"><i class="icofont icofont-tasks mr-2"></i>List View</a>

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
	<script src="{{asset('/assets/js/cus/myEventsCalendar.js')}}"></script>

	<script>

		$(document).ready(function() {

			$('#fullcalendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				defaultDate: '2014-06-12',
				defaultView: 'month',
				editable: true,
				events: [
					{
						title: 'All Day Event',
						start: '2014-06-01'
					},
					{
						title: 'Long Event',
						start: '2014-06-07',
						end: '2014-06-10'
					},
					{
						id: 999,
						title: 'Repeating Event',
						start: '2014-06-09T16:00:00'
					},
					{
						id: 999,
						title: 'Repeating Event',
						start: '2014-06-16T16:00:00'
					},
					{
						title: 'Meeting',
						start: '2014-06-12T10:30:00',
						end: '2014-06-12T12:30:00'
					},
					{
						title: 'Lunch',
						start: '2014-06-12T12:00:00'
					},
					{
						title: 'Birthday Party',
						start: '2014-06-13T07:00:00'
					},
					{
						title: 'Click for Google',
						url: 'http://google.com/',
						start: '2014-06-28'
					}
				]
			});

		});


	</script>
@endsection
