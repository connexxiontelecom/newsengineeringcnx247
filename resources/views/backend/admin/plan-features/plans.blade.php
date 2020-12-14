@extends('layouts.app')

@section('title')
    Plans & Features
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                @include('backend.admin.common._nav-slab')
            </div>
        </div>

    </div>
</div>
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="card-header">
                        <h5 class="sub-title">Plans & Features</h5>
                        <div class="btn-group float-right">
                            <a href="{{route('new-plans-n-features')}}" class="btn btn-primary btn-mini"> <i class="ti-plus mr-2"></i> Add New Plan</a>
                            <a href="{{route('plans-n-features')}}" class="btn btn-danger btn-mini"> <i class="ti-import mr-2"></i> View Plans</a>
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
                    <div class="row simple-cards users-card">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if (count($plans) > 0)
                                        @foreach ($plans as $plan)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$plan->planName->name}}</td>
                                                <td>{{$plan->duration}} <label for="" class="label label-primary"> days</label></td>
                                                <td>{{$plan->currency->symbol}}{{number_format($plan->price,2)}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{route('edit-plans-n-features',$plan->id)}}"> <i class="ti-pencil text-warning mr-3"></i> </a>
                                                        <a href="{{route('view-plans-n-features', $plan->slug)}}"> <i class="ti-eye text-info mr-3"></i> </a>
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">There're no plans</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection

@section('extra-scripts')

@endsection
