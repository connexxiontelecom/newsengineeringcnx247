@extends('layouts.app')

@section('title')
    Project Invoice
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
   <form action="{{route('store-project-invoice')}}" method="post" autocomplete="off">
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
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 invoice-client-info">
                            <h6>Client Information :</h6>
                            <label for="">Client <sup class="text-danger">*</sup></label>
                            <select name="client" id="client" class="form-control js-example-basic-single select-client">
                                <option selected disabled>Select client</option>
                                @foreach ($clients as $client)
                                    <option value="{{$client->id}}">{{$client->company_name ?? ''}}</option>
                                @endforeach
                            </select>
                            @error('client')
                                <i class="text-danger mt-3 d-flex">{{$message}}</i>
                            @enderror
                        </div>
                        @if (count($budgets) > 0)
                        <input type="hidden" name="setBudget" value="1">
                        <div class="col-md-12 col-xs-12 mt-4">
                            <label for="">Budget <sup class="text-danger">*</sup></label>
                            <select name="budget" id="budget" class="form-control js-example-basic-single">
                                <option selected disabled>Select budget</option>
                                @foreach ($budgets as $budget)
																<option value="{{$budget->id}}">{{$budget->budget_title ?? ''}} -  Budget: {{Auth::user()->tenant->currency->symbol ?? 'N'}} {{number_format($budget->budget_amount,2) ?? 0}}, Actual: {{Auth::user()->tenant->currency->symbol ?? 'N'}} {{number_format($budget->actual_amount,2) ?? 0}}</option>
                                @endforeach
                            </select>
                            @error('budget')
                                <i class="text-danger mt-3 d-flex">{{$message}}</i>
                            @enderror
                        </div>
                        @else
                        <input type="hidden" name="setBudget" value="0">
                        @endif
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h6 class="m-b-20">Invoice Number <span>#{{$invoice_no}}</span></h6>
                            <div class="form-group">
                                <label for="">Issue Date</label>
                                <input type="date" name="date" placeholder="Date" class="form-control">
                                @error('date')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Due Date</label>
                                <input type="date" name="due_date" class="form-control" placeholder="Due Date">
                                @error('due_date')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <input type="hidden" value="{{$status}}" name="status">
                            <input type="hidden" name="ref_no" value="{{$project->id}}">
                            <input type="hidden" name="invoice_no" value="{{$invoice_no}}">
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 client-account-wrapper mb-3">
                    <div class="form-group">
                        <label for="">Client GL Code <sup class="text-danger">*</sup></label>
                        <select name="client_account" id="client_account" class="form-control js-example-basic-single">
                            <option selected disabled>Select account</option>
                            @foreach ($accounts as $account)
                                <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - ({{$account->glcode ?? ''}})</option>
                            @endforeach
                        </select>
                        @error('client_account')
                            <i class="text-danger mt-4 d-flex">{{$message}}</i>
                        @enderror
                        <input type="hidden" name="setAccount" id="setAccount" value="{{old('setAccount')}}">
												<input type="hidden" value="{{$status}}" name="status">
												<input type="hidden" name="vat" id="vat" value="{{$policy->vat}}">
                        @error('client_account')
                            <i class="text-danger mt-3 d-flex">{{$message}}</i>
                        @enderror
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
                                    <th>Account</th>
                                    <th>Amount ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                    <th class="text-danger">Action</th>
                                </tr>
                            </thead>
                            <tbody id="products">
                                <tr class="item">
                                    <td>
                                        <div class="form-group">
                                            <textarea name="description[]" placeholder="Description" value="{{old('description[]')}}" style="resize: none;" class=" form-control"></textarea>
                                            @error('description')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select name="accounts[]" class="form-control js-example-basic-single select-product" id="accounts">
                                                <option disabled selected>Select account</option>
                                                @foreach ($accounts as $item)
                                                    <option value="{{$item->glcode}}">{{$item->account_name ?? ''}} - ({{$item->glcode}})</option>
                                                @endforeach
                                            </select>
                                            @error('accounts')
                                                <i class="text-danger mt-4 d-flex">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Amount" step="0.01" name="amount[]" class="form-control payment autonumber">
                                        @error('amount')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </td>
                                    <td>
                                        <i class="ti-trash text-danger remove-line" style="cursor: pointer;"></i>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <button class="btn btn-mini btn-primary add-line" type="button"> <i class="ti-plus mr-2"></i> Add Line</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
													<tr class="text-info">
														<td>
																<hr>
																<h6 class="text-primary">VAT ({{$policy->vat}}%) :</h6>
														</td>
														<td>
																<hr>
																<h6 class="text-primary"> <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}</span> <span class="vat"> 0.00</span></h6>
														</td>
												</tr>
												<tr>
													<th>Currency :</th>
													<td>
														<div class="form-group">
															<select name="currency" id="currency" value="{{old('currency')}}" class="js-example-basic-single">
																	<option value="{{Auth::user()->tenant->currency->id}}" selected>{{Auth::user()->tenant->currency->name ?? ''}} ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</option>
																	@foreach($currencies->where('id', '!=', Auth::user()->tenant->currency->id) as $currency)
																			<option value="{{$currency->id}}" data-abbr="{{$currency->abbr}}">{{$currency->name ?? ''}} ({{$currency->symbol ?? ''}})</option>
																	@endforeach
															</select>
															@error('currency')
																	<i class="text-danger mt-3 d-flex ">{{$message}}</i>
															@enderror
													</div>
													</td>
											</tr>
											<tr class="exchange-rate">
													<th>Exchange Rate :</th>
													<td>
															<input type="text" placeholder="Exchange rate" value="1" class="form-control" id="exchange_rate" name="exchange_rate">
													</td>
											</tr>
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
                    <button type="submit" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-control-shuffle"></i> Submit Invoice</button>
                    <a href="{{url()->previous()}}" class="btn btn-danger btn-mini waves-effect m-b-10 btn-sm waves-light">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection
@section('dialog-section')
<div class="modal fade" id="budgetModa" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title" style="text-transform: uppercase">Project Budget</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="sub-title">{{$project->post_title ?? ''}}</h5>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12  inject-table"></div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
			var defaultCurrency = "{{Auth::user()->tenant->currency->id}}";
			var string = null;
			$('.exchange-rate').hide();
        if($('#setAccount') == 1){
                $('.client-account-wrapper').show();
                $('#setAccount').val(1);
            }else{
                $('.client-account-wrapper').hide();
                $('#setAccount').val(0);
            }
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
				$(document).on('change', '#currency', function(e){
					e.preventDefault();
						if(defaultCurrency != $(this).val()){
							var abbr = $(this).find(':selected').data('abbr');
							string = abbr+"_"+"{{Auth::user()->tenant->currency->abbr}}";
							var url = "https://free.currconv.com/api/v7/convert?q="+string+"&compact=ultra&apiKey=c6616c96883701c84660";
							axios.get(url)
							.then(response=>{
								$('#exchange_rate').val(response.data[string]);
							});
							$('.exchange-rate').show();
						}else{
							$('.exchange-rate').hide();
						}
				});
        $(document).on('change', '#budget', function(e){
            e.preventDefault();
            axios.post('/project/get-budget',{budget:$(this).val()})
            .then(response=>{
                $('.inject-table').html(response.data);
                $('#budgetModal').modal('show');
            })
            .catch(error=>{

            });

        });

        $(document).on('change', '.select-client', function(e){
            e.preventDefault();
           axios.post('/crm/client/client-account',{id:$(this).val()})
           .then(response=>{
               if(response.data.client.glcode == null){
                $('.client-account-wrapper').show();
                $('#setAccount').val(1);
               }else{
                $('.client-account-wrapper').hide();
                $('#setAccount').val(0);
               }
           });
        });
				function setTotal(){
        var sum = 0;
        $(".payment").each(function(){
            sum += +$(this).val().replace(/,/g, '');
				});
				var vat = ($('#vat').val() * sum)/100;
									$(".vat").text(vat.toLocaleString());
            $(".total").text(sum.toLocaleString());
		}
});
</script>
@endsection
