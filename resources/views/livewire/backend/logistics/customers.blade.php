<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="mb-2 sub-title">Customers</h5>
                <a href="{{route('logistics-new-customer')}}" class="btn btn-primary btn-mini float-right mb-3"><i class="ti-plus"></i>Add New Customer</a>

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
                                <th>Customer Name</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$customer->full_name ?? ''}}</td>
                                        <td>{{$customer->mobile_no ?? ''}}</td>
                                        <td>{{$customer->email ?? ''}}</td>
                                        <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($customer->created_at))}}</td>
                                        <td>
                                            <a href="" class="btn btn-mini btn-primary"><i class="ti-eye mr-2"></i>Learn more</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                <th>Customer Name</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
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
