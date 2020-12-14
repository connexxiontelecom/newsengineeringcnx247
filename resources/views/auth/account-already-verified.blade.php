@extends('layouts.auth-layout')

@section('title')
    Oops!
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
                                <h6 class="text-center sub-title txt-primary">Ooops!</h6>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <p>It appears you've verified your account before.</p>
                                <p>Please let us know if you have any concerns.</p>
                                <p>Thank you, <br> <strong>{{ config('app.name') }}.</strong> </p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-inverse text-left m-b-0">Proceed to <a href="{{ route('signin') }}"><strong class="f-w-600">Signin</strong></a></p>
                                    
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
