@extends('layouts.frontend-layout')

@section('title')
    Pricing
@endsection

@section('extra-styles')

    <style>
        .card{
            /*border-radius: 0px !important;*/
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
						<h4 class="title text-light"> Pricing </h4>
						<div class="page-next">
							<nav aria-label="breadcrumb" class="d-inline-block">
								<ul class="breadcrumb bg-white rounded shadow mb-0">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Pricing</li>
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
			<div class="row justify-content-center">
				<div class="col-12 text-center">
					<div class="section-title mb-4 pb-2">
						<h4 class="title mb-4">Pricing Plans That Suit You</h4>
						<p class="text-muted para-desc mb-0 mx-auto">We chose a pricing approach that is well-suited for companies or organizations of various sizes. Whatever may be your budget, <span class="text-primary font-weight-bold">CNX247</span> offers flexible pricing plans that will get your business up and running while you devote your time to other things.</p>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col-12 mt-0 pt-0">
					<div class="text-center">
						<ul class="nav nav-pills rounded-pill justify-content-center d-inline-block border py-1 px-2" id="pills-tab" role="tablist">
							<li class="nav-item d-inline-block">
								<a class="nav-link px-3 rounded-pill active monthly" id="Monthly" data-toggle="pill" href="#Month" role="tab" aria-controls="Month" aria-selected="true">Monthly</a>
							</li>
							<li class="nav-item d-inline-block">
								<a class="nav-link px-3 rounded-pill monthly" id="Quarterly" data-toggle="pill" href="#Quarter" role="tab" aria-controls="Quarter" aria-selected="true">Quarterly <span class="badge badge-pill badge-info"> -5%</span></a>
							</li>
							<li class="nav-item d-inline-block">
								<a class="nav-link px-3 rounded-pill yearly" id="Yearly" data-toggle="pill" href="#Year" role="tab" aria-controls="Year" aria-selected="false">Yearly <span class="badge badge-pill badge-info"> -9%</span></a>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade active show" id="Month" role="tabpanel" aria-labelledby="Monthly">
							<div class="row">
								<div class="col-md-4 col-12 mt-4 pt-2">
									<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
										<div class="card-body">
											<h2 class="title text-uppercase mb-4">Free Trial</h2>
											<div class="d-flex mb-1">
												<span class="h4 mb-0 mt-2">₦ </span>
												<span class="price h1 mb-0"> {{number_format(0)}}</span>
												<span class="h4 align-self-end">/mo</span>
											</div>
											<small class="text-center text-muted mb-4">
												Start free and gain access to all features of CNX247 ERP Solution for 2 weeks to see how we suit your business needs and transform your processes.
											</small>
											<div class="mt-4">
												<span class="mt-2 badge badge-pill badge-success">Calls</span>
												<span class="mt-2 badge badge-pill badge-success">Emails</span>
												<span class="mt-2 badge badge-pill badge-success">SMS</span>
												<span class="mt-2 badge badge-pill badge-success">CNX Stream</span>
												<span class="mt-2 badge badge-pill badge-success">CNX Drive</span>
												<span class="mt-2 badge badge-pill badge-success">Chat</span>
												<span class="mt-2 badge badge-pill badge-success">Workflow</span>
												<span class="mt-2 badge badge-pill badge-success">Activity Stream</span>
												<span class="mt-2 badge badge-pill badge-success">CRM</span>
												<span class="mt-2 badge badge-pill badge-success">Project</span>
												<span class="mt-2 badge badge-pill badge-success">Reports</span>
												<span class="mt-2 badge badge-pill badge-success">Procurement</span>
												<span class="mt-2 badge badge-pill badge-success">Task</span>
												<span class="mt-2 badge badge-pill badge-success">Workgroup</span>
												<span class="mt-2 badge badge-pill badge-success">Clock In & Out</span>
												<span class="mt-2 badge badge-pill badge-danger">Basic Accounting</span>
												<span class="mt-2 badge badge-pill badge-success">Full Accounting</span>
												<span class="mt-2 badge badge-pill badge-success">HR</span>
												<span class="mt-2 badge badge-pill badge-success">Logistics</span>
											</div>
											<a href="#" class="btn btn-primary mt-4">Start Free</a>
										</div>
									</div>
								</div>
								@if (count($plans) > 0)
									@foreach ($plans as $plan)
										@if ($plan->duration <= 30)
											<div class="col-md-4 col-12 mt-4 pt-2">
												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
													<div class="card-body">
														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>
														<div class="d-flex mb-1">
															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}} </span>
															<span class="price h1 mb-0"> {{number_format($plan->price)}}</span>
															<span class="h4 align-self-end">/mo</span>
														</div>
														<small class="text-center text-muted mb-4">
															{{$plan->description}}
														</small>
														<div class="mt-4">
															@if($plan->calls != 0)
																<span class="mt-2 badge badge-pill badge-success">Calls: {{number_format($plan->calls).' minutes/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Calls</span>
															@endif
															@if($plan->emails != 0)
																<span class="mt-2 badge badge-pill badge-success">Emails: {{number_format($plan->emails).'/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Emails</span>
															@endif
															@if($plan->sms != 0)
																<span class="mt-2 badge badge-pill badge-success">SMS: {{number_format($plan->sms).'/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">SMS</span>
															@endif
																<span class="mt-2 badge badge-pill badge-success">Users: {{number_format($plan->team_size).' max'}}</span>
															@if($plan->stream != 0)
																<span class="mt-2 badge badge-pill badge-success">CNX Stream: {{number_format($plan->stream).' hrs/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CNX Stream</span>
															@endif
															@if($plan->storage_size != 0)
																<span class="mt-2 badge badge-pill badge-success">CNX Drive: {{number_format($plan->storage_size).'GB'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CNX Drive</span>
															@endif
															@if($plan->chat != 0)
																<span class="mt-2 badge badge-pill badge-success">Chat</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Chat</span>
															@endif
															@if($plan->workflow != 0)
																<span class="mt-2 badge badge-pill badge-success">Workflow</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Workflow</span>
															@endif
															@if($plan->activity_stream != 0)
																<span class="mt-2 badge badge-pill badge-success">Activity Stream</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Activity Stream</span>
															@endif
															@if($plan->crm != 0)
																<span class="mt-2 badge badge-pill badge-success">CRM</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CRM</span>
															@endif
															@if($plan->project != 0)
																<span class="mt-2 badge badge-pill badge-success">Project</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Project</span>
															@endif
															@if($plan->reports != 0)
																<span class="mt-2 badge badge-pill badge-success">Reports</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Reports</span>
															@endif
															@if($plan->procurement != 0)
																<span class="mt-2 badge badge-pill badge-success">Procurement</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Procurement</span>
															@endif
															@if($plan->task != 0)
																<span class="mt-2 badge badge-pill badge-success">Task</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Task</span>
															@endif
															@if($plan->workgroup != 0)
																<span class="mt-2 badge badge-pill badge-success">Workgroup</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Workgroup</span>
															@endif
															@if($plan->clock_in != 0)
																<span class="mt-2 badge badge-pill badge-success">Clock In & Out</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Clock In & Out</span>
															@endif
															@if($plan->basic_accounting != 0)
																<span class="mt-2 badge badge-pill badge-success">Basic Accounting</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Basic Accounting</span>
															@endif
															@if($plan->full_accounting != 0)
																<span class="mt-2 badge badge-pill badge-success">Full Accounting</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Full Accounting</span>
															@endif
															@if($plan->hr != 0)
																<span class="mt-2 badge badge-pill badge-success">HR</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">HR</span>
															@endif
															@if($plan->logistics != 0)
																<span class="mt-2 badge badge-pill badge-success">Logistics</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Logistics</span>
															@endif
														</div>
														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								@else
									<p class="text-center">There are no plans</p>
								@endif
							</div>
						</div>
						<div class="tab-pane fade" id="Quarter" role="tabpanel" aria-labelledby="Quarterly">
							<div class="row">
								<div class="col-md-4 col-12 mt-4 pt-2">
									<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
										<div class="card-body">
											<h2 class="title text-uppercase mb-4">Free Trial</h2>
											<div class="d-flex mb-1">
												<span class="h4 mb-0 mt-2">₦ </span>
												<span class="price h1 mb-0"> {{number_format(0)}}</span>
												<span class="h4 align-self-end">/mo</span>
											</div>
											<small class="text-center text-muted mb-4">
												Start free and gain access to all features of CNX247 ERP Solution for 2 weeks to see how we suit your business needs and transform your processes.
											</small>
											<div class="mt-4">
												<span class="mt-2 badge badge-pill badge-success">Calls</span>
												<span class="mt-2 badge badge-pill badge-success">Emails</span>
												<span class="mt-2 badge badge-pill badge-success">SMS</span>
												<span class="mt-2 badge badge-pill badge-success">CNX Stream</span>
												<span class="mt-2 badge badge-pill badge-success">CNX Drive</span>
												<span class="mt-2 badge badge-pill badge-success">Chat</span>
												<span class="mt-2 badge badge-pill badge-success">Workflow</span>
												<span class="mt-2 badge badge-pill badge-success">Activity Stream</span>
												<span class="mt-2 badge badge-pill badge-success">CRM</span>
												<span class="mt-2 badge badge-pill badge-success">Project</span>
												<span class="mt-2 badge badge-pill badge-success">Reports</span>
												<span class="mt-2 badge badge-pill badge-success">Procurement</span>
												<span class="mt-2 badge badge-pill badge-success">Task</span>
												<span class="mt-2 badge badge-pill badge-success">Workgroup</span>
												<span class="mt-2 badge badge-pill badge-success">Clock In & Out</span>
												<span class="mt-2 badge badge-pill badge-danger">Basic Accounting</span>
												<span class="mt-2 badge badge-pill badge-success">Full Accounting</span>
												<span class="mt-2 badge badge-pill badge-success">HR</span>
												<span class="mt-2 badge badge-pill badge-success">Logistics</span>
											</div>
											<a href="#" class="btn btn-primary mt-4">Start Free</a>
										</div>
									</div>
								</div>
								@if (count($plans) > 0)
									@foreach ($plans as $plan)
										@if ($plan->duration > 30 && $plan->duration <= 90 )
											<div class="col-md-4 col-12 mt-4 pt-2">
												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
													<div class="card-body">
														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>
														<div class="d-flex mb-1">
															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}} </span>
															<span class="price h1 mb-0"> {{number_format($plan->price)}}</span>
															<span class="h4 align-self-end">/mo</span>
														</div>
														<small class="text-center text-muted mb-4">
															{{$plan->description}}
														</small>
														<div class="mt-4">
															@if($plan->calls != 0)
																<span class="mt-2 badge badge-pill badge-success">Calls: {{number_format($plan->calls).' minutes/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Calls</span>
															@endif
															@if($plan->emails != 0)
																<span class="mt-2 badge badge-pill badge-success">Emails: {{number_format($plan->emails).'/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Emails</span>
															@endif
															@if($plan->sms != 0)
																<span class="mt-2 badge badge-pill badge-success">SMS: {{number_format($plan->sms).'/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">SMS</span>
															@endif
															<span class="mt-2 badge badge-pill badge-success">Users: {{number_format($plan->team_size).' max'}}</span>
															@if($plan->stream != 0)
																<span class="mt-2 badge badge-pill badge-success">CNX Stream: {{number_format($plan->stream).' hrs/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CNX Stream</span>
															@endif
															@if($plan->storage_size != 0)
																<span class="mt-2 badge badge-pill badge-success">CNX Drive: {{number_format($plan->storage_size).'GB'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CNX Drive</span>
															@endif
															@if($plan->chat != 0)
																<span class="mt-2 badge badge-pill badge-success">Chat</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Chat</span>
															@endif
															@if($plan->workflow != 0)
																<span class="mt-2 badge badge-pill badge-success">Workflow</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Workflow</span>
															@endif
															@if($plan->activity_stream != 0)
																<span class="mt-2 badge badge-pill badge-success">Activity Stream</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Activity Stream</span>
															@endif
															@if($plan->crm != 0)
																<span class="mt-2 badge badge-pill badge-success">CRM</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CRM</span>
															@endif
															@if($plan->project != 0)
																<span class="mt-2 badge badge-pill badge-success">Project</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Project</span>
															@endif
															@if($plan->reports != 0)
																<span class="mt-2 badge badge-pill badge-success">Reports</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Reports</span>
															@endif
															@if($plan->procurement != 0)
																<span class="mt-2 badge badge-pill badge-success">Procurement</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Procurement</span>
															@endif
															@if($plan->task != 0)
																<span class="mt-2 badge badge-pill badge-success">Task</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Task</span>
															@endif
															@if($plan->workgroup != 0)
																<span class="mt-2 badge badge-pill badge-success">Workgroup</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Workgroup</span>
															@endif
															@if($plan->clock_in != 0)
																<span class="mt-2 badge badge-pill badge-success">Clock In & Out</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Clock In & Out</span>
															@endif
															@if($plan->basic_accounting != 0)
																<span class="mt-2 badge badge-pill badge-success">Basic Accounting</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Basic Accounting</span>
															@endif
															@if($plan->full_accounting != 0)
																<span class="mt-2 badge badge-pill badge-success">Full Accounting</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Full Accounting</span>
															@endif
															@if($plan->hr != 0)
																<span class="mt-2 badge badge-pill badge-success">HR</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">HR</span>
															@endif
															@if($plan->logistics != 0)
																<span class="mt-2 badge badge-pill badge-success">Logistics</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Logistics</span>
															@endif
														</div>
														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								@else
									<p class="text-center">There are no plans </p>
								@endif
							</div>
						</div>

						<div class="tab-pane fade" id="Year" role="tabpanel" aria-labelledby="Yearly">
							<div class="row">
								<div class="col-md-4 col-12 mt-4 pt-2">
									<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
										<div class="card-body">
											<h2 class="title text-uppercase mb-4">Free Trial</h2>
											<div class="d-flex mb-1">
												<span class="h4 mb-0 mt-2">₦ </span>
												<span class="price h1 mb-0"> {{number_format(0)}}</span>
												<span class="h4 align-self-end">/mo</span>
											</div>
											<small class="text-center text-muted mb-4">
												Start free and gain access to all features of CNX247 ERP Solution for 2 weeks to see how we suit your business needs and transform your processes.
											</small>
											<div class="mt-4">
												<span class="mt-2 badge badge-pill badge-success">Calls</span>
												<span class="mt-2 badge badge-pill badge-success">Emails</span>
												<span class="mt-2 badge badge-pill badge-success">SMS</span>
												<span class="mt-2 badge badge-pill badge-success">CNX Stream</span>
												<span class="mt-2 badge badge-pill badge-success">CNX Drive</span>
												<span class="mt-2 badge badge-pill badge-success">Chat</span>
												<span class="mt-2 badge badge-pill badge-success">Workflow</span>
												<span class="mt-2 badge badge-pill badge-success">Activity Stream</span>
												<span class="mt-2 badge badge-pill badge-success">CRM</span>
												<span class="mt-2 badge badge-pill badge-success">Project</span>
												<span class="mt-2 badge badge-pill badge-success">Reports</span>
												<span class="mt-2 badge badge-pill badge-success">Procurement</span>
												<span class="mt-2 badge badge-pill badge-success">Task</span>
												<span class="mt-2 badge badge-pill badge-success">Workgroup</span>
												<span class="mt-2 badge badge-pill badge-success">Clock In & Out</span>
												<span class="mt-2 badge badge-pill badge-danger">Basic Accounting</span>
												<span class="mt-2 badge badge-pill badge-success">Full Accounting</span>
												<span class="mt-2 badge badge-pill badge-success">HR</span>
												<span class="mt-2 badge badge-pill badge-success">Logistics</span>
											</div>
											<a href="#" class="btn btn-primary mt-4">Start Free</a>
										</div>
									</div>
								</div>
							@if (count($plans) > 0)
									@foreach ($plans as $plan)
										@if ($plan->duration >= 360)
											<div class="col-md-4 col-12 mt-4 pt-2">
												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
													<div class="card-body">
														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>
														<div class="d-flex mb-1">
															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}} </span>
															<span class="price h1 mb-0"> {{number_format($plan->price)}}</span>
															<span class="h4 align-self-end">/mo</span>
														</div>
														<small class="text-center text-muted mb-4">
															{{$plan->description}}
														</small>
														<div class="mt-4">
															@if($plan->calls != 0)
																<span class="mt-2 badge badge-pill badge-success">Calls: {{number_format($plan->calls).' minutes/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Calls</span>
															@endif
															@if($plan->emails != 0)
																<span class="mt-2 badge badge-pill badge-success">Emails: {{number_format($plan->emails).'/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Emails</span>
															@endif
															@if($plan->sms != 0)
																<span class="mt-2 badge badge-pill badge-success">SMS: {{number_format($plan->sms).'/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">SMS</span>
															@endif
															<span class="mt-2 badge badge-pill badge-success">Users: {{number_format($plan->team_size).' max'}}</span>
															@if($plan->stream != 0)
																<span class="mt-2 badge badge-pill badge-success">CNX Stream: {{number_format($plan->stream).' hrs/mo'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CNX Stream</span>
															@endif
															@if($plan->storage_size != 0)
																<span class="mt-2 badge badge-pill badge-success">CNX Drive: {{number_format($plan->storage_size).'GB'}}</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CNX Drive</span>
															@endif
															@if($plan->chat != 0)
																<span class="mt-2 badge badge-pill badge-success">Chat</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Chat</span>
															@endif
															@if($plan->workflow != 0)
																<span class="mt-2 badge badge-pill badge-success">Workflow</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Workflow</span>
															@endif
															@if($plan->activity_stream != 0)
																<span class="mt-2 badge badge-pill badge-success">Activity Stream</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Activity Stream</span>
															@endif
															@if($plan->crm != 0)
																<span class="mt-2 badge badge-pill badge-success">CRM</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">CRM</span>
															@endif
															@if($plan->project != 0)
																<span class="mt-2 badge badge-pill badge-success">Project</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Project</span>
															@endif
															@if($plan->reports != 0)
																<span class="mt-2 badge badge-pill badge-success">Reports</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Reports</span>
															@endif
															@if($plan->procurement != 0)
																<span class="mt-2 badge badge-pill badge-success">Procurement</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Procurement</span>
															@endif
															@if($plan->task != 0)
																<span class="mt-2 badge badge-pill badge-success">Task</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Task</span>
															@endif
															@if($plan->workgroup != 0)
																<span class="mt-2 badge badge-pill badge-success">Workgroup</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Workgroup</span>
															@endif
															@if($plan->clock_in != 0)
																<span class="mt-2 badge badge-pill badge-success">Clock In & Out</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Clock In & Out</span>
															@endif
															@if($plan->basic_accounting != 0)
																<span class="mt-2 badge badge-pill badge-success">Basic Accounting</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Basic Accounting</span>
															@endif
															@if($plan->full_accounting != 0)
																<span class="mt-2 badge badge-pill badge-success">Full Accounting</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Full Accounting</span>
															@endif
															@if($plan->hr != 0)
																<span class="mt-2 badge badge-pill badge-success">HR</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">HR</span>
															@endif
															@if($plan->logistics != 0)
																<span class="mt-2 badge badge-pill badge-success">Logistics</span>
															@else
																<span class="mt-2 badge badge-pill badge-danger">Logistics</span>
															@endif
														</div>
														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								@else
									<p class="text-center">There are no plans </p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- FAQ n Contact Start -->
	<section class="section bg-light">
		<div class="container">
			<div class="row mt-sm-0 pt-sm-0 justify-content-center">
				<div class="col-12 text-center">
					<div class="section-title">
						<h4 class="title mb-4">Didn't Find a Suitable Plan?</h4>
						<p class="text-muted para-desc mx-auto">We can discuss a custom-tailored solution for your business.</p>
						<div class="mt-4 pt-2">
							<a href="javascript:void(0)" class="btn btn-primary">Contact Us <i class="mdi mdi-arrow-right"></i></a>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end section-->
	<!-- FAQ n Contact End -->
@endsection
