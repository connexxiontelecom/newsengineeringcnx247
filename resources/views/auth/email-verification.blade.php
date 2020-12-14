@extends('layouts.auth-layout')

@section('title')
    Email Verification
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('main-content')

<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" wire:submit.prevent="signupNow">
                    <div class="text-center">
                        <img src="/assets/images/logo.png" alt="logo.png" height="75" width="120">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h6 class="text-center sub-title txt-primary">Email Verification</h6>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <h5 class="text-center mb-4">Okay...! One more step then we're done.</h5>
                                <p>Thank you for your registration. We sent a mail to your inbox for verification. Click on the <strong>Activation link</strong>
                                or <code>copy & paste </code> the URL in your browser to activate your account. </p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                                    <p class="text-inverse text-left"><a href="{{ route('home') }}"><b class="f-w-600">Back to Homepage</b></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>

@endsection
