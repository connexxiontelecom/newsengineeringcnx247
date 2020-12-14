@extends('layouts.app')

@section('title')
    Employee Appraisal (Self)
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
                <h5 class="sub-title">Employee Appraisal <label class="label label-primary">Self<label></h5>
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
                                <form action="{{route('store-self-appraisal')}}" method="post">
                                    @csrf
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($questions as $question)
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="col-xs-12">
                                                    <label class="label label-danger">{{$i++}}</label>
                                                    <h6 class="d-inline-block">
                                                        {!! $question->question !!}</h6>
                                                </div>
                                                <input type="hidden" name="questions[]" value="{{$question->id}}"/>
                                                <textarea name="answers[]" class="form-control col-md-12 mb-3 inlineContent" placeholder="Type answer here..." style="resize:none;"></textarea>
                                                <!--<div name="answers[]" class="form-control col-md-12 mb-3 inlineContent" placeholder="Type answer here..." style="resize:none;"></div>-->
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn-group d-flex justify-content-center">
                                                <a href="{{route('user-administration')}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i> Cancel</a>
                                                <input type="hidden" name="appraisal_id" value="{{$appraisal_id}}"/>
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
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@endsection
