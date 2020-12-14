<div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="icofont icofont-travelling f-30 text-c-lite-green"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">Overall</h6>
                            <h2 class="m-b-0">{{number_format(count($resignations))}}</h2>
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
                            <i class="icofont icofont-travelling f-30 text-c-green"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">This Year</h6>
                            <h2 class="m-b-0">{{number_format($thisYear ?? 0)}}</h2>
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
                            <i class="icofont icofont-travelling f-30 text-success"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">Last Month</h6>
                            <h2 class="m-b-0">{{number_format($lastMonth ?? 0)}}</h2>
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
                            <i class="icofont icofont-travelling f-30 text-c-blue"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class="text-muted m-b-10">This Month</h6>
                            <h2 class="m-b-0">{{number_format($thisMonth ?? 0)}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
   <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="card bg-c-blue text-white widget-visitor-card">
                <div class="card-block-small text-center">
                    <h2>{{number_format($resignations->where('status', 'declined')->count())}}</h2>
                    <h6>Declined</h6>
                    <i class="icofont icofont-ui-block"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="card bg-c-pink text-white widget-visitor-card">
                <div class="card-block-small text-center">
                    <h2>{{number_format($resignations->where('status', 'approved')->count())}}</h2>
                    <h6>Approved</h6>
                    <i class="icofont icofont-holding-hands"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="card bg-c-yellow text-white widget-visitor-card">
                <div class="card-block-small text-center">
                    <h2>{{number_format($resignations->where('status', 'in-progress')->count())}}</h2>
                    <h6>In-progress</h6>
                    <i class="icofont icofont-sand-clock"></i>
                </div>
            </div>
        </div>
   </div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.hr.common._slab-menu')
                </div>
            </div>
        </div>
   </div>

</div>
<div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Resignation</h5>
                </div>
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingTwo">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Resignation List
                                </a>
                            </h3>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="accordion-content accordion-desc">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table ">
                                                            <thead>
                                                                <th>#</th>
                                                                <th>From</th>
                                                                <th>Subject</th>
                                                                <th>Status</th>
                                                                <th>Content</th>
                                                                <th>Date</th>
                                                            </thead>
                                                            @php
                                                                $index = 1;
                                                            @endphp
                                                            @foreach ($resignations as $resign)
                                                                <tr>
                                                                    <td>{{$index++}}</td>
                                                                    <td><img src="/assets/images/avatars/thumbnails/{{$resign->user->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$resign->user->first_name}}">
                                                                        <a href="/activity-stream/profile/{{$resign->user->url}}">{{$resign->user->first_name}} {{$resign->user->surname ?? ''}}</a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('view-resignation', $resign->slug)}}">{!! strlen($resign->subject) > 25 ? substr($resign->subject, 0, 25).'...' : $resign->subject !!}</a>
                                                                    </td>
                                                                    <td>
                                                                        @if ($resign->status == 'in-progress')
                                                                            <label for="" class="label label-warning">{{$resign->status}}</label>
                                                                        @elseif($resign->status == 'approved')
                                                                            <label for="" class="label label-success">{{$resign->status}}</label>
                                                                        @elseif($resign->status == 'declined')
                                                                            <label for="" class="label label-danger">{{$resign->status}}</label>
                                                                        @endif
                                                                    </td>
                                                                    <td>{!! strlen($resign->content) > 25 ? substr($resign->content, 0, 25).'...' : $resign->content !!}</td>
                                                                    <td>{{date('d M, Y', strtotime($resign->created_at))}}</td>
                                                                </tr>
                                                            @endforeach

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
        </div>
   </div>
</div>
