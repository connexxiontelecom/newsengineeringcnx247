@extends('layouts.app')

@section('title')
    Opening Balance
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
<link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
<div>
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
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="sub-title">Opening Balance</h5>
                                    <form>
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="date" name="date" placeholder="Date" id="date" class="form-control">
                                            @error('date')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Account Name</label>
                                                <select  name="account_name" id="account_name" class="form-control js-example-basic-single">
                                                    <option disabled selected>Select Account</option>
                                                    @foreach ($accounts as $account)
                                                        <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - {{$account->glcode ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                            @error('account_name')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Transaction Type</label>
                                            <select name="transaction_type" id="transaction_type" class="form-control">
                                                    <option value="1">Debit</option>
                                                    <option value="2">Credit</option>
                                            </select>
                                            @error('transaction_type')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                            <div class="form-group debit">
                                                <label for="">DR</label>
                                                <input type="number" step="0.01" class="form-control" placeholder="Debit" name="debit" id="debit" value="0">
                                                @error('debit')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <div class="form-group credit" style="display: none;">
                                                <label for="">CR</label>
                                                <input type="number" step="0.01" class="form-control" placeholder="Credit" name="credit" id="credit" value="0">
                                                @error('credit')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        <div class="form-group">
                                            <div class="btn-group d-flex justify-content-center">
                                                <a href="javascript:void(0);"  class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                                <button type="button" class="btn btn-mini btn-success saveOpeningBalanceBtn"> <i class="ti-check mr-2"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="sub-title">Opening Balance</h5>
                                    <div class="dt-responsive table-responsive">
                                        <table class="table table-striped table-bordered nowrap portableTables">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Account</th>
                                                    <th>Narration</th>
                                                    <th>Debit({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                                    <th>Credit({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                                    <th>Ref. No</th>
                                                    <th>Date</th>
                                                    <th>Bank</th>
                                                    <th>Posted By</th>
                                                </tr>
                                            </thead>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                <tbody>
                                                    @foreach ($opening_balances as $balance)
                                                        <tr>
                                                            <td>{{$serial++}}</td>
                                                            <td>{{$balance->account ?? ''}} ({{$balance->gcode ?? ''}})</td>
                                                            <td>{{$balance->narration ?? ''}}</td>
                                                            <td>{{number_format($balance->dr_amount) ?? '-'}}</td>
                                                            <td>{{number_format($balance->cr_amount) ?? '-'}}</td>
                                                            <td>{{$balance->ref_no ?? '-'}}</td>
                                                            <td>{{!is_null($balance->transaction_date) ? date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($balance->transaction_date)) : '-' }}</td>
                                                            <td>
                                                                @if ($balance->bank == 1)
                                                                    <label class="label label-primary">Bank</label>
                                                                @else
                                                                    <label class="label label-secondary">Not Bank</label>
                                                                @endif
                                                            </td>
                                                            <td>{{$balance->posted_by ?? ''}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Account</th>
                                                    <th>Narration</th>
                                                    <th>Debit({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                                    <th>Credit({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                                    <th>Ref. No</th>
                                                    <th>Date</th>
                                                    <th>Bank</th>
                                                    <th>Posted By</th>
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

@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
<script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
<script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
<script src="\assets\pages\data-table\js\data-table-custom.js"></script>

<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>


<script>
    $(document).ready(function(){
        $(document).on('change', '#transaction_type', function(e){
            e.preventDefault();
            if($(this).val() == 2){
                $('.debit').hide();
                $('.credit').show();
            }else{
                $('.debit').show();
                $('.credit').hide();
            }
        });

        $(document).on('click', '.saveOpeningBalanceBtn', function(e){
            e.preventDefault();
            if($('#date').val() == ''  || $('#account_name').val() == ''){
                Toastify({
                      text: 'All fields are required.',
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
            }else{
                if($('#transaction_type').val() == 1 && $('#debit').val() <= 0){
                    Toastify({
                      text: 'Opening Balance required',
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                }
                if($('#transaction_type').val() == 2 && $('#credit').val() <= 0){
                    Toastify({
                      text: 'Opening Balance required',
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                }
                $('.saveOpeningBalanceBtn').text('Processing...');
                axios.post('/accounting/opening-balance',
                    {
                        transaction_type:$('#transaction_type').val(),
                        debit:$('#debit').val(),
                        credit:$('#credit').val(),
                        account_name:$('#account_name').val(),
                        date:$('#date').val()
                    }
                )
                .then(response=>{
                    Toastify({
                      text: response.data.message,
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                    $('.saveOpeningBalanceBtn').text("Save");
                    location.reload();
                })
                .catch(err=>{
                    Toastify({
                      text: response.data.message,
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                    $('.saveOpeningBalanceBtn').text("Save");
                });
            }
        });
    });
</script>
@endsection
