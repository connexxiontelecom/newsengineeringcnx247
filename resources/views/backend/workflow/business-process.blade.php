@extends('layouts.app')

@section('title')
    Business Process
@endsection

@section('extra-styles')
<link rel="stylesheet" href="{{asset('assets/css/cus/parsley.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/cus/progressBar.css')}}">
@endsection

@section('content')

   <div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        @include('livewire.backend.workflow.common._workflow-slab')
    </div>
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
                                    <h5 class="sub-title">Business Process</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-mini btn-primary float-right mb-3 mt-1" data-target="#businessProcessModal" data-toggle="modal" type="button"><i class="ti-plus mr-2"></i>Add New Business Process</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-block accordion-block">
                                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="accordion-panel">
                                                        <div class="accordion-heading" role="tab" id="headingExpense">
                                                            <h3 class="card-title accordion-title">
                                                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseExpense" aria-expanded="true" aria-controls="collapseExpense">
                                                                Expense Report
                                                            </a>
                                                        </h3>
                                                        </div>
                                                        <div id="collapseExpense" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingExpense">
                                                            <div class="accordion-content accordion-desc">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <th>#</th>
                                                                        <th>Approver</th>
                                                                        <th>Department</th>
                                                                        <th>Set By</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </thead>
                                                                    @php
                                                                        $n = 1;
                                                                    @endphp
                                                                    @foreach ($approvers as $item)
                                                                        @if ($item->request_type == 'expense-report')
                                                                            <tr>
                                                                                <td>{{$n++}}</td>
                                                                                <td>{{$item->processor->first_name ?? ''}} {{$item->processor->surname ?? ''}}</td>
                                                                                <td>{{$item->department->department_name ?? ''}} </td>
                                                                                <td>{{$item->setBy->first_name ?? ''}} {{$item->setBy->surname ?? ''}} </td>
                                                                                <td>
                                                                                    <label for="" class="label label-warning">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($item->created_at))}}</label>
                                                                                </td>
                                                                                <td>
                                                                                    <a href=""><i class="ti-pencil"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-panel">
                                                        <div class="accordion-heading" role="tab" id="headingPurchase">
                                                            <h3 class="card-title accordion-title">
                                                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapsePurchase" aria-expanded="false" aria-controls="collapsePurchase">
                                                                Purchase Request
                                                            </a>
                                                        </h3>
                                                        </div>
                                                        <div id="collapsePurchase" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPurchase">
                                                            <div class="accordion-content accordion-desc">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <th>#</th>
                                                                        <th>Approver</th>
                                                                        <th>Department</th>
                                                                        <th>Set By</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </thead>
                                                                    @php
                                                                        $n = 1;
                                                                    @endphp
                                                                    @foreach ($approvers as $item)
                                                                        @if ($item->request_type == 'purchase-request')
                                                                            <tr>
                                                                                <td>{{$n++}}</td>
                                                                                <td>{{$item->processor->first_name ?? ''}} {{$item->processor->surname ?? ''}}</td>
                                                                                <td>{{$item->department->department_name ?? ''}} </td>
                                                                                <td>{{$item->setBy->first_name ?? ''}} {{$item->setBy->surname ?? ''}} </td>
                                                                                <td>
                                                                                    <label for="" class="label label-warning">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($item->created_at))}}</label>
                                                                                </td>
                                                                                <td>
                                                                                    <a href=""><i class="ti-pencil"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-panel">
                                                        <div class=" accordion-heading" role="tab" id="headingGeneral">
                                                            <h3 class="card-title accordion-title">
                                                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseGeneral" aria-expanded="false" aria-controls="collapseGeneral">
                                                                General Request
                                                            </a>
                                                        </h3>
                                                        </div>
                                                        <div id="collapseGeneral" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGeneral">
                                                            <div class="accordion-content accordion-desc">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <th>#</th>
                                                                        <th>Approver</th>
                                                                        <th>Department</th>
                                                                        <th>Set By</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </thead>
                                                                    @php
                                                                        $n = 1;
                                                                    @endphp
                                                                    @foreach ($approvers as $item)
                                                                        @if ($item->request_type == 'general-request')
                                                                            <tr>
                                                                                <td>{{$n++}}</td>
                                                                                <td>{{$item->processor->first_name ?? ''}} {{$item->processor->surname ?? ''}}</td>
                                                                                <td>{{$item->department->department_name ?? ''}} </td>
                                                                                <td>{{$item->setBy->first_name ?? ''}} {{$item->setBy->surname ?? ''}} </td>
                                                                                <td>
                                                                                    <label for="" class="label label-warning">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($item->created_at))}}</label>
                                                                                </td>
                                                                                <td>
                                                                                    <a href=""><i class="ti-pencil"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-panel">
                                                        <div class=" accordion-heading" role="tab" id="headingBusiness">
                                                            <h3 class="card-title accordion-title">
                                                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseBusiness" aria-expanded="false" aria-controls="collapseBusiness">
                                                                Business Trip
                                                            </a>
                                                        </h3>
                                                        </div>
                                                        <div id="collapseBusiness" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingBusiness">
                                                            <div class="accordion-content accordion-desc">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <th>#</th>
                                                                        <th>Approver</th>
                                                                        <th>Department</th>
                                                                        <th>Set By</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </thead>
                                                                    @php
                                                                        $n = 1;
                                                                    @endphp
                                                                    @foreach ($approvers as $item)
                                                                        @if ($item->request_type == 'business-trip')
                                                                            <tr>
                                                                                <td>{{$n++}}</td>
                                                                                <td>{{$item->processor->first_name ?? ''}} {{$item->processor->surname ?? ''}}</td>
                                                                                <td>{{$item->department->department_name ?? ''}} </td>
                                                                                <td>{{$item->setBy->first_name ?? ''}} {{$item->setBy->surname ?? ''}} </td>
                                                                                <td>
                                                                                    <label for="" class="label label-warning">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($item->created_at))}}</label>
                                                                                </td>
                                                                                <td>
                                                                                    <a href=""><i class="ti-pencil"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-panel">
                                                        <div class=" accordion-heading" role="tab" id="headingLeave">
                                                            <h3 class="card-title accordion-title">
                                                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseLeave" aria-expanded="false" aria-controls="collapseLeave">
                                                                Leave Approval
                                                            </a>
                                                        </h3>
                                                        </div>
                                                        <div id="collapseLeave" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingLeave">
                                                            <div class="accordion-content accordion-desc">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <th>#</th>
                                                                        <th>Approver</th>
                                                                        <th>Department</th>
                                                                        <th>Set By</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </thead>
                                                                    @php
                                                                        $n = 1;
                                                                    @endphp
                                                                    @foreach ($approvers as $item)
                                                                        @if ($item->request_type == 'leave-approval')
                                                                            <tr>
                                                                                <td>{{$n++}}</td>
                                                                                <td>{{$item->processor->first_name ?? ''}} {{$item->processor->surname ?? ''}}</td>
                                                                                <td>{{$item->department->department_name ?? ''}} </td>
                                                                                <td>{{$item->setBy->first_name ?? ''}} {{$item->setBy->surname ?? ''}} </td>
                                                                                <td>
                                                                                    <label for="" class="label label-warning">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($item->created_at))}}</label>
                                                                                </td>
                                                                                <td>
                                                                                    <a href=""><i class="ti-pencil"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
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
                </div>
            </div>
        </div>
   </div>
@endsection

@section('dialog-section')
<div class="modal fade" id="businessProcessModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-uppercase">Business Process</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="businessProcessForm"  data-parsley-validate>
                    <div class="form-group">
                        <label for="">Department</label>
                        <select name="department" id="department" class="form-control" required>
                            <option selected disabled>Select department</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->department_name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Processor</label>
                        <select name="processor" id="processor" class="form-control" required>
                            <option selected disabled>Select processor</option>
                            @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Request Type</label>
                        <select name="request_type" id="request_type" class="form-control" required>
                            <option value="expense-report">Expense Report</option>
                            <option value="purchase-request">Purchase Request</option>
                            <option value="general-request">General Request</option>
                            <option value="leave-request">Leave Approval</option>
                            <option value="business-trip">Business Trip</option>
                        </select>
                    </div>
                    <hr>
                    <div class="btn-group d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                        <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light" id="businessProcessBtn"><i class="mr-2 ti-check"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="{{asset('/assets/js/cus/parsley.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/progressBar.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#businessProcessForm').parsley().on('field:validated', function() {

       }).on('form:submit', function() {
           var config = {
                       onUploadProgress: function(progressEvent) {
                       var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                       }
               };
               var form_data = new FormData();
               form_data.append('department',$('#department').val());
               form_data.append('processor',$('#processor').val());
               form_data.append('request_type',$('#request_type').val());
               $('#businessProcessBtn').text('Processing...');
                axios.post('/workflow/business-process',form_data, config)
               .then(response=>{
                   $.notify(response.data.message, 'success');
                   $('#businessProcessBtn').text('Done');
                   setTimeout(function () {
                       $("#businessProcessBtn").text("Save");
                       window.location.reload();
                   }, 2000);

               })
               .catch(error=>{
                   $.notify('Error! Something went wrong.', 'error');
                   $('#businessProcessBtn').text('Ooops...Could not submit report.');
                   setTimeout(function () {
                       $("#businessProcessBtn").text("Save");
                   }, 2000);
               });
               return false;
       });
    });
</script>
@endsection
