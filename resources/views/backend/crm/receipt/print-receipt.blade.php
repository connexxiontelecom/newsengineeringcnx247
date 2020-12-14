@extends('layouts.app')

@section('title')
    Receipt
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
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.crm.common._slab-menu')
                </div>
            </div>
        </div>
    </div>
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
                    <h6 class="m-0">{{$receipt->client->first_name ?? ''}} {{$receipt->client->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$receipt->client->street_1 ?? ''}}, {{$receipt->client->postal_code ?? ''}} {{$receipt->client->city ?? ''}}</p>
                    <p class="m-0">{{$receipt->client->mobile_no ?? ''}}</p>
                    <p><a href="mailto:{{$receipt->client->email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[{{$receipt->client->email ?? ''}}]</a></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                            <tr>
                                <th>Date :</th>
                                <td>{{date('d F, Y', strtotime($receipt->issue_date))}}</td>
                            </tr>
                            <tr>
                                <th>Payment Type: </th>
                                <td>
                                    <span class="label label-warning">
                                        @switch($receipt->payment_type)
                                                @case(1)
                                                     Cash
                                                    @break
                                                @case(2)
                                                     Bank Transfer
                                                    @break
                                                @default
                                                     Cheque
                                            @endswitch
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Ref.<span>#{{$receipt->ref_no}}</span></h6>
                    <h6 class="text-uppercase text-primary">Total :
                        <span>{{ $receipt->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}} {{number_format(($invoiceBalance->sum('total') / $receipt->exchange_rate) ,2) }}</span>
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
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
																@foreach ($invoices as $item)
																		@foreach ($item->getInvoiceDescription as $desc)
																			<tr>
																					<td>
																							<p>{!! $desc->description ?? '' !!}</p>
																					</td>
																					<td>{{ $receipt->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}}{{number_format($item->payment/$receipt->exchange_rate)}}</td>
																			</tr>
																		@endforeach

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
                                    <strong class="text-primary">VAT :</strong>
                                </td>
                                <td>
                                    <hr>
                                    <strong class="text-primary">{{ $receipt->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}}{{number_format($invoiceBalance->sum('tax_value') / $receipt->exchange_rate,2)}}</strong>
                                </td>
                            </tr>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <strong class="text-primary">Paid :</strong>
                                </td>
                                <td>
                                    <hr>
                                    <strong class="text-primary">{{ $receipt->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}}{{number_format($receipt->amount/$receipt->exchange_rate,2)}}</strong>
                                </td>
                            </tr>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <strong class="text-primary">Balance :</strong>
                                </td>
                                <td>
                                    <hr>
                                    <strong class="text-primary">{{ $receipt->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol}} {{number_format(($invoiceBalance->sum('total') / $receipt->exchange_rate) - ($receipt->amount/$receipt->exchange_rate),2) }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h6>Terms And Condition :</h6>
                    <p>{!! Auth::user()->tenant->receipt_terms !!}</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20" value="{{$receipt->id}}" id="sendInvoiceViaEmail"> <i class="icofont icofont-email mr-2"></i> <span id="sendEmailAddon">Send as Email</span> </button>
                        <button type="button" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20" type="button" id="printInvoice"><i class="icofont icofont-printer mr-2"></i> Print</button>
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
<script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
<script src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/axios-progress.js')}}"></script>
<script>
    $(document).ready(function(){
        //print without commission
        $(document).on('click', '#printInvoice', function(event){
            $('#invoiceContainer').printThis({
                header:"<p></p>",
                footer:"<p></p>",
            });
        });

        //send invoice
        $(document).on('click', '#sendInvoiceViaEmail', function(e){
            $('#sendEmailAddon').text('Processing...');
            axios.post('/send/receipt/email/',{id:$(this).val()})
            .then(response=>{
                $('#sendEmailAddon').text('Done!');
                Toastify({
                text: "Receipt sent via mail.",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: 'right', // `left`, `center` or `right`
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                }).showToast();

            })
            .catch(error=>{
                $('#sendEmailAddon').text('Error!');
                Toastify({
                text: "Ooops! Something went wrong. Try again.",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: 'right', // `left`, `center` or `right`
                backgroundColor: "linear-gradient(to right, #FF0000, #DE0000)",
                }).showToast();
            });
        });
    });
</script>
@endsection
