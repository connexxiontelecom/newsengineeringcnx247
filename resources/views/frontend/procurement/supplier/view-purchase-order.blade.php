@extends('layouts.frontend-layout')

@section('title')
    Purchase Order >
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
       @include('frontend.procurement.partials._header-menu')
        <section class="section mt-60">
            <div class="container mt-lg-3">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="pb-4">
                            <h5>Purchase Order Number: {{$order->purchase_order_no ?? ''}}</h5>
                            <p class="text-muted mb-0"><strong class="badge badge-danger">Instruction:</strong> {!! $order->instruction ?? '' !!}</p>
                            <div class="btn-group float-right mb-5">
                                @if ($order->status == 'in-progress')
                                    <button href="javascript:void(0)" class="btn btn-sm btn-outline-danger mt-2 mr-2 decline">Decline</button>
                                    <button href="javascript:void(0)" class="btn btn-sm btn-outline-primary mt-2 mr-2 approve">Approve</button>
                                @endif
                                @if ($order->status == 'approved')
                                    <button href="javascript:void(0)" class="btn btn-sm btn-outline-success mt-2 mr-2 delivered">Delivered</button>
                                @endif
                            </div>
                        </div>
                        <!-- Invoice Start -->
                        <section class="bg-invoice">
                            <div class="container">
                                <div class="row pt-1 pt-sm-0 justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="card shadow rounded border-0">
                                            <div class="card-body">
                                                <div class="invoice-top border-bottom">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="logo-invoice mb-2">
                                                                <a href="{{route('home')}}">
                                                                    <img class="img-fluid ml-5 mt-3" src="{{asset('/assets/images/company-assets/logos/'.$order->orderedBy->tenant->logo ?? 'logo.png')}}" alt="{{$order->orderedBy->tenant->company_name  ?? 'CNX247 ERP Solution'}}" height="52" width="82">
                                                                </a> <br>
                                                                {{$order->orderedBy->tenant->company_name ?? ''}}<span class="text-primary"></span></div>
                                                            <a href="{{$order->orderedBy->tenant->website ?? 'https://www.cnx247.com'}}" target="_blank" class="text-primary h6"><i data-feather="link" class="fea icon-sm text-muted mr-2"></i>{{$order->orderedBy->tenant->website ?? 'https://www.cnx247.com'}}</a>
                                                        </div>

                                                        <div class="col-md-4 mt-4 mt-sm-0">
                                                            <h5>Address :</h5>
                                                            <dl class="row mb-0">
                                                                <dt class="col-2 text-muted"><i data-feather="map-pin" class="fea icon-sm"></i></dt>
                                                                <dd class="col-10 text-muted">
                                                                    <a href="javascript:void(0);" class="video-play-icon text-muted">
                                                                        <p class="mb-0">{{$order->orderedBy->tenant->street_1 ?? '-'}}</p>
                                                                        <p class="mb-0">{{$order->orderedBy->tenant->city ?? ''}}, {{$order->orderedBy->tenant->postal_code ?? '-'}}</p>
                                                                    </a>
                                                                </dd>

                                                                <dt class="col-2 text-muted"><i data-feather="mail" class="fea icon-sm"></i></dt>
                                                                <dd class="col-10 text-muted">
                                                                    <a href="mailto:contact@example.com" class="text-muted">{{$order->orderedBy->tenant->email ?? '-'}}</a>
                                                                </dd>

                                                                <dt class="col-2 text-muted"><i data-feather="phone" class="fea icon-sm"></i></dt>
                                                                <dd class="col-10 text-muted">
                                                                    <a href="tel:{{$order->orderedBy->tenant->phone ?? '-'}}" class="text-muted">{{$order->orderedBy->tenant->phone ?? '-'}}</a>
                                                                </dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="invoice-middle py-4">
                                                    <h5>Purchase Order Details</h5>
                                                    <div class="row mb-0">
                                                        <div class="col-md-8 order-2 order-md-1">
                                                            <dl class="row">
                                                                <dt class="col-md-3 col-5 font-weight-normal">Purchase Order No. :</dt>
                                                                <dd class="col-md-9 col-7 text-muted">{{$order->purchase_order_no ?? ''}}</dd>

                                                                <dt class="col-md-3 col-5 font-weight-normal">Requested By :</dt>
                                                                <dd class="col-md-9 col-7 text-muted">{{$order->orderedBy->first_name ?? ''}} {{$order->orderedBy->surname ?? ''}}</dd>

                                                                <dt class="col-md-3 col-5 font-weight-normal">Amount :</dt>
                                                                <dd class="col-md-9 col-7 text-muted">
                                                                    <p class="mb-0">{{$order->orderedBy->tenant->currency->symbol ?? ''}}{{number_format($order->total) ?? ''}}</p>
                                                                </dd>

                                                                <dt class="col-md-3 col-5 font-weight-normal">Status :</dt>
                                                                <dd class="col-md-9 col-7 text-muted">{{$order->status ?? ''}}</dd>
                                                            </dl>
                                                        </div>

                                                        <div class="col-md-4 order-md-2 order-1 mt-2 mt-sm-0">
                                                            <dl class="row mb-0">
                                                                <dt class="col-md-4 col-5 font-weight-normal">Latest Delivery Date :</dt>
                                                                <dd class="col-md-8 col-7 text-muted">{{date('d F, Y', strtotime($order->delivery_date))}}</dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="invoice-table pb-4">
                                                    <div class="table-responsive bg-white shadow rounded">
                                                        <table class="table mb-0 table-center invoice-tb">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th scope="col" class="text-left">No.</th>
                                                                    <th scope="col" class="text-left">Item Name</th>
                                                                    <th scope="col">Quantity</th>
                                                                    <th scope="col">Unit Price ({{$order->orderedBy->tenant->currency->symbol}})</th>
                                                                    <th scope="col">Total ({{$order->orderedBy->tenant->currency->symbol}})</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach ($items as $item)
                                                                    <tr>
                                                                        <th scope="row" class="text-left">{{$i++}}</th>
                                                                        <td class="text-left">{{$item->product ?? '-'}}</td>
                                                                        <td>{{$item->quantity ?? '-'}}</td>
                                                                        <td>{{number_format($item->unit_price,2) ?? ''}}</td>
                                                                        <td>{{number_format($item->total,2)}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-5 ml-auto">
                                                            <input type="hidden" name="orderId" id="orderId" value="{{$order->id}}">
                                                            <ul class="list-unstyled h5 font-weight-normal mt-4 mb-0">
                                                                <li class="d-flex justify-content-between">Total :<span>{{$order->orderedBy->tenant->currency->symbol}} {{number_format($order->total,2)}}</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </section>
@endsection

@section('extra-scripts')
    <script>
        $(document).ready(function(){

            $(document).on('click', '.decline', function(e){
                e.preventDefault();
                decline($('#orderId').val());
            });
            $(document).on('click', '.approve', function(e){
                e.preventDefault();
                approve($('#orderId').val());
            });
            $(document).on('click', '.delivered', function(e){
                e.preventDefault();
                delivered($('#orderId').val());
            });
        });

        function approve(order){
            takeAction('approved', order);
        }

        function decline(order){
            takeAction('declined', order);
        }
        function delivered(order){
            takeAction('delivered', order);
        }

        function takeAction(status, id){
            axios.post('/procurement/supplier/take-action',{status:status, order:id})
            .then(res=>{
                $.notify(res.data.message, 'success');
                location.reload();
            });
        }
    </script>
@endsection
