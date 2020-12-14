@extends('layouts.app')

@section('title')
    Pick-up Points
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
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
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    <button class="btn btn-mini btn-primary float-right mb-3" data-target="#pickUpModal" data-toggle="modal" ><i class="ti-plus mr-2"></i>Add New Pick-up Point</button>
                                    <h5 class="sub-title">Pick-up Points</h5>
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Location</th>
                                                <th>Address</th>
                                                <th>Reg. By</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach ($locations as $location)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td>{{$location->location ?? ''}}</td>
                                                        <td>{{$location->address ?? ''}}</td>
                                                        <td>{{$location->registeredBy->first_name ?? ''}} {{$location->registeredBy->surname ?? ''}}</td>
                                                        <td>{{date('d F, Y', strtotime($location->created_at)) ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" data-location="{{$location->location ?? ''}}" data-id="{{$location->id}}" data-address="{{$location->address ?? ''}}" class="btn btn-mini btn-warning editPickup" data-toggle="modal" data-target="#editPickupModal"><i class="ti-pencil mr-2"></i>Edit</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Location</th>
                                                <th>Address</th>
                                                <th>Reg. By</th>
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
@endsection

@section('dialog-section')
<div class="modal fade" id="pickUpModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="icofont icofont-location-pin text-white"></i> Add New Pick-up Point</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form data-parsley-validate id="pickupForm">

                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" required placeholder="Location" id="pickup_location">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea  id="pickup_address" style="resize: none;" required class="form-control reminder-content" placeholder="Type address here..."></textarea>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <input type="hidden" id="pickupId">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                        <button type="submit" id="pickUpPointBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="ti-check mr-2"></i>  Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editPickupModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="icofont icofont-location-pin text-white"></i> Edit Pick-up Point</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form data-parsley-validate id="editPickupForm">

                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" required placeholder="Location" id="edit_pickup_location">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea  id="edit_pickup_address" style="resize: none;" required class="form-control reminder-content" placeholder="Type address here..."></textarea>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <input type="hidden" id="editPickupId">
                            <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                            <button type="submit" id="editPickUpPointBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="ti-check mr-2"></i>  Save changes</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')
<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

<script src="\assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
<script src="\assets\pages\data-table\js\jszip.min.js"></script>
<script src="\assets\pages\data-table\js\pdfmake.min.js"></script>
<script src="\assets\pages\data-table\js\vfs_fonts.js"></script>
<script src="\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
<script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

<script src="\assets\pages\data-table\js\data-table-custom.js"></script>

<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>

<script>
$(document).ready(function(){

    $('#pickupForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };
                var form_data = new FormData();
                form_data.append('location',$('#pickup_location').val());
                form_data.append('address',$('#pickup_address').val());
                $('#pickUpPointBtn').text('Processing...');
                 axios.post('/logistics/pick-up-point/store',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#pickUpPointBtn').text('Done');
                    $('#pickUpModal').modal('hide');
                    $('#pickup_location').val('');
                    $('#pickup_address').val('');
                    setTimeout(function () {
                        $("#pickUpPointBtn").text("Save");
                        $("#simpletable").load(location.href + " #simpletable");
                    }, 2000);

                })
                .catch(errors=>{
                    var errs = Object.values(errors.response.data.error);
                    $.notify(errs, "error");
                    $('#pickUpPointBtn').text('Error!');
                    setTimeout(function () {
                        $("#pickUpPointBtn").text("Save");
                    }, 2000);
                });
                return false;
        });


        $(document).on('click', '.editPickup', function(e){
            e.preventDefault();
            $('#edit_pickup_location').val($(this).data('location'));
            $('#edit_pickup_address').val($(this).data('address'));
            $('#editPickupId').val($(this).data('id'));
        });

        $('#editPickupForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };
                var form_data = new FormData();
                form_data.append('location',$('#edit_pickup_location').val());
                form_data.append('address',$('#edit_pickup_address').val());
                form_data.append('pickup',$('#editPickupId').val());
                $('#editPickUpPointBtn').text('Processing...');
                axios.post('/logistics/pick-up-point/edit',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#editPickUpPointBtn').text('Done');
                    $('#editPickupModal').modal('hide');
                    $('#edit_pickup_location').val('');
                    $('#edit_pickup_address').val('');
                    setTimeout(function () {
                        $("#editPickUpPointBtn").text("Save");
                        $("#simpletable").load(location.href + " #simpletable");
                    }, 2000);

                })
                .catch(errors=>{
                    var errs = Object.values(errors.response.data.error);
                    $.notify(errs, "error");
                    $('#editPickUpPointBtn').text('Error!');
                    setTimeout(function () {
                        $("#editPickUpPointBtn").text("Save changes");
                    }, 2000);
                });
                return false;
        });

    });
</script>
@endsection
