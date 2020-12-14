@extends('layouts.app')

@section('title')
    Vendor Services
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.procurement.supplier.common._procurement-slab')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="card-header">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Service Setup</h5>
                                <form action="{{route('store-vendor-service')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Product/Service Description</label>
                                        <input type="text" name="product" id="product" placeholder="Product/Service Description" class="form-control">
                                        @error('product')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Account</label>
                                        <select name="account" class="form-control select2-selection__rendered js-example-basic-single ">
                                            @foreach($accounts as $account)
                                                <option value="{{$account->glcode}}">{{$account->account_name}} - {{$account->glcode}}</option>
                                            @endforeach
                                        </select>
                                        @error('account')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <hr>
                                    <div class="form-group mt-4">
                                        <input type="hidden" id="serviceId">
                                        <div class="btn-group d-flex justify-content-center">
                                            <a href="{{url()->previous()}}" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                            <button type="submit" class="btn btn-mini btn-success" id="saveBtn"> <i class="ti-check mr-2"></i>
                                                Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Products/Services</h5>
                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service Name</th>
                                            <th>Account</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($services as $service)
                                            <tr>
                                                <td>{{$serial++}}</td>
                                                <td>{{$service->product}}</td>
                                                <td> {{$service->account_name ?? ''}} - ({{$service->glcode}})</td>
                                                <td>{{date('d F, Y', strtotime($service->created_at))}}</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="editService" data-service="{{$service->product}}" data-id="{{$service->id}}"><i class="ti-pencil text-warning"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Service Name</th>
                                            <th>Account</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
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
    <script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>

    <script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>


    <script>
        $(document).ready(function(){
            $(document).on('click', '.editService', function(e){
                e.preventDefault();
                var service = $(this).data('service');
                var id = $(this).data('id');
                $('#product').val(service);
                $('#serviceId').val(id);
                $('#saveBtn').text('Save changes');
            });
        });
    </script>
@endsection
