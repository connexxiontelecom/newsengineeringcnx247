@extends('layouts.app')

@section('title')
    Project Receipt
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
<div class="container">
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-block">
                        <div class="alert alert-success" role="alert">
                            {!! session()->get('success') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
   @endif
    @if (session()->has('error'))
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-block">
                        <div class="alert alert-warning" role="alert">
                            {!! session()->get('error') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
   @endif
   <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
			@include('backend.project.common._project-detail-slab')
    </div>
</div>
   <form action="{{route('store-project-receipt')}}" method="post" autocomplete="off">
       @csrf
    <div class="card">
        <div class="row invoice-contact">
            <div class="col-md-12">
                <div class="invoice-box row">
                    <div class="col-sm-6">
                        <table class="table table-responsive invoice-table table-borderless">
                            <tbody>
                                <tr>
                                    <td><img src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" class="m-b-10" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="52" width="82"></td>
                                </tr>
                                <tr>
                                    <td>{{ Auth::user()->tenant->company_name ?? 'Company Name here'}}</td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->street_1 ?? 'Street here'}} {{ Auth::user()->tenant->city ?? ''}} {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}</td>
                                </tr>
                                <tr>
                                    <td><a href="mailto:{{Auth::user()->tenant->email ?? ''}}" target="_top"><span class="__cf_email__" data-cfemail="">[ {{Auth::user()->tenant->email ?? 'Email here'}} ]</span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->phone ?? 'Phone Number here'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-responsive invoice-table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="sub-title"><strong>Project Name:</strong> {{$project->post_title ?? ''}}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong  style="text-transform: uppercase;">Start Date:</strong> <label for="" class="label label-primary">{{!is_null($project->start_date) ? date('d F, Y', strtotime($project->start_date)) : '-' }}</label> </td>
                                </tr>
                                <tr>
                                    <td><strong style="text-transform: uppercase;">Due Date:</strong> <label for="" class="label label-danger">{{!is_null($project->end_date) ? date('d F, Y', strtotime($project->end_date)) : '-' }}</label></td>
                                </tr>
                                <tr>
                                    <td><strong  style="text-transform: uppercase;">Created By:</strong> {{$project->user->first_name ?? ''}} {{$project->surname ?? ''}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="card-block">
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6>Receive From:</h6>
                    <p><strong class="m-0">{{$client->company_name}}</strong></p>
                    <p class="m-0 m-t-10">{{$client->street_1 ?? ''}} {{$client->postal_code ?? ''}} {{$client->city ?? ''}}</p>

                    @error('client')
                        <i class="text-danger mt-3 d-flex">{{$message}}</i>
                    @enderror
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Receipt Number <span>#{{$receipt_no}}</span></h6>
                    <h6 class="m-b-20">Amount Due: <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{ number_format(($invoices->sum('total') - $invoices->sum('paid_amout')),2) }}</span></h6>
                    <input type="hidden" value="{{$status}}" name="status">
                    <input type="hidden" name="ref_no" value="{{$project->id}}">
                    <input type="hidden" name="receipt_no" value="{{$receipt_no}}">
                    <input type="hidden" name="client" value="{{$client->id}}">
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="row mt-3">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Payment Date</label>
                                <input type="date" name="payment_date" placeholder="Date" class="form-control">
                                @error('payment_date')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select name="payment_method" class="form-control">
                                    <option value="1">Cash</option>
                                    <option value="2">Bank Transfer</option>
                                    <option value="3">Cheque</option>
                                </select>
                                @error('payment_method')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Reference No.</label>
                                <input type="text" placeholder="Reference No." readonly value="{{$project->id}}" class="form-control" name="reference_no">
                                @error('reference_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Bank</label>
                                <select name="bank" id="bank" class="form-control">
                                    <option selected disabled>Select bank</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{$bank->glcode}}">{{$bank->bank_name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('reference_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Description</th>
                                    <th>Amount  ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                    <th>Payment  ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                </tr>
                            </thead>
                            <tbody id="products">
                                @foreach ($invoices as $invoice)
                                <tr class="item">
                                    <td>
                                        <div class="form-group">
                                            <p>
                                                <a href="javascript:void(0);">Invoice # {{$invoice->invoice_no ?? ''}}</a>
                                                <input type="hidden" name="invoices[]" value="{{$invoice->id}}">
                                                <input type="hidden" name="accounts[]" value="{{$invoice->glcode}}">

                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  name="amount[]" step="0.01" placeholder="Amount" readonly value="{{number_format($invoice->total - $invoice->paid_amount,2)}}">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Payment"  name="payment[]" class="form-control payment autonumber">
                                        @error('payment')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Total :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary"> <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}</span> <span class="total">0.00</span></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <button type="submit" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-control-shuffle"></i> Submit Receipt</button>
                    <a href="{{url()->previous()}}" class="btn btn-danger btn-mini waves-effect m-b-10 btn-sm waves-light">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection
@section('dialog-section')

@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script src="\assets\pages\form-masking\inputmask.js"></script>
<script src="\assets\pages\form-masking\jquery.inputmask.js"></script>
<script src="/assets/pages/form-masking/autoNumeric.js"></script>
<script src="/assets/pages/form-masking/form-mask.js"></script>
<script>
    $(document).ready(function(){
         $(".select-product").select2({
            placeholder: "Select account"
        });
        var grand_total = 0;
        $(document).on('click', '.add-line', function(e){
            e.preventDefault();
            var new_selection = $('.item').first().clone();
            $('#products').append(new_selection);

            $(".select-product").select2({
                placeholder: "Select account"
            });
            $(".select-product").last().next().next().remove();
        });

        //Remove line
        $(document).on('click', '.remove-line', function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
            calculateTotals();
        });

        $('.payment').on('change', function(e){
            e.preventDefault();
						setTotal();
						$(this).val().toLocaleString();
        });

    function setTotal(){
        var sum = 0;
        $(".payment").each(function(){
            sum += +$(this).val().replace(/,/g, '');
        });
            $(".total").text(sum.toLocaleString());
		}

});
</script>
@endsection
