@extends('layouts.app')

@section('title')
	Accounting Dashboard
@endsection

@section('extra-styles')

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
						@if (session()->has('success'))
							<div class="alert alert-success background-success mt-3">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<i class="icofont icofont-close-line-circled text-white"></i>
								</button>
								{!! session()->get('success') !!}
							</div>
						@endif
							<div class="row">

								<div class="col-md-12 col-lg-12">
									<div class="card">
										<div class="card-block">
											<h5 class="sub-title">Account Dashboard </h5>
											<p>Year: <label for="" class="label label-info">{{date('Y', strtotime($start_date))}}</label></p>
											<div class="row">
												<!-- <div class="col-md-6 offset-md-3">
													<form action="route('filter-dashboard')}}" method="post">
														csrf
														<div class="input-group input-group-button" id="date_range">
												<span class="input-group-addon btn btn-primary" id="basic-addon9">
														<span class="">From</span>
												</span>
															<input type="date" class="form-control" name="start_date" placeholder="Start Date">
															<span class="input-group-addon btn btn-primary" id="basic-addon9">
														<span class="">To</span>
												</span>
															<input type="date"  class="form-control" name="end_date" placeholder="End Date">
														</div>
														<div class="form-group d-flex justify-content-center mt-3">
															<div class="btn-group">
																<button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Submit</button>
															</div>
														</div>
													</form>
												</div> -->
												<!-- order-visitor start -->
												<div class="col-md-6">
													<div class="card text-center text-white bg-c-yellow">
														<div class="card-block">
															<h6 class="m-b-0">Unpaid Invoices</h6>
															<h4 class="m-t-10 m-b-10"><i class="feather icon-arrow-up m-r-15"></i>{{Auth::user()->tenant->currency->symbol ?? 'N'}}
																{{number_format($invoices->where('posted',0)->where('trash',0)->sum('total') ) }}</h4>
															<p class="m-b-0">A total of {{$invoices->count()}} invoice(s)</p>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card text-center text-white bg-c-green">
														<div class="card-block">
															<h6 class="m-b-0">Receipt</h6>
															<h4 class="m-t-10 m-b-10"><i class="feather icon-arrow-up m-r-15"></i>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoices->sum('paid_amount'),2)}}</h4>
															<p class="m-b-0">A total of {{$invoices->count()}} receipt(s)</p>
														</div>
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="card text-center text-white bg-c-yellow">
														<div class="card-block">
															<h6 class="m-b-0">Unpaid Bills</h6>
															<h4 class="m-t-10 m-b-10"><i class="feather icon-arrow-down m-r-15"></i>{{Auth::user()->tenant->currency->symbol ?? 'N'}}
																{{number_format( ($bills->where('trash',0)->sum('bill_amount') + $bills->where('trash',0)->sum('vat_amount')) - $bills->where('trash',0)->sum('paid_amount') ) }}</h4>
															<p class="m-b-0">A total of {{$bills->count()}} bill(s)</p>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card text-center text-white bg-c-green">
														<div class="card-block">
															<h6 class="m-b-0">Payment</h6>
															<h4 class="m-t-10 m-b-10"><i class="feather icon-arrow-up m-r-15"></i>{{Auth::user()->tenant->currency->symbol ?? 'N'}}
																{{number_format( $payments->where('trash',0)->sum('amount'),2 ) }}</h4>
															<p class="m-b-0">A total of {{$payments->count()}} payment(s)</p>
														</div>
													</div>
												</div>
												<!-- order-visitor end -->
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="card">
														<div class="card-block">
															<div class="row">

																<div class="col-sm-6">
																	<h2 class="d-inline-block text-c-pink m-r-10">{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoices->where('trash', '=',1)->sum('total') + $invoices->where('trash', '=',1)->sum('tax_value'),2)}}</h2>
																	<div class="d-inline-block">
																		<p class="text-muted m-b-0">Declined Invoices</p>
																	</div>
																</div>
																<div class="col-sm-6">
																	<h2 class="d-inline-block text-c-pink m-r-10">{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($bills->where('trash', '=',1)->sum('bill_amount') + $bills->where('trash', '=',1)->sum('vat_amount'),2)}}</h2>
																	<div class="d-inline-block">
																		<p class="text-muted m-b-0">Declined Bills</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
		</div>
	</div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
