@extends('layouts.app')

@section('title')
    Terms and Conditions
@endsection

@section('extra-styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Company's Terms & Conditions</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form action="{{route('update-terms-n-conditions')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Terms & Conditions</label>
                            <textarea name="terms" class="form-control content">{{$terms->terms}}</textarea>
                        </div>
                        <div class="form-group d-flex justify-content-center" style="position: relative; bottom:0px;">
                            <div class="btn-group">
                                <input type="hidden" value="{{$terms->id}}" name="id">
                                <a class="btn btn-mini btn-secondary" href="{{route('terms-n-conditions')}}"><i class="ti-eye mr-2"></i> Read Terms & Conditions</a>
                                <button class="btn btn-mini btn-warning" type="submit"><i class="ti-pencil mr-2"></i> Edit Terms</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@endsection
