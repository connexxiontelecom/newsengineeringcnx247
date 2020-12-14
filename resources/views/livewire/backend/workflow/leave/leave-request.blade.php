<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        @include('livewire.backend.workflow.common._workflow-slab')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="sub-title">Leave Request</div>
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#expenseReportTab" role="tab">Add New Leave Request</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#businessProcessTab" role="tab">My Leave Requests</a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="expenseReportTab" role="tabpanel">
                         <div class="card">
                            <div class="card-block">
                                @if(session()->has('success'))
                                    <div class="alert alert-success border-success" style="padding:5px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled"></i>
                                        </button>
                                        <strong>Success!</strong> {!! session('success') !!}
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-warning border-warning" style="padding:5px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled"></i>
                                        </button>
                                         {!! session('error') !!}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <form  action="{{route('leave-request')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="">Reason</label>
                                                    <input name="reason" type="text" value="{{old('reason')}}" class="form-control form-control-normal" placeholder="Reason">
                                                    @error('reason')
                                                        <span class="mt-3">
                                                            <i class="text-danger">{{ $message }}</i>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class=" form-group col-md-6">
                                                    <label class="">Start Date</label>
                                                    <input name="start_date" type="datetime-local" class="form-control form-control-normal" placeholder="Start Date">
                                                    @error('start_date')
                                                        <span class="mt-3">
                                                            <i class="text-danger">{{ $message }}</i>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class=" form-group col-md-6">
                                                    <label class="">End Date</label>
                                                    <input name="end_date" type="datetime-local" class="form-control form-control-normal" placeholder="End Date">
                                                    @error('end_date')
                                                        <span class="mt-3">
                                                            <i class="text-danger">{{ $message }}</i>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="">Leave Type</label>
                                                    <select name="absence_type" class="form-control form-control-normal">
                                                        <option selected disabled>Select leave type</option>
                                                        @foreach ($leave_types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->leave_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('absence_type')
                                                        <span class="mt-3">
                                                            <i class="text-danger">{{ $message }}</i>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                                <div class="form-group col-md-6">
																									@if($storage_capacity == 1)
                                                    <label class="">Attachment <br> <i>(Optional)</i></label>
                                                    <input type="file" class="form-control-file" name="attachment">

																									@endif

																									@if($storage_capacity == 0)

																										Drive Full, Please Upgrade to Upload More Files

																									@endif
                                                </div>
                                                <div class=" row m-t-30 d-flex justify-content-center">
                                                    <div class="preloader3 loader-block mb-3" wire:loading wire:target="submitExpenseReport">
                                                        <div class="circ1 loader-primary"></div>
                                                        <div class="circ2 loader-primary"></div>
                                                        <div class="circ3 loader-primary"></div>
                                                        <div class="circ4 loader-primary"></div>
                                                    </div>
                                                    <div class="col-sm-10 col-md-12">
                                                        <div class="btn-group d-flex justify-content-center">
                                                            <button class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</button>
                                                            <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check mr-2"></i>Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="tab-pane" id="businessProcessTab" role="tabpanel">
                        <div class="card">
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap" style="margin-top: 10px;">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $serial = 1;
                                                    @endphp
                                                    @foreach ($leaves as $leave)
                                                        <tr>
                                                            <td>{{$serial++}}</td>
                                                            <td>
                                                                <a href="{{route('view-workflow-task', $leave->post_url)}}">{{$leave->post_title ?? ''}}</a></td>
                                                            <td>{!! strlen($leave->post_content) > 75 ? substr($leave->post_content,0,75).'...' : $leave->post_content !!}</td>
                                                            <td>
                                                                @switch($leave->post_status)
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
                                                            <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($leave->created_at))}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
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
        </div>
    </div>
</div>

@push('leave-request-script')

@endpush
