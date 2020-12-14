<div>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-diamond bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Requisition</span>
                    <h6>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($overall)}}</h6>
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
                    <i class="icofont icofont-diamond bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Requisition</span>
                    <h6>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($thisYear)}}</h6>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-pink f-16 ti-calendar m-r-10"></i>This Year
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-diamond bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Requisition</span>
                    <h6>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($lastMonth)}}</h6>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-green f-16 ti-calendar m-r-10"></i>Last Month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-diamond bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">Requisition</span>
                    <h6>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($thisMonth)}}</h6>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 ti-calendar m-r-10"></i>This Month
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
