<div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="ti-shield f-30 text-c-pink"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">At Risk</h6>
                            <h5 class="m-b-0">{{number_format($atRiskTasks)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="icofont icofont-sand-clock f-30 text-c-yellow"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">In Progress</h6>
                            <h5 class="m-b-0">{{number_format($inprogressTasks)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="ti-check f-30 text-c-green"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">Complete</h6>
                            <h5 class="m-b-0">{{number_format($completedTasks)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="ti-na f-30 text-c-pink"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">Cancel</h6>
                            <h5 class="m-b-0">{{number_format($cancelTask)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-12 push-xl-9">
            <div class="card">
                <div class="card-block p-t-3">
                    <div class="task-right">
                        <div class="task-right-header-users">
                            <span class=" sub-title">Recent Creators</span>
                        </div>
                        <div class="user-box assign-user taskboard-right-users">
                            @foreach($tasks->take(5) as $proj)
                                <div class="media">
                                    <div class="media-left media-middle photo-table">
                                        <a href="{{route('view-profile',$proj->user->url )}}">
                                            <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$proj->user->avatar ?? 'avatar.png'}}" alt="User">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="{{route('view-profile',$proj->user->url )}}">
                                            <h6>{{$proj->user->first_name ?? ''}} {{$proj->user->surname ?? ''}}</h6>
                                        </a>
                                        <p>{{$proj->user->position ?? ''}}</p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-12 pull-xl-3 filter-bar">
            @include('livewire.backend.task.common._task-slab')
            <div class="row">
                <div class="col-sm-12 filter-bar">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="sub-title" id="assignedTask">Assigned Task(s)</h5>
                            <p class="text-muted">These task(s) were assigned to you by someone.</p>
                            <div class="row">
                                @foreach($tasks as $task)
                                    @if (count($task->responsiblePersons) > 0)
                                        @foreach ($task->responsiblePersons as $person)
                                            @if ($person->user_id == Auth::user()->id)
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="card" style="border-top: 4px solid {{$task->post_color}}">
                                                        <div class="card-header">
                                                            <a href="{{ route('view-task', $task->post_url) }}" class="card-title">{{$task->post_title}}</a>
                                                            <span class="label label-primary f-right"> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->created_at) )}}</span>
                                                        </div>
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <p class="task-detail">{{ strlen(strip_tags($task->post_content)) > 110 ? substr(strip_tags($task->post_content), 0, 110).'...' : strip_tags($task->post_content) }}</p>
                                                                    <p class="task-due">
                                                                        <strong> Due :</strong>
                                                                        <strong class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date) )}}</strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="task-list-table">
                                                                @foreach($task->responsiblePersons as $person)
                                                                    <a href="/activity-stream/profile/{{$person->user->url}}">
                                                                        <img class="img-fluid img-radius" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar.png' }}" alt="{{$person->user->first_name}} {{$person->user->surname ?? ''}}">
                                                                    </a>

                                                                @endforeach
                                                            </div>
                                                            <div class="task-board">
                                                                <div class="dropdown-secondary dropdown">
                                                                    <button
                                                                        class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                                                        type="button"
                                                                        id="dropdown6"
                                                                        data-toggle="dropdown"
                                                                        aria-haspopup="true"
                                                                        aria-expanded="false"
                                                                    >
                                                                        <i class="icofont icofont-navigation-menu"></i>
                                                                    </button>
                                                                    <div
                                                                        class="dropdown-menu"
                                                                        aria-labelledby="dropdown6"
                                                                        data-dropdown-in="fadeIn"
                                                                        data-dropdown-out="fadeOut"
                                                                    >
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect" href="{{ route('view-task', $task->post_url) }}">
                                                                            <i class="ti-eye text-primary"></i> View task
                                                                        </a>
                                                                        @if ($task->user_id == Auth::user()->id)
                                                                            <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-task', $task->post_url) }}">
                                                                                <i class="icofont icofont-ui-edit text-warning"></i> Edit task
                                                                            </a>
                                                                            <a class="dropdown-item waves-light waves-effect delete-task" data-toggle="modal" data-target="#taskDeleteModal" data-task-name="{{$task->post_title}}" data-task-id="{{$task->id}}" href="javascript:void(0);">
                                                                                <i class="icofont icofont-close-line text-danger"></i> Delete
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 filter-bar">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="sub-title" id="myTask">My Task(s)</h5>
                            <p class="text-muted">Tasks that were created by you.</p>
                            <div class="row">
                                @foreach($tasks as $task)
                                        @if ($task->user_id == Auth::user()->id)
                                            <div class="col-sm-6 col-md-6">
                                                <div class="card" style="border-top: 4px solid {{$task->post_color}}">


                                                    <div class="card-header">
                                                        <a href="{{ route('view-task', $task->post_url) }}" class="card-title">{{$task->post_title}}</a>
                                                        {{-- <span class=" btn-warning label f-right"> {{ " In - progress" }}</span> --}}

                                                        @if ($task->post_status == 'completed')
                                                        <label for="" class="label  f-right btn-success">Completed</label>
                                                        @elseif($task->post_status == 'in-progress')
                                                        <label for="" class="label btn-warning f-right">in-progress</label>

                                                        @elseif($task->post_status == 'closed')
                                                        <label for="" class="label btn-warning f-right">Closed</label>

                                                        @elseif($task->post_status == 'on-hold')
                                                        <label for="" class="label btn-warning f-right">On-Hold</label>

                                                        @elseif($task->post_status == 'at-risk')
                                                        <label for="" class="label btn-danger f-right">At-Risk</label>

                                                        @elseif($task->post_status == 'resolved')
                                                        <label for="" class="label btn-success f-right">Resolved</label>

                                                        @endif

                                                        <p><i class="ti-alarm-clock"></i><label style="font-size: 10px; margin-right:10px;" >created: </label><label style="font-size: 10px;"> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->created_at) )}}</label></p>
                                                    </div>

                                                 {{--    <div class="card-header">
                                                        <a href="{{ route('view-task', $task->post_url) }}" class="card-title">{{$task->post_title}}</a>
                                                        <span class="label label-primary f-right"> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->created_at) )}}</span>
                                                    </div> --}}

                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <p class="task-detail">{{ strlen(strip_tags($task->post_content)) > 110 ? substr(strip_tags($task->post_content), 0, 110).'...' : strip_tags($task->post_content) }}</p>
                                                                <p class="task-due">
                                                                    <strong> Due :</strong>
                                                                    <strong class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date) )}}</strong>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="task-list-table">
                                                            @foreach($task->responsiblePersons as $person)
                                                                <a href="/activity-stream/profile/{{$person->user->url}}">
                                                                    <img class="img-fluid img-radius" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar.png' }}" alt="{{$person->user->first_name}} {{$person->user->surname ?? ''}}">
                                                                </a>

                                                            @endforeach
                                                        </div>
                                                        <div class="task-board">
                                                            <div class="dropdown-secondary dropdown">
                                                                <button
                                                                    class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                                                    type="button"
                                                                    id="dropdown6"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                    <i class="icofont icofont-navigation-menu"></i>
                                                                </button>
                                                                <div
                                                                    class="dropdown-menu"
                                                                    aria-labelledby="dropdown6"
                                                                    data-dropdown-in="fadeIn"
                                                                    data-dropdown-out="fadeOut"
                                                                >
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item waves-light waves-effect" href="{{ route('view-task', $task->post_url) }}">
                                                                        <i class="ti-eye text-primary"></i> View task
                                                                    </a>
                                                                    @if ($task->user_id == Auth::user()->id)
                                                                        <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-task', $task->post_url) }}">
                                                                            <i class="icofont icofont-ui-edit text-warning"></i> Edit task
                                                                        </a>
                                                                        <a class="dropdown-item waves-light waves-effect delete-task" data-toggle="modal" data-target="#taskDeleteModal" data-task-name="{{$task->post_title}}" data-task-id="{{$task->id}}" href="javascript:void(0);">
                                                                            <i class="icofont icofont-close-line text-danger"></i> Delete
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 filter-bar">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="sub-title" id="participatingObserving">Participating <label for="" class="badge badge-primary">or</label> Observing</h5>
                            <p class="text-muted">These are tasks that you're either observing or participating.</p>
                            <div class="row">
                                @foreach($tasks as $task)
                                    @foreach ($task->postParticipants as $participant)
                                        @if ($participant->user_id == Auth::user()->id)
                                            <div class="col-sm-6 col-md-6">
                                                <div class="card" style="border-top: 4px solid {{$task->post_color}}">
                                                    <div class="card-header">
                                                        <a href="{{ route('view-task', $task->post_url) }}" class="card-title">{{$task->post_title}}</a>
                                                        <span class="label label-primary f-right"> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->created_at) )}}</span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <p class="task-detail">{{ strlen($task->post_content) > 110 ? substr($task->post_content, 0, 110).'...' : $task->post_content }}</p>
                                                                <p class="task-due">
                                                                    <strong> Due :</strong>
                                                                    <strong class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date) )}}</strong>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="task-list-table">
                                                            @foreach($task->responsiblePersons as $person)
                                                                <a href="/activity-stream/profile/{{$person->user->url}}">
                                                                    <img class="img-fluid img-radius" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar.png' }}" alt="{{$person->user->first_name}} {{$person->user->surname ?? ''}}">
                                                                </a>

                                                            @endforeach
                                                        </div>
                                                        <div class="task-board">
                                                            <div class="dropdown-secondary dropdown">
                                                                <button
                                                                    class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                                                    type="button"
                                                                    id="dropdown6"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                    <i class="icofont icofont-navigation-menu"></i>
                                                                </button>
                                                                <div
                                                                    class="dropdown-menu"
                                                                    aria-labelledby="dropdown6"
                                                                    data-dropdown-in="fadeIn"
                                                                    data-dropdown-out="fadeOut"
                                                                >
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item waves-light waves-effect" href="{{ route('view-task', $task->post_url) }}">
                                                                        <i class="ti-eye text-primary"></i> View task
                                                                    </a>
                                                                    @if ($task->user_id == Auth::user()->id)
                                                                        <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-task', $task->post_url) }}">
                                                                            <i class="icofont icofont-ui-edit text-warning"></i> Edit task
                                                                        </a>
                                                                        <a class="dropdown-item waves-light waves-effect delete-task" data-toggle="modal" data-target="#taskDeleteModal" data-task-name="{{$task->post_title}}" data-task-id="{{$task->id}}" href="javascript:void(0);">
                                                                            <i class="icofont icofont-close-line text-danger"></i> Delete
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                    @foreach ($task->postObservers as $observer)
                                        @if ($observer->user_id == Auth::user()->id)
                                            <div class="col-sm-6 col-md-6">
                                                <div class="card" style="border-top: 4px solid {{$task->post_color}}">
                                                    <div class="card-header">
                                                        <a href="{{ route('view-task', $task->post_url) }}" class="card-title">{{$task->post_title}}</a>
                                                        <span class="label label-primary f-right"> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->created_at) )}}</span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <p class="task-detail">{!! strlen($task->post_content) > 110 ? substr($task->post_content, 0, 110).'...' : $task->post_content !!}</p>
                                                                <p class="task-due">
                                                                    <strong> Due :</strong>
                                                                    <strong class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date) )}}</strong>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="task-list-table">
                                                            @foreach($task->responsiblePersons as $person)
                                                                <a href="/activity-stream/profile/{{$person->user->url}}">
                                                                    <img class="img-fluid img-radius" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar.png' }}" alt="{{$person->user->first_name}} {{$person->user->surname ?? ''}}">
                                                                </a>

                                                            @endforeach
                                                        </div>
                                                        <div class="task-board">
                                                            <div class="dropdown-secondary dropdown">
                                                                <button
                                                                    class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                                                    type="button"
                                                                    id="dropdown6"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                    <i class="icofont icofont-navigation-menu"></i>
                                                                </button>
                                                                <div
                                                                    class="dropdown-menu"
                                                                    aria-labelledby="dropdown6"
                                                                    data-dropdown-in="fadeIn"
                                                                    data-dropdown-out="fadeOut"
                                                                >
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item waves-light waves-effect" href="{{ route('view-task', $task->post_url) }}">
                                                                        <i class="ti-eye text-primary"></i> View task
                                                                    </a>
                                                                    @if ($task->user_id == Auth::user()->id)
                                                                        <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-task', $task->post_url) }}">
                                                                            <i class="icofont icofont-ui-edit text-warning"></i> Edit task
                                                                        </a>
                                                                        <a class="dropdown-item waves-light waves-effect delete-task" data-toggle="modal" data-target="#taskDeleteModal" data-task-name="{{$task->post_title}}" data-task-id="{{$task->id}}" href="javascript:void(0);">
                                                                            <i class="icofont icofont-close-line text-danger"></i> Delete
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('task-script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.delete-task', function(e){
                e.preventDefault();
                var id = $(this).data('task-id');
                var name = $(this).data('task-name');
                $('#taskName').text(name);
                $('#taskId').val(id);
            });
            $(document).on('click', '#deleteTaskBtn', function(e){
                e.preventDefault();
                axios.post('/delete/task', {taskId:$('#taskId').val()})
                .then(response=>{
                    $.notify('Success! Task deleted.', 'success');
                    location.reload();
                });
            });
        });
    </script>
@endpush
