@extends('layouts.frontend-layout')

@section('title')
	Pricing
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
						<h4 class="title text-light"> Product </h4>
						<div class="page-next">
							<nav aria-label="breadcrumb" class="d-inline-block">
								<ul class="breadcrumb bg-white rounded shadow mb-0">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Product</li>
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
		<!-- Crypto Portfolio end -->
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 text-center">
					<div class="section-title mb-4 pb-2">
						<h4 class="title mb-4">Your Tools Are Just One Click Away</h4>
						<p class="text-muted para-desc mb-0 mx-auto">Prepare your business for daily success with a robust solution to manage your clients and deals, plan your team’s projects and tasks, and keep track of your organizational results.</p>
					</div>
				</div><!--end col-->
			</div><!--end row-->

			<div class="row">
				<div class="col-12 mt-4 pt-2">
					<img src="{{asset('/frontend/images/task.png')}}" class="img-fluid mx-auto d-block" alt="">
				</div><!--end col-->
			</div><!--end row-->
			<div class="container mt-100 mt-60">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<img src="{{asset('/frontend/images/hr-dashboard.png')}}" class="img-fluid rounded" alt="">
					</div><!--end col-->
					<div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
						<div class="section-title ml-lg-5">
							<h4 class="title mb-4">Human Resource Management</h4>
							<p class="text-muted"><span class="text-primary font-weight-bold">CNX247</span> takes care of your HR processes while you take care of your employees.</p>
							<ul class="list-unstyled text-muted">
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>On-Boarding</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Worktime Management</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Attendance Management</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Employee Directory</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Termination & Resignation</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Performance Indicator & Employee Appraisal</li>
							</ul>
						</div>
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end container-->
			<div class="container mt-100 mt-60">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<img src="{{asset('/frontend/images/crm-dashboard.png')}}" class="img-fluid rounded" alt="">
					</div><!--end col-->
					<div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
						<div class="section-title ml-lg-5">
							<h4 class="title mb-4">Customer Relations Management</h4>
							<p class="text-muted"><span class="text-primary font-weight-bold">CNX247</span> provides you with a detailed overview of each customer, an ability to track your opportunities and deals in real time, and compile personalized invoices efficiently.</p>
							<ul class="list-unstyled text-muted">
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Clients, Leads & Deals</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Bulk SMS</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Email Campaign</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Invoices</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Receipts</li>
							</ul>
						</div>
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end container-->
			<div class="container mt-100 mt-60">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<img src="{{asset('/frontend/images/accounting.png')}}" class="img-fluid rounded" alt="">
					</div><!--end col-->
					<div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
						<div class="section-title ml-lg-5">
							<h4 class="title mb-4">Accounting</h4>
							<p class="text-muted"><span class="text-primary font-weight-bold">CNX247</span> handles your end-to-end accounting, you don't need to worry yourself about posting and complex accounting book keeping. All you get is just your balanced financial reports and books.</p>
							<ul class="list-unstyled text-muted">
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Chart of Accounts, Opening Balance & Ledger Defaults</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Vendor Bills</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Customers & Invoices</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Receipts, Payments & Journal Vouchers</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Balance Sheet, Trial Balance & Profit/Loss</li>
							</ul>
						</div>
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end container-->
			<div class="container mt-100 mt-60">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<img src="{{asset('/frontend/images/procurement.png')}}" class="img-fluid rounded" alt="">
					</div><!--end col-->
					<div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
						<div class="section-title ml-lg-5">
							<h4 class="title mb-4">Procurement</h4>
							<p class="text-muted">Centralized management of the services and purchases supplied to your business regularly.</p>
							<ul class="list-unstyled text-muted">
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Vendors</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Purchase Orders</li>
								<li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Services</li>
							</ul>
						</div>
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end container-->
		</div><!--end container-->
	</section>
@endsection
