@extends('layouts.frontend-layout')

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

@section('content')
	<!-- Hero Start -->
	<section class="bg-half bg-dark d-table w-100" style="background-image:url('{{asset('/frontend/images/bg-5.jpg')}}'); background-size:auto ;box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.60);">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 text-center">
					<div class="page-next-level">
						<h4 class="title text-light">{{$chosen_plan->planName->name}}</h4>
						<div class="page-next">
							<nav aria-label="breadcrumb" class="d-inline-block">
								<ul class="breadcrumb bg-white rounded shadow mb-0">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item"><a href="{{route('pricing')}}">Pricing</a></li>
									<li class="breadcrumb-item active" aria-current="page">Register</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>  <!--end col-->
			</div><!--end row-->
		</div> <!--end container-->
	</section><!--end section-->
	<!-- Hero End -->
	<section class="bg-home d-flex align-items-center mt-100 mt-60 mb-5">
		<div class="container">
			<div class="row align-items-start">
				<div class="col-lg-5 col-md-4 sidebar sticky-bar">
					<h5>Plan Details</h5>
					<p class="text-muted">{{$chosen_plan->description}}</p>
					<span class="badge badge-pill badge-outline-primary">{{$chosen_plan->duration ?? '-'}} days</span>
					<br>
					@if($chosen_plan->duration > 31 && $chosen_plan->duration <= 90)
						<span class="badge badge-pill badge-outline-primary mt-1" style="cursor: pointer;">{{$chosen_plan->currency->symbol}}{{number_format($chosen_plan->price * 3,2)}}</span>
					@elseif($chosen_plan->duration > 91 && $chosen_plan->duration <= 365)
						<span class="badge badge-pill badge-outline-primary mt-1" style="cursor: pointer;">{{$chosen_plan->currency->symbol}}{{number_format($chosen_plan->price * 12,2)}}</span>
					@else
						<span class="badge badge-pill badge-outline-primary mt-1" style="cursor: pointer;">{{$chosen_plan->currency->symbol}}{{number_format($chosen_plan->price,2)}}</span>
					@endif
					<h5 class="mt-4">Plan Features</h5>
					<p class="text-muted">This plan gives you access to the following features of the application:</p>
					<ul class="list-unstyled">
						@if (count($modules) > 0)
							@foreach ($modules as $module)
								<li class="text-muted"><i data-feather="arrow-right" class="fea icon-sm text-success mr-2"></i>{{$module->module_name}}</li>
							@endforeach
						@else
							<li class="mb-0 text-danger">There are no modules for this plan</li>
						@endif
					</ul>
				</div>
				<div class="col-lg-7 col-md-8">
					<div class="card login_page shadow rounded border-0">
						<div class="card-body">
							<h4 class="card-title text-center">Sign Up</h4>
							<form class="login-form mt-4" method="post" action="{{route('register-site')}}">
								@csrf
								<div class="row">
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Site Address <span class="text-danger">*</span></label>
											<i data-feather="link" class="fea icon-sm icons"></i>
											<input type="text" name="site_address" id="site_address" value="{{old('site_address')}}" class="form-control pl-5" placeholder="">
											<small>Your team will use it to sign in to {{config('app.name')}}. At least 3 characters</small><br>
											@error('site_address')
											<small class="mt-3"><i class="text-danger">{{ $message }}</i></small>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>First Name <span class="text-danger">*</span></label>
											<i data-feather="user" class="fea icon-sm icons"></i>
											<input type="text" class="form-control pl-5" value="{{old('first_name')}}" name="first_name" id="first_name">
											@error('first_name')
											<small class="mt-3"><i class="text-danger">{{ $message }}</i></small>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Work Email <span class="text-danger">*</span></label>
											<i data-feather="mail" class="fea icon-sm icons"></i>
											<input type="text" class="form-control pl-5" name="email" id="email" value="{{old('email')}}">
											@error('email')
											<small class="mt-3"><i class="text-danger">{{ $message }}</i></small>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Password <span class="text-danger">*</span></label>
											<i data-feather="key" class="fea icon-sm icons"></i>
											<input type="password" name="password"  id="password" class="form-control pl-5">
											@error('password')
											<small class="mt-3"><i class="text-danger">{{ $message }}</i></small>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Industry <span class="text-danger">*</span></label>
											<select name="industry" id="industry" class="form-control">
												@foreach ($industries as $industry)
													<option value="{{$industry->id}}">{{$industry->industry}}</option>
												@endforeach
											</select>
											@error('industry')
											<small class="mt-3"><i class="text-danger">{{ $message }}</i></small>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Company Name <span class="text-danger">*</span></label>
											<i data-feather="briefcase" class="fea icon-sm icons"></i>
											<input type="text" name="company_name" value="{{old('company_name')}}" id="company_name" class="form-control pl-5">
											@error('company_name')
											<small class="mt-3">
												<i class="text-danger">{{ $message }}</i>
											</small>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Role <span class="text-danger">*</span></label>
											<select name="role" id="role" class="form-control">
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
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Use Case <span class="text-danger">*</span></label>
											<select id="use_case" class="form-control" name="use_case" >
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
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Team Size <span class="text-danger">*</span></label>
											<i data-feather="users" class="fea icon-sm icons"></i>
											<input type="number" id="team_size" name="team_size" value="{{old('team_size')}}" placeholder="Team size (ex. 50)" class="form-control pl-5">
											@error('team_size')
											<span class="mt-3">
												<i class="text-danger">{{ $message }}</i>
											</span>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group position-relative">
											<label>Phone Number <span class="text-danger">*</span></label>
											<i data-feather="phone" class="fea icon-sm icons"></i>
											<input type="text" id="phone" name="phone" placeholder="Phone number" value="{{old('phone')}}" class="form-control pl-5">
											@error('phone')
											<span class="mt-3">
												<i class="text-danger">{{ $message }}</i>
											</span>
											@enderror
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" checked name="terms" class="custom-control-input">
												<label class="custom-control-label" for="customCheck1">I Accept <a href="#" class="text-primary">Terms And Condition</a></label>
											</div>
											@error('terms')
											<span class="mt-3">
												<i class="text-danger">{{ $message }}</i>
											</span>
											@enderror
										</div>
									</div>
									<div class="col-md-12">
										<input type="hidden" name="orderID" value="{{rand(100,999)}}">
										<input type="hidden" name="quantity" value="1">
										@if($chosen_plan->duration > 31 && $chosen_plan->duration <= 90)
											<input type="hidden" name="amount" value="{{ ($chosen_plan->price * 100 * 3)}}">
										@elseif($chosen_plan->duration > 91 && $chosen_plan->duration <= 365)
											<input type="hidden" name="amount" value="{{ ($chosen_plan->price * 100 * 12)}}">
										@else
											<input type="hidden" name="amount" value="{{ ($chosen_plan->price * 100)}}">
										@endif
										<input type="hidden" name="currency" value="NGN">
										<input type="hidden" id="duration" value="{{$chosen_plan->duration}}">
										<input type="hidden" id="plan" value="{{$chosen_plan->plan_id}}">
										<input type="hidden" name="metadata[]" id="metadata">
										<input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
										<button class="btn btn-primary btn-block" type="submit" id="proceedToPay">Pay & Sign Up</button>
									</div>
									<div class="mx-auto">
										<p class="mb-0 mt-3"><small class="text-dark mr-2">Already have an account ?</small> <a href="{{route('signin')}}" class="text-dark font-weight-bold">Sign in</a></p>
									</div>
								</div>
							</form>
						</div>
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
