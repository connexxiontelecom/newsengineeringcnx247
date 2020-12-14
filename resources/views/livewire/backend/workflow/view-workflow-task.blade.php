<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('workflow-tasks')}}">Workflow Tasks</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"href="{{route('workflow-tasks')}}">My Requests</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('workflow-tasks')}}">Workflow in Activity Stream</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                    <div class="card-block">
                        <h5 class="sub-title text-center">Processors</h5>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="card-block">
                                    <div class="team-box p-b-20">
                                        <div class="team-section d-inline-block">
                                            <a href="#! "><img src="/assets/images/avatars/thumbnails/{{$request->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$request->user->first_name }} {{$request->user->surname ?? ''}} is the requester"></a>
                                        </div>
                                    </div>

                                </div>
                                    @foreach ($request->responsiblePersons as $processor)
                                        <div class="card-block" style="padding:10px;">
                                            <div class="team-box p-b-10">
                                                <div class="team-section d-inline-block">
                                                    @if($processor->status == 'in-progress')
                                                        <i class="ti-timer mr-1 text-warning"></i>
                                                    @elseif($processor->status == 'approved')
                                                        <i class="ti-check-box mr-1 text-success"></i>
                                                    @elseif($processor->status == 'declined')
                                                        <i class="ti-na text-danger"></i>
                                                    @endif
                                                    <a href="#! "><img src="/assets/images/avatars/thumbnails/{{$processor->user->avatar ?? 'avatar.png'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$processor->user->first_name }} {{$processor->user->surname ?? ''}} {{$processor->status}} request"></a>
                                                    <i class="zmdi zmdi-long-arrow-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-12 d-flex align-items-center bd-highlight mb-4 ">
                                            <div class="team-box p-b-10">
                                                <div class="team-section d-inline-block">
                                                    @switch($request->post_status)
                                                        @case('in-progress')
                                                            <label for="" class="label label-warning special-badge">In-progress</label>
                                                            @break
                                                        @case('approved')
                                                            <label for="" class="label label-success special-badge">Approved</label>
                                                            @break
                                                        @case('declined')
                                                            <label for="" class="label label-danger special-badge">Declined</label>
                                                            @break
                                                        @default

                                                    @endswitch
                                                    @if ($request->post_type == 'leave-request' && $request->post_status == 'approved' && $request->user_id == Auth::user()->id)
                                                        <button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini clockInBtn" wire:click="clockIn({{ $request->id }})"> <i class="ti-alarm-clock mr-2"></i>
                                                            Clock-in
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    @if($request->post_status == 'in-progress')
                                        @foreach($request->responsiblePersons as $app)

                                        @if($app->user_id == Auth::user()->id && $app->status == 'in-progress')
                                                <button class="btn btn-out-dashed btn-danger btn-square btn-mini" wire:click="declineRequest({{ $request->id }})"><i class="ti-na mr-2"></i> DECLINE</button>

                                                <button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini approveBtn" wire:click="approveRequest({{ $request->id }})"> <i class="ti-check-box mr-2"></i>
                                                    APPROVE
                                                </button>
                                            @elseif($app->user_id == Auth::user()->id && $app->status == 'decline')
                                                <i>You previously declined this request</i>
                                            @elseif($app->user_id == Auth::user()->id && $app->status == 'approve')
                                                <i>You previously approved this request</i>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (session()->has('done'))
                            <div class="col-md-12">
                                {!! session()->get('done') !!}
                            </div>
                        @endif
                        @if ($actionStatus == 1 && $verificationPostId == $request->id)
                        <div class="row mt-2">
                            <div class="col-md-8 offset-md-2">
                                <div class="card ml-4">
                                    <div class="card-block">
                                        <div class="col-sm-12">
                                            <h5 class="sub-title">Transaction Password</h5>
                                            @if (session()->has('error_code'))
                                                <div class="alert alert-warning background-warning" role="alert">
                                                    {!! session()->get('error_code') !!}
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                @if (session()->has('success_code'))
                                                    <div class="alert alert-success background-success" role="alert">
                                                        {!! session()->get('success_code') !!}
                                                    </div>
                                                @endif
                                            <div class="input-group input-group-primary">
                                                <input type="password" class="form-control" wire:model.debounce.9900000ms="transactionPassword" placeholder="Transaction Password">
                                                    <span class="input-group-addon btn-mini" wire:click="verifyCode({{ $request->id }})">
                                                    <i class="ti-check mr-2"></i> Verify
                                                    </span>
                                            </div>
                                            @error('transactionPassword')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-12 push-xl-8 task-detail-right">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">
                        <i class="icofont icofont-ui-note m-r-10"></i> Request Details
                    </h5>
                </div>
                <div class="card-block task-details">
                    <table class="table table-border table-xs">
                        <tbody>
                            <tr>
                                <td>
                                    <i class="icofont icofont-id-card"></i> Created:
                                </td>
                                <td class="text-right">{{date('d F, Y', strtotime($request->created_at))}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="icofont icofont-ui-love-add"></i> Created by:
                                </td>
                                <td class="text-right">
                                    <a href="#">{{$request->user->first_name}}  {{$request->user->surname ?? ''}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="icofont icofont-spinner-alt-3"></i> Revisions:</td>
                                <td class="text-right">{{count($request->postReviews)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="icofont icofont-washing-machine"></i> Status:
                                </td>
                                <td class="text-right">
                                    @switch($request->post_status)
                                        @case('in-progress')
                                            <label for="" class="label label-warning">in-progress</label>
                                            @break
                                        @case('declined')
                                            <label for="" class="label label-danger">Declined</label>
                                            @break
                                        @case('approved')
                                            <label for="" class="label label-success">Approved</label>
                                            @break
                                        @default
                                     @endswitch
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">
                        <i class="icofont icofont-attachment"></i> Attachment(s)
                    </h5>
                </div>
                <div class="card-block task-attachment">
                    <ul class="media-list">
                        @foreach ($attachments as $attach)

                        @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                                    @case('pptx')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/ppt.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a> </small>
                                        </div>
                                    </li>

                                        @break
                                    @case('pdf')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/pdf.png" height="32" width="32" alt="{{$request->name ?? 'No name'}}"> <br/>
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif

                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>

                                        </div>
                                    </li>
                                    @break

                                    @case('csv')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/csv.png" height="32" width="32" alt="{{$file->name ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('xls')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('xlsx')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('doc')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/xls.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('doc')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/doc.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('docx')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/doc.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('jpeg')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/jpg.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('jpg')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/jpg.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('png')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/png.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('gif')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/file.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('ppt')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/ppt.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @case('txt')
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/txt.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                    @break
                                    @default
                                    <li class="media d-flex m-b-10">
                                        <div class="m-r-20 v-middle">
                                            <img src="/assets/formats/file.png" height="32" width="32" alt="{{$request->post_title ?? 'No name'}}">
                                            @if(file_exists(public_path('/assets/uploads/requisition/'.$attach->attachment)))
                                                @if (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1073741824)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1073741824,2)}}GB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1048576)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1048576,2)}}MB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) >= 1024)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}KB</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) > 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @elseif (\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment)) == 1)
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}byte</small>
                                                @else
                                                    <small>{{number_format(\File::size(public_path('/assets/uploads/requisition/'.$attach->attachment))/1024,2)}}bytes</small>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="m-b-5 d-block">{{strlen($request->post_title) > 25 ? substr($request->post_title, 0,25).'...' : $request->post_title }}</a>
                                            <div class="text-muted">
                                                <span>
                                                    Uploaded by
                                                    <a href="{{route('view-profile', $request->user->url)}}">{{$request->user->first_name ?? ''}} {{$request->surname ?? ''}}</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="f-right v-middle text-muted">
                                            <a href="/assets/uploads/requisition/{{$attach->attachment}}"><i class="icofont icofont-download-alt f-18"></i></a>
                                        </div>
                                    </li>
                                @endswitch
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12 pull-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <i class="icofont icofont-tasks-alt m-r-5"></i> {{$request->post_title }}
                    </h5>
                </div>
                <div class="card-block">
                    <h6 class="sub-title m-b-15">Overview</h6>
                    <div class="row mt-2">
                        <div class="col-md-12 p-3" style="background:#FDFBEE;">
                            <p><strong>Task:</strong></p>
                            <p>Kindly act on this request titled: {{str_replace('-', ' ', $request->post_type)}} "{{$request->post_title ?? '' }}".</p>
                             {!! $request->post_content !!}
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Requester:</label>
                                <p class="text-muted">{{$request->first_name ?? '' }} {{$request->surname ?? ''}}</p>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Amount:</label>
                                <p class="text-muted">{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($request->budget,2) ?? '-' }}</p>
                                @php
                                    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                @endphp
                                <p><i>{{ ucfirst($f->format($request->budget))  }} {{ strtolower($request->currency) }} {{Auth::user()->tenant->currency->name ?? 'Naira'}}(s) only</i></p>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Currency:</label>
                                <p class="text-muted">{{Auth::user()->tenant->currency->name ?? 'Naira'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="m-t-20 m-b-20">
                            <h6 class="sub-title m-b-15">Revisions</h6>
                        </div>
                        <div class="row">
                            <ul class="media-list revision-blc">
                                @if(count($request->postReviews) > 0)
                                    @foreach ($request->postReviews as $review)
                                    <li class="media d-flex m-b-15">
                                        <div class="p-l-15 p-r-20 d-inline-block v-middle">
                                            <a href="{{ route('view-profile', $review->user->url) }}">
                                                <img class="media-object img-radius comment-img" src="{{$review->user->avatar ?? '/assets/images/avatar-1.jpg'}}" alt="{{$review->user->first_name}} {{$review->user->surname ?? ''}}">
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
                    </div>
                </div>
                @if (!$request->user_id == Auth::user()->id)
                    <div class="card-footer">
                        <div class="col-md-12 btn-add-task">
                            <div class="form-group">
                                <label for="">Review</label>
                                <textarea wire:model.debounce.10000ms="review" class="form-control" style="resize: none;" placeholder="Leave review..."></textarea>

                                <button class="float-right mt-2 btn btn-primary btn-mini" wire:click="leaveReviewBtn({{$request->id }})">
                                    <i class="icofont icofont-plus f-w-600"></i>
                                    Review
                                </button>
                            </div>
                            @error('review')
                            <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>
            <div class="card comment-block">
                <div class="card-header">
                    <h5 class="card-header-text">
                        <i class="icofont icofont-comment m-r-5"></i> Comments
                    </h5>
                </div>
                <div class="card-block">
                    <ul class="media-list">
                        @foreach ($request->postComments as $comment)
                            <li class="media">
                                <div class="media-left">
                                    <a href="{{ route('view-profile', $comment->user->url) }}">
                                        <img class="media-object img-radius comment-img" src="{{$comment->user->avatar ?? '/assets/images/avatar-1.jpg'}}" alt="{{$comment->user->first_name}} {{$comment->user->surname ?? ''}}">
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
                            <div class="form-group">
                                <label for="">Comment</label>
                                <textarea wire:model.debounce.10000ms="comment" class="form-control" style="resize: none;" placeholder="Leave comment..."></textarea>

                                <button class="btn btn-primary btn-mini mt-2 float-right" wire:click="leaveCommentBtn({{$request->id }})">
                                    <i class="icofont icofont-plus f-w-600"></i>
                                    Comment
                                </button>
                            </div>
                            @error('comment')
                            <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
