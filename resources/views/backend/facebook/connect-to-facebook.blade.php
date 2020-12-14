@extends('layouts.app')

@section('title')
    Connect to Facebook
@endsection

@section('extra-styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 offset-sm-3 offset-md-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <h5 class="m-0 sub-title">
                        Let's get you connected to Facebook!
                    </h5>
                    <p class="mt-3">
                      Click the <strong>Connect</strong> button to get connected to <strong>Facebook</strong>
                    </p>
                    <a href="#fakelink" class="btn btn-facebook float-right btn-mini">
                        <i class="icofont icofont-social-facebook"></i>Facebook
                    </a>
                    <pre id="apiCall"></pre>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

@endsection
