<div class="row">

    <div class="col-xl-3 col-lg-12 push-xl-9">
        <div class="card">
            <div class="card-block p-t-10">
                <div class="task-right">
                    <div class="task-right-header-users">
                        <span class=" sub-title">Recent Creators</span>
                    </div>
                    <div class="user-box assign-user taskboard-right-users">
                    @foreach($projects->take(5) as $proj)
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
        @include('livewire.backend.project.common._project-slab')
        <div class="row">
            <div class="col-sm-12 filter-bar">
                <div class="card">
                    <div class="card-block">
                        <h5 class="sub-title" id="assignedTask">Assigned Project(s)</h5>
                        <p class="text-muted">These project(s) were assigned to you by someone.</p>
                        <div class="row">


                            @foreach ($projects as $task)
                                @foreach ($task->responsiblePersons as $person)
                                    @if ($person->user_id == Auth::user()->id)




                                        <div class="col-sm-6">
                                            <div class="card" style="border-top: 4px solid {{$task->post_color}}">
                                                 <div class="card-header">
                                                      <a href="{{ route('view-project', $task->post_url) }}" class="card-title">{{$task->post_title}}</a>
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
                                                    {{-- <a href="{{ route('view-project', $task->post_url) }}" class="card-title">{{$task->post_title}}</a>
                                                    <span class="label label-primary f-right"> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->created_at) )}}</span> --}}
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p class="task-detail">{!! strlen(strip_tags($task->post_content)) > 110 ? substr(strip_tags($task->post_content), 0, 110).'...' : strip_tags($task->post_content) !!}</p>
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
                                                                <a class="dropdown-item waves-light waves-effect" href="{{route('view-project', $task->post_url)}}">
                                                                    <i class="ti-eye text-primary"></i> View project
                                                                </a>
                                                                @if($task->user_id == Auth::user()->id)
                                                                    <a class="dropdown-item waves-light waves-effect" href="{{route('edit-project', $task->post_url)}}">
                                                                        <i class="icofont icofont-ui-edit text-warning"></i> Edit project
                                                                    </a>
                                                                    <a href="javascript:void(0);" class="dropdown-item waves-light waves-effect delete-project" data-toggle="modal" data-target="#projectDeleteModal" data-project-name="{{$task->post_title}}" data-project-id="{{$task->id}}">
                                                                        <i class="ti-trash text-danger"></i> Delete project
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
    @can('view projects')
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <p class="text-muted">Kindly <a href="" class="btn btn-success btn-mini waves-effect waves-light"><i class="zmdi zmdi-shopping-cart mr-2"></i> upgrade</a> your plan to access this feature or contact your admin.</p>
            </div>
        </div>
    </div>
@endcan
</div>
@push('project-script')
<script>
    $(document).ready(function(){

        $('#datatable-assignment').DataTable();
        $('#datatable-request').DataTable();

        $(document).on('click', '.delete-project', function(e){
            e.preventDefault();
            var id = $(this).data('project-id');
            var name = $(this).data('project-name');
            $('#projectName').text(name);
            $('#projectId').val(id);
        });
        $(document).on('click', '#deleteProjectBtn', function(e){
            e.preventDefault();
            axios.post('/delete/project', {projectId:$('#projectId').val()})
            .then(response=>{
                $.notify('Success! Project deleted.', 'success');
                location.reload();
            });
        });
    });
</script>
@endpush
