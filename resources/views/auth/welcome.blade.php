@extends('layouts.auth-layout')

@section('title')
    Welcome
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
                                <h6 class="text-center sub-title txt-primary">Welcome {{$user->first_name}}</h6>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <p>We're pleased to have you on board.</p>
                                <p>{{ config('app.name') }} has a lot to offer. Explore the platform. Please do not hesitate to contact us if you face any challenge.</p>
                                Once again, welcome to <strong> {{ config('app.name') }}.</strong>
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
