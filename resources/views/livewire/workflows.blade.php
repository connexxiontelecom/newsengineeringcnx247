
<div class="card">
    <div class="card-block">
        <h5 class="sub-title mb-2">Assignments</h5> <br>
        <div class="dropdown-primary dropdown open mt-2 mb-3" data-intro="This is Card Header" data-step="1">
            <button class="btn btn-primary btn-sm dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-filter mr-2"></i>{{$current_action ?? 'Filter'}}</button>
            <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" wire:click="allWorkflows">All</a>
                <a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" wire:click="inprogressWorkflows">In-progress</a>
                <a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" wire:click="approvedWorkflows">Approved</a>
                <a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" wire:click="declinedWorkflows">Declined</a>
            </div>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success border-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled"></i>
            </button>
            {!! session('success') !!}
        </div>
				@endif

        <div class="dt-responsive table-responsive">
            <table id="datatable-assignment" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($requests as $request)
                        @foreach($request->responsiblePersons as $person)
                            @if($person->user_id == Auth::user()->id)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <a href="{{ route('view-workflow-task', $request->post_url) }}">{!! strlen($request->post_title) > 18 ? substr($request->post_title, 0,15).'...' : $request->post_title !!}</a>
                                    </td>
                                    <td>
                                        {!! strlen($request->post_content ) > 35 ? substr($request->post_content, 0,35).'...' : $request->post_content  !!}
                                    </td>
                                    <td>
                                        @if($request->post_status == 'in-progress')
                                            <label class="badge badge-warning text-white special-badge"><small class="text-uppercase">in-progress</small></label>
                                        @elseif($request->post_status == 'approved')
                                            <label class="badge badge-success special-badge"><small class="text-uppercase">approved</small></label>

                                        @elseif($request->post_status == 'declined')
                                            <label class="badge badge-danger special-badge"><small class="text-uppercase">declined</small></label>
                                        @endif
                                    </td>
                                    <td> <small class="text-uppercase">{{date('d M, Y | h:i a', strtotime($request->created_at))}}</small> </td>
                                    <td>
                                        You're assigned to act on this request'<br/>
                                        <div class="btn-group mt-2">
                                            @if($request->post_status == 'in-progress')
                                                    @foreach($request->responsiblePersons as $app)

                                                        @if($app->user_id == Auth::user()->id && $app->status == 'in-progress')
                                                            <button class="btn btn-out-dashed btn-danger btn-square btn-mini" wire:click="declineRequest({{ $request->id }})"><i class="ti-na mr-2"></i> DECLINE</button>

                                                            <button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini approveBtn" wire:click="approveRequest({{ $request->id }})"> <i class="ti-check-box mr-2"></i>
                                                                APPROVE
                                                            </button>
                                                        @elseif($app->user_id == Auth::user()->id && $app->status == 'decline')
                                                            <i>Decline,(you)</i>
                                                        @elseif($app->user_id == Auth::user()->id && $app->status == 'approve')
                                                            <i>Approved,(you)</i>
                                                        @endif
                                                    @endforeach
                                            @endif

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
                                    </td>
                                </tr>

                            @endif

                        @endforeach
                    @endforeach


                </tbody>

            </table>

    </div>
</div>
