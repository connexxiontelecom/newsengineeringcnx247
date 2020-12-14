@extends('layouts.app')

@section('title')
    Post or Trash Invoice
@endsection

@section('extra-styles')

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
    <div class="card" id="invoiceContainer">
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
                    <h6 class="m-0">{{$invoice->client->first_name ?? ''}} {{$invoice->client->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$invoice->client->street_1 ?? ''}}, {{$invoice->client->postal_code ?? ''}} {{$invoice->client->city ?? ''}}</p>
                    <p class="m-0">{{$invoice->client->mobile_no ?? ''}}</p>
                    <p><a href="mailto:{{$invoice->client->email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[{{$invoice->client->email ?? ''}}]</a></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6>Order Information :</h6>
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                            <tr>
                                <th>Issue Date :</th>
                                <td>{{date('d F, Y', strtotime($invoice->issue_date))}}</td>
                            </tr>
                            <tr>
                                <th>Due Date :</th>
                                <td>{{date('d F, Y', strtotime($invoice->due_date))}}</td>
                            </tr>
                            <tr>
                                <th>Status :</th>
                                <td>
                                    <span class="label label-warning">Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Invoice Number <span>#{{$invoice->invoice_no}}</span></h6>
                    <h6 class="text-uppercase text-primary">Balance Due :
                        <span>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($invoice->total - $invoice->cash,2)}}</span>
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->invoiceItem as $item)
                                    <tr>
                                        <td>
                                            <p>{{$item->description ?? ''}}</p>
                                        </td>
                                        <td>{{number_format($item->quantity)}}</td>
                                        <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($item->unit_cost, 2)}}</td>
                                        <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($item->total, 2)}}</td>
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
                        <tbody class="float-left pl-3">
                            <tr>
                                <th class="text-left"> <strong>Account Name:</strong> </th>
                                <td>{{Auth::user()->tenantBankDetails->account_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <th class="text-left"><strong>Account Number:</strong> </th>
                                <td>{{Auth::user()->tenantBankDetails->account_number ?? ''}}</td>
                            </tr>
                            <tr>
                                <th class="text-left"><strong>Bank:</strong> </th>
                                <td>{{Auth::user()->tenant->tenantBankDetails->bank_name ?? ''}}</td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th>Sub Total :</th>
                                <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($invoice->sub_total,2)}}</td>
                            </tr>
                            <tr>
                                <th>Taxes ({{$invoice->tax_rate}}%) :</th>
                                <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($invoice->tax_value,2) ?? 0}}</td>
                            </tr>
                            <tr>
                                <th>Discount ({{$invoice->discount_rate}}%) :</th>
                                <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($invoice->discount_value,2) ?? 0}}</td>
                            </tr>
                            <tr>
                                <th>Cash:</th>
                                <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($invoice->cash,2) ?? 0}}</td>
                            </tr>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Total :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($invoice->total,2)}}</h5>
                                </td>
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
        </div>
    </div>
    <div class="card" style="margin-top:-25px;">
        <div class="card-block">
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <div class="btn-group">
                        <a href="#" class="btn btn-danger btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"  > <i class="ti-close mr-2"></i> Trash Invoice </a>
                        <a href="{{route('post-invoice', $invoice->slug)}}" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20" ><i class="icofont icofont-paper-plane mr-2"></i> Post Invoice</a>
                        <a href="{{route('invoice-posting')}}" class="btn btn-secondary btn-mini waves-effect m-b-10 btn-sm waves-light"><i class="ti-arrow-left mr-2"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script>
    $(document).ready(function(){
        //print without commission



    });
</script>
@endsection
