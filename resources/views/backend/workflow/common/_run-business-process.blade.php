<div class="row">
    <div class="col-md-12">
        <div class="dropdown-primary dropdown open mt-2 float-right">
            <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light text-uppercase" type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-time mr-2"></i>Run Business Process</button>
            <div class="dropdown-menu text-uppercase" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a class="dropdown-item waves-light waves-effect" href="{{ route('expense-report') }}"><i class="ti-notepad mr-2"></i> Expense Report </a>
                <a class="dropdown-item waves-light waves-effect" href="{{ route('purchase-request') }}"><i class="ti-wallet mr-2"></i> Purchase Request </a>
                <a class="dropdown-item waves-light waves-effect" href="{{ route('general-request') }}"><i class="ti-clipboard mr-2"></i> General Request </a>
                <a class="dropdown-item waves-light waves-effect" href="{{ route('business-trip') }}"><i class="ti-notepad mr-2"></i> Business Trip </a>
                <a class="dropdown-item waves-light waves-effect" href="{{ route('leave-request') }}"><i class="ti-calendar mr-2"></i> Leave Approval </a>
                <a class="dropdown-item waves-light waves-effect" href="{{ route('internal-memo') }}"><i class="ti-pin-alt mr-2"></i> Internal Memo </a>
            </div>
        </div>
    </div>
</div>
