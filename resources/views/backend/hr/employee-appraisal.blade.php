@extends('layouts.app')

@section('title')
    Employee Appraisal
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('livewire.backend.hr.common._slab-menu')
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Employee Appraisal</h5>
                <button class="btn btn-mini btn-primary float-right mb-3" data-toggle="modal" data-target="#appraisalModal"><i class="ti-plus mr-2"></i> Start New Appraisal</button>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Appraisal Period</th>
                            <th>Supervisor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach($appraisals as $appraisal)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>
                                        <a href="{{route('view-profile', $appraisal->takenBy->url)}}">
                                            <img src="/assets/images/avatars/thumbnails/{{$appraisal->takenBy->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$appraisal->takenBy->surname ?? ''}}">
                                            {{$appraisal->takenBy->first_name ?? ''}} {{$appraisal->takenBy->surname ?? ''}}
                                            @if($appraisal->employee_status == 0)
                                            <sup class="badge badge-warning badge-top-right text-white ml-3">in-progress</sup>
                                            @else
                                                <sup class="badge badge-success badge-top-right ml-3">Done</sup>

                                            @endif
                                        </a>

                                    </td>
                                    <td>
                                        {{date('M, Y', strtotime($appraisal->start_date))}} <label class="badge badge-info">to</label>
                                        {{date( 'M, Y', strtotime($appraisal->end_date))}}
                                    </td>
                                    </label>
                                    <td>
                                        <a href="{{route('view-profile', $appraisal->supervisedBy->url)}}">
                                            <img src="/assets/images/avatars/thumbnails/{{$appraisal->supervisedBy->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$appraisal->supervisedBy->surname ?? ''}}">
                                            {{$appraisal->supervisedBy->first_name ?? ''}} {{$appraisal->supervisedBy->surname ?? ''}}
                                            @if($appraisal->supervisor_status == 0)
                                            <sup class="badge badge-warning badge-top-right text-white ml-3">in-progress</sup>
                                            @else
                                                <sup class="badge badge-success badge-top-right ml-3">Done</sup>

                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        @if($appraisal->appraisal_status == 0)
                                            <label class="label label-warning">Pending</label>
                                        @else
                                            <label class="label label-success">Completed</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($appraisal->appraisal_status == 0)
                                            <small class="text-danger">No result yet.</small>
                                        @else
                                            <a href="{{route('appraisal-result', $appraisal->appraisal_id)}}" class="btn btn-info btn-mini waves-effect waves-light">
                                                <i class="ti-eye mr-2"></i>View Result
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Appraisal Period</th>
                            <th>Supervisor</th>
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
@endsection
@section('dialog-section')
<div class="modal fade" id="appraisalModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title bg-primary">Start New Appraisal</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-xl-12">
                    <div class="sub-title">Employee Appraisal</div>
                    <ul class="nav nav-tabs md-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#single" role="tab"><i class="ti-user mr-2"></i>Individually</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bulk" role="tab"><i class="ti-layout-grid3 mr-2"></i>Bulk</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="single" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Employee <sup class="text-danger">*</sup></label>
                                    <select id="single_employee" class="form-control">
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Supervisor <sup class="text-danger">*</sup></label>
                                    <select id="single_supervisor" class="form-control">
                                        @foreach($supervisors as $supervisor)
                                            <option value="{{$supervisor->id}}">{{$supervisor->first_name ?? ''}} {{$supervisor->surname ?? ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Start Date <sup class="text-danger">*</sup></label>
                                    <input type="date" id="start_date" class="form-control" placeholder="Start Date">

                                </div>
                                <div class="form-group col-md-6">
                                    <label>End Date <sup class="text-danger">*</sup></label>
                                    <input type="date" id="end_date" class="form-control" placeholder="End Date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="btn-group d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                                        <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" id="submitAppraisal"><i class="ti-clock mr-2"></i>Submit Appraisal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="bulk" role="tabpanel">
                            <form>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Supervisor <sup class="text-danger">*</sup></label>
                                        <select id="bulk_supervisor" class="form-control">
                                            @foreach($supervisors as $supervisor)
                                                <option value="{{$supervisor->user_id}}">{{$supervisor->first_name ?? ''}} {{$supervisor->surname ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Start Date <sup class="text-danger">*</sup></label>
                                        <input type="date" id="start" class="form-control" placeholder="Start Date">

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>End Date <sup class="text-danger">*</sup></label>
                                        <input type="date" id="end" class="form-control" placeholder="End Date">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="" id="selectAll">
                                                <span class="cr">
                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                                <span>Select all employees</span>
                                            </label>
                                        </div>
                                        <hr>
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach($employees as $employee)
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="{{$employee->id}}" name="employees" id="employee_{{$employee->id}}">
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <span>{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="btn-group d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                                            <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" id="submitBulkAppraisal"><i class="ti-clock mr-2"></i>Submit Appraisal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
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
        $('#selectAll').change(function(){
            var checkboxes = $(this).closest('form').find(':checkbox');
            if($(this).prop('checked')) {
            checkboxes.prop('checked', true);
            } else {
            checkboxes.prop('checked', false);
            }
        });

        $(document).on('click', '#submitAppraisal', function(e){
            e.preventDefault();
            var employee = $('#single_employee').val();
            var supervisor = $('#single_supervisor').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var error = 0;
            console.log(employee);
            console.log(supervisor);
            console.log(start_date);
            console.log(end_date);
            if(employee == '' || supervisor == '' || start_date == '' || end_date == ''){
                $.notify("Ooops! Kindly make complete the form.", "error");
                error++;
            }else{
                if(supervisor == employee){
                    $.notify("Ooops! Employee cannot appraisal himself/herself.", "error");
                    error++;
                }else{
                    error = 0;
                }

                if(end_date < start_date){
                    $.notify("Ooops! End date cannot be later than start date.", "error");
                    error++;
                }else{
                    error = 0;
                }


            }

            if(error == 0){
                $.notify("success");
                axios.post('/employee-appraisal', {
                    employee:employee,
                    supervisor:supervisor,
                    start_date:start_date,
                    end_date:end_date
                })
                .then(response=>{
                    $('#appraisalModal').modal('hide');
                })
                .catch(error=>{

                });
            }

        });

        $(document).on('click', '#submitBulkAppraisal', function(e){
            e.preventDefault();

            //var employees = $("input[name=employees").val();
            var employees = []
            $("input:checkbox[name=employees]:checked").each(
                function(){employees.push($(this).val());
                });
            var supervisor = $('#bulk_supervisor').val();
            var start_date = $('#start').val();
            var end_date = $('#end').val();
            var error = 0;

            console.log(employees);
            axios.post('/bulk/employee-appraisal', {
                employees:employees,
                supervisor:supervisor,
                start_date:start_date,
                end_date:end_date
            })
            .then(response=>{
                $.notify(response.data.message,'success');
                $('#appraisalModal').modal('hide');
            })
            .catch(error=>{
                $.notify("Ooops! Something went wrong. Try again.", "error");
            });


        });
    });
</script>
@endsection
