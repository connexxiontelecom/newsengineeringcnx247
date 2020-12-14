@extends('layouts.app')

@section('title')
    Tenants
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
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-pie-chart bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Tenants</span>
                <h4>{{number_format($overall)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-yellow f-16 ti-calendar m-r-10"></i>Overall
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-pie-chart bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Tenants</span>
                <h4>{{number_format($lastMonth)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-pink f-16 ti-calendar m-r-10"></i>Last Month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Tenants</span>
                <h4>{{number_format($thisMonth)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-blue f-16 ti-calendar m-r-10"></i>This Month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-pie-chart bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Tenants</span>
                <h4>{{number_format($thisWeek)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-green f-16 ti-calendar m-r-10"></i>This Week
                    </span>
                </div>
            </div>
        </div>
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
                        <div class="col-lg-12 col-md-12">
                            <div class="card-header">
                                <h5 class="card-header-text sub-title">Tenants</h5>
                            </div>
                            <div class="card-block">
                                <div class="col-md-12 ">
                                    <ul class="list-view">
                                        @if (count($tenants) > 0)
                                            @foreach ($tenants as $tenant)
                                                <li>
                                                    <div class="card list-view-media">
                                                        <div class="card-block">
                                                            <div class="media">
                                                                <a class="media-left" href="{{route('view-tenant', $tenant->slug)}}">
                                                                    <img class="img-fluid ml-5 mt-3" src="/assets/images/company-assets/logos/{{!empty($tenant->logo) ? $tenant->logo : 'logo.png'}}" alt="{{!empty($tenant->company_name) ? $tenant->company_name : config('app.name') }}" height="52" width="82">
                                                                </a>
                                                                <div class="media-body">
                                                                    <div class="col-xs-12">
                                                                        <h6 class="d-inline-block">
                                                                            {{$tenant->company_name ?? ''}}</h6>
                                                                        <label class="label label-info">{{$tenant->plan->name ?? ''}}</label>
                                                                        <div class="btn-group float-right">
                                                                            <a href="{{route('view-tenant', $tenant->slug)}}" class="btn btn-mini btn-info"> Learn more </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="f-13 text-muted m-b-15">
                                                                        {{$tenant->industry->industry}}
                                                                    </div>
                                                                    {!! strlen($tenant->description) > 280 ? substr($tenant->description, 0,280).'...' : $tenant->description !!}
                                                                    <div class="m-t-15">
                                                                        <a href="" data-toggle="tooltip" title="" class="btn btn-facebook btn-mini waves-effect waves-light" data-original-title="Facebook">
                                                                            <span class="icofont icofont-social-facebook"></span>
                                                                        </a>
                                                                        <a href="button" data-toggle="tooltip" title="" class="btn btn-twitter btn-mini waves-effect waves-light" data-original-title="Twitter">
                                                                            <span class="icofont icofont-social-twitter"></span>
                                                                        </a>
                                                                        <a href="button" data-toggle="tooltip" title="" class="btn btn-linkedin btn-mini waves-effect waves-light" data-original-title="Linkedin">
                                                                            <span class="icofont icofont-brand-linkedin"></span>
                                                                        </a>
                                                                        <a href="button" data-toggle="tooltip" title="" class="btn btn-dribbble btn-mini waves-effect waves-light" data-original-title="Drible">
                                                                            <span class="icofont icofont-social-dribble"></span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <h5 class="text-center">No records found</h5>
                                        @endif
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            {{$tenants->links()}}
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

@section('extra-scripts')

@endsection
