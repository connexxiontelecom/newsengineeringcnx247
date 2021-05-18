<nav class="navbar navbar-light bg-faded m-b-30 p-10">
    <div class="row">
        <div class="d-inline-block">
            <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('my-event-list')}}"><i class="icofont icofont-tasks"></i>  List Events</a>
            <a href="{{ route('my-event-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-calendar"></i> Calendar</a>
        </div>
    </div>
    <div class="nav-item nav-grid">
        <a href="{{route('my-new-event')}}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="ti-plus mr-2"></i>New Event</a>
    </div>
</nav>
