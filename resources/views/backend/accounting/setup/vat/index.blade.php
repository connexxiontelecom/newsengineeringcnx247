@extends('layouts.app')

@section('title')
    VAT Setup
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
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-block">
                            <h5 class="sub-title">Setup VAT</h5>
                                <form >
                                    <div class="form-group">
                                        <label for="">VAT Value</label>
                                        <input type="number" step="0.01" id="vat" name="vat" placeholder="VAT" class="form-control">
                                        @error('vat')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">VAT Account</label>
                                        <select  name="vat_glcode" id="vat_glcode" class="form-control js-example-basic-single">
                                            <option disabled selected>Select Account</option>
                                            @foreach ($accounts as $account)
                                                <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - {{$account->glcode ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        @error('vat_glcode')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <div class="btn-group d-flex justify-content-center">
                                            <a href="javascript:void(0);" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                            <button type="button" class="btn btn-mini btn-success saveVatBtn" > <i class="ti-check mr-2"></i> Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>VAT</h5>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>VAT</th>
                                            <th>GL Code</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @if (!empty($policy))
                                            <tr>
                                                <td>{{$serial++}}</td>
                                                <td>{{$policy->vat ?? ''}}</td>
                                                <td>{{$policy->glcode ?? ''}}</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="edit-policy" data-vat="{{$policy->vat ?? 0}}" data-account="{{$policy->glcode}}"> <i class="ti-pencil text-warning"></i> </a>
                                                </td>
                                            </tr>

                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>VAT</th>
                                            <th>GL Code</th>
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

@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>

<script>
    $(document).ready(function(){
        $(document).on('click', '.saveVatBtn', function(e){
            e.preventDefault();
            if($('#vat').val() == '' || $('#vat_glcode').val() == ''){
                Toastify({
                      text: 'VAT value & Account is required',
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
            }else{
                axios.post('/accounting/vat', {vat:$('#vat').val(), account:$('#vat_glcode').val()})
                .then(response=>{
                    Toastify({
                      text: response.data.message,
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #0AC282, #51AA4C)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                    location.reload();
                })
                .catch(err=>{
                    Toastify({
                      text: "Ooops! Could not set VAT. Try again.",
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                });
            }
        });
        $(document).on('click', '.edit-policy', function(e){
            e.preventDefault();
            var account = $(this).data('account');
            var vat = $(this).data('vat');
            $('#vat').val(vat);
            $('#vat_glcode').val(account);
        });
    });
</script>

@endsection
