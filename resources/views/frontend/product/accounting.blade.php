@extends('layouts.frontend-layout')

@section('title')
	Accounting
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
						<h4 class="title text-light"> Accounting </h4>
						<div class="page-next">
							<nav aria-label="breadcrumb" class="d-inline-block">
								<ul class="breadcrumb bg-white rounded shadow mb-0">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item">Product</li>
									<li class="breadcrumb-item active" aria-current="page">Accounting</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>  <!--end col-->
			</div><!--end row-->
		</div> <!--end container-->
	</section><!--end section-->
	<!-- Hero End -->
	<section class="section">
		<div class="container">
			<div class="row align-items-center" id="counter">
				<div class="col-md-6">
					<img src="{{asset('/frontend/images/hr-dashboard.png')}}" class="img-fluid" alt="">
				</div><!--end col-->

				<div class="col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
					<div class="ml-lg-4">
						<div class="section-title">
							<h4 class="title mb-4">Accounting</h4>
							<p class="text-muted">
								<span class="text-primary font-weight-bold">CNX247</span>
								Handles your End-to-end accounting, you don't need to worry yourself about posting and complex accounting book keeping. All you get is just your balanced financial reports and books!
							</p>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container mt-100 mt-60">
			<div class="row align-items-end mb-2 pb-2">
				<div class="col-md-8">
					<div class="section-title text-center text-md-left">
						<h6 class="text-primary">Services</h6>
						<h4 class="title mb-4">What does our Accounting System Offer?</h4>
						{{--            <p class="text-muted mb-0 para-desc">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>--}}
					</div>
				</div><!--end col-->
			</div><!--end row-->
			<div class="row">
				<div class="col-md-4 mt-0 pt-0">
					<ul class="nav nav-pills nav-justified flex-column bg-white rounded shadow p-3 mb-0 sticky-bar" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link rounded active" id="webdeveloping" data-toggle="pill" href="#onboarding" role="tab" aria-controls="developing" aria-selected="false">
								<div class="text-center pt-1 pb-1">
									<h6 class="title font-weight-normal mb-0">Chart of Accounts</h6>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->

						<li class="nav-item mt-2">
							<a class="nav-link rounded" id="database" data-toggle="pill" href="#data-analise" role="tab" aria-controls="data-analise" aria-selected="false">
								<div class="text-center pt-1 pb-1">
									<h6 class="title font-weight-normal mb-0">Financial Reports</h6>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->

						<li class="nav-item mt-2">
							<a class="nav-link rounded" id="server" data-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">
								<div class="text-center pt-1 pb-1">
									<h6 class="title font-weight-normal mb-0">Invoices</h6>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->

						<li class="nav-item mt-2">
							<a class="nav-link rounded" id="webdesigning" data-toggle="pill" href="#designing" role="tab" aria-controls="designing" aria-selected="false">
								<div class="text-center pt-1 pb-1">
									<h6 class="title font-weight-normal mb-0">Payables</h6>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->
					</ul><!--end nav pills-->
				</div><!--end col-->

				<div class="col-md-8 col-12 mt-0 pt-0">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade bg-white show active p-4 rounded shadow" id="onboarding" role="tabpanel" aria-labelledby="webdeveloping">
							<img src="{{asset('/frontend/images/coa_1.png')}}" class="img-fluid" alt="">
							<div class="mt-0">
								<p class="text-muted">Easily Set up your Chart of Accounts</p>
							</div>
						</div><!--end teb pane-->

						<div class="tab-pane fade bg-white p-4 rounded shadow" id="data-analise" role="tabpanel" aria-labelledby="database">
							<img src="{{asset('/frontend/images/triall.png')}}" class="img-fluid" alt="">
							<div class="mt-0">
								<p class="text-muted">From Profit and Loss statements and Trial Balance to Balance Sheet,  CNX247 offers business reports required to run your business smoothly. </p>
							</div>
						</div><!--end teb pane-->

						<div class="tab-pane fade bg-white p-4 rounded shadow" id="security" role="tabpanel" aria-labelledby="server">
							<img src="{{asset('/frontend/images/invoice.png')}}" class="img-fluid" alt="">
							<div class="mt-0">
								<p class="text-muted">Everything you need to simplify your business invoicing, and more.</p>
							</div>
						</div><!--end teb pane-->

						<div class="tab-pane fade bg-white p-4 rounded shadow" id="designing" role="tabpanel" aria-labelledby="webdesigning">
							<img src="{{asset('/frontend/images/invoice.png')}}" class="img-fluid" alt="">
							<div class="mt-0">
								<p class="text-muted">Be abreast of your Payables and know where your money is going. From vendor bills to expenses, CNX247 makes managing payables easy.</p>
							</div>
						</div><!--end teb pane-->
					</div><!--end tab content-->
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end section-->
@endsection
