@extends('layouts.app')

@section('title')
    {{$tenant->company_name ?? ''}}
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
                        <div class="col-lg-12">
                            <!-- tab header start -->
                            <div class="tab-header card">
                                <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#company_info" role="tab">Company Info</a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#transaction" role="tab">Transaction Details</a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tenant-landlord" role="tab">Emails & Reminders</a>
                                        <div class="slide"></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <!-- tab panel personal start -->
                                <div class="tab-pane active" id="company_info" role="tabpanel">
                                    <!-- personal card start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text">About {{$tenant->company_name ?? ''}}</h5>
                                            <a class="media-left" href="{{route('view-tenant', $tenant->slug)}}">
                                                <img class="img-fluid ml-5 mt-3" src="/assets/images/company-assets/logos/{{!empty($tenant->logo) ? $tenant->logo : 'logo.png'}}" alt="{{!empty($tenant->company_name) ? $tenant->company_name : config('app.name') }}" height="52" width="82">
                                            </a>
                                        </div>
                                        <div class="card-block">
                                            <div class="view-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table m-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Company Name</th>
                                                                                    <td>{{$tenant->company_name ?? ''}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Email</th>
                                                                                    <td>{{$tenant->email ?? ''}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Date Registered</th>
                                                                                    <td>{{date('d F, Y', strtotime($tenant->created_at))}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Start Date</th>
                                                                                    <td class="text-success">{{date('d F, Y', strtotime($tenant->start))}} @ <small>{{date('h:ia', strtotime($tenant->start))}}</small></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">End Date</th>
                                                                                    <td class="text-danger">{{date('d F, Y', strtotime($tenant->end))}} @ <small>{{date('h:ia', strtotime($tenant->start))}}</small></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Phone</th>
                                                                                    <td>{{$tenant->phone ?? ''}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Team Size</th>
                                                                                    <td>{{number_format($tenant->team_size ?? 0)}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Preferred Language</th>
                                                                                    <td>{{$tenant->lang_id ?? ''}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Industy</th>
                                                                                    <td>{{$tenant->industry->industry ?? ''}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Website</th>
                                                                                    <td><a href="url({{$tenant->website}})" target="_blank">{{$tenant->website}}</a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                            </div>
                                                            <!-- end of row -->
                                                        </div>
                                                        <!-- end of general info -->
                                                    </div>
                                                    <!-- end of col-lg-12 -->
                                                </div>
                                                <!-- end of row -->
                                            </div>
                                            <!-- end of view-info -->
                                            <div class="edit-info" style="display: none;">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                                        <input type="text" class="form-control" placeholder="Full Name">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-radio">
                                                                                        <div class="group-add-on">
                                                                                            <div class="radio radiofill radio-inline">
                                                                                                <label>
                                                                            <input type="radio" name="radio" checked=""><i class="helper"></i> Male
                                                                        </label>
                                                                                            </div>
                                                                                            <div class="radio radiofill radio-inline">
                                                                                                <label>
                                                                            <input type="radio" name="radio"><i class="helper"></i> Female
                                                                        </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <input id="dropper-default" class="form-control" type="text" placeholder="Select Your Birth Date">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <select id="hello-single" class="form-control">
                                                                <option value="">---- Marital Status ----</option>
                                                                <option value="married">Married</option>
                                                                <option value="unmarried">Unmarried</option>
                                                            </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                                        <input type="text" class="form-control" placeholder="Address">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                                <div class="col-lg-6">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                                        <input type="text" class="form-control" placeholder="Mobile Number">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i class="icofont icofont-social-twitter"></i></span>
                                                                                        <input type="text" class="form-control" placeholder="Twitter Id">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i class="icofont icofont-social-skype"></i></span>
                                                                                        <input type="email" class="form-control" placeholder="Skype Id">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i class="icofont icofont-earth"></i></span>
                                                                                        <input type="text" class="form-control" placeholder="website">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                            </div>
                                                            <!-- end of row -->
                                                            <div class="text-center">
                                                                <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-text">Description About {{$tenant->company_name ?? ''}}</h5>
                                                </div>
                                                <div class="card-block user-desc">
                                                    <div class="view-desc">
                                                        {!! $tenant->description ?? '' !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="transaction" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text">Transaction Details</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="view-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table m-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Plan/Package</th>
                                                                                    <td><label for="" class="label label-info">{{$tenant->plan->name ?? ''}}</label></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Reference Code</th>
                                                                                    <td>{{$transaction->reference ?? ''}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Tenant ID</th>
                                                                                    <td> <label for="" class="label label-primary">{{$tenant->tenant_id ?? ''}}</label> </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Payment Status</th>
                                                                                    <td class="text-success"> <small class="text-uppercase">{{$transaction->status ?? ''}}</small></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Payment Channel</th>
                                                                                    <td class=""><small class="text-uppercase">{{$transaction->channel ?? ''}}</small></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">BIN</th>
                                                                                    <td class=""><small class="text-uppercase">{{$transaction->bin ?? ''}}</small></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Expire Month</th>
                                                                                    <td class=""><small class="text-uppercase">{{$transaction->exp_month ?? ''}}</small></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Amount Paid</th>
                                                                                    <td>{{number_format(($transaction->amount)/100, 2)}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Currency</th>
                                                                                    <td>{{$transaction->currency ?? ''}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Transaction IP Address</th>
                                                                                    <td> <label for="" class="label label-info">{{$transaction->ip_address ?? ''}}</label> </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Bank</th>
                                                                                    <td>{{$transaction->bank ?? ''}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Card Type</th>
                                                                                    <td> <small class="text-uppercase">{{$transaction->card_type  ?? ''}}</small></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Last 4 Digits</th>
                                                                                    <td class=""><small class="text-uppercase">{{$transaction->last4 ?? ''}}</small></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Expire Year</th>
                                                                                    <td class=""><small class="text-uppercase">{{$transaction->exp_year ?? ''}}</small></td>
                                                                                </tr>
                                                                            </tbody>
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
                                </div>
                                <div class="tab-pane" id="tenant-landlord" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text">Reminders & Emails</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="view-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <div class="row">
                                                                <div class="col-md-12">
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
                                                                        <div class="col-sm-12">
                                                                            <div class="card">
                                                                                <div class="card-block">
                                                                                    <div class="dt-responsive table-responsive">
                                                                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                                            <thead>
                                                                                            <tr>
                                                                                                <th>#</th>
                                                                                                <th>Subject</th>
                                                                                                <th>Content</th>
                                                                                                <th>Type</th>
                                                                                                <th>Date</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @php
                                                                                                    $serial = 1;
                                                                                                @endphp
                                                                                                @if (count($conversations) > 0)
                                                                                                    @foreach ($conversations as $conversation)
                                                                                                        <tr>
                                                                                                            <td>{{$serial++}}</td>
                                                                                                            <td>{{$conversation->subject}}</td>
                                                                                                            <td>{!! strlen($conversation->content) > 100 ? substr($conversation->content,0,100).'...' : $conversation->content !!}</td>
                                                                                                            <td>
                                                                                                                @if ($conversation->type == 1 )
                                                                                                                    <label for="" class="label-danger label">Reminder</label>
                                                                                                                @else
                                                                                                                    <label for="" class="label-primary label">Email</label>
                                                                                                                @endif
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                {{date('d F, Y h:ia', strtotime($conversation->created_at))}}
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <a href="{{route('tenant-landlord-conversation', $conversation->slug)}}"> <i class="ti-eye mr-2 text-info"></i> </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endforeach
                                                                                                @else
                                                                                                        <p class="text-center">No records found.</p>
                                                                                                @endif

                                                                                            </tbody>
                                                                                            <tfoot>
                                                                                            <tr>
                                                                                                <th>#</th>
                                                                                                <th>Subject</th>
                                                                                                <th>Content</th>
                                                                                                <th>Type</th>
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
        </div>
   </div>
@endsection

@section('extra-scripts')

@endsection
