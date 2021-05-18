<nav class="navbar navbar-light bg-faded m-b-30 p-10">
    <div class="row">
        <div class="d-inline-block">
            <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('task-board')}}"><i class="icofont icofont-tasks"></i>  Tasks Board</a>
						@can('task gantt chart')

						<a href="{{ route('task-gantt-chart') }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-spreadsheet"></i> Gantt</a>
						@endcan
						@can('task calendar')

            <a href="{{ route('task-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-calendar"></i>  Calendar</a>
						@endcan
						@can('task analytics')

            <a href="{{ route('task-analytics') }}" class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-pie-chart "></i>  Analytics </a>
						@endcan
            <a href="{{route('task-board')}}#participatingObserving" class="btn btn-secondary btn-mini btn-round text-white"><i class="icofont icofont-unity-hand "></i>  Participating | Observing </a>

        </div>
		</div>
		@can('create task')
			<div class="nav-item nav-grid">
					<a href="{{route('new-task')}}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="ti-plus mr-2"></i>New Task</a>
			</div>

		@endcan
</nav>
