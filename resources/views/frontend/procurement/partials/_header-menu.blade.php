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
                                        <h3 class="title mb-0">{{Auth::user()->company_name ?? ''}}</h3>
                                        <small class="text-muted h6 mr-2">{{Auth::user()->supplierIndustry->industry ?? ''}}</small>
                                        <ul class="list-inline mb-0 mt-3">
                                            <li class="list-inline-item mr-2"><a href="javascript:void(0)" class="text-muted" title="Email"><i data-feather="mail" class="fea icon-sm mr-2"></i>{{Auth::user()->company_email ?? ''}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-5 text-md-right text-center">
                                        <ul class="list-unstyled social-icon social mb-0 mt-4">
                                            <li class="list-inline-item"><a href="{{route('supplier-account')}}" class="rounded" data-toggle="tooltip" data-placement="bottom" title="My Account"><i data-feather="user" class="fea icon-sm fea-social"></i></a></li>
                                            <!--<li class="list-inline-item"><a href="javascript:void(0)" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Messages"><i data-feather="message-circle" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Notifications"><i data-feather="bell" class="fea icon-sm fea-social"></i></a></li> -->
                                            <li class="list-inline-item"><a href="{{route('supplier-settings')}}" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Settings"><i data-feather="tool" class="fea icon-sm fea-social"></i></a></li>
                                            <li class="list-inline-item"><a href="{{route('supplier-purchase-orders')}}" class="rounded" data-toggle="tooltip" data-placement="bottom" title="Purchase Orders"><i data-feather="shopping-cart" class="fea icon-sm fea-social"></i></a></li>
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
