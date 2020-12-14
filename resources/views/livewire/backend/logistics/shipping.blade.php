<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="mb-2 sub-title">Shipping List</h5>
                <a href="{{route('new-shipping')}}" class="btn btn-primary btn-mini float-right mb-3"><i class="ti-plus"></i>Add New Shipping</a>

                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-warning background-warning mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tracking No.</th>
                                <th>Pay. Mode</th>
                                <th>Shipper</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Tracking No.</th>
                                    <th>Pay. Mode</th>
                                    <th>Shipper</th>
                                    <th>Customer</th>
                                    <th>Status</th>
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
