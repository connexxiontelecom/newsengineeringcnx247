@extends('layouts.app')

@section('title')
    New Journal Entry
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/component.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    @if(session()->has('success'))
                        <div class="alert alert-success border-success" style="padding:5px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            <strong>Success!</strong> {!! session('success') !!}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-warning border-warning" style="padding:5px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            {!! session('error') !!}
                        </div>
                    @endif
                    <h5 class="sub-title">New Journal Entry</h5>
                    <form action="{{route('new-journal-entry')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="date" placeholder="Date" class="form-control" name="issue_date">
                                            @error('issue_date')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Entry #</label>
                                            <input type="text"  name="entry_no" value="JV{{rand(10,100)}}" readonly placeholder="Entry #" class="form-control">
                                            @error('entry_no')
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
                                            <th>Account</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Narration</th>
                                            <th>Name</th>
                                        </tr>
                                        </thead>
                                        <tbody id="products">
                                                <tr class="item">
                                                <td>
                                                    <div class="form-group">
                                                        <select name="account[]" class="text-white  account js-example-basic-single select-account form-control">
                                                            <option disabled selected>Select account</option>
                                                            @foreach($accounts as $account)
                                                                    <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - {{$account->glcode ?? ''}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('account')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="0.01" placeholder="Debit Amount" class="form-control debit-amount" value="0"  name="debit_amount[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="0.01" placeholder="Credit Amount" class="form-control credit-amount" value="0"  name="credit_amount[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="narration[]" class="form-control" placeholder="Narration">
                                                </td>
                                                <td>
                                                    <input type="text" name="name[]" class="form-control" placeholder="Name">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <button class="btn btn-mini btn-primary add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <table class="table  invoice-detail-table">
                                    <tr>
                                        <td colspan="3" class="text-right"><strong style="font-size:14px; text-transform:uppercase; text-align: right;">Total:</strong></td>
                                        <td class="text-right drTotal">0.00

                                        </td>
                                        <td class="text-center crTotal"> 00

                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <input type="hidden" id="drTotalHidden">
                                    <input type="hidden" id="crTotalHidden">
                                    <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary save-entry btn-mini"><i class="ti-check mr-2"> Save</i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
    <script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
    <script>
        var debitTotal = 0;
        var creditTotal = 0;
        $(document).ready(function(){
            $(".select-account").select2({
                placeholder: "Select account"
            });
            //updateStatus();
            var grand_total = 0;
            var invoice_total = 0;

            $('#creditTotal').text(creditTotal);
            $('#debitTotal').text(debitTotal);
            $(document).on('click', '.add-line', function(e){
                e.preventDefault();
                var new_selection = $('.item').first().clone();
                $('#products').append(new_selection);

                $(".select-account").select2({
                    placeholder: "Select account"
                });
                $(".select-account").last().next().next().remove();
            });

            //Remove line
            $(document).on('click', '.remove-line', function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
                calculateTotals();
            });
            $("body").on('focusout', '.debit-amount', function(e) {
                var sum = 0;
                $(this).closest('tr').find('.credit-amount').val(0);
                sumDebit();
                sumCredit();
            });
            $("body").on('focusout', '.credit-amount', function(e) {
                var sum = 0;
                $(this).closest('tr').find('.debit-amount').val(0);
                sumDebit();
                sumCredit();
            });

        });
        function updateStatus(debit, credit){
            if(debit != credit && debit <= 0 && credit <= 0){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }

        function sumDebit(){
            var sum = 0;
            $(".debit-amount").each(function(){
                sum += +$(this).val();
            });
            $(".drTotal").text(sum.toLocaleString());
            $('#drTotalHidden').val(sum);
            if($('#drTotalHidden').val() != $('#crTotalHidden').val()){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }
        function sumCredit(){
            var sum = 0;
            $(".credit-amount").each(function(){
                sum += +$(this).val();
            });
            $('#crTotalHidden').val(sum);
            $(".crTotal").text(sum.toLocaleString());
            if($('#drTotalHidden').val() != $('#crTotalHidden').val()){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }

    </script>
@endsection
