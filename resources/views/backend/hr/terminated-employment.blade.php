@extends('layouts.app')

@section('title')
    Terminated Employment
@endsection

@section('extra-styles')

@endsection

@section('content')
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
                            <h2 class="m-b-0">{{number_format(count($terminations))}}</h2>
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
<div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Employment Termination Log</h5>
                </div>
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingTwo">
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
                                                                <th>Employee</th>
                                                                <th>Effective Date</th>
                                                                <th>Terminated By</th>
                                                                <th>Date</th>
                                                            </thead>
                                                            @php
                                                                $index = 1;
                                                            @endphp
                                                            @foreach ($terminations as $terminate)
                                                                <tr>
                                                                    <td>{{$index++}}</td>
                                                                    <td><img src="/assets/images/avatars/thumbnails/{{$terminate->terminatedEmployee->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$terminate->terminatedEmployee->first_name}}">
                                                                        <a href="/activity-stream/profile/{{$terminate->terminatedEmployee->url}}">{{$terminate->terminatedEmployee->first_name}} {{$terminate->terminatedEmployee->surname ?? ''}}</a>
                                                                    </td>
                                                                    <td>
                                                                        {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($terminate->effective_date))}}
                                                                    </td>
                                                                    <td><img src="/assets/images/avatars/thumbnails/{{$terminate->terminatedBy->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$terminate->terminatedBy->first_name}}">
                                                                        <a href="/activity-stream/profile/{{$terminate->terminatedBy->url}}">{{$terminate->terminatedBy->first_name}} {{$terminate->terminatedBy->surname ?? ''}}</a>
                                                                    </td>
                                                                    <td>{{date('d M, Y', strtotime($terminate->created_at))}}</td>
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

@endsection

@section('extra-scripts')


@stack('appreciation-script')
@endsection
