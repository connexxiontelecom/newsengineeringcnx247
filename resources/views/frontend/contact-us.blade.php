@extends('layouts.frontend-layout')
@section('title')
	Contact Us
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
						<h4 class="title text-light"> Contact Us </h4>
						<div class="page-next">
							<nav aria-label="breadcrumb" class="d-inline-block">
								<ul class="breadcrumb bg-white rounded shadow mb-0">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Contact Us</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>  <!--end col-->
			</div><!--end row-->
		</div> <!--end container-->
	</section><!--end section-->
	<!-- Hero End -->
	<!-- Start Contact -->
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6  mt-4 pt-2">
					<div class="card shadow rounded border-0">
						<div class="card-body py-5">
							<h4 class="card-title">Get In Touch !</h4>
							<div class="custom-form mt-4">
								<div id="message"></div>
								<form method="post" action="mailto:chijoke@connexxiongroup.com" name="contact-form" id="contact-form">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group position-relative">
												<label>Your Name <span class="text-danger">*</span></label>
												<i data-feather="user" class="fea icon-sm icons"></i>
												<input name="name" id="name" type="text" class="form-control pl-5" required>
											</div>
										</div><!--end col-->
										<div class="col-md-6">
											<div class="form-group position-relative">
												<label>Your Email <span class="text-danger">*</span></label>
												<i data-feather="mail" class="fea icon-sm icons"></i>
												<input name="email" id="email" type="email" class="form-control pl-5" required>
											</div>
										</div><!--end col-->
										<div class="col-md-12">
											<div class="form-group position-relative">
												<label>Subject <span class="text-danger">*</span></label>
												<i data-feather="book" class="fea icon-sm icons"></i>
												<input name="subject" id="subject" type="text" class="form-control pl-5" required>
											</div>
										</div><!--end col-->
										<div class="col-md-12">
											<div class="form-group position-relative">
												<label>Comments <span class="text-danger">*</span></label>
												<i data-feather="message-circle" class="fea icon-sm icons"></i>
												<textarea name="comments" id="comments" rows="4" class="form-control pl-5" required></textarea>
											</div>
										</div>
									</div><!--end row-->
									<div class="row">
										<div class="col-sm-12 text-center">
											<input type="submit" id="submit" name="send" class="submitBnt btn btn-primary btn-block" value="Send Message">
											<div id="simple-msg"></div>
										</div><!--end col-->
									</div><!--end row-->
								</form><!--end form-->
							</div><!--end custom-form-->
						</div>
					</div>
				</div><!--end col-->

				<div class="col-lg-8 col-md-6 pl-md-3 pr-md-3 mt-4 pt-2">
					<div class="card map map-height-two rounded map-gray border-0">
						<div class="card-body p-0">
							<script src="https://apps.elfsight.com/p/platform.js" defer></script>
							<div class="elfsight-app-3e4a234c-ddae-442f-829a-f9f9a55ede19"></div>
{{--							<iframe src="https://www.google.com/maps/place/2+Iller+Cres,+Maitama+900271,+Abuja/@9.0946015,7.4939372,17z/data=!3m1!4b1!4m5!3m4!1s0x104e0a69145f361d:0xcfd7575e5ae4f434!8m2!3d9.0946015!4d7.4961259" style="border:0" class="rounded" allowfullscreen=""></iframe>--}}
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container mt-100 mt-60">
			<div class="row">
				<div class="col-md-4">
					<div class="card contact-detail text-center border-0">
						<div class="card-body p-0">
							<div class="icon">
								<img src="{{asset('/frontend/images/icon/bitcoin.svg')}}" class="avatar avatar-small" alt="">
							</div>
							<div class="content mt-3">
								<h4 class="title font-weight-bold">Phone</h4>
								<p class="text-muted">Our team is happy to respond to your enquiries via phone calls</p>
								<a href="tel:+2349016400000" class="text-primary">+234 901 640 0000</a>
							</div>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
					<div class="card contact-detail text-center border-0">
						<div class="card-body p-0">
							<div class="icon">
								<img src="{{asset('/frontend/images/icon/Email.svg')}}" class="avatar avatar-small" alt="">
							</div>
							<div class="content mt-3">
								<h4 class="title font-weight-bold">Email</h4>
								<p class="text-muted">Our team is happy to respond to your enquiries via email</p>
								<a href="mailto:info@cnx247.com" class="text-primary">info@cnx247.com</a>
							</div>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
					<div class="card contact-detail text-center border-0">
						<div class="card-body p-0">
							<div class="icon">
								<img src="{{asset('/frontend/images/icon/location.svg')}}" class="avatar avatar-small" alt="">
							</div>
							<div class="content mt-3">
								<h4 class="title font-weight-bold">Location</h4>
								<p class="text-muted">2A Iller Crescent, Off Katsina Ala, <br>Maitama, Abuja</p>
								<a href="https://www.google.com/maps/place/2+Iller+Cres,+Maitama+900271,+Abuja/@9.0946015,7.4939372,17z/data=!3m1!4b1!4m5!3m4!1s0x104e0a69145f361d:0xcfd7575e5ae4f434!8m2!3d9.0946015!4d7.4961259" class="video-play-icon h6 text-primary">View on Google map</a>
							</div>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end section-->
	<!-- End contact -->
@endsection
