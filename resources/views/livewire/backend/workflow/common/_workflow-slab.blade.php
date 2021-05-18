<nav class="navbar navbar-light bg-faded m-b-30 p-10">
    <div class="row">
        <div class="d-inline-block">
            <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('workflow-tasks')}}"><i class="icofont icofont-tasks"></i>  Workflow Tasks</a>
						<a href="{{route('workflow-tasks')}}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-spreadsheet"></i> My Requests</a>
						@can('view workflow statistics')
            <a href="{{ route('workflow-tasks') }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-calendar"></i>  Statistics</a>

						@endcan
						@can('set business process')
						<a href="{{ route('workflow-business-process') }}" class="btn btn-danger btn-mini btn-round text-white"><i class="ti-target"></i>  Business Process</a>

						@endcan
        </div>
    </div>
    <div class="nav-item nav-grid">
        <div class="dropdown-primary dropdown open mt-2 float-right">
            <button class="btn btn-primary btn-mini waves-effect waves-light dropdown-toggle waves-effect waves-light" type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-time mr-2"></i>Run Business Process</button>
            <div class="dropdown-menu text-uppercase" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a class="dropdown-item waves-light waves-effect" href="{{route('expense-report')}}"><i class="ti-notepad mr-2 text-danger"></i> Expense Report </a>
                <a class="dropdown-item waves-light waves-effect" href="{{route('purchase-request')}}"><i class="ti-wallet mr-2 text-danger"></i> Purchase Request </a>
                <a class="dropdown-item waves-light waves-effect" href="{{route('general-request')}}"><i class="ti-clipboard mr-2 text-danger"></i> General Request </a>
								<a class="dropdown-item waves-light waves-effect" href="{{route('business-trip')}}"><i class="ti-notepad mr-2 text-danger"></i> Business Trip </a>
								@can('raise leave approval')
                <a class="dropdown-item waves-light waves-effect" href="{{route('leave-request')}}"><i class="ti-calendar mr-2 text-danger"></i> Leave Approval </a>

								@endcan
								@can('raise internal memo')
                <a class="dropdown-item waves-light waves-effect" href="{{ route('internal-memo') }}"><i class="ti-pin-alt mr-2 text-danger"></i> Internal Memo </a>

								@endcan
            </div>
        </div>
    </div>
</nav>
