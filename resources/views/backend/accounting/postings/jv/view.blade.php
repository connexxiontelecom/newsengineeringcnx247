@extends('layouts.app')

@section('title')
    Journal Entry Details
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
                    <a href="{{route('journal-entries')}}" class="btn mb-4 btn-primary btn-mini"><i class="ti-layout mr-2"></i>Journal Entries</a>
                    <form action="#" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="sub-title">Journal Entry Details</h5>
                                <div class="form-group">
                                    <strong for="">Account</strong>
                                    <p>{{$entry->account_name ?? ''}} - ({{$entry->glcode ?? ''}})</p>
                                </div>
                                <div class="form-group">
                                    <strong for="">Amount</strong>
                                    <p>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{$entry->dr_amount > 0 ? number_format($entry->dr_amount,2) : number_format($entry->cr_amount,2)}}</p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong for="">Date</strong>
                                            <p>{{!is_null($entry->jv_date) ? date('d F, Y', strtotime($entry->jv_date)) : '-'}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong for="">Reference #</strong>
                                            <p>{{$entry->ref_no ?? '-'}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <strong for="">Name</strong>
                                    <p>{{$entry->name ?? '-'}}</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <strong for="">Narration</strong>
                                    <p>{{$entry->narration ?? '-'}}</p>
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
                                            <h5 class="text-primary total">{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{$entry->dr_amount > 0 ? number_format($entry->dr_amount,2) : number_format($entry->cr_amount,2)}}</h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <a href="{{route('decline-jv', $entry->slug)}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Decline Journal Voucher</a>
                                    <a href="{{route('post-jv', $entry->slug)}}" class="btn btn-primary btn-mini"><i class="ti-check mr-2"> Post Journal Voucher</i></a>
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
        $(document).ready(function(){
            //$('#issueReceiptBtn').attr('disabled', 'disabled');
            var grand_total = 0;
            var invoice_total = 0;
            $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());
            $(".select-invoice").on('change', function() {
                var amount = $(this).data('amount');
                var el = $(this);
                if ($(".select-invoice").is(':checked')){
                    $(this).closest('tr').find('.receive-amount').val(amount);
                    invoice_total += amount;
                    $('.totalSpan').text(parseFloat(invoice_total).toLocaleString());
                    $('#grandTotal').val(invoice_total);
                    //sumPayment(el);
                }else{
                    var sub_amount = $(this).closest('tr').find('.receive-amount').val();
                    // console.log("Checkbox is unchecked."+sub_amount);
                    cur = invoice_total - sub_amount;
                    invoice_total = cur;
                    $('.totalSpan').text(parseFloat(invoice_total).toLocaleString());
                    $('#grandTotal').val(invoice_total);
                    var sub_amount = $(this).closest('tr').find('.receive-amount').val(0);
                    //sumPayment(el);
                }
            });

            //calculate totals
            function calculateTotals(){
                const subTotals = $('.item').map((idx, val)=> calculateSubTotal(val)).get();
                const total = subTotals.reduce((a, v)=> a + Number(v), 0);
                grand_total = total;
                $('.sub-total').text(formatAsCurrency(grand_total));
                $('#subTotal').val(grand_total);
                $('#totalAmount').val(grand_total);
                $('.total').text(formatAsCurrency(total));
                $('.balance').text(formatAsCurrency(total));
            }

            //calculate subtotals
            function calculateSubTotal(row){
                const $row = $(row);
                const inputs = $row.find('input');
                const subtotal = inputs[0].value * inputs[1].value;
                $row.find('td:nth-last-child(2) input[type=text]').val(subtotal);
                return subtotal;
            }
            //format as currency
            function formatAsCurrency(amount){
                return "₦"+Number(amount).toFixed(2);
            }

            $(document).on('blur', '#cash_amount', function(e){
                var cash = $(this).val();
                var total = $('#totalAmount').val() - cash;
                $('.balance').text(formatAsCurrency(total));
            });

            $(document).on('click', '#calculatePayment', function(e){
                e.preventDefault();
                calculatePayment();
            });
        });

        function calculatePayment(){
            var total = 0;
            $('tr .item').each (function() {
                total = eval($(this).find('.receive-amount').val());
                console.log(total);
            });
        }
        /*function sumPayment(el){
            var total = 0;
            el.closest('tr').each (function() {
                total = eval($(this).find('.receive-amount').val()) + eval(total);
                console.log(total);
            });
        }*/
    </script>
@endsection
