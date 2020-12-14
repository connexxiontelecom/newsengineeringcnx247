<nav class="navbar navbar-light bg-faded m-b-30 p-10 filter-bar">
	<div class="row">
			<div class="d-inline-block">
					<a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('project-board')}}"><i class="icofont icofont-tasks"></i>  Project Detail</a>
					<a href="{{ route('project-budget', $project->post_url) }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-spreadsheet"></i> Budget</a>
					<a href="{{ route('project-invoice', $project->post_url) }}" class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-money-bag "></i>  Invoice </a>
					<a href="{{ route('project-bill', $project->post_url) }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-receipt "></i>  Bill </a>
			</div>
	</div>
	<div class="nav-item nav-grid">
			<a href="{{ route('load-project-gantt-chart',$project->post_url) }}" class="btn btn-info btn-mini btn-round text-white"><i class="icofont icofont-pie-chart "></i>  Gantt</a>
			<a href="{{ route('project-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-calendar"></i>  Calendar</a>
			<a href="{{ route('project-analytics') }}" class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-pie-chart "></i>  Analytics </a>
	</div>
</nav>
