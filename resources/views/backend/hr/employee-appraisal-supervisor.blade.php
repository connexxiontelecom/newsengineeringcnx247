@extends('layouts.app')

@section('title')
    Employee Appraisal (Supervisor)
@endsection

@section('extra-styles')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="d-inline-block">
                    <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('clients')}}"><i class="icofont icofont-ui-user"></i>  Plans</a>
                    <a href="{{ route('leads') }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-thumbs-up"></i> Features</a>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Employee Appraisal <label class="label label-primary">Supervisor<label></h5>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                <div class="col-md-12">
                    <ul class="list-view">
                        <li>
                            <div class="card list-view-media">
                                <div class="card-block">
                                <form action="{{route('store-supervisor-appraisal')}}" method="post">
                                    @csrf
                                    @php
                                        $quan = 1;
                                    @endphp
                                    <h5 class="sub-title"><label class="label label-primary">Quantitative Assessment (Score 20)</label></h5>
                                    <strong>Rating</strong>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="ml-3 mb-3">
                                                <li><strong>1-</strong> Unsatisfactory performance</li>
                                                <li><strong>2-</strong> Fair performance</li>
                                                <li><strong>3-</strong> Satisfactory performance</li>
                                                <li><strong>4-</strong> Good performance</li>
                                                <li><strong>5-</strong> Excellent/Outstanding performance</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3 offset-md-2">
                                            <div class="card rounded-card">
                                                <div class="card-block">
                                                        <img class="img-100" src="/assets/images/avatars/thumbnails/{{$appraisal->takenBy->avatar ?? 'avatar.png'}}" alt="{{$appraisal->takenBy->first_name ?? ''}} {{$appraisal->takenBy->surname ?? ''}}" style="width:64px; height:64px;">
                                                    <div class="user-content">
                                                        <h4 class="">{{$appraisal->takenBy->first_name ?? ''}} {{$appraisal->takenBy->surname ?? ''}}</h4>
                                                        <p class="m-b-0 text-muted">{{$appraisal->takenBy->position ?? '-'}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @if (count($quantitatives) > 0)
                                        @foreach($quantitatives as $quantitative)
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-xs-10 col-md-10">
                                                            <p><strong>Question</strong></p>
                                                            <label class="label label-danger">{{$quan++}}</label>
                                                            <h6 class="d-inline-block">
                                                                {!! $quantitative->question !!}</h6>
                                                                <input type="hidden" value="{{$quantitative->id}}" name="quantitative[]"/>
                                                        </div>
                                                        <div class="col-md-2 col-xs-2">
                                                            <p><strong>Rating</strong></p>
                                                            <select  class="form-control" name="quantitative_rating[]" autocomplete="off">
                                                                <option value="1">Unsatisfactory</option>
                                                                <option value="2">Fair</option>
                                                                <option value="3">Satisfactory</option>
                                                                <option value="4">Good</option>
                                                                <option value="5">Excellent</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12">
                                                        <h6 class="text-center">There're no quantitative questions for this job role.</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <h5 class="sub-title mt-4"><label class="label label-primary">Qualitative Assessment (Score 80)</label></h5>
                                    <strong>Rating</strong>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="ml-3 mb-3">
                                                <li><strong>1-</strong> Unsatisfactory performance</li>
                                                <li><strong>2-</strong> Fair performance</li>
                                                <li><strong>3-</strong> Satisfactory performance</li>
                                                <li><strong>4-</strong> Good performance</li>
                                                <li><strong>5-</strong> Excellent/Outstanding performance</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3 offset-md-2">
                                            <div class="card rounded-card">
                                                <div class="card-block">
                                                        <img class="img-100" src="/assets/images/avatars/thumbnails/{{$appraisal->takenBy->avatar ?? 'avatar.png'}}" alt="{{$appraisal->takenBy->first_name ?? ''}} {{$appraisal->takenBy->surname ?? ''}}" style="width:64px; height:64px;">
                                                    <div class="user-content">
                                                        <h4 class="">{{$appraisal->takenBy->first_name ?? ''}} {{$appraisal->takenBy->surname ?? ''}}</h4>
                                                        <p class="m-b-0 text-muted">{{$appraisal->takenBy->position ?? '-'}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @php
                                        $qual = 1;
                                    @endphp
                                    @if (count($qualitatives) > 0)
                                        @foreach($qualitatives as $quality)
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-xs-10 col-md-10">
                                                            <p><strong>Question</strong></p>
                                                            <label class="label label-danger">{{$qual++}}</label>
                                                            <h6 class="d-inline-block">
                                                                {!! $quality->question !!}</h6>
                                                                <input type="hidden" value="{{$quality->id}}" name="qualitative[]"/>
                                                        </div>
                                                        <div class="col-md-2 col-xs-2">
                                                            <p><strong>Rating</strong></p>
                                                            <select  class="form-control" name="qualitative_rating[]" autocomplete="off">
                                                                <option value="1">Unsatisfactory</option>
                                                                <option value="2">Fair</option>
                                                                <option value="3">Satisfactory</option>
                                                                <option value="4">Good</option>
                                                                <option value="5">Excellent</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12">
                                                        <h6 class="text-center">There're no qualitative questions for this job role.</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn-group d-flex justify-content-center">
                                                <a href="{{route('user-administration')}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i> Cancel</a>
                                                <input type="hidden" name="appraisal_id" value="{{$appraisal->appraisal_id}}"/>
                                                <input type="hidden" name="user_id" value="{{$appraisal->employee}}"/>
                                                <button type="submit" class="btn btn-primary btn-mini"><i class="ti-close mr-2"></i> Submit</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('dialog-section')

@endsection
@section('extra-scripts')

@endsection
