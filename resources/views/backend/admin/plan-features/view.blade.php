@extends('layouts.app')

@section('title')
    Plans & Features > {{$plan->planName->name ?? ''}}
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
                        <h5 class="sub-title">{{$plan->planName->name}}</h5>
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
                        <div class="col-sm-12 col-xl-6">
                            <h4 class="sub-title">Details</h4>
                            <p class="text-muted">
                                {{$plan->description}}
                            </p>
                            <dl class="dl-horizontal row">
                                <dt class="col-sm-3">Plan Name</dt>
                                <dd class="col-sm-9"> <label for="" class="label label-primary">{{$plan->planName->name ?? ''}}</label></dd>
                                <dt class="col-sm-3">Price</dt>
                                <dd class="col-sm-9"><label for="" class="label label-primary">{{$plan->currency->symbol}}{{number_format($plan->price,2)}}</label></dd>
                                <dt class="col-sm-3">Duration</dt>
                                <dd class="col-sm-9"><label for="" class="label label-primary">{{$plan->duration}} days</label></dd>
                            </dl>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <h4 class="sub-title">Modules for this plan</h4>
                            <ul>
                                @if (count($modules) > 0)
                                    @foreach ($modules as $module)
                                    <li class="mb-3">
                                        <i class="icofont icofont-hand-right text-info"></i> {{$module->module_name ?? ''}}
                                    </li>
                                @endforeach
                                @else
                                    <li>
                                        There're no modules assigned to this plan ({{$plan->planName->name}})
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection

@section('extra-scripts')

@endsection
