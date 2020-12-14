<section class="bg-profile d-table w-100 bg-primary" style="background: url('images/account/bg.png') center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card public-profile border-0 rounded shadow" style="z-index: 1;">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 text-md-left text-center">
                                <img src="/frontend/images/procurement/supplier/avatar/avatar.png" class="avatar avatar-large rounded-circle shadow d-block mx-auto" alt="Supplier">
                            </div>

                            <div class="col-lg-10 col-md-9">
                                <div class="row align-items-end">
                                    <div class="col-md-7 text-md-left text-center mt-4 mt-sm-0">
                                        <h3 class="title mb-0">{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}</h3>
                                        <small class="text-muted h6 mr-2">{{Auth::user()->role == 1 ? 'Driver' : '-'}}</small>
                                        <ul class="list-inline mb-0 mt-3">
                                            <li class="list-inline-item mr-2"><a href="javascript:void(0)" class="text-muted" title="Email"><i data-feather="mail" class="fea icon-sm mr-2"></i>{{Auth::user()->email ?? ''}}</a></li>
                                            <li class="list-inline-item mr-2"><a href="javascript:void(0)" class="text-muted" title="Phone"><i data-feather="phone" class="fea icon-sm mr-2"></i>{{Auth::user()->mobile_no ?? ''}}</a></li>
                                        </ul>
                                        <ul class="list-inline mb-0 mt-3">
                                            <li class="list-inline-item mr-2"><a href="javascript:void(0)" class="text-muted" title="Vehicle Assigned">Vehicle Assigned: <span class="badge badge-pill badge-primary"> {{Auth::user()->assignedVehicle->make_model ?? 'No vehicle assigned yet.'}} </span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-5 text-md-right text-center">
                                        <ul class="list-unstyled social-icon social mb-0 mt-4">
                                            <li class="list-inline-item"><a href="{{route('logistics-account')}}" class="rounded" data-toggle="tooltip" data-placement="bottom" title="My Account"><i data-feather="user" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="{{route('supplier-settings')}}" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Settings"><i data-feather="tool" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="{{route('logistics-log')}}" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Check-in or out"><i data-feather="clipboard" class="fea icon-sm fea-social"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
