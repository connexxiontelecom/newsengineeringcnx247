@extends('layouts.app')

@section('title')
    Invoice List
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

<style>
/* The heart of the matter */

.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <h5 class="sub-title text-center">
                    Invoices
                </h5>
            </div>
        </div>

    </div>
</div>

    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.crm.common._slab-menu')

                </div>
            </div>
        </div>
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success background-success" role="alert">
                    {!! session()->get('success') !!}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 filter-bar">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icofont icofont-ui-calendar f-30 text-c-lite-green"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">This Year</h6>
                                    <h5 class="m-b-0">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($thisYear,2)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icofont icofont-ui-calendar f-30 text-c-lite-green"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">Last Month</h6>
                                    <h5 class="m-b-0">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($last_month,2)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icofont icofont-ui-calendar f-30 text-c-lite-green"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">This Month</h6>
                                    <h5 class="m-b-0">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($monthly,2)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icofont icofont-ui-calendar f-30 text-c-lite-green"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">This Week</h6>
                                    <h5 class="m-b-0">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($this_week,2)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
						</div>
						<div class="col-md-12">
							<div class="card">
									<div class="card-block">
											<div class="row">

													<div class="col-sm-4">
															<h4 class="d-inline-block text-c-green m-r-10">{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoices->sum('paid_amount'),2)}}</h4>
															<div class="d-inline-block">
																	<p class="m-b-0"><i class="feather icon-chevrons-down m-r-10 text-c-green"></i></p>
																	<p class="text-muted m-b-0">Paid Invoices</p>
															</div>
													</div>
													<div class="col-sm-4">
															<h4 class="d-inline-block text-c-yellow m-r-10">{{Auth::user()->tenant->currency->symbol ?? 'N'}}
																{{number_format($invoices->where('posted',0)->where('trash',0)->sum('total') ) }}</h4>
															<div class="d-inline-block">
																	<p class="m-b-0"><i class="icofont icofont-sand-clock m-r-10 text-c-yellow"></i></p>
																	<p class="text-muted m-b-0">Unpaid Invoices</p>
															</div>
													</div>
													<div class="col-sm-4">
															<h4 class="d-inline-block text-c-pink m-r-10">{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoices->where('trash', '=',1)->sum('total') + $invoices->where('trash', '=',1)->sum('tax_value'),2)}}</h4>
															<div class="d-inline-block">
																	<p class="m-b-0"><i class="icofont icofont-ui-close m-r-10 text-c-pink"></i></p>
																	<p class="text-muted m-b-0">Declined</p>
															</div>
													</div>
											</div>
									</div>
							</div>
					</div>
            <div class="row">
							<div class="col-sm-12">
								<div class="card card-border-primary">
									<div class="card-block">
										<div class="dt-responsive table-responsive">
											<table id="simpletable" class="table table-striped table-bordered nowrap">
													<thead>
													<tr>
															<th>#</th>
															<th>Company Name</th>
															<th>Issued By</th>
															<th>Invoice No.</th>
															<th>Total</th>
															<th>Paid</th>
															<th>Balance</th>
															<th>Due Date</th>
															<th>Action</th>
													</tr>
													</thead>
													<tbody>
															@php
																	$serial = 1;
															@endphp
															@foreach ($invoices->where('trash', '!=',1) as $invoice)
																<tr>
																	<td>{{$serial++}}</td>
																	<td>{{$invoice->client->company_name ?? ''}}</td>
																	<td>{{$invoice->converter->first_name ?? ''}}  {{$invoice->converter->surname ?? ''}}</td>
																	<td>{{$invoice->invoice_no}}</td>
																	<td>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format(($invoice->total),2)}}</td>
																	<td>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoice->paid_amount,2)}}</td>
																	<td>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format(($invoice->total)  - ($invoice->paid_amount),2)}}</td>
																	<td>{{date('d F, Y', strtotime($invoice->due_date))}}</td>
																	<td>

                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="{{route('print-invoice', $invoice->slug)}}"><i class="ti-printer"></i> Print Invoice</a>
                                            <a class="dropdown-item waves-light waves-effect" href="{{route('print-invoice', $invoice->slug)}}"><i class="ti-trash"></i> Decline Invoice</a>
                                            @if(($invoice->paid_amount) < ($invoice->total))
                                                <a class="dropdown-item waves-light waves-effect" href="{{route('receive-payment', $invoice->slug)}}"><i class="ti-receipt"></i> Receive Payment</a>
																						@endif

                                        </div>
                                    </div>
																	</td>
																</tr>
															@endforeach
													</tbody>
													<tfoot>
													<tr>
														<th>#</th>
														<th>Company Name</th>
														<th>Issued By</th>
														<th>Invoice No.</th>
														<th>Total</th>
														<th>Paid</th>
														<th>Balance</th>
														<th>Due Date</th>
														<th>Action</th>
													</tr>
													</tfoot>
											</table>
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
<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
