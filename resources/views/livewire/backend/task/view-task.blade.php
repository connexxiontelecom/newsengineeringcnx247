




<div class="row">
    <div class="col-xl-4 col-lg-12 push-xl-8 task-detail-right">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-clock-time m-r-10"></i>Task Duration
                </h5>
                <div class="btn-group mt-2 d-flex justify-content-center" role="group">
                    <button type="button"  class="btn btn-success btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start Date">
                        <i class="ti-alarm-clock"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->start_date))}} @ {{date('h:ia', strtotime($task->start_date))}}
                    </button>
                    <button type="button"  class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Due Date">
                        <i class="ti-alarm-clock"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date))}} @ {{date('h:ia', strtotime($task->end_date))}}
                    </button>
                </div>
            </div>
        </div>
        <div class="card card-border-primary" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-ui-note m-r-10"></i> Task Details
                </h5>
            </div>
            <div class="card-block task-details">
                <table class="table table-border table-xs">
                    <tbody>
                        <tr>
                            <td>
                                <i class="icofont icofont-id-card"></i> Created:
                            </td>
                            <td class="text-right">{{date('d F, Y', strtotime($task->created_at))}}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-spinner-alt-5"></i> Priority:
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="javascript:void(0);">
                                        {{$task->priority->name}}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-ui-love-add"></i> Created by:
                            </td>
                            <td class="text-right">
                                <a href="{{ route('view-profile', $task->user->url) }}">{{$task->user->first_name}}  {{$task->user->surname ?? ''}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="icofont icofont-spinner-alt-3"></i> Revisions:</td>
                            <td class="text-right">{{count($task->postReviews)}}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-washing-machine"></i> Status:
                            </td>
                            <td class="text-right">{{$task->postStatus->name ?? '-'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div>
                    <div class="dropdown-secondary dropdown d-inline-block">
                        <button
                            class="btn btn-sm btn-primary dropdown-toggle waves-light"
                            type="button"
                            id="dropdown3"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="icofont icofont-navigation-menu"></i>
                        </button>
                        <div
                            class="dropdown-menu"
                            aria-labelledby="dropdown3"
                            data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut"
                        >
                        @if ($task->post_status == 'in-progress')
                            <a wire:click="markAsComplete({{$task->id}})"  class="dropdown-item waves-light waves-effect" href="javascript:void(0);">
                                <i class="icofont icofont-checked m-r-10"></i>Mark as completed
                            </a>

                        @endif
                        @if ($task->user_id == Auth::user()->id)
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-task', $task->post_url) }}">
                                <i class="icofont icofont-edit-alt m-r-10 text-warning"></i>Edit task
                            </a>
                        @endif
                            <a class="dropdown-item waves-light waves-effect" href="{{ route('view-task', $task->post_url) }}">
                                <i class="ti-eye text-primary m-r-10"></i>View task
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-border-danger" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-attachment"></i> Shared Files
                </h5>
                <button class="btn btn-success btn-mini float-right uploadAttachmentBtn" data-post-id="{{$task->id}}" title="Upload attachment" data-toggle="modal" data-target="#uploadTaskAttachmentModal">
                    <i class="ti-cloud-up mr-2"></i> Upload Attachment
                </button>
            </div>
            <div class="card-block task-attachment">
                <ul class="media-list">
                    @foreach ($attachments as $attach)

                    @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                                @case('pptx')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/pdf.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>

                                    @break
                                @case('pdf')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/pdf.png" height="32" width="32" alt="{{$task->name ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break

                                @case('csv')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/pdf.png" height="32" width="32" alt="{{$file->name ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('xls')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('xlsx')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('doc')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('doc')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('docx')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('jpeg')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('jpg')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('png')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('gif')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('ppt')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                                @case('txt')
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                    </div>
                                    <div class="media-body">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                        <div class="text-muted">
                                            <span>
                                                Uploaded by
                                                <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                    </div>
                                </li>
                                @break
                            @endswitch
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card card-border-info" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-users-alt-4"></i> Responsible Person(s)
                </h5>
                <button id="AddRespPersons" class="btn btn-sm btn-primary f-right btn-mini" style="margin-bottom: 10px"  {{-- wire:click="markAsComplete({{$task->id}})"  --}} title="Add a responsible person" data-toggle="modal" data-target="#modal-1" >
                <i class="fa fa-plus-square"></i>Add person</button>
            </div>
            <div style="display:none; padding-right: 10px; padding-left:10px;" id="AddRespPersonsContainer">

                <form method="post" action="{{route('add-responsible-person')}}" enctype="multipart/form-data" id="_addResponsiblePerson">
                    @csrf

                <div class="row">
                    <div class="form-group  col-md-12">
                        <label class="">Responsible Person(s)</label>
                    <input type="hidden" name="taskId" value="{{$task->id}}">
                    <input type="hidden" name="url" value="{{$link}}">
                        <select name="responsible_persons[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                            <option selected disabled>Add Responsible Person(s)</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <button id="add" class="btn btn-sm btn-warning f-right btn-mini" style="margin-bottom: 10px"  {{-- wire:click="markAsComplete({{$task->id}})"  --}}>
                        <i class="fa fa-plus-square"></i>Add</button>
                </div>

            </form>


            </div>
            <div class="card-block user-box assign-user">
                @foreach($task->responsiblePersons as $person)
                    <div class="media">
                        <div class="media-left media-middle photo-table">
                            <a href="{{ route('view-profile', $person->user->url) }}">
                                <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                            </a>
                        </div>
                        <div class="media-body">
                            <h6><a href="{{ route('view-profile', $person->user->url) }}">{{$person->user->first_name }}  {{ $person->user->surname ?? '' }}</a>
                                <button  class="btn btn-sm btn-danger f-right  btn-mini" {{-- data-toggle="tooltip" data-placement="top"
                                data-original-title="Remove Person" --}} style="margin-left: 10px" wire:click="removeResponsiblePerson({{$person->user->id}})"  title="Remove person" >
                                <i class="fa fa-trash-o"></i>
                                </button>
                            </h6>
                            <p>{{$person->user->position ?? '-' }}</p>
                        </div>
                        <div>
                            @if ($person->user_id == Auth::user()->id)
                                <div class="dropdown-secondary dropdown d-inline-block">
                                    <button
                                        class="btn btn-sm btn-light dropdown-toggle waves-light"
                                        type="button"
                                        id="dropdown3"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <i class="icofont icofont-navigation-menu"></i>
                                    </button>
                                    <div
                                        class="dropdown-menu"
                                        aria-labelledby="dropdown3"
                                        data-dropdown-in="fadeIn"
                                        data-dropdown-out="fadeOut"
                                    >
                                        <a  class="dropdown-item waves-light waves-effect" href="{{route('submit-task', $task->post_url)}}">
                                            <i class="icofont icofont-paper-plane m-r-10"></i>Submit Task
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
        <div class="card card-border-warning" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-users-alt-4"></i> Participant(s)
                </h5>
                <button class="btn btn-sm btn-primary f-right btn-mini"
                style="margin-bottom: 10px"
                itle="Add a participant" id="_addpart">
                    <i class="fa fa-plus-square"></i>Add Participant</button>
            </div>




            <div style="display:none; padding-right: 10px; padding-left:10px;" id="AddParticipantsContainer">

                <form method="post" action="{{route('add-participants')}}" enctype="multipart/form-data" id="_addParticipants" >
                    @csrf
                <div class="row">
                    <div class="form-group  col-md-12">
                        <label class="">Responsible Person(s)</label>
                    <input type="hidden" name="taskId" value="{{$task->id}}">
                    <input type="hidden" name="url" value="{{$link}}">
                        <select name="participants[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                            <option selected disabled>Add Responsible Person(s)</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <button id="add_participants"  class="btn btn-sm btn-warning f-right btn-mini" style="margin-bottom: 10px"  {{-- wire:click="markAsComplete({{$task->id}})"  --}}>
                        <i class="fa fa-plus-square"></i>Add</button>
                </div>

            </form>


            </div>





            <div class="card-block user-box assign-user">
                @if(count($task->postParticipants) > 0)
                    @foreach($task->postParticipants as $part)
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="{{ route('view-profile', $part->user->url) }}">
                                    <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $part->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6><a href="{{ route('view-profile', $part->user->url) }}">{{$part->user->first_name }}  {{ $part->user->surname ?? '' }}</a>
                                    <button class="btn btn-sm f-right btn-danger  btn-mini"
                                     {{-- data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove Participant"  --}}style="margin-left: 10px" wire:click="removeParticipant({{$part->user->id}})" title="Remove participant" >
                                    <i class="fa fa-trash-o"></i></button></h6>
                                <p>{{$part->user->position ?? '-' }}</p>
                            </div>
                            <div>
                                <a href="#!" class="text-muted">
                                    <i class="icon-options-vertical"></i>
                                </a>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                @else
                        <p class="">There're no participants for this task</p>

                @endif

            </div>
        </div>
        <div class="card card-border-primary" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-users-alt-4"></i> Observers(s)
                </h5>
                <button  class="btn btn-sm btn-primary f-right btn-mini" style="margin-bottom: 10px"
                id ="_addobserv"  title="Add an observer" >
                    <i class="fa fa-plus-square"></i>Add Observer</button>
            </div>



            <div style="display:none; padding-right: 10px; padding-left:10px;" id="AddObserversContainer">

                <form method="post" action="{{route('add-observers')}}" enctype="multipart/form-data" id="_addObservers">
                    @csrf
                <div class="row">
                    <div class="form-group  col-md-12">
                        <label class="">Responsible Person(s)</label>
                    <input type="hidden" name="taskId" value="{{$task->id}}">
                    <input type="hidden" name="url" value="{{$link}}">
                        <select name="observers[]" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                            <option selected disabled>Add Responsible Person(s)</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <button id="add_observers" class="btn btn-sm btn-warning f-right btn-mini" style="margin-bottom: 10px"  {{-- wire:click="markAsComplete({{$task->id}})"  --}}>
                        <i class="fa fa-plus-square"></i>Add</button>
                </div>

            </form>

            </div>




            <div class="card-block user-box assign-user">
                @if(count($task->postObservers) > 0)
                    @foreach($task->postObservers as $part)
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="{{ route('view-profile', $part->user->url) }}">
                                    <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $part->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6><a href="{{ route('view-profile', $part->user->url) }}">{{$part->user->first_name }}  {{ $part->user->surname ?? '' }}</a>
                                     <button class="btn f-right btn-sm btn-danger btn-mini" {{--  data-toggle="tooltip"
                                     data-placement="top" title="" data-original-title="Remove observer"  --}}style="margin-left: 10px" wire:click="removeObserver({{$part->user->id}})" title="Remove observer" >
                                    <i class="fa fa-trash-o"></i></button></h6>
                                <p>{{$part->user->position ?? '-' }}</p>

                            </div>
                            <div>
                                <a href="#!" class="text-muted">
                                    <i class="icon-options-vertical"></i>
                                </a>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                @else
                        <p class="">There're no observers for this task</p>

                @endif

            </div>
        </div>

    </div>
    <div class="col-xl-8 col-lg-12 pull-xl-4 filter-bar">
            @include('livewire.backend.task.common._task-slab')
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">
                    <i class="icofont icofont-tasks-alt m-r-5"></i> {{$task->post_title }}

                @if ($task->post_status == 'completed')
                <label for="" class="label btn-success">Completed</label>
                @elseif($task->post_status == 'in-progress')
                <label for="" class="label btn-warning">in-progress</label>

                @elseif($task->post_status == 'closed')
                <label for="" class="label btn-warning">Closed</label>

                @elseif($task->post_status == 'on-hold')
                <label for="" class="label btn-warning">On-Hold</label>

                @elseif($task->post_status == 'at-risk')
                <label for="" class="label btn-danger">At-Risk</label>

                @elseif($task->post_status == 'resolved')
                <label for="" class="label btn-success">Resolved</label>

                @endif


                </h5>
              {{--   <button
                class="btn btn-sm btn-primary f-right btn-mini" style="margin-bottom: 10px"  wire:click="markAsComplete({{$task->id}})"  title="update task status" data-toggle="modal" data-target="#taskUpdateStatus" >
                    <i class="icofont icofont-ui-alarm"></i>Update Task Status

                </button> --}}

                <button
                class="btn btn-sm btn-primary f-right dropdown-toggle waves-light"
                type="button"
                id="statusDropDown"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"

            >
                <i class="icofont icofont-ui-alarm"></i>Update Task Status
            </button>
            <div
            class="dropdown-menu"
            aria-labelledby="statusDropDown"
            data-dropdown-in="fadeIn"
            data-dropdown-out="fadeOut"
        >

            @if($task->post_status != 'at-risk')
            <a wire:click="markAsRisk({{$task->id}})"  class="dropdown-item waves-light waves-effect" href="javascript:void(0);">
                <i class="icofont icofont-checked text-danger m-r-10"></i>Mark as At-Risk
            </a>
            @endif
            {{-- <div class="dropdown-divider"></div> --}}
            @if($task->post_status != 'closed')
            <a wire:click="markAsClosed({{$task->id}})"  class="dropdown-item waves-light waves-effect" href="javascript:void(0);">
                <i class="icofont icofont-checked text-warning m-r-10"></i>Mark as Closed
            </a>
            @endif
            {{-- <div class="dropdown-divider"></div> --}}
            @if($task->post_status != 'on-hold')
            <a wire:click="markAsHold({{$task->id}})"  class="dropdown-item waves-light waves-effect" href="javascript:void(0);">
                <i class="icofont icofont-checked text-warning m-r-10"></i>Mark as on-Hold
            </a>
            @endif

           {{--  <div class="dropdown-divider"></div> --}}

           @if($task->post_status != 'resolved')
            <a wire:click="markAsResolved({{$task->id}})"  class="dropdown-item waves-light waves-effect" href="javascript:void(0);">
                <i class="icofont icofont-checked text-success m-r-10"></i>Mark as Resolved
            </a>
            @endif

            @if($task->post_status != 'completed')
            <a wire:click="markAsComplete({{$task->id}})"  class="dropdown-item waves-light waves-effect" href="javascript:void(0);">
                <i class="icofont icofont-checked text-success m-r-10"></i>Mark as Completed
            </a>
            @endif


           {{--  <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-task', $task->post_url) }}">
                <i class="icofont icofont-edit-alt m-r-10 text-warning"></i>Edit task
            </a>

            <a class="dropdown-item waves-light waves-effect" href="{{ route('view-task', $task->post_url) }}">
                <i class="ti-eye text-primary m-r-10"></i>View task
            </a> --}}
        </div>
                <div style="height: 10px"></div>


               {{--  @if ($task->post_status == 'in-progress' && $task->user_id == Auth::user()->id)
                <button class="btn btn-sm btn-primary f-right btn-mini" wire:click="markAsComplete({{$task->id}})" >
                    <i class="icofont icofont-ui-alarm"></i>Mark as completed
                </button>
                @endif --}}

                <div class="">
                    <div class="m-b-20">
                        <h6 class="sub-title m-b-15">Overview</h6>
                        {!! $task->post_content !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="card comment-block">
            <div class="card-block">
                <h5 class="sub-title">
                    <i class="icofont icofont-comment m-r-5"></i> Comments
                </h5>
                <ul class="media-list">
                    @foreach ($task->postComments as $comment)
                        <li class="media">
                            <div class="media-left">
                                <a href="{{ route('view-profile', $comment->user->url) }}">
                                    <img class="media-object img-radius comment-img" src="/assets/images/avatars/thumbnails/{{$comment->user->avatar ?? '/assets/images/avatar-1.jpg'}}" alt="{{$comment->user->first_name}} {{$comment->user->surname ?? ''}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading txt-primary">{{$comment->user->first_name}} {{ $comment->user->surname ?? ''}}
                                    <span class="f-12 text-muted m-l-5">{{ $comment->created_at->diffForHumans() }}</span>
                                </h6>
                                <p>{!! $comment->comment !!}</p>
                                <hr>
                            </div>
                        </li>

                    @endforeach
                </ul>
                <div class="md-float-material d-flex">
                    <div class="col-md-12 btn-add-task">
                        <div class="input-group input-group-button">
                            <input type="text" wire:model.debounce.10000ms="comment" class="form-control" placeholder="Leave comment...">

                            <span class="input-group-addon btn btn-primary btn-sm" wire:click="leaveCommentBtn({{$task->id }})">
                                <i class="icofont icofont-plus f-w-600"></i>
                                Comment
                            </span>
                        </div>
                        @error('comment')
                        <i class="text-danger">{{$message}}</i>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="card comment-block">
            <div class="card-block">
                <h5 class="sub-title">
                    <i class="icofont icofont-paper-plane m-r-5"></i> Submission(s)
                </h5>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-block accordion-block">
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                    @php
                                        $n = 1;
                                    @endphp

                                    @foreach($task->getPostSubmission as $post)
                                        <div class="accordion-panel">
                                            <div class="accordion-heading" role="tab" id="heading_{{$post->id}}">
                                                <h3 class="card-title accordion-title">
                                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$post->id}}" aria-expanded="true" aria-controls="collapse_{{$post->id}}">
                                                   <label class="badge badge-danger">{{$n++}}</label> Submission by: <label class="label label-primary">{{$post->submittedBy->first_name ?? ''}} {{$post->submittedBy->surname ?? ''}}</label> <small>{{date(Auth::user()->dateFormat->format ?? 'd F, Y', strtotime($post->created_at))}} @ {{date('h:ia', strtotime($post->created_at))}}</small>
                                                   @if($post->status == 'in-progress')
                                                        <label class="label label-warning float-right">{{$post->status ?? ''}}</label>
                                                   @elseif($post->status == 'approved')
                                                        <label class="label label-success float-right">{{$post->status ?? ''}}</label>
                                                   @else
                                                        <label class="label label-danger float-right">{{$post->status ?? ''}}</label>
                                                   @endif
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapse_{{$post->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_{{$post->id}}">
                                                <div class="accordion-content accordion-desc">
                                                   {!! $post->note !!}

                                                   <hr>
                                                @foreach ($submissionAttachments as $attach)
                                                        @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                                                            @case('pptx')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/pdf.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>

                                                                @break
                                                            @case('pdf')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/pdf.png" height="32" width="32" alt="{{$task->name ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break

                                                            @case('csv')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/pdf.png" height="32" width="32" alt="{{$file->name ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('xls')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('xlsx')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('doc')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('doc')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('docx')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('jpeg')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('jpg')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('png')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('gif')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('ppt')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                            @case('txt')
                                                            <li class="media d-flex m-b-10">
                                                                <div class="m-r-20 v-middle">
                                                                    <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$task->post_title ?? 'No name'}}">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}" class="m-b-5 d-block">{{strlen($task->post_title) > 25 ? substr($task->post_title, 0,25).'...' : $task->post_title }}</a>
                                                                    <div class="text-muted">
                                                                        <span>
                                                                            Uploaded by
                                                                            <a href="{{route('view-profile', $task->user->url)}}">{{$task->user->first_name ?? ''}} {{$task->surname ?? ''}}</a>
                                                                            <small>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($attach->created_at))}}</small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="f-right v-middle text-muted">
                                                                    <a href="/assets/uploads/attachments/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                                                </div>
                                                            </li>
                                                            @break
                                                        @endswitch
                                                @endforeach
                                                @if($task->post_status == 'in-progress' && $task->user_id == Auth::user()->id)
                                                    <hr>
                                                    <div class="btn-group d-flex justify-content-end mr-1">
                                                        <button class="btn btn-mini btn-success approve-submission" type="button" data-toggle="modal" data-target="#reviewTaskModal" data-responsible="{{$post->submittedBy->first_name ?? ''}} {{$post->submittedBy->surname ?? ''}}" data-user="{{$post->submitted_by}}" data-submission-id="{{$post->id}}"><i class="ti-check mr-2"></i> Approve</button>
                                                        <button class="btn btn-mini btn-danger decline-submission" type="button" data-responsible="{{$post->submittedBy->first_name ?? ''}} {{$post->submittedBy->surname ?? ''}}" data-submission-id="{{$post->id}}" data-user="{{$post->submitted_by}}"><i class="ti-close mr-2"></i> Decline</button>
                                                    </div>
                                                @endif

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 m-b-20">
                    <h6 class="sub-title m-b-15">Revisions</h6>
                </div>
                <div class="row">
                    <ul class="media-list revision-blc">
                        @if(count($task->postReviews) > 0)
                            @foreach ($task->postReviews as $review)
                            <li class="media d-flex m-b-15">
                                <div class="p-l-15 p-r-20 d-inline-block v-middle">
                                    <a href="{{ route('view-profile', $review->user->url) }}">
                                        <img class="media-object img-radius comment-img" src="/assets/images/avatars/thumbnails/{{$review->user->avatar ?? '/assets/images/avatar-1.jpg'}}" alt="{{$review->user->first_name}} {{$review->user->surname ?? ''}}">
                                    </a>
                                </div>
                                <div class="d-inline-block">
                                {!! $review->content !!}
                                    <div class="media-annotation">{{$review->created_at->diffForHumans()}}</div>
                                </div>
                            </li>

                            @endforeach

                        @else
                            <p class="ml-4 text-center">There're no reviews for this task.</p>
                        @endif
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="col-md-12 btn-add-task">
                        <div class="input-group input-group-button">
                            <input type="text" wire:model.debounce.10000ms="review" class="form-control" placeholder="Leave review...">

                            <span class="input-group-addon btn btn-primary btn-sm" wire:click="leaveReviewBtn({{$task->id }})">
                                <i class="icofont icofont-plus f-w-600"></i>
                                Review
                            </span>
                        </div>
                        @error('review')
                        <i class="text-danger">{{$message}}</i>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('task-script')
<script>
    $(document).ready(function(){
       var file_data = null;
       var postId = null;
       var responsible = null;
       var submission = null;
       var user = null;
       var appraisal = null;
       $(document).on('change', '#attachment', function(e){
           e.preventDefault();
           var extension = $('#attachment').val().split('.').pop().toLowerCase();
           if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'jpeg', 'jpg', 'png']) == -1) {
               $.notify('Ooops! File format not supported.', 'error');
               $('#attachment').val('');
           }else{
               file_data = $('#attachment').prop('files')[0];

           }
       });

       $(document).on('click', '.uploadAttachmentBtn', function(e){
           e.preventDefault();
           postId = $(this).data('post-id');

       });
        $('#taskAttachmentForm').parsley().on('field:validated', function() {

       }).on('form:submit', function() {
           var config = {
                       onUploadProgress: function(progressEvent) {
                       var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                       }
               };
               var form_data = new FormData();
               form_data.append('attachment',file_data);
               form_data.append('post', postId);
               $('#uploadTaskAttachmentBtn').text('Processing...');
                axios.post('/upload/post/attachment',form_data, config)
               .then(response=>{
                   $.notify(response.data.message, 'success');
                   $('#uploadTaskAttachmentBtn').text('Done');
                   setTimeout(function () {
                       $("#uploadTaskAttachmentBtn").text("Save");
                       location.reload();
                   }, 2000);

               })
               .catch(errors=>{
                   var errs = Object.values(errors.response.data.error);
                   $.notify(errs, "error");
                   $('#uploadTaskAttachmentBtn').text('Error!');
                   setTimeout(function () {
                       $("#uploadTaskAttachmentBtn").text("Save");
                   }, 2000);
               });
               return false;
       });

       $(document).on('click', '.submitReviewBtn', function(e){
                var form_data = new FormData();
               form_data.append('review', $('#leave_review').val());
               form_data.append('rating', $('#rating').val());
               form_data.append('revision', $('#revisionId').val());
               form_data.append('subitted', $('#submittedBy').val());
       });
       $(document).on('click', '.approve-submission', function(e){
           e.preventDefault();
           responsible = $(this).data('responsible');
           submission = $(this).data('submission-id');
           user = $(this).data('user');
           var placeholder = "What would you say about the work done by "+responsible+" ?";
           $('#leave_review').attr('placeholder', placeholder);
       });
       $("#appraisal").on('change', function() {
            if ($("#appraisal").is(':checked'))
                appraisal = 1;
            else {
                appraisal = 0;
            }
        });
       $('#reviewSubmissionForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
            axios.post('/rate/task/submitted', {
                submission:submission,
                responsible:responsible,
                review: $('#leave_review').val(),
                rating: $('#rating').val(),
                appraisal: appraisal,
                user: user,
            })
            .then(res=>{
                $.notify(res.data.message, 'success');
                $('#reviewTaskModal').modal('hide');
                $('#leave_review').val('');
            })
            .catch(error=>{
                $.notify('Ooops! Something went wrong. Try again.', 'error');
                $('#reviewTaskModal').modal('hide');
            });
            return false;
        });

        $('#AddRespPersons').on('click', function(){
            $("#AddRespPersonsContainer").toggle();//.css("display","block");
        });

        $('#add').on('click', function(){
            $("#AddRespPersonsContainer").css("display","none");
            $('_addResponsiblePerson').submit();
        });



        $('#_addpart').on('click', function(){
            $("#AddParticipantsContainer").toggle();//.css("display","block");
        });

        $('#add_participants').on('click', function(){
            $("#AddParticipantsContainer").css("display","none");
            $('_addParticipants').submit();
        });



        $('#_addobserv').on('click', function(){
            $("#AddObserversContainer").toggle();//.css("display","block");
        });


        $('#add_observers').on('click', function(){
            $("#AddObserversContainer").css("display","none");
            $('_addObservers').submit();
        });





       });
   </script>
@endpush
