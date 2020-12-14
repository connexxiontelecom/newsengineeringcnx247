@extends('layouts.app')

@section('title')
    {{$product->product_name ?? ''}}
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h4 class="sub-title">Product Details</h4>
                <div class="btn-group d-flex justify-content-end">
                    <a href="{{route('add-new-product')}}" class="btn btn-mini btn-primary"><i class="ti-plus"></i> Add New Product</a>
                    <a href="{{route('products')}}" class="btn btn-mini btn-danger"><i class="icofont icofont-shopping-cart"></i> All Products</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Product detail page start -->
        <div class="card product-detail-page">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-5 col-xs-12">
                        <div class="port_details_all_img row">
                            <div class="col-lg-12 m-b-15">
                                <div id="big_banner">
                                    <div class="port_big_img">
                                        <img class="img img-fluid" src="/assets/uploads/featuredImage/{{$product->featured_image}}" alt="{{$product->product_name ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xs-12 product-detail" id="product-detail">
                        <div class="row">
                            <div>
                                <div class="col-lg-12">
                                    <span class="txt-muted d-inline-block">Category: <label for="" class="label label-info">{{$product->category->category ?? ''}}</label> </span>
                                    <span class="f-right">Added By : <label for="" class="label label-success">{{$product->user->first_name ?? ''}} {{$product->user->surname ?? ''}}</label> </span>
                                    
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="pro-desc">{!! $product->product_name ?? ''!!}</h4>
                                </div>
                                <div class="col-lg-12">
                                    <span class="text-primary product-price">{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($product->price, 2)}}</span> 
                                    <hr>
                                    {!! $product->product_description ?? ''!!}
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-group d-flex justify-content-end">
                                        <!-- <a href="route('delete-product', $product->slug"> <i class="text-danger ti-trash mr-2"></i> </a> -->
                                        <a href="{{route('edit-product', $product->slug)}}"> <i class="text-warning ti-pencil mr-2"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')

@endsection
