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
       @include('frontend.logistics.partials._header-menu')
        <section class="section mt-60">
            <div class="container mt-lg-3">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="border-bottom pb-4">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-6 mt-4">
                                    <h5>Guarantor :</h5>
                                    @foreach (Auth::user()->driverGuarantor as $item)
                                        <div class="mt-4">
                                            @php
                                                $g = 1;
                                            @endphp
                                            <span class="badge badge-pill badge-primary"> {{$g++}} </span>
                                            <div class="media align-items-center">
                                                <i data-feather="user" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Full Name :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->full_name ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="phone" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Mobile No. :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->mobile_no ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="mail" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Email :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->email ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="user" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Relationship :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->guarantorRelationship->name ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="map" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Address :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->address ?? ''}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-6 mt-4">
                                    <h5>Emergency Contact(s) :</h5>
                                    @php
                                        $e = 1;
                                    @endphp
                                    @foreach (Auth::user()->driverEmergencyContact as $item)
                                        <div class="mt-4">
                                            <span class="badge badge-pill badge-danger"> {{$e++}} </span>
                                            <div class="media align-items-center">
                                                <i data-feather="user" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Full Name :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->full_name ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="phone" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Mobile No. :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->mobile_no ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="mail" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Email :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->email ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="user" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Relationship :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->emergencyRelationship->name ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="map" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Address :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->address ?? ''}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-6 mt-4">
                                    <h5>Next of Kin:</h5>
                                    @php
                                        $n = 1;
                                    @endphp
                                    @foreach (Auth::user()->driverNextOfKin as $item)
                                        <div class="mt-4">
                                            <span class="badge badge-pill badge-warning"> {{$n++}} </span>
                                            <div class="media align-items-center">
                                                <i data-feather="user" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Full Name :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->full_name ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="phone" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Mobile No. :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->mobile_no ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="mail" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Email :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->email ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="user" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Relationship :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->emergencyRelationship->name ?? ''}}</a>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-3">
                                                <i data-feather="map" class="fea icon-ex-md text-muted mr-3"></i>
                                                <div class="media-body">
                                                    <h6 class="text-primary mb-0">Address :</h6>
                                                    <a href="javascript:void(0)" class="text-muted">{{$item->address ?? ''}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
@endsection
