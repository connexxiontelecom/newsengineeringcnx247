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
                            <h5 class="m-b-0">{{number_format($tasks->where('post_status', 'at-risk')->where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'task')->count())}}</h5>
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
                            <h5 class="m-b-0">{{number_format($tasks->where('post_status', 'in-progress')->where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'task')->count())}}</h5>
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
                            <h5 class="m-b-0">{{number_format($tasks->where('post_status', 'completed')->where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'task')->count())}}</h5>
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
                            <h5 class="m-b-0">{{number_format($tasks->where('post_status', 'cancelled')->where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'task')->count())}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12  filter-bar">
            <div class="card">
                <div class="card-block">
                    <form wire:submit.prevent="sortTask">
                        <div class="row">
                            <div class="col-sm-6 ">
                                <label for="">Date Range</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon btn btn-light">
                                        <span class="">From</span>
                                    </span>
                                    <input type="date" wire:model.debounce.90000ms="from" class="form-control" placeholder="From">
                                    <span class="input-group-addon btn btn-light">
                                        <span class="">To</span>
                                    </span>
                                    <input type="date" wire:model.debounce.90000ms="to" class="form-control" placeholder="To">
                                        <button class="input-group-addon" style="cursor: pointer;" type="submit">Sort Task</button>
                                </div>
                                @error('from')
                                <i class="text-danger">{{$message}}</i> <br>
                                @enderror
                                @error('to')
                                <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12  filter-bar">
            @include('livewire.backend.task.common._task-slab')
            <div class="row">
                <div class="col-xl-9 col-md-12">
                    <div class="card social-network">
                        <div class="card-header">
                            <h5>Task Overview</h5>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <i class="icofont icofont-ui-calendar text-primary"></i>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">Overall :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($overall)}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">This Year :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($thisYear)}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">Last Month :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($lastMonth)}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">This Month :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($thisMonth)}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <i class="icofont icofont-ui-calendar text-primary"></i>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">Last Week :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($lastWeek)}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">This Week :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($thisWeek)}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">Yesterday :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($yesterday)}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">Today :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($today)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 m-t-0">
                                    <i class="icofont icofont-ui-calendar text-primary"></i>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">Last Year :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($lastYear)}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 m-t-0">
                                    <i class="icofont icofont-ui-calendar text-primary"></i>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-muted m-b-5">Last Three Years :</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="m-b-5 f-w-400">{{number_format($lastThreeYears)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-12">
                    <div class="card user-card2">
                        <div class="card-block text-center">
                            <h6 class="m-b-15">Scale</h6>
                            <div class="risk-rate">
                                <span>{{number_format($tasks->where('post_status', 'completed')->where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'task')->count() - $tasks->where('post_status', 'in-progress')->where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'task')->count())}}</span>
                            </div>
                            <h6 class="m-b-10 m-t-10">Scale</h6>
                            <a href="{{route('task-board')}}" class="text-c-yellow b-b-warning">Task Dashoard</a>
                            <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                                <div class="col m-t-15 b-r-default">
                                    <h6 class="text-muted">Completed</h6>
                                    <h6>{{number_format($tasks->where('post_status', 'completed')->where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'task')->count())}}</h6>
                                </div>
                                <div class="col m-t-15">
                                    <h6 class="text-muted">In-Progress</h6>
                                    <h6>{{number_format($tasks->where('post_status', 'in-progress')->where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'task')->count())}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tasks</h5>
                            <span>Collection of tasks</span>

                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="DOM-dt" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Author</th>
                                            <th>Assigned To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @if (count($tasks) > 0)
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <a href="{{route('view-task', $task->post_url)}}">
                                                        {{strlen($task->post_title) > 15 ? substr($task->post_title, 0,15).'...'  : $task->post_title}}
                                                    </a>
                                                </td>
                                                <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->start_date)) }}</td>
                                                <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date)) }}</td>
                                                <td>
                                                    <label for="" class="label label-info">{{$task->postStatus->name ?? ''}}</label>
                                                </td>
                                                <td>
                                                    <a href="{{route('view-profile', $task->user->url)}}">
                                                        <img class="img-30 img-radius" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$task->user->first_name ?? ''}} {{$task->user->surname ?? ''}} " src="/assets/images/avatars/thumbnails/{{$person->user->avatar ?? 'avatar.png'}}" alt="Arthur Crooks ">
                                                    </a>
                                                    <a href="{{route('view-profile', $task->user->url)}}">
                                                        {{$task->user->first_name ?? ''}} {{$task->user->surname ?? ''}}
                                                    </a>
                                                </td>
                                                <td>
                                                    @foreach ($task->responsiblePersons as $person)
                                                    <a href="{{route('view-profile', $person->user->url)}}">
                                                        <img class="img-30 img-radius" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name ?? ''}} {{$person->user->surname ?? ''}} " src="/assets/images/avatars/thumbnails/{{$person->user->avatar ?? 'avatar.png'}}" alt="Arthur Crooks ">
                                                    </a>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">No records found...</td>
                                            </tr>
                                        @endif
                                </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Author</th>
                                        <th>Assigned To</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
