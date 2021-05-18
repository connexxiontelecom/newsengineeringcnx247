<nav class="navbar navbar-light bg-faded m-b-30 p-10">
    <div class="row">
        <div class="d-inline-block">
            <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('project-board')}}"><i class="icofont icofont-tasks"></i>  Project Board</a>
						@can('project gantt chart')
						<a href="{{ route('project-gantt-chart') }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-spreadsheet"></i> Gantt</a>

						@endcan
						@can('project calendar')
						<a href="{{ route('project-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-calendar"></i>  Calendar</a>

						@endcan
           @can('project analytics')
					 	<a href="{{ route('project-analytics') }}" class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-pie-chart "></i>  Analytics </a>

					 @endcan
        </div>
		</div>

			<div class="nav-item nav-grid">
					<a href="{{route('new-project')}}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="ti-plus mr-2"></i>New Project</a>
			</div>
</nav>
