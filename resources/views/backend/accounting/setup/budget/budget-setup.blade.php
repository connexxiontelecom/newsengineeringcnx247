@extends('layouts.app')

@section('title')
    Budget Setup
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                @if (session()->has('success'))
                <div class="alert alert-success background-success mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="icofont icofont-close-line-circled text-white"></i>
                    </button>
                    {!! session()->get('success') !!}
                </div>
            @endif
                <h5 class="sub-title">Budget Setup</h5>
                <button class="btn btn-mini btn-primary float-right mb-3" data-toggle="modal" data-target="#budgetModal"><i class="ti-plus mr-2"></i> New Budget</button>
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Budget Profile</th>
                            <th>Account</th>
                            <th>Amount({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                            <th>Date</th>
                            <th>Created By</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $serial = 1;
                        @endphp
                        @foreach($budgets as $budget)
                            <tr>
                                <td>{{$serial++}}</td>
                                <td>{{$budget->bp_title}}</td>
                                <td>{{$budget->account ?? ''}} - ({{$budget->bcode}})</td>
                                <td>{{number_format($budget->amount)}}</td>
                                <td>{{date('d F, Y', strtotime($budget->created_at))}}</td>
                                <td>
                                    {{$budget->first_name ?? ''}} {{$budget->surname ?? ''}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Budget Profile</th>
                            <th>Account</th>
                            <th>Amount({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                            <th>Date</th>
                            <th>Created By</th>
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
    <div class="modal fade" id="budgetModal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-uppercase">Budget Setup</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="">Budget Profile <sup class="text-danger">*</sup></label>
                            <select type="text" id="budget_profile" class="form-control col-md-12">
                                @foreach($profiles as $profile)
                                    <option value="{{$profile->id}}">{{$profile->budget_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Budget Title <sup class="text-danger">*</sup></label>
                            <input type="text" placeholder="Budget Title" id="budget_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">GL Account <sup class="text-danger">*</sup></label>
                            <select type="text" id="gl_code" class="form-control col-md-12">
                                @foreach($accounts as $account)
                                    <option value="{{$account->glcode}}">{{$account->account_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Amount <sup class="text-danger">*</sup></label>
                            <input type="number" step="0.01" id="amount" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i>Close</button>
                    <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="setupBudgetBtn"> <i class="ti-check mr-2"></i>Submit</button>
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
    <script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#setupBudgetBtn', function(e){
                e.preventDefault();
                var budget_profile = $('#budget_profile').val();
                var budget_title = $('#budget_title').val();
                var glcode = $('#gl_code').val();
                var amount = $('#amount').val();
                if(budget_profile == '' || budget_title == '' || glcode == '' || amount == '' ){
                    $.notify('Ooops! All fields are required.', 'error');
                }else{
                    axios.post('/budget-setup',{
                        budget_profile:budget_profile,
                        budget_title:budget_title,
                        glcode:glcode,
                        amount:amount
                    })
                    .then(response=>{
                        $('#budgetModal').modal('hide');
                        $.notify(response.data.message,'success');
                    })
                    .catch(error=>{
                        $.notify(error.response.data.error,'error');
                    });
                }
            });
        });
    </script>
@endsection
