@extends('layouts.frontend-layout')

@section('title')
    My Account
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
                            <p class="text-muted mb-0">
                                {!! Auth::user()->tagline !!}
                            </p>
                        </div>

                        <div class="border-bottom pb-4">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <h5>Contact Person :</h5>
                                    <div class="mt-4">
                                        <div class="media align-items-center">
                                            <i data-feather="mail" class="fea icon-ex-md text-muted mr-3"></i>
                                            <div class="media-body">
                                                <h6 class="text-primary mb-0">Email :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{Auth::user()->email_address ?? ''}}</a>
                                            </div>
                                        </div>
                                        <div class="media align-items-center mt-3">
                                            <i data-feather="phone" class="fea icon-ex-md text-muted mr-3"></i>
                                            <div class="media-body">
                                                <h6 class="text-primary mb-0">Phone :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{Auth::user()->email_address ?? ''}}</a>
                                            </div>
                                        </div>
                                        <div class="media align-items-center mt-3">
                                            <i data-feather="briefcase" class="fea icon-ex-md text-muted mr-3"></i>
                                            <div class="media-body">
                                                <h6 class="text-primary mb-0">Position :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{Auth::user()->position ?? ''}}</a>
                                            </div>
                                        </div>
                                        <h5>More About {{Auth::user()->company_name ?? ''}} :</h5>
                                        <div class="media align-items-center mt-3">
                                            <i data-feather="globe" class="fea icon-ex-md text-muted mr-3"></i>
                                            <div class="media-body">
                                                <h6 class="text-primary mb-0">Website :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{Auth::user()->website ?? ''}}</a>
                                            </div>
                                        </div>
                                        <div class="media align-items-center mt-3">
                                            <i data-feather="calendar" class="fea icon-ex-md text-muted mr-3"></i>
                                            <div class="media-body">
                                                <h6 class="text-primary mb-0">Member since</h6>
                                                <p class="text-muted mb-0">{{date('d F, Y', strtotime(Auth::user()->created_at))}}</p>
                                            </div>
                                        </div>
                                        <div class="media align-items-center mt-3">
                                            <i data-feather="map-pin" class="fea icon-ex-md text-muted mr-3"></i>
                                            <div class="media-body">
                                                <h6 class="text-primary mb-0">Address :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{Auth::user()->company_address ?? ''}}</a>
                                            </div>
                                        </div>
                                        <div class="media align-items-center mt-3">
                                            <i data-feather="phone" class="fea icon-ex-md text-muted mr-3"></i>
                                            <div class="media-body">
                                                <h6 class="text-primary mb-0">Phone :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{Auth::user()->company_phone ?? ''}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-md-6 mt-4 pt-2 pt-sm-0">
                                    <h5>Recent Purchase Orders :</h5>
                                    @foreach (Auth::user()->orderSupplier()->orderBy('id', 'DESC')->take(3)->get() as $order)
                                        <div class="media key-feature align-items-center p-3 rounded shadow mt-4">
                                            <img src="images/job/Circleci.svg" class="avatar avatar-ex-sm" alt="">
                                            <div class="media-body content ml-3">
                                                <a href="{{route('my-purchase-orders', $order->slug)}}" class="text-secondary">
                                                    <h4 class="title mb-0">PO Number: {{$order->purchase_order_no}}</h4>
                                                </a>
                                                @if ($order->status == 'in-progress')
                                                    <a href="javascript:void(0);" class="badge badge-warning badge-pill float-right"> {{$order->status}} </a>
                                                @elseif($order->status == 'approved')
                                                    <a href="javascript:void(0);" class="badge badge-primary badge-pill float-right"> {{$order->status}} </a>
                                                @elseif($order->status == 'delivered')
                                                    <a href="javascript:void(0);" class="badge badge-success badge-pill float-right"> {{$order->status}} </a>
                                                @else
                                                    <a href="javascript:void(0);" class="badge badge-danger badge-pill float-right"> {{$order->status}} </a>

                                                @endif
                                                <p class="text-muted mb-0">{{$order->orderedBy->tenant->currency->symbol}}{{number_format($order->total)}}</p>
                                                <p class="text-muted mb-0"><a href="javascript:void(0)" class="text-primary">Requested by: </a> {{$order->orderedBy->first_name ?? ''}} {{$order->orderedBy->surname ?? '' }} <small class="badge badge-pill badge-outline-primary"> From </small> {{$order->orderedBy->tenant->company_name ?? ''}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
