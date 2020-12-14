@extends('layouts.app')

@section('title')
    Ledger Defaults & Variables
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
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
                    @if (session()->has('error'))
                        <div class="alert alert-warning background-warning mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="sub-title">Ledger Defaults & Variables</div>
                                    <ul class="nav nav-tabs md-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Counters & Sales Tax/VAT</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Default Accounts</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#messages3" role="tab">Miscellaneous</a>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content card-block">
                                        <div class="tab-pane active" id="home3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-6 col-form-label">Next Invoice Number:</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" placeholder="Next Invoice Number" class="form-control" name="next_invoice_number" id="next_invoice_number">
                                                            @error('next_invoice_number')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-6 col-form-label">Next Receipt Number:</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" placeholder="Next Receipt Number" class="form-control" name="next_receipt_number" id="next_receipt_number">
                                                            @error('next_receipt_number')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile3" role="tabpanel">
                                            <form action="{{route('ledger-default-variables')}}" method="post">
                                                @csrf
                                                @foreach ($defaults as $default)
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Account for {{str_replace('-', ' ',ucfirst($default->handle))}}</label>
                                                        <input type="hidden" value="{{$default->handle ?? ''}}" name="handle[]">
                                                        <div class="col-sm-6">
                                                            <select name="account[]" id="account" value="{{$default->dcode ?? ''}}" class="form-control js-example-basic-single">
                                                                @foreach ($accounts as $account)
                                                                    <option value="{{$account->glcode ?? ''}}">{{$account->account_name ?? ''}} - {{$account->glcode ?? ''}}</option>
                                                                    @endforeach
                                                            </select>
                                                            @error('account')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="label-main">
                                                                <label class="label label-warning">{{$default->account_name ?? ''}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 d-flex justify-content-center">
                                                        <div class="btn-group">
                                                            <a href="" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                                            <button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="messages3" role="tabpanel">
                                            <p class="m-0">3. This is Photoshop's version of Lorem IpThis is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean mas Cum sociis natoque penatibus et magnis dis.....</p>
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

@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>

@endsection
