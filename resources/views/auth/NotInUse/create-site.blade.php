@extends('layouts.auth-layout')

@section('title')
    Create Site
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
                <form class="md-float-material form-material" method="post" action="{{route('register-site')}}">
                    @csrf
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-5" style="background:#F7F9FD;">
                                    <div class="text-center">
                                        <img src="/assets/images/logo.png" alt="logo.png" height="75" width="120">
                                    </div>
                                    <div class="form-group">
                                        <h3>Well done!</h3>
                                        <p>You're seconds away from your site.</p>
                                        <p>Just fill in a few details to get started.</p>
                                        <h2>Chosen Plan</h2>
                                        <h3>{!! $chosen_plan->name ?? '' !!}</h3>
                                        <ul>
                                            @foreach ($features as $item)
                                                <li>{!! $item->feature !!}</li>
                                            @endforeach
                                        </ul> <br>
                                        <strong>₦{{number_format($chosen_plan->price,2) ?? '0'}}</strong> <br>
                                        <label class="label label-primary">Duration:</label> <span>{{$chosen_plan->duration ?? ''}} <small>days</small></span>

                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group form-primary">
                                        <label for="">Choose site address <sup class="text-danger">*</sup></label>
                                        <div class="input-group">
                                            <input type="text" name="site_address" id="site_address" value="{{old('site_address')}}" class="form-control" placeholder="Site address">
                                            <span class="input-group-addon" id="basic-addon5">.cnx247.com</span>
                                        </div>
                                        <small>Your team will use it to sign in to {{config('app.name')}}. At least 3 characters</small>
                                        @error('site_address')
                                            <span class="mt-3">
                                                <i class="text-danger">{{ $message }}</i>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <label for="">You work email <sup class="text-danger">*</sup></label>
                                                <input  type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Work email">
                                                @error('email')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <label for="">Password</label>
                                                <input name="password" type="password" id="password" class="form-control" placeholder="Password">
                                                @error('password')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small class="ml-3 mr-2 d-flex">Password must be at least 6 characters, including 1 uppercase letter, 1 number and 1 special character.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <label for="">Industry</label>
                                                <select id="industry" class="form-control" name="industry" value="{{old('industry')}}">
                                                    <option value="1">Education</option>
                                                    <option value="2">Information Technology</option>
                                                    <option value="3">Business</option>
                                                </select>
                                                @error('industry')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <label for="">Company Name</label>
                                                <input name="company_name" value="{{old('company_name')}}" id="company_name" type="text" class="form-control" placeholder="Company Name">
                                                @error('company_name')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <label for="">Main use case <sup class="text-danger">*</sup></label>
                                                <select id="use_case" class="form-control" name="use_case" value="{{old('use_case')}}">
                                                    <option value="1">Business</option>
                                                    <option value="2">Marketing</option>
                                                    <option value="3">Project</option>
                                                </select>
                                                @error('use_case')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <label for="">Your role</label>
                                                <select id="role" class="form-control" name="role" value="{{old('role')}}">
                                                    <option value="1">CEO</option>
                                                    <option value="2">Manager</option>
                                                    <option value="3">Investor</option>
                                                </select>
                                                @error('role')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <small class="ml-3 mr-2 d-flex">What do you plan to use {{config('app.name')}} mainly for?</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <label for="">Team size<sup class="text-danger">*</sup></label>
                                                <input type="number" id="team_size" value="{{old('team_size')}}" placeholder="Team size (ex. 50)" class="form-control" name="team_size">
                                                @error('team_size')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                            </div>
                                            <small class="ml-3 mr-2 d-flex">How big is your team?</small>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-primary">
                                                <label for="">Phone number</label>
                                                <input type="text" id="phone" placeholder="Phone number" value="{{old('phone')}}" class="form-control" name="phone">
                                                @error('phone')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-md-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" checked name="terms">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">I agree with <strong> {{config('app.name')}}’s</strong> Terms of Use and confirm that I have familiarized myself with the <a href="#">Privacy Policy.</a></span>
                                                </label>
                                            </div>
                                            @error('terms')
                                                    <span class="mt-3">
                                                        <i class="text-danger">{{ $message }}</i>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="orderID" value="{{rand(100,999)}}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="amount" value="{{ ($chosen_plan->price * 100)}}">
                                    <input type="hidden" name="currency" value="NGN">
                                    <input type="hidden" id="duration" value="{{$chosen_plan->duration}}">
                                    <input type="hidden" id="plan" value="{{$chosen_plan->id}}">
                                    <input type="hidden" name="metadata[]" id="metadata">
                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                    <div class="row m-t-30 d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20 btn-sm" id="proceedToPay" >Proceed to make Payment</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-inverse text-left m-b-0">Thank you.</p>
                                            <p class="text-inverse text-left"><a href="{{ route('home') }}"><b class="f-w-600">Back to Homepage</b></a></p>
                                        </div>

                                    </div>

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

@section('extra-scripts')
<script>
    $(document).ready(function(){
       $(document).on('click', '#proceedToPay', function(){

            var metadata = $('#metadata').val();
            var site_address = $('#site_address').val();
            var phone = $('#phone').val();
            var use_case = $('#use_case').val();
            var role = $('#role').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var team_size = $('#team_size').val();
            var company_name = $('#company_name').val();
            var industry = $('#industry').val();
            var duration = $('#duration').val();
            var plan = $('#plan').val();
            var fid = {'company_name':company_name, 'industry':industry,
                        'site_address':site_address, 'phone': phone,
                        'use_case':use_case, 'role':role,
                        'email':email, 'password':password,
                        'team_size':team_size,
                        'duration':duration,
                        'plan':plan
                    };
            $('#metadata').val(JSON.stringify(fid));
       });
    });
</script>
@endsection
