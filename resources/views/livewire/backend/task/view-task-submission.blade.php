<div class="row">
    <div class="col-md-12 filter-bar">
        @include('livewire.backend.task.common._task-slab')
    </div>
    <div class="col-sm-12 filter-bar">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title" id="assignedTask">Task Submission(s)</h5>
                <div class="row">
                    @foreach($submissions as $task)
                        @if (count($task->getPost->responsiblePersons) > 0)
                            @foreach ($task->getPost->responsiblePersons as $person)
                                @if ($person->user_id == Auth::user()->id)
                                    <div class="col-sm-4 col-md-4">
                                        <div class="card" style="border-top: 4px solid {{$task->getPost->post_color}}">
                                            <div class="card-header">
                                                @if($task->status == 'in-progress')
                                                    <i class="icofont icofont-ui-clock text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$task->status}}"></i>
                                                @elseif($task->status == 'approved')
                                                    <i class="icofont icofont-tick-mark text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$task->status}}"></i>
                                                @else
                                                    <i class="icofont icofont-ui-block text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$task->status}}"></i>
                                                @endif
                                                <a href="{{ route('view-task', $task->getPost->post_url) }}" class="card-title">{{$task->getPost->post_title}}</a>
                                                <span class="label label-primary f-right">Date: {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->getPost->created_at) )}}</span>
                                            </div>
                                            <div class="card-block">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="task-detail">{{ strlen($task->getPost->post_content) > 110 ? substr($task->getPost->post_content, 0, 110).'...' : $task->getPost->post_content }}</p>
                                                        <p class="task-due">
                                                            <strong> Due :</strong>
                                                            <strong class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->getPost->end_date) )}}</strong>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="task-list-table">
                                                    @foreach($task->getPost->responsiblePersons as $person)
                                                        <a href="/activity-stream/profile/{{$person->user->url}}">
                                                            <img class="img-fluid img-radius" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}} Status: {{$person->status}}" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar.png' }}" alt="{{$person->user->first_name}} {{$person->user->surname ?? ''}}">
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
                                                            <a class="dropdown-item waves-light waves-effect" href="{{ route('view-task', $task->getPost->post_url) }}">
                                                                <i class="ti-eye text-primary"></i> View task
                                                            </a>
                                                            @if ($task->user_id == Auth::user()->id)
                                                                <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-task', $task->getPost->post_url) }}">
                                                                    <i class="icofont icofont-ui-edit text-warning"></i> Edit task
                                                                </a>
                                                                <a class="dropdown-item waves-light waves-effect delete-task" data-toggle="modal" data-target="#taskDeleteModal" data-task-name="{{$task->getPost->post_title}}" data-task-id="{{$task->getPost->id}}" href="javascript:void(0);">
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
