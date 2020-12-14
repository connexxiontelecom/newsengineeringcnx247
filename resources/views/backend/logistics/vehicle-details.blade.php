@extends('layouts.app')

@section('title')
    Vehicle Details > {{$vehicle->owner_name ?? ''}}
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.logistics.common._logistics-slab')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Product detail page start -->
        <div class="card product-detail-page">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-5 col-xs-12">
                        <div class="port_details_all_img row">
                            <div class="col-lg-12 m-b-15">
                                <div id="big_banner">
                                    <div class="port_big_img">
                                        <img class="img img-fluid" src="/assets/uploads/logistics/vehicles/{{$vehicle->image ?? 'vehicle.png'}}" alt="{{$vehicle->owner_name ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xs-12 product-detail" id="product-detail">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button class="btn btn-mini btn-primary float-right mb-2" data-toggle="modal" data-target="#assignVehicleModal"><i class="zmdi zmdi-car-taxi mr-2"></i> Assign To Driver</button>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="col-lg-2"><strong>Owner Name:</strong> </td>
                                            <td class="col-lg-10">{{$vehicle->owner_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Registration No.:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->registration_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Registration Date:</strong></td>
                                            <td class="col-lg-10">{{date('d F, Y', strtotime($vehicle->registration_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Chassis No.:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->chassis_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Engine No.:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->engine_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Make/Model:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->make_model ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Date Added:</strong></td>
                                            <td class="col-lg-10"><label class="label label-primary">{{date('d F, Y', strtotime($vehicle->created_at))}}</label></td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Assigned To:</strong></td>
                                            <td class="col-lg-10"><label class="label label-success">{{$vehicle->assignedTo->first_name ?? ''}} {{$vehicle->assignedTo->surname ?? ''}}</label></td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Added By:</strong></td>
                                            <td class="col-lg-10"><label class="label label-warning">{{$vehicle->addedBy->first_name ?? ''}} {{$vehicle->addedBy->surname ?? ''}}</label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                        <a href="{{route('logistics-vehicles')}}" class="btn btn-mini btn-secondary">Back To Vehicles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Vehicle Assignment Log</h5>

                <table class="table table-strip">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Driver</th>
                            <th>Assigned By</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($logs as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->assignedTo->first_name ?? ''}} {{$item->assignedTo->surname ?? ''}}</td>
                                <td>{{$item->assignedBy->first_name ?? ''}} {{$item->assignedBy->surname ?? ''}}</td>
                                <td>{{date('d F, Y', strtotime($item->created_at))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Driver</th>
                            <th>Assigned By</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')
<div class="modal fade" id="assignVehicleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="zmdi zmdi-car-taxi text-white"></i> Assign Vehicle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form data-parsley-validate id="assignVehicle">

                    <div class="form-group">
                        <label for="">Drivers</label>
                        <select name="assign_driver"  id="assign_driver" class="form-control" required>
                            <option selected disabled>Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{$driver->id}}">{{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="vehicleId" id="vehicleId" value="{{$vehicle->id}}">
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <input type="hidden" id="editPickupId">
                            <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                            <button type="submit" id="assignVehicleBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="ti-check mr-2"></i> Assign Vehicle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script>
    $(document).ready(function(){

    $('#assignVehicle').parsley().on('field:validated', function() {

    }).on('form:submit', function() {
    var config = {
                onUploadProgress: function(progressEvent) {
                var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                }
        };
        var form_data = new FormData();
        form_data.append('driver',$('#assign_driver').val());
        form_data.append('vehicle',$('#vehicleId').val());
        $('#assignVehicleBtn').text('Processing...');
        axios.post('/logistics/vehicle/assign',form_data, config)
        .then(response=>{
            $.notify(response.data.message, 'success');
            $('#assignVehicleBtn').text('Done');
            location.reload();
            $('#assignVehicleModal').modal('hide');
            setTimeout(function () {
                $("#assignVehicleBtn").text("Save");
                $("#simpletable").load(location.href + " #simpletable");
            }, 2000);

        })
        .catch(errors=>{
            var errs = Object.values(errors.response.data.error);
            $.notify(errs, "error");
            $('#assignVehicleBtn').text('Error!');
            setTimeout(function () {
                $("#assignVehicleBtn").text("Save");
            }, 2000);
        });
        return false;
        });
    });
</script>
@endsection
