@extends('layouts.frontend-layout')

@section('title')
    Successful Payment
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
    <section class="bg-home d-flex align-items-center">
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 offset-md-3">
                    <div class="section-title">
                        <h4 class="title mb-4">Congratulations <span class="text-primary">{{$name}}</span>!</h4>
                        <p class="text-muted">Thank you for creating <strong>{{config('app.name')}}</strong> account. To continue, please click the link below to access your account.</p>
                        <p class="text-center">
                            <a href="{{route('signin')}}" class="badge badge-primary">Signin</a>
                        </p>
                        <p class="text-muted">Please don't forget to use the email and password you chose during registration.</p>
                        <p class="text-muted">We also sent an invoice to your email for this payment. Please refer to it to learn more about your subscription.</p>
                        <p class="text-muted">Should you face any challenge, don't hesitate to contact our support unit.</p>
                        <p class="text-muted">
                            Yours faithfull, <br>
                            CNX247 Team.
                        </p>
                    </div>
                </div>
            </div>
        </div>
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
            var first_name = $('#first_name').val();
            var fid = {'company_name':company_name, 'industry':industry,
                        'site_address':site_address, 'phone': phone,
                        'use_case':use_case, 'role':role,
                        'email':email, 'password':password,
                        'team_size':team_size,
                        'duration':duration,
                        'plan':plan,
                        'first_name':first_name
                    };
            $('#metadata').val(JSON.stringify(fid));
       });
    });
</script>
@endsection
