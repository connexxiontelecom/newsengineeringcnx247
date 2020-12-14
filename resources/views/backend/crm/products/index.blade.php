@extends('layouts.app')

@section('title')
    Products
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
                <h4 class="sub-title">Products</h4>
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
    @foreach ($products as $product)
        <div class="col-xl-4 col-md-6 col-sm-6 col-xs-12">
            <div class="card prod-view">
                <div class="prod-item text-center">
                    <div class="prod-img">
                        <div class="option-hover">
                            <a href="{{route('product-details', $product->slug)}}" class="btn btn-primary btn-icon waves-effect waves-light m-r-15 hvr-bounce-in option-icon">
                                <i class="icofont icofont-eye-alt f-20"></i>
                            </a>
                            <a href="{{route('edit-product', $product->slug)}}" class="btn btn-warning btn-icon waves-effect waves-light m-r-15 hvr-bounce-in option-icon">
                                <i class="ti-pencil f-20"></i>
                            </a>
                        </div>
                        <a href="{{route('product-details', $product->slug)}}" class="hvr-shrink">
                            <img src="/assets/uploads/featuredImage/{{$product->featured_image}}" style="width:380px; height:180px;" class="img-fluid o-hidden" alt="prod1.jpg">
                        </a>
                    </div>
                    <div class="prod-info">
                        <a href="{{route('product-details', $product->slug)}}" class="txt-muted"><h4>{{$product->product_name ?? ''}}</h4></a>
                        <div class="m-b-10">
                            <label class="label label-danger">{{$product->category->category}}</label>
                        </div>
                        <span class="prod-price">{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($product->price, 2)}} 
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')

@endsection
