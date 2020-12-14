@extends('layouts.app')

@section('title')
Receive Payment
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
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
   <form action="{{route('raise-receipt')}}" method="post">
       @csrf
    <div class="card">
        <div class="row invoice-contact">
            <div class="col-md-8">
                <div class="invoice-box row">
                    <div class="col-sm-12">
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
                    <h6 class="m-0">{{$client->title ?? ''}} {{$client->first_name ?? ''}} {{$client->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$client->street_1 ?? ''}}. {{$client->city ?? ''}}, {{$client->postal_code ?? ''}}</p>
                    <p class="m-0">{{$client->mobile_no ?? ''}}</p>
                    <p><a href="mailto:{{$client->email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[ {{$client->email ?? ''}} ]</a></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Balance: <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoices->sum('total') - $invoices->sum('cash') - $invoices->sum('paid_amount'),2)}}</span></h6>
                    <h6 class="text-uppercase text-primary">Amount Received :
                        <span class="balance">{{Auth::user()->tenant->currency->symbol ?? 'N'}} <span class="amount-received"></span> </span>
                    </h6>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Payment Date</label>
                                <input type="date" name="payment_date" placeholder="Date" class="form-control">
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
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Amount Due</th>
                                    <th>Amount Paid</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody id="products">
                                @foreach($invoices as $item)
                                    <tr class="item">
                                        <td>
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="" data-amount="{{ number_format((float)($item->total - $item->paid_amount), 2, '.', '')}}" class="select-invoice">
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
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->issue_date))}}</p>
                                        </td>
                                        <td>
                                            <p>{{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->due_date))}}</p>
                                        </td>
                                        <td>
                                            <p>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format(($item->total - $item->paid_amount),2)}}</p>
                                        </td>
                                        <td>
                                            <p>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($item->paid_amount ?? 0,2)}}</p>
                                        </td>
                                        <td><input type="number" step="0.01" class="form-control payment" name="payment[]" style="width: 120px;"></td>
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
                                <td class="amount-receive">{{Auth::user()->tenant->currency->symbol ?? 'N'}} <span class="amount-received">0.00</span> </td>
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
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <input type="hidden" name="clientId" value="{{$client->id}}">
                    <input type="hidden" name="totalAmount" value="{{$invoices->sum('total') - $invoices->sum('cash')}}" id="totalAmount"/>
                    <button type="submit" id="issueReceiptBtn" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-check"></i> Submit</button>
                    <a href="{{url()->previous()}}" class="btn btn-danger btn-mini waves-effect m-b-10 btn-sm waves-light">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script>
    $(document).ready(function(){
        var grand_total = 0;
        var invoice_total = 0;
        $(".select-invoice").on('change', function() {
            var amount = $(this).data('amount');
                if ($(this).is(':checked')){
                    $(this).closest('tr').find('.payment').val(amount);
                    $('.amount-received').text(parseFloat(invoice_total).toLocaleString());
                    setTotal();
                }else{
                    var sub_amount = $(this).closest('tr').find('.payment').val();
                    cur = invoice_total - sub_amount;
                    invoice_total = cur;
                    $('.amount-received').text(parseFloat(invoice_total).toLocaleString());
                    var sub_amount = $(this).closest('tr').find('.payment').val('');
                    setTotal();
                }
        });
        $(document).on("change", ".payment", function() {
            setTotal();
        });
    });

    function setTotal(){
        var sum = 0;
        $(".payment").each(function(){
            sum += +$(this).val();
        });
            $(".amount-received").text(sum.toLocaleString());
    }
</script>
@endsection
