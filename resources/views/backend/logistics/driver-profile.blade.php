@extends('layouts.app')

@section('title')
    Driver Profile
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="content social-timeline">
    <div class="">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-xs-12">
                <div class="social-timeline-left" style="top:0px !important;">
                    <div class="card">
                        <div class="social-profile">
                            <img class="img-fluid width-100" src="/assets/uploads/logistics/avatars/medium/{{$driver->avatar ?? 'profile.jpg'}}" alt="">
                            <div class="profile-hvr uploadAvatar">
                                <i class="icofont icofont-ui-edit p-r-10"></i>
                            </div>
                            <input type="file" hidden id="avatarInput">
                            <input type="hidden" id="userId" value="{{$driver->id}}">
                        </div>
                        <div class="card-block social-follower">
                            <h4>{{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</h4>
                            <h5>{{$driver->driver_id}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-8 col-xs-12 ">
                <!-- Nav tabs -->
                <div class="card social-tabs">
                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#about" role="tab">About</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#photos" role="tab">Guarantor(s)</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#friends" role="tab">Log</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="about">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h5 class="sub-title">Personal Information</h5>
                                        <div id="view-info" class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <input type="hidden" name="driver" id="driver" value="{{$driver->id}}"/>
                                                <form>
                                                    <table class="table table-responsive m-b-0">
                                                        <tr>
                                                            <th class="social-label b-none p-t-0">Full Name
                                                            </th>
                                                            <td class="social-user-name b-none p-t-0 text-muted">{{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Gender</th>
                                                            <td class="social-user-name b-none text-muted">{{$driver->gender == 1 ? 'Male' : 'Female'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Email Address</th>
                                                            <td class="social-user-name b-none text-muted">{{$driver->email ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Mobile No.</th>
                                                            <td class="social-user-name b-none text-muted">{{$driver->mobile_no ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Pickup Point.</th>
                                                            <td class="social-user-name b-none text-muted">
                                                                <p><strong>Location: </strong>{{$driver->driverLocation->location ?? ''}}</p>
                                                                <p><strong>Address: </strong>{{$driver->driverLocation->address ?? ''}}</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Member Since</th>
                                                            <td class="social-user-name b-none text-muted">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($driver->created_at))}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none p-b-0">Address</th>
                                                            <td class="social-user-name b-none p-b-0 text-muted">{{$driver->address ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none p-b-0">Vehicle Assigned</th>
                                                            <td class="social-user-name b-none p-b-0 text-muted">
                                                                <a href="">Vehicle Assigend</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <button type="button" class="btn btn-mini btn-primary float-right mb-3" data-toggle="modal" data-target="#emergencyContactModal"><i class="ti-plus"></i> Add New Contact</button>
                                        <h5 class="sub-title">Emergency Contact</h5>
                                        <div id="contact-info" class="row">
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($driver->driverEmergencyContact as $emergency)
                                                <div class="col-lg-6 col-md-6 mt-3" style="border-left:2px solid #FF0000;">
                                                    <label class="badge badge-danger">{{$i++}}</label>
                                                    <table class="table table-responsive m-b-0">
                                                        <tr>
                                                            <th class="social-label b-none p-t-0">
                                                            Full Name</th>
                                                            <td class="social-user-name b-none p-t-0 text-muted">{{$emergency->full_name ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none p-t-0">Mobile No.</th>
                                                            <td class="social-user-name b-none p-t-0 text-muted">{{$emergency->mobile_no ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Email Address</th>
                                                            <td class="social-user-name b-none text-muted"><a href="mailto:{{$emergency->email ?? ''}}" class="__cf_email__" data-cfemail="e195849295a1868c80888dcf828e8c">[{{$emergency->email ?? ''}}]</a></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Relationship</th>
                                                            <td class="social-user-name b-none text-muted"><label class="label label-primary">{{$emergency->emergencyRelationship->name ?? ''}}</label></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none p-b-0">Address</th>
                                                            <td class="social-user-name b-none p-b-0 text-muted">{{$emergency->address ?? ''}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <button type="button" class="btn btn-mini btn-primary float-right mb-3" data-target="#nextOfKinModal" data-toggle="modal"><i class="ti-plus"></i> Add New Contact</button>
                                        <h5 class="sub-title">Next of Kin</h5>
                                        <div id="work-info" class="row">
                                            @php
                                            $k = 1;
                                        @endphp
                                        @foreach($driver->driverNextOfKin as $kin)
                                            <div class="col-lg-6 col-md-6 mt-3" style="border-left:2px solid #2EA44F;">
                                                <label class="badge badge-success">{{$k++}}</label>
                                                <table class="table table-responsive m-b-0">
                                                    <tr>
                                                        <th class="social-label b-none p-t-0">
                                                        Full Name</th>
                                                        <td class="social-user-name b-none p-t-0 text-muted">{{$kin->full_name ?? ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none p-t-0">Mobile No.</th>
                                                        <td class="social-user-name b-none p-t-0 text-muted">{{$kin->mobile_no ?? ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none">Email Address</th>
                                                        <td class="social-user-name b-none text-muted"><a href="mailto:{{$kin->email ?? ''}}" class="__cf_email__" data-cfemail="e195849295a1868c80888dcf828e8c">[{{$emergency->email ?? ''}}]</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none">Relationship</th>
                                                        <td class="social-user-name b-none text-muted"><label class="label label-primary">{{$kin->nextOfKinRelationship->name ?? ''}}</label></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none p-b-0">Address</th>
                                                        <td class="social-user-name b-none p-b-0 text-muted">{{$kin->address ?? ''}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="photos">
                        <div class="card">
                                <div class="card-block">
                                    <button class="btn btn-mini btn-primary float-right mb-3" data-target="#guarantorModal" data-toggle="modal"><i class="ti-plus mr-2"></i> Add New Guarantor</button>
                                    <h5 class="sub-title">Guarantor(s)</h5>
                                    <div class="demo-gallery">
                                        @php
                                        $g = 1;
                                    @endphp
                                    @foreach($driver->driverGuarantor as $guarant)
                                        <div class="col-lg-6 col-md-6 mt-3" style="border-left:2px solid #2EA44F;">
                                            <label class="badge badge-success">{{$g++}}</label>
                                            <table class="table table-responsive m-b-0">
                                                <tr>
                                                    <th class="social-label b-none p-t-0">
                                                    Full Name</th>
                                                    <td class="social-user-name b-none p-t-0 text-muted">{{$guarant->full_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="social-label b-none p-t-0">Mobile No.</th>
                                                    <td class="social-user-name b-none p-t-0 text-muted">{{$guarant->mobile_no ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="social-label b-none">Email Address</th>
                                                    <td class="social-user-name b-none text-muted"><a href="mailto:{{$guarant->email ?? ''}}" class="__cf_email__" data-cfemail="e195849295a1868c80888dcf828e8c">[{{$guarant->email ?? ''}}]</a></td>
                                                </tr>
                                                <tr>
                                                    <th class="social-label b-none">Relationship</th>
                                                    <td class="social-user-name b-none text-muted"><label class="label label-primary">{{$guarant->guarantorRelationship->name ?? ''}}</label></td>
                                                </tr>
                                                <tr>
                                                    <th class="social-label b-none p-b-0">Address</th>
                                                    <td class="social-user-name b-none p-b-0 text-muted">{{$guarant->address ?? ''}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="friends">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Company Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Plan</th>
                                                    <th>Days</th>
                                                    <th>Status</th>
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
                                                    <th>Company Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Plan</th>
                                                    <th>Days</th>
                                                    <th>Status</th>
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
@endsection

@section('dialog-section')
<div class="modal fade" id="emergencyContactModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title">Add New Emergency Contact</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-parsley-validate id="driverEmergencyForm">
                    <div class="form-group">

                        <label>Full Name</label>
                        <input type="text" required name="full_name" id="full_name" placeholder="Full Name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" required name="mobile_no" id="mobile_no" placeholder="Mobile Number" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" required name="email_address" id="email_address" placeholder="Email Address" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Relationship</label>
                        <select class="form-control" required name="relationship" id="relationship">
                            <option disabled selected>Select Relationship</option>
                            @foreach($relationships as $relate)
                                <option value="{{$relate->id}}">{{$relate->name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Office/Residential Address</label>
                        <textarea required placeholder="Office/Residential Address" name="address" id="address" class="form-control" style="resize:none;"></textarea>
                    </div>
                    <hr/>
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-mini btn-primary" id="driverEmergencyBtn"><i class="ti-check mr-2"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nextOfKinModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title">Add New Next of Kin</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-parsley-validate id="driverKinForm">
                    <div class="form-group">

                        <label>Full Name</label>
                        <input type="text" required name="kin_full_name" id="kin_full_name" placeholder="Full Name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" required name="kin_mobile_no" id="kin_mobile_no" placeholder="Mobile Number" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" required name="kin_email_address" id="kin_email_address" placeholder="Email Address" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Relationship</label>
                        <select class="form-control" required name="kin_relationship" id="kin_relationship">
                            <option disabled selected>Select Relationship</option>
                            @foreach($relationships as $relate)
                                <option value="{{$relate->id}}">{{$relate->name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Office/Residential Address</label>
                        <textarea required placeholder="Office/Residential Address" name="kin_address" id="kin_address" class="form-control" style="resize:none;"></textarea>
                    </div>
                    <hr/>
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-mini btn-primary" id="driverKinBtn"><i class="ti-check mr-2"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="guarantorModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title">Add New Guarnator</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-parsley-validate id="guarantorForm">
                    <div class="form-group">

                        <label>Full Name</label>
                        <input type="text" required name="guarantor_full_name" id="guarantor_full_name" placeholder="Full Name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" required name="guarantor_mobile_no" id="guarantor_mobile_no" placeholder="Mobile Number" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" required name="guarantor_email_address" id="guarantor_email_address" placeholder="Email Address" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Relationship</label>
                        <select class="form-control" required name="guarantor_relationship" id="guarantor_relationship">
                            <option disabled selected>Select Relationship</option>
                            @foreach($relationships as $relate)
                                <option value="{{$relate->id}}">{{$relate->name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Office/Residential Address</label>
                        <textarea required placeholder="Office/Residential Address" name="guarantor_address" id="guarantor_address" class="form-control" style="resize:none;"></textarea>
                    </div>
                    <hr/>
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-mini btn-primary" id="driverGuarantorBtn"><i class="ti-check mr-2"></i>Submit</button>
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
<script>
    $(document).ready(function(){
        $('#driverEmergencyForm').parsley().on('field:validated', function() {
            //var ok = $('.parsley-error').length === 0;

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };

                var form_data = new FormData();
                form_data.append('full_name',$('#full_name').val());
                form_data.append('mobile_no',$('#mobile_no').val());
                form_data.append('email_address',$('#email_address').val());
                form_data.append('relationship',$('#relationship').val());
                form_data.append('address',$('#address').val());
                form_data.append('driver',$('#driver').val());
                $('#driverEmergencyBtn').text('Processing...');
                 axios.post('/logistics/driver/emergency-contact',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#driverEmergencyBtn').text('Done');
                    setTimeout(function () {
                        $("#driverEmergencyBtn").text("Save");
                        window.location.reload();
                    }, 2000);

                })
                .catch(errors=>{
                    var errs = Object.values(errors.response.data.error);
                    $.notify(errs, "error");
                    $('#driverEmergencyBtn').text('Error!');
                    setTimeout(function () {
                        $("#driverEmergencyBtn").text("Save");
                    }, 2000);
                });
                return false;
            });
        $('#driverKinForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };

                var form_data = new FormData();
                form_data.append('full_name',$('#kin_full_name').val());
                form_data.append('mobile_no',$('#kin_mobile_no').val());
                form_data.append('email_address',$('#kin_email_address').val());
                form_data.append('relationship',$('#kin_relationship').val());
                form_data.append('address',$('#kin_address').val());
                form_data.append('driver',$('#driver').val());
                $('#driverKinBtn').text('Processing...');
                 axios.post('/logistics/driver/kin-contact',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#driverKinBtn').text('Done');
                    setTimeout(function () {
                        $("#driverKinBtn").text("Save");
                        window.location.reload();
                    }, 2000);

                })
                .catch(errors=>{
                    var errs = Object.values(errors.response.data.error);
                    $.notify(errs, "error");
                    $('#driverKinBtn').text('Error!');
                    setTimeout(function () {
                        $("#driverKinBtn").text("Save");
                    }, 2000);
                });
                return false;
            });
        $('#guarantorForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };

                var form_data = new FormData();
                form_data.append('full_name',$('#guarantor_full_name').val());
                form_data.append('mobile_no',$('#guarantor_mobile_no').val());
                form_data.append('email_address',$('#guarantor_email_address').val());
                form_data.append('relationship',$('#guarantor_relationship').val());
                form_data.append('address',$('#guarantor_address').val());
                form_data.append('driver',$('#driver').val());
                $('#driverGuarantorBtn').text('Processing...');
                 axios.post('/logistics/driver/guarantor',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#driverGuarantorBtn').text('Done');
                    setTimeout(function () {
                        $("#driverGuarantorBtn").text("Save");
                        window.location.reload();
                    }, 2000);

                })
                .catch(errors=>{
                    var errs = Object.values(errors.response.data.error);
                    $.notify(errs, "error");
                    $('#driverGuarantorBtn').text('Error!');
                    setTimeout(function () {
                        $("#driverGuarantorBtn").text("Save");
                    }, 2000);
                });
                return false;
            });

            $(document).on('click', '.uploadAvatar', function(e){
             e.preventDefault();
             $('#avatarInput').click();
             $('#avatarInput').change(function(ev){
                  let file = ev.target.files[0];
                let reader = new FileReader();
                var avatar='';
                reader.onloadend = (file) =>{
                    avatar = reader.result;
                    $('#avatar-preview').attr('src', avatar);
                    axios.post('/logistics/user/avatar',{avatar:avatar, user:$('#userId').val()})
                    .then(response=>{
                        $.notify('Success! Profile image updated.', 'success');
                        location.reload();
                    })
                    .catch(error=>{
                        var errs = Object.values(error.response.data.error);
                        $.notify(errs, "error");
                        });
                    }
                    reader.readAsDataURL(file);

                });
         });
    });
</script>
@endsection
