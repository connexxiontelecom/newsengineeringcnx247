@extends('layouts.app')

@section('title')
    Payment Details
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.procurement.supplier.common._procurement-slab')
    </div>
</div>
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
                    <a href="{{route('payments')}}" class="btn mb-4 btn-primary btn-mini"><i class="ti-layout mr-2"></i>Payments</a>
                    <form action="#" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="sub-title">Payment Details</h5>
                                <div class="form-group">
                                    <strong for="">Bank</strong>
                                    <p>Bank Name</p>
                                </div>
                                <div class="form-group">
                                    <strong for="">Payment Amount</strong>
                                    <p>{{$payment->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol }}{{number_format($payment->amount/$payment->exchange_rate,2)}}</p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong for="">Date</strong>
                                            <p>{{!is_null($payment->date_now) ? date('d F, Y', strtotime($payment->date_now)) : '-'}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong for="">Reference #</strong>
                                            <p>{{$payment->ref_no ?? '-'}}</p>
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
                                            <th>Bill Date</th>
                                            <th>Payment</th>
                                        </tr>
                                        </thead>
                                        <tbody id="products">
                                        @foreach($items as $item)
                                            <tr class="item">
                                                <td>
                                                    <div class="form-group">
                                                        <p><a target="_blank" href="javascript:void(0);">{{$item->description ?? ''}}</a></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>{{!is_null($item->created_at) ? date('d F, Y', strtotime($item->created_at)) : '-'}}</p>
                                                </td>
                                                <td>
                                                    <p>{{$payment->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol }}{{number_format($item->pay_amount/$payment->exchange_rate,2)}}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Memo</label>
                                    <textarea name="memo" id="memo" readonly placeholder="Memo" style="resize: none;" class="form-control">{{$item->memo ?? ''}}</textarea>
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
                                            <h5 class="text-primary total"><span class="totalSpan">{{$payment->getCurrency->symbol ?? Auth::user()->tenant->currency->symbol }}{{number_format($payment->amount/$payment->exchange_rate,2)}}</span></h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" id="grandTotal" name="grandTotal">
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <a href="{{route('decline-payment', $payment->slug)}}" class="btn btn-mini btn-danger"><i class="ti-trash mr-2"></i>Decline</a>
                                    <a href="{{route('post-payment', $payment->slug)}}" class="btn btn-primary btn-mini"><i class="ti-check mr-2"> Post Payment</i></a>
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

@endsection
