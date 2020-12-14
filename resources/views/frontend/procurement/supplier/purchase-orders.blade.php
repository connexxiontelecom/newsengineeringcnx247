@extends('layouts.frontend-layout')

@section('title')
    Purchase Orders
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
                        <div class="border-bottom pb-4">
                            <h5>Purchase Orders</h5>
                            <p class="text-muted mb-0">All purchase orders</p>
                        </div>
                        <div class="border-bottom pb-4">
                            <div class="row">
                                @foreach (Auth::user()->orderSupplier()->orderBy('id', 'DESC')->get() as $order)
                                    <div class="col-md-6 mt-4">
                                        <div class="media key-feature align-items-center p-3 rounded shadow mt-4">
                                            <img src="images/job/Circleci.svg" class="avatar avatar-ex-sm" alt="">
                                            <div class="media-body content ml-3">
                                                <a href="{{route('my-purchase-orders', $order->slug)}}" class="text-secondary">
                                                    <h4 class="title mb-0">PO Number: {{$order->purchase_order_no}}</h4>
                                                </a>
                                                @if ($order->status == 'in-progress')
                                                    <a href="javascript:void(0);" class="badge badge-warning badge-pill float-right"> {{$order->status}} </a>
                                                @elseif($order->status == 'approved')
                                                    <a href="javascript:void(0);" class="badge badge-success badge-pill float-right"> {{$order->status}} </a>
                                                @else
                                                    <a href="javascript:void(0);" class="badge badge-danger badge-pill float-right"> {{$order->status}} </a>
                                                @endif
                                                <p class="text-muted mb-0">{{$order->orderedBy->tenant->currency->symbol}}{{number_format($order->total)}}</p>
                                                <p class="text-muted mb-0"><a href="javascript:void(0)" class="text-primary">Requested by: </a> {{$order->orderedBy->first_name ?? ''}} {{$order->orderedBy->surname ?? '' }} <small class="badge badge-pill badge-outline-primary"> From </small> {{$order->orderedBy->tenant->company_name ?? ''}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
