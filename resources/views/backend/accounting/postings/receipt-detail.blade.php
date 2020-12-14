@extends('layouts.app')

@section('title')
    Post or Trash Receipt
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
                    <h6 class="m-0">{{$receipt->client->company_name ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$receipt->client->street_1 ?? ''}}, {{$receipt->client->postal_code ?? ''}} {{$receipt->client->city ?? ''}}</p>
                    <p class="m-0">{{$receipt->client->mobile_no ?? ''}}</p>
                    <p><a href="mailto:{{$receipt->client->email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[{{$receipt->client->email ?? ''}}]</a></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6>Order Information :</h6>
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                            <tr>
                                <th>Issue Date :</th>
                                <td>{{date('d F, Y', strtotime($receipt->issue_date))}}</td>
                            </tr>
                            <tr>
                                <th>Issued By :</th>
                                <td>
                                    <span class="label label-warning">{{$receipt->converter->first_name ?? ''}} {{$receipt->converter->surname ?? ''}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Ref. Number <span>#{{$receipt->ref_no}}</span></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Description</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipt->receiptItem as $item)
                                    <tr>
                                        <td>
                                            <p>Receipt for invoice # {{$item->invoice_id ?? ''}}</p>
                                        </td>
                                        <td>{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($item->payment, 2)}}</td>
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
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Total :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary">{{Auth::user()->tenant->currency->symbol ?? '₦'}}{{number_format($receipt->receiptItem->sum('payment'),2)}}</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top:-25px;">
        <div class="card-block">
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <div class="btn-group">
                        <a href="{{route('decline-receipt-posting', $receipt->slug)}}" class="btn btn-danger btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"  > <i class="ti-close mr-2"></i> Decline Receipt </a>
                        <a href="{{route('receipt-posting-post', $receipt->slug)}}" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20" ><i class="icofont icofont-paper-plane mr-2"></i> Post Receipt</a>
                        <a href="{{url()->previous()}}" class="btn btn-secondary btn-mini waves-effect m-b-10 btn-sm waves-light"><i class="ti-arrow-left mr-2"></i> Back</a>
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
