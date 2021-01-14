@extends('layouts.app')

@section('title')
Receive Payment
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/cus/datetimepicker.min.css">
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

<div class="container">
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.crm.common._slab-menu')
                </div>
            </div>
        </div>
   </div>
   <form action="{{route('receive-invoice-payment')}}" method="post" autocomplete="off">
       @csrf
    <div class="card">
        <div class="row invoice-contact">
            <div class="col-md-12 col-sm-12">
                <div class="invoice-box row">
                    <div class="col-sm-12">
											@if (count($status) > 0)
													<div class="alert alert-warning background-warning" role="alert">
														<strong>Ooops!</strong> This action cannot be completed because there is a receipt that needs to be taken care of.
													</div>
											@endif
                        <table class="table table-responsive invoice-table table-borderless">
                            <tbody>
                                <tr>
                                    <td><img src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" class="m-b-10" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="52" width="82"></td>
                                </tr>
                                <tr>
                                    <td>{{ Auth::user()->tenant->company_name ?? 'Company Name here'}}</td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->street_1 ?? 'Street here'}} {{ Auth::user()->tenant->city ?? ''}} {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}</td>
                                </tr>
                                <tr>
                                    <td><a href="mailto:{{Auth::user()->tenant->email ?? ''}}" target="_top"><span class="__cf_email__" data-cfemail="">[ {{Auth::user()->tenant->email ?? 'Email here'}} ]</span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->phone ?? 'Phone Number here'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="card-block">
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6>Client Information :</h6>
                    <h6 class="m-0">{{$invoice->client->title ?? ''}} {{$invoice->client->first_name ?? ''}} {{$invoice->client->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$invoice->client->street_1 ?? ''}}. {{$invoice->client->city ?? ''}}, {{$invoice->client->postal_code ?? ''}}</p>
                    <p class="m-0">{{$invoice->client->mobile_no ?? ''}}</p>
                    <p><a href="mailto:{{$invoice->client->email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[ {{$invoice->client->email ?? ''}} ]</a></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Balance: <span>{{$invoice->getCurrency->symbol ??  'N'}}{{number_format($pending_invoices->sum('total')/$invoice->exchange_rate - $pending_invoices->sum('paid_amount')/$invoice->exchange_rate,2)}}</span></h6>
                    <h6 class="text-uppercase text-primary">Amount Received :
                        <span class="balance">{{$invoice->getCurrency->symbol ?? 'N'}} {{number_format($pending_invoices->sum('paid_amount')/$invoice->exchange_rate,2)}}<span class="amount-received"></span> </span>
                    </h6>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Payment Date</label>
                                <input type="text" name="payment_date" id="payment_date" placeholder="dd/mm/yyyy" class="form-control">
                                @error('payment_date')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select name="payment_method" class="form-control">
                                    <option value="1">Cash</option>
                                    <option value="2">Bank Transfer</option>
                                    <option value="3">Cheque</option>
                                </select>
                                @error('payment_method')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Reference No.</label>
                                <input type="text" placeholder="Reference No." class="form-control" name="reference_no">
                                @error('reference_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Bank.</label>
                                <select name="bank" id="bank" class="form-control">
                                    <option selected disabled>Select bank</option>
                                    @foreach ($charts as $item)
                                    <option value="{{$item->glcode}}">{{$item->bank_name ?? ''}}</option>

                                    @endforeach
                                </select>
                                @error('bank')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th style="width:20px;">
                                    </th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>Original Amount</th>
                                    <th>Balance</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody id="products">
                                @foreach($pending_invoices as $item)
                                    <tr class="item">
                                        <td>
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="" data-amount="{{ number_format((float)($item->total/$invoice->exchange_rate) - ($item->paid_amount/$invoice->exchange_rate), 2, '.', '')}}" class="select-invoice">
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <p><a target="_blank" href="{{route('print-invoice', $item->slug)}}">Invoice #{{$item->invoice_no}} ({{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->created_at))}})</a></p>
                                                <input type="hidden" value="{{$item->id}}" name="invoices[]">
                                                <input type="hidden" value="{{$item->exchange_rate}}" name="exchange_rate[]">
                                                <input type="hidden" value="{{$item->currency_id}}" name="currency[]">
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->due_date))}}</p>
                                        </td>
                                        <td>
                                            <p>{{$invoice->getCurrency->symbol ?? 'N'}}{{number_format(($item->total)/$invoice->exchange_rate,2)}}</p>
                                        </td>
                                        <td>
                                            <p>{{$invoice->getCurrency->symbol ?? 'N'}}{{number_format(($item->total)/$invoice->exchange_rate - ($item->paid_amount)/$invoice->exchange_rate,2)}}</p>
                                        </td>
                                        <td><input type="text" class="form-control payment autonumber" name="payment[]" style="width: 120px;"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
                            <tr>
                                <th>Amount Received :</th>
                                <td class="amount-receive">{{$invoice->getCurrency->symbol ?? 'N'}} <span class="total">0.00</span> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h6>Terms And Condition :</h6>
                <p>{!! Auth::user()->tenant->invoice_terms !!}</p>
                </div>
						</div>
						@if (count($status) <= 0)
							<div class="row text-center">
									<div class="col-sm-12 invoice-btn-group text-center">
											<input type="hidden" name="clientId" value="{{$invoice->client->id}}">
											<input type="hidden" name="totalAmount" value="{{$pending_invoices->sum('total') - $pending_invoices->sum('cash')}}" id="totalAmount"/>
											<button type="submit" id="issueReceiptBtn" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-check"></i> Submit</button>
											<a href="{{url()->previous()}}" class="btn btn-danger btn-mini waves-effect m-b-10 btn-sm waves-light">Back</a>
									</div>
							</div>
						@else
						<strong class="text-danger text-center d-flex justify-content-center">This action cannot be completed. A pending receipt needs to be posted or declined.</strong>
						<hr>
						<div class="btn-group  d-flex justify-content-center">
							<a href="{{route('invoice-list')}}" class="btn btn-secondary btn-mini text-center">Back</a>
							<a href="{{route('receipt-posting')}}" class="btn btn-primary btn-mini text-center">Receipts</a>
						</div>
						@endif
        </div>
    </div>
</form>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script src="\assets\pages\form-masking\inputmask.js"></script>
<script src="\assets\pages\form-masking\jquery.inputmask.js"></script>
<script src="/assets/pages/form-masking/autoNumeric.js"></script>
<script src="/assets/pages/form-masking/form-mask.js"></script>
<script type="text/javascript" src="/assets/js/cus/moment.js"></script>
<script type="text/javascript" src="/assets/js/cus/datetimepicker.js"></script>

<script>
    $(document).ready(function(){
			$('#payment_date').datetimepicker();
        var grand_total = 0;
        var invoice_total = 0;
        $(".select-invoice").on('change', function() {
            var amount = $(this).data('amount');
                if ($(this).is(':checked')){
                    $(this).closest('tr').find('.payment').val(amount);
                    //$('.amount-received').text(parseFloat(invoice_total).toLocaleString());
                    setTotal();
                }else{
                    var sub_amount = $(this).closest('tr').find('.payment').val();
                    cur = invoice_total - sub_amount;
                    invoice_total = cur;
                    //$('.amount-received').text(parseFloat(invoice_total).toLocaleString());
                    var sub_amount = $(this).closest('tr').find('.payment').val('');
                    setTotal();
                }
        });
        $(document).on("change", ".payment", function() {
            setTotal();
				});

				$('.payment').on('change', function(e){
            e.preventDefault();
						setTotal();
						$(this).val().toLocaleString();
        });
    });


    function setTotal(){
        var sum = 0;
        $(".payment").each(function(){
						sum += +$(this).val().replace(/,/g, '');
            $(".total").text(sum.toLocaleString());
        });
		}
</script>
@endsection
