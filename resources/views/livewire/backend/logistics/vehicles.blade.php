<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="mb-2 sub-title">Vehicles</h5>
                <a href="{{route('logistics-new-vehicle')}}" class="btn btn-primary btn-mini float-right mb-3"><i class="ti-plus"></i>Add New Vehicle</a>

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
                                <th>Reg. No.</th>
                                <th>Reg. Date</th>
                                <th>Chassis No.</th>
                                <th>Engine No.</th>
                                <th>Owner Name</th>
                                <th>Maker/Model</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($vehicles as $vehicle)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$vehicle->registration_no ?? ''}}</td>
                                        <td>{{date('d F, Y', strtotime($vehicle->registration_date))}}</td>
                                        <td>{{$vehicle->chassis_no ?? ''}}</td>
                                        <td>{{$vehicle->engine_no ?? ''}}</td>
                                        <td>{{$vehicle->owner_name ?? ''}}</td>
                                        <td>{{$vehicle->make_model ?? ''}}</td>
                                        <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($vehicle->created_at))}}</td>
                                        <td>
                                            <a class="btn btn-mini btn-primary" href="{{route('logistics-view-vehicle', $vehicle->slug)}}"><i class="ti-eye mr-2"></i> Learn more</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Reg. No.</th>
                                    <th>Reg. Date</th>
                                    <th>Chassis No.</th>
                                    <th>Engine No.</th>
                                    <th>Owner Name</th>
                                    <th>Maker/Model</th>
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
