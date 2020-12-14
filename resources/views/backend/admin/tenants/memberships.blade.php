@extends('layouts.app')

@section('title')
    Tenant Memberships
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
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-diamond bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Membership</span>
                <h4>{{number_format($expiringThisMonth)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-yellow f-16 ti-calendar m-r-10"></i>Expiring this month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-diamond bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Membership</span>
                <h4>{{number_format($expired)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-pink f-16 ti-calendar m-r-10"></i>Expired
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-diamond bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Membership</span>
                <h4>3</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-green f-16 ti-calendar m-r-10"></i>Renewal
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-diamond bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Membership</span>
                <h4>2</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-blue f-16 ti-calendar m-r-10"></i>Renewals this week
                    </span>
                </div>
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
                                <div class="card-header">
                                    <h5>Memberships</h5>
                                    <span>A run-down of all tenant subscription.</span>

                                </div>
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
                                                @foreach ($memberships as $membership)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td>{{$membership->tenant->company_name}}</td>
                                                        <td>
                                                            <label for="" class="label label-primary">{{date('d F, Y', strtotime($membership->start_date))}}</label>
                                                        </td>
                                                        <td>
                                                            <label for="" class="label label-danger">{{date('d F, Y', strtotime($membership->end_date))}}</label>
                                                        </td>
                                                        <td>
                                                            <label for="" class="label label-info">{{$membership->planName->name}}</label>
                                                        </td>
                                                        <td>
                                                            <label class="label label-warning">Warning Label</label>
                                                        </td>
                                                        <td>
                                                            @if ($membership->status == 1)
                                                                <label for="" class="badge badge-success">Active</label>
                                                            @else
                                                                <label for="" class="badge badge-danger">Inactive</label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="javascript:void(0);" data-company-name="{{$membership->tenant->company_name}}" data-tenant-id="{{$membership->tenant->tenant_id}}" data-toggle="modal" data-target="#reminderModal" class="mr-2 reminderBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send a reminder to {{$membership->tenant->company_name}}"> <i class="icofont icofont-ui-alarm text-warning"></i> </a>
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#contactModal" class="mr-2 messageBtn" data-tenant-id="{{$membership->tenant->tenant_id}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Message {{$membership->tenant->company_name}}"> <i class="icofont icofont-email text-info"></i> </a>
                                                                <a href="{{route('view-tenant',$membership->tenant->slug)}}" class="mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Learn more"> <i class="icofont icofont-eye-alt text-primary"></i> </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
@endsection

@section('dialog-section')
<div class="modal fade" id="reminderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title"><i class="icofont icofont-ui-alarm text-white"></i> Send Reminder</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-control">
                    <label for="">Subject</label>
                    <input type="text" class="form-control" placeholder="Subject" id="reminder-subject">
                </div>
                <div class="form-control">
                    <label for="">Body</label>
                    <textarea  id="reminder-body" class="form-control content reminder-content" placeholder="Type content here..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="sendReminderId">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                <button type="button" id="sendReminderBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="icofont icofont-paper-plane mr-2"></i>  Send</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="icofont icofont-email text-white"></i> Send an email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-control">
                    <label for="">Subject</label>
                    <input type="text" id="email-subject" class="form-control" placeholder="Subject">
                </div>
                <div class="form-control">
                    <label for="">Body</label>
                    <textarea  id="email-body" class="form-control content email-content" placeholder="Type content here..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="sendTenantEmail">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                <button type="button" id="sendMessageBtn" class="btn btn-primary waves-effect waves-light btn-mini"><i class="icofont icofont-send-mail mr-2"></i>  Send</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
<script src="\assets\pages\data-table\js\data-table-custom.js"></script>

<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>

<script>
    $(document).ready(function(){
        $(document).on('click', '.reminderBtn', function(e){
            e.preventDefault();
            var tenantId = $(this).data('tenant-id');
            $('#sendReminderId').val(tenantId);
        });

        $(document).on('click', '#sendReminderBtn', function(event){
            event.preventDefault();
            var content =  tinymce.get("reminder-body").getContent();
            var subject = $('#reminder-subject').val();
            if(subject == '' || content == ''){
                $.notify("Ooops! Kindly fill subject and content.", "error");
            }else{
                axios.post('/tenant/send-reminder', {content:content, subject:subject, tenantId:$('#sendReminderId').val()})
                .then(response=>{
                    $('#reminderModal').modal('hide');
                    $.notify(response.data.message, "success");
                });
            }
        });
        $(document).on('click', '.messageBtn', function(e){
            e.preventDefault();
            var tenantId = $(this).data('tenant-id');
            $('#sendTenantEmail').val(tenantId);
        });

        $(document).on('click', '#sendMessageBtn', function(event){
            event.preventDefault();
            var content =  tinymce.get("email-body").getContent();
            var subject = $('#email-subject').val();
            if(subject == '' || content == ''){
                $.notify("Ooops! Kindly fill subject and content.", "error");
            }else{
                axios.post('/tenant/email/send', {content:content, subject:subject, tenantId:$('#sendTenantEmail').val()})
                .then(response=>{
                    $('#contactModal').modal('hide');
                    $.notify(response.data.message, "success");
                });
            }
        });

    });
</script>
@endsection
