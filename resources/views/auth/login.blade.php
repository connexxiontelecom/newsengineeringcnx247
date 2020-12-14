@extends('layouts.auth-layout')

@section('title')
    Sign In
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
	<div class="back-to-home rounded d-none d-sm-block">
		<a href="{{route('home')}}" class="btn btn-icon btn-outline-info"><i data-feather="home" class="icons"></i></a>
	</div>
	<!-- Hero Start -->
	<section class="cover-user bg-white">
		<div class="container-fluid px-0">
			<div class="row no-gutters position-relative">
				<div class="col-lg-4 cover-my-30 order-2">
					<div class="cover-user-img d-flex align-items-center">
						<div class="row">
							<div class="col-12">
								<div class="card login-page border-0" style="z-index: 1">
									<div class="card-body p-0">
										<form class="login-form mt-4" method="post" action="{{route('login')}}">
											@csrf
											<div class="row">
												<div class="col-lg-12 mb-5 text-center">
													<a class="logo" href="{{route('home')}}">
														<img src="{{asset('/frontend/images/logo.png')}}" height="52" width="100" alt="{{config('app.name')}}">
													</a>
												</div>
												<h4 class="card-title col-lg-12 text-center mb-4">Sign In</h4>
												@if(session()->has('unverified'))
													<div class="alert alert-warning border-warning">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<i class="icofont icofont-close-line-circled"></i>
														</button>
														{!! session('unverified') !!}
													</div>
												@endif
												@if(session()->has('wrongCredentials'))
													<div class="alert alert-warning border-warning">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<i class="icofont icofont-close-line-circled"></i>
														</button>
														{!! session('wrongCredentials') !!}
													</div>
												@endif
												@if(session()->has('success'))
													<div class="alert alert-success border-success">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<i class="icofont icofont-close-line-circled"></i>
														</button>
														{!! session('success') !!}
													</div>
												@endif
												<div class="col-lg-12">
													<div class="form-group position-relative">
														<label>Email <span class="text-danger">*</span></label>
														<i data-feather="user" class="fea icon-sm icons"></i>
														<input type="email" class="form-control pl-5" name="email">
														@error('email')
														<span class="mt-3">
															<i class="text-danger">{{ $message }}</i>
														</span>
														@enderror
													</div>
												</div><!--end col-->
												<div class="col-lg-12">
													<div class="form-group position-relative">
														<label>Password <span class="text-danger">*</span></label>
														<i data-feather="key" class="fea icon-sm icons"></i>
														<input type="password" class="form-control pl-5" name="password">
													</div>
												</div><!--end col-->

												<div class="col-lg-12">
													<div class="d-flex justify-content-between">
														<div class="form-group">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
																<label class="custom-control-label" for="customCheck1">Remember me</label>
															</div>
														</div>
														<p class="forgot-pass mb-0"><a href="{{route('reset-password') }}" class="text-dark font-weight-bold">Forgot password ?</a></p>
													</div>
												</div><!--end col-->

												<div class="col-lg-12 mb-0">
													<button class="btn btn-primary btn-block" type="submit">Sign In</button>
												</div><!--end col-->
												<div class="col-12 text-center">
													<p class="mb-0 mt-3"><small class="text-dark mr-2">Don't have an account ?</small> <a href="{{route('pricing')}}" class="text-dark font-weight-bold">Sign Up</a></p>
												</div><!--end col-->
											</div><!--end row-->
										</form>
									</div>
								</div>
							</div><!--end col-->
						</div><!--end row-->
					</div> <!-- end about detail -->
				</div> <!-- end col -->
				<div class="col-lg-8 offset-lg-4 padding-less img order-1" style="background-image:url('{{asset('/frontend/images/bg-5.jpg')}}')" data-jarallax='{"speed": 0.5}'></div><!-- end col -->
			</div><!--end row-->
		</div><!--end container fluid-->
	</section><!--end section-->
	<!-- Hero End -->
@endsection
