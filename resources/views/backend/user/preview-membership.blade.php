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
       <div class="col-md-10 offset-md-1">
           <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Preview Plan</h5>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                <form method="post" action="{{route('pay-membership')}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8 col-xl-8 col-md-8">
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
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 mt-4 pt-2">
                            <div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
                                <div class="card-body">
                                    <h4 class="title text-uppercase mb-4">{{$plan->planName->name}}
                                        @if ($plan->id == Auth::user()->tenant->plan_id)
                                            <label for="" class="label label-danger">Current plan</label>
                                            @endif
                                            <label for="" class="label label-primary">Chosen plan</label>
                                    </h4>
                                    <div class="d-flex mb-4">
                                        <span class="h5 mb-0 mt-0">{{$plan->currency->symbol}}</span>
                                        <span class="price h5 mb-0">{{number_format($plan->price,2)}}</span>
                                        <span class="h5 align-self-end mb-1">/mo</span>
                                    </div>

                                    <p class="text-center text-muted">
                                        {{$plan->description}}
                                    </p>
                                    <p class="text-center text-muted">
                                        Duration: {{$plan->duration ?? ''}} days
                                    </p>
                                    <hr/>
                                    <ul class="list-unstyled mb-0 pl-0">
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
                                     <div>
                                         <input type="hidden" name="orderID" value="{{rand(100,999)}}">
                                         <input type="hidden" name="quantity" value="1">
                                          @if($plan->duration > 31 && $plan->duration <= 90)
                                             <input type="hidden" name="amount" value="{{ ($plan->price * 100 * 3)}}">
                                         @elseif($plan->duration > 91 && $plan->duration <= 365)
                                             <input type="hidden" name="amount" value="{{ ($plan->price * 100 * 12)}}">
                                         @else
                                             <input type="hidden" name="amount" value="{{ ($plan->price * 100)}}">
                                         @endif
                                         <input type="hidden" name="currency" value="NGN">
                                         <input type="hidden" id="duration" value="{{$plan->duration}}">
                                         <input type="hidden" id="plan" value="{{$plan->plan_id}}">
                                         <input type="hidden" name="metadata[]" id="metadata">
                                         <input type="hidden" name="email" value="{{Auth::user()->email}}" id="email">
                                         <input type="hidden" name="first_name" value="{{Auth::user()->first_name}}" id="first_name">
                                         <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">

                                     </div>
                                     <button class="btn btn-primary btn-mini" type="submit" id="proceedToPay">Proceed to make Payment</button>
                                    </p>
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
<script>
    $(document).ready(function(){
       $(document).on('click', '#proceedToPay', function(){

            var metadata = $('#metadata').val();
            var email = $('#email').val();
            var duration = $('#duration').val();
            var plan = $('#plan').val();
            var first_name = $('#first_name').val();
            var fid = {
                        'email':email,
                        'duration':duration,
                        'plan':plan,
                        'first_name':first_name
                    };
            $('#metadata').val(JSON.stringify(fid));
       });
    });
</script>
@endsection
