@extends('layouts.app')

@section('title')
    Invoice Details
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
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.procurement.supplier.common._procurement-slab')
    </div>
</div>
    <div class="card" id="purchaseContainer">
        <div class="card-block">
            <div class="row invoive-info">
                <div class="col-md-6 col-sm-6 ">
                    <h6 class="sub-title">Vendor Information</h6>
                    <p class="m-0 m-t-10 text-left"><strong>Vendor Name: </strong>{{$bill->getVendor->company_name ?? 'Vendor Name'}} </p>
                    <p class="m-0 m-t-10 text-left"><strong>Address: </strong>{{$bill->getVendor->company_address ?? 'Address'}} </p>
                    <p class="m-0 text-left"><strong>Email: </strong>{{$bill->getVendor->email_address ?? ''}}</p>
                    <p class="text-left"><strong>Phone: </strong>{{$bill->getVendor->mobile_no ?? 'Phone Number here'}}</p>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <h6 class="sub-title">Bill Detail</h6>
                    <p class="m-0 m-t-10 text-left"><strong>Bill No.: </strong>{{$bill->bill_no <= 10 ? '0000'.$bill->invoice_no : $bill->bill_no}}</p>
                    <p class="m-0 m-t-10 text-left"><strong>Bill Date: </strong>{{date('d F, Y', strtotime($bill->bill_date))}} </p>
                    <p class="m-0 text-left"><strong>Payment Status: </strong>{{$bill->status}}</p>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-hover">
                        <thead>
                        <th>Payment Instruction/Note</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$bill->instruction}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                            <tr class="thead-default">
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Unit Price({{ $bill->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}})</th>
                                <th>Total({{ $bill->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}})</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($items as $item)
                                    <tr class="item">
                                        <td>
                                            {{$item->description ?? '' }}
                                        </td>
                                        <td>
                                            {{$item->quantity }}
                                        </td>
                                        <td>
                                            {{number_format($item->rate,2) ?? '0'}}
                                        </td>
                                        <td>{{number_format($item->amount/$bill->exchange_rate,2)}}</td>
                                    </tr>
                                @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><strong>VAT: </strong>{{ $bill->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}} {{number_format($bill->vat_amount/$bill->exchange_rate,2)}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Sub-total: </strong>{{ $bill->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}} {{number_format(($bill->bill_amount/$bill->exchange_rate) - ($bill->vat_amount/$bill->exchange_rate),2)}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total: </strong>{{ $bill->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}} {{number_format($bill->bill_amount/$bill->exchange_rate,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top:-25px;">
        <div class="card-block">
            <div class="row text-center">
                <div class="col-sm-12 purchase-btn-group text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-mini btn-print-purchase m-b-10 btn-sm waves-effect waves-light m-r-20" type="button" id="printInvoice"><i class="icofont icofont-printer mr-2"></i> Print</button>
												<a href="{{url()->previous()}}" class="btn btn-secondary btn-mini waves-effect m-b-10 btn-sm waves-light"><i class="ti-arrow-left mr-2"></i> Back</a>
												@if ($bill->trash == 0)
													<a href="{{route('decline-bill', $bill->slug)}}" class="btn btn-danger btn-mini waves-effect m-b-10 btn-sm waves-light"><i class="ti-trash mr-2"></i> Decline Bill</a>
												@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
    <script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
    <script src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
    <script src="{{asset('/assets/js/cus/axios-progress.js')}}"></script>
    <script>
        $(document).ready(function(){
            //print without commission
            $(document).on('click', '#printInvoice', function(event){
                $('#purchaseContainer').printThis({
                    header:"<p></p>",
                    footer:"<p></p>",
                });
            });

            //send purchase
            $(document).on('click', '#sendInvoiceViaEmail', function(e){
                $('#sendEmailAddon').text('Processing...');
                axios.post('/send/purchase/email/',{id:$(this).val()})
                    .then(response=>{
                        $('#sendEmailAddon').text('Done!');
                    })
                    .catch(error=>{
                        $('#sendEmailAddon').text('Error!');
                    });
            });
        });
    </script>
@endsection
