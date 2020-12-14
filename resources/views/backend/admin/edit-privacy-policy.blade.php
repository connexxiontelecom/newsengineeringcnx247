@extends('layouts.app')

@section('title')
    Edit Privacy Policy
@endsection

@section('extra-styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Edit Privacy Policy</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form action="{{route('update-privacy-policy')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Privacy Policy</label>
                            <textarea name="privacy_policy" class="form-control content">{{$policy->privacy_policy}}</textarea>
                        </div>
                        <div class="form-group d-flex justify-content-center" style="position: relative; bottom:0px;">
                            <div class="btn-group">
                                <input type="hidden" value="{{$policy->id}}" name="id">
                                <a class="btn btn-mini btn-secondary" href=""><i class="ti-eye mr-2"></i> Read Privacy Policy</a>
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
