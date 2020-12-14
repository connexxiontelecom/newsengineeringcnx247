@extends('layouts.app')

@section('title')
    Our Pricing
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
   <div class="row">
       <div class="col-md-12">
           <div class="card">
            <div class="card-block">
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                <div class="col-lg-12 col-xl-12 col-md-12">
                    <div class="sub-title">Our Pricing</div>
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Monthly</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Quarterly</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#messages3" role="tab">Annually</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <!-- Tab panes --> 
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="home3" role="tabpanel">
                            <div class="row">
                                @foreach ($plans as $plan)
                                    @if($plan->duration <= 30 )
                                        <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                                            <div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
                                                <div class="card-body">
                                                    <h4 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}
                                                        @if ($plan->id == Auth::user()->tenant->plan_id)
                                                            <label for="" class="label label-danger">Current plan</label>
                                                        @endif
                                                    </h4>
                                                    <div class="d-flex mb-4">
                                                        <span class="h5 mb-0 mt-0">{{$plan->currency->symbol}}</span>
                                                        <span class="price h5 mb-0">{{number_format($plan->price,2)}}</span>
                                                        <span class="h5 align-self-end mb-1">/mo</span>
                                                    </div>
                
                                                    <p class="text-center text-muted">
                                                        {{$plan->description}}
                                                    </p>
                                                    <hr/>
                                                    <ul class=" mb-0 pl-0">
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Calls: {{$plan->calls != 0 ? number_format($plan->calls).' minutes/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Emails: {{$plan->emails != 0 ? number_format($plan->emails).'/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>SMS: {{$plan->sms != 0 ? number_format($plan->sms).'/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Users: {{$plan->team_size != 0 ? number_format($plan->team_size).' users (max)' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>CNXStream: {{$plan->stream != 0 ? number_format($plan->stream).' hours    ' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>CNXDrive: {{$plan->storage != 0 ? number_format($plan->storage).' GB' : '-'}}
                                                        </li>
                                                    </ul>
                                                    <p class="text-center">
                                                        <a href="{{route('renew-membership', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary btn-mini mt-4">Buy Now</a>
                                                    </p>
                                                    <p class="text-center text-muted">
                                                        Duration: {{$plan->duration}} days
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="profile3" role="tabpanel">
                            <div class="row">
                                @foreach ($plans as $plan)
                                    @if($plan->duration > 30 && $plan->duration <= 90)
                                        <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                                            <div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
                                                <div class="card-body">
                                                    <h4 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}
                                                        @if ($plan->id == Auth::user()->tenant->plan_id)
                                                            <label for="" class="label label-danger">Current plan</label>
                                                        @endif
                                                    </h4>
                                                    <div class="d-flex mb-4">
                                                        <span class="h5 mb-0 mt-0">{{$plan->currency->symbol}}</span>
                                                        <span class="price h5 mb-0">{{number_format($plan->price,2)}}</span>
                                                        <span class="h5 align-self-end mb-1">/mo</span>
                                                    </div>
                
                                                    <p class="text-center text-muted">
                                                        {{$plan->description}}
                                                    </p>
                                                    <hr/>
                                                    <ul class=" mb-0 pl-0">
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Calls: {{$plan->calls != 0 ? number_format($plan->calls).' minutes/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Emails: {{$plan->emails != 0 ? number_format($plan->emails).'/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>SMS: {{$plan->sms != 0 ? number_format($plan->sms).'/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Users: {{$plan->team_size != 0 ? number_format($plan->team_size).' users (max)' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>CNXStream: {{$plan->stream != 0 ? number_format($plan->stream).' hours    ' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>CNXDrive: {{$plan->storage != 0 ? number_format($plan->storage).' GB' : '-'}}
                                                        </li>
                                                    </ul>
                                                    <p class="text-center">
                                                        <a href="{{route('renew-membership', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary btn-mini mt-4">Buy Now</a>
                                                    </p>
                                                    <p class="text-center text-muted">
                                                        Duration: {{$plan->duration}} days
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                               @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="messages3" role="tabpanel">
                            <div class="row">
                                @foreach ($plans as $plan)
                                    @if($plan->duration >= 360)
                                        <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                                            <div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
                                                <div class="card-body">
                                                    <h4 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}
                                                        @if ($plan->id == Auth::user()->tenant->plan_id)
                                                            <label for="" class="label label-danger">Current plan</label>
                                                        @endif
                                                    </h4>
                                                    <div class="d-flex mb-4">
                                                        <span class="h5 mb-0 mt-0">{{$plan->currency->symbol}}</span>
                                                        <span class="price h5 mb-0">{{number_format($plan->price,2)}}</span>
                                                        <span class="h5 align-self-end mb-1">/mo</span>
                                                    </div>
                
                                                    <p class="text-center text-muted">
                                                        {{$plan->description}}
                                                    </p>
                                                    <hr/>
                                                    <ul class=" mb-0 pl-0">
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Calls: {{$plan->calls != 0 ? number_format($plan->calls).' minutes/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Emails: {{$plan->emails != 0 ? number_format($plan->emails).'/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>SMS: {{$plan->sms != 0 ? number_format($plan->sms).'/month' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>Users: {{$plan->team_size != 0 ? number_format($plan->team_size).' users (max)' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>CNXStream: {{$plan->stream != 0 ? number_format($plan->stream).' hours    ' : '-'}}
                                                        </li>
                                                        <li class="h6 text-muted mb-0"><span class="text-primary h5 mr-2">
                                                            <i class="uim uim-check-circle"></i></span>CNXDrive: {{$plan->storage != 0 ? number_format($plan->storage).' GB' : '-'}}
                                                        </li>
                                                    </ul>
                                                    <p class="text-center">
                                                        <a href="{{route('renew-membership', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary btn-mini mt-4">Buy Now</a>
                                                    </p>
                                                    <p class="text-center text-muted">
                                                        Duration: {{$plan->duration}} days
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
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
