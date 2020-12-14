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
                <h4 class="sub-title">Add New Product</h4>
                <div class="btn-group d-flex justify-content-end">
                    <a href="{{route('new-client')}}" class="btn btn-mini btn-primary"><i class="ti-plus"></i> Add New Product</a>
                    <a href="{{route('products')}}" class="btn btn-mini btn-danger"><i class="icofont icofont-shopping-cart"></i> All Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <form action="{{route('add-new-product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="exist" value="{{$exist}}"/>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                               <div class="form-group">
                                   <label for="">Product Name</label>
                                   <input type="text" name="product_name" placeholder="Product Name" class="form-control" value="{{old('product_name')}}">
                                   @error('product_name')
                                       <i class="text-danger mt-2">{{$message}}</i>
                                   @enderror
                               </div>
                               <div class="form-group">
                                   <label for="">Product Description</label>
                                   <textarea name="product_description" class="form-control content" placeholder="Product Description">{{old('product_description')}}</textarea>
                                   @error('product_description')
                                       <i class="text-danger mt-2">{{$message}}</i>
                                   @enderror
                               </div>
                               <div class="form-group">
                                   <label for="">Featured Image</label>
                                   <input type="file" name="featured_image" class="form-control-file">
                                   @error('featured_image')
                                       <i class="text-danger mt-2">{{$message}}</i>
                                   @enderror
                               </div>
                               <div class="form-group">
                                   <label for="">Price</label>
                                   <input type="number" placeholder="Price" name="price" class="form-control">
                                   @error('price')
                                       <i class="text-danger mt-2">{{$message}}</i>
                                   @enderror
                               </div>
                               @if($exist == 'yes')
                                <div class="form-group">
                                    <label for="">GL Code (Account)</label>
                                    <select name="account" class="form-control">
                                        <option selected disabled>Select account</option>
                                        @foreach($charts as $chart)
                                            <option value="{{$chart->glcode}}">{{$chart->account_name  ?? '-'}} - ({{$chart->glcode ?? ''}})</option>
                                        @endforeach
                                    </select>
                                    @error('account')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                               @endif
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Category</h4>
                                        @foreach ($categories as $cat)
                                            <div class="form-group">
                                                <label>
                                                    <input type="radio" name="product_category" value="{{$cat->id}}">
                                                    <i class="helper"></i>{{$cat->category}}
                                                </label>
                                            </div>
                                            
                                        @endforeach
                                        @error('product_category')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-mini" type="submit"><i class="ti-save-alt"></i> Save</button>
                                    <a class="btn btn-secondary btn-mini" href="{{url()->previous()}}"><i class="ti-arrow-left"></i> Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
@endsection
