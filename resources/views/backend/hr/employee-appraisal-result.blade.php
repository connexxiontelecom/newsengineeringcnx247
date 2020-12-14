@extends('layouts.app')

@section('title')
    Employee Appraisal Result
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
                <div id="appraisalContainer">
                    <h5 class="sub-title">Employee Appraisal Result</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <h5 class="sub-title"><label class="label label-primary">Self Assessment<label></h5>
                        <ul class="list-view">
                            <li>
                                <div class="card list-view-media">
                                    <div class="card-block">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($self as $ques)
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="col-xs-12">
                                                        <label class="label label-danger">{{$i++}}</label>
                                                        <h6 class="d-inline-block">
                                                            {!! $ques->questionSelf->question !!}</h6>
                                                    </div>
                                                    <blockquote class="blockquote ml-5">
                                                        <p class="m-b-0">{!! $ques->answer !!}</p>
                                                        
                                                    </blockquote>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <h5 class="sub-title"><label class="label label-primary">Quantitative Assessment<label></h5>
                        <ul class="list-view">
                            <li>
                                <div class="card list-view-media">
                                    <div class="card-block">
                                        @php
                                            $n = 1;
                                            $total = 0;
                                        @endphp
                                        @foreach($quantitative as $ques)
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-xs-10 col-md-10">
                                                            <label class="label label-danger">{{$n++}}</label>
                                                            <h6 class="d-inline-block">
                                                                {!! $ques->questionQuantitative->question !!}</h6>
                                                        </div>
                                                        <div class="col-md-2 col-xs-2">
                                                            <label class="label label-info float-right">{{$ques->rating}}/5</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php 
                                                $total += $ques->rating;
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <h5 class="sub-title"><label class="label label-primary">Qualitative Assessment<label></h5>
                        <ul class="list-view">
                            <li>
                                <div class="card list-view-media">
                                    <div class="card-block">
                                        @php
                                            $q = 1;
                                        @endphp
                                        @foreach($qualitative as $ques)
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-xs-10 col-md-10">
                                                            <label class="label label-danger">{{$q++}}</label>
                                                            <h6 class="d-inline-block">
                                                                {!! $ques->questionQualitative->question !!}</h6>
                                                        </div>
                                                        <div class="col-md-2 col-xs-2">
                                                            <label class="label label-info float-right">{{$ques->rating}}/5</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php 
                                                $total += $ques->rating;
                                            @endphp
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-end">
                                                        <h5 class="text-danger">Total: <span class="text-muted">{{number_format($total)}}</span></h5>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="btn-group">
                                                            Appraised by: <label class="label label-info"> {{$appraisal->supervisedBy->first_name ?? ''}} {{$appraisal->supervisedBy->surname ?? ''}}</label>
                                                            Appraisal Period: <label class="label label-danger"> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($appraisal->start_date))}} to {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($appraisal->end_date))}}</label>
                                                            Appraisee: <label class="label label-primary"> {{$appraisal->takenBy->first_name ?? ''}} {{$appraisal->takenBy->surname ?? ''}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="btn-group d-flex justify-content-center">
                            <a href="{{route('user-administration')}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i> Cancel</a>
                            <button type="button" id="printAppraisal" class="btn btn-primary btn-mini"><i class="ti-printer mr-2"></i> Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('dialog-section')

@endsection
@section('extra-scripts')
<script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '#printAppraisal', function(event){
            $('#appraisalContainer').printThis({
                header:"<p></p>",
                footer:"<p></p>",
            });
        });
    });
</script>
@endsection
