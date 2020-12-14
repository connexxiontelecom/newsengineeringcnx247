@extends('layouts.app')

@section('title')
    New Vendor Bill
@endsection

@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/cus/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/css/cus/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
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
                    <a href="{{route('vendor-bills')}}" class="btn mb-4 btn-primary btn-mini"><i class="ti-layout mr-2"></i>Vendor Bills</a>
                    <form action="{{route('new-vendor-bill')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Vendor</label>
                                    <select name="vendor" id="vendor" class="text-white select2-selection__rendered js-example-basic-single form-control">
                                        <option disabled selected>Select Vendor</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}" class="">{{$vendor->company_name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="date" placeholder="Date" class="form-control" name="issue_date">
                                            @error('issue_date')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Bill Number</label>
                                            <input type="text" placeholder="Bill Number" class="form-control" disabled value="{{$billNo <= 10 ? '00000'.$billNo : $billNo}}">
                                            <input type="hidden" value="{{$billNo}}" name="bill_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Bill To</label>
                                            <textarea name="bill_to" id="bill_to" cols="5" style="resize:none;" placeholder="Bill to..." class="form-control"></textarea>
                                            @error('bill_to')
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
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th class="text-danger">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tbody id="products">
                                        <tr class="item">
                                            <td>
                                                <div class="form-group">
                                                    <select name="description[]" value="{{old('description[]')}}" class="js-example-basic-single select-product">
                                                        <option selected disabled>Select service/product</option>
                                                        @foreach($services as $service)
                                                            <option value="{{$service->id}}">{{$service->product ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('description')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" placeholder="Quantity" name="quantity[]" class="form-control">
                                                @error('quantity')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" placeholder="Unit Cost" step="0.01" class="form-control" name="unit_cost[]">
                                                @error('unit_cost')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </td>
                                            <td><input type="text" name="total[]" readonly style="width: 120px;"></td>
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
                                <button class="btn btn-mini btn-primary add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Payment Instruction <sup class="text-danger">*</sup></label>
                                    <textarea name="payment_instruction" placeholder="Payment instruction..." class="form-control" style="resize: none;"></textarea>
                                    @error('payment_instruction')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                    <input type="hidden" name="totalAmount" id="totalAmount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>
																			<tr>
																				<th>Currency :</th>
																				<td>
																					<div class="form-group">
																						<select name="currency" id="currency" value="{{old('currency')}}" class="js-example-basic-single">
																								<option value="{{Auth::user()->tenant->currency->id}}" selected>{{Auth::user()->tenant->currency->name ?? ''}} ({{Auth::user()->tenant->currency->symbol ?? 'N'}})</option>
																								@foreach($currencies->where('id', '!=', Auth::user()->tenant->currency->id) as $currency)
																										<option value="{{$currency->id}}">{{$currency->name ?? ''}} ({{$currency->symbol ?? ''}})</option>
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
                                            <h5 class="text-primary"> <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}</span> <span class="total"> 0.00</span></h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"> Submit</i></button>
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
    <script src="/assets/js/cus/jquery-ui.min.js"></script>
    <script src="/assets/js/cus/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
    <script>
        $(document).ready(function(){
					var defaultCurrency = "{{Auth::user()->tenant->currency->id}}";
			$('.exchange-rate').hide();
            $(".select-product").select2({
                placeholder: "Select product/service"
            });
            var grand_total = 0;
            var rowCount = 1;
            $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());

            $(document).on('click', '.add-line', function(e){
                e.preventDefault();
                var new_selection = $('.item').first().clone();
                $('#products').append(new_selection);

                $(".select-product").select2({
                    placeholder: "Select product or service"
                });
                $(".select-product").last().next().next().remove();
						});

						$(document).on('change', '#currency', function(e){
							e.preventDefault();
								if(defaultCurrency != $(this).val()){
									$('.exchange-rate').show();
								}else{
									$('.exchange-rate').hide();
								}
						});

            //Remove line
            $(document).on('click', '.remove-line', function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
                calculateTotals();
                rowCount--;
            });

            $(document).on('change', '#vendor', function(e){
                e.preventDefault();
                axios.post('/vendor-bill/details', {vendor:$(this).val()})
                .then(response=>{
                    $('#bill_to').val(response.data.vendor.company_address);
                })
                .catch(error=>{

                });
            });

            //calculate totals
            function calculateTotals(){
                const subTotals = $('.item').map((idx, val)=> calculateSubTotal(val)).get();
                const total = subTotals.reduce((a, v)=> a + Number(v), 0);
                grand_total = total;
                $('.sub-total').text(formatAsCurrency(grand_total));
                $('#subTotal').val(grand_total);
                $('#totalAmount').val(grand_total);
                $('.total').text(total.toLocaleString());
            }

            //calculate subtotals
            function calculateSubTotal(row){
                const $row = $(row);
                const inputs = $row.find('input');
                const subtotal = inputs[0].value * inputs[1].value;
                // $row.find('td:nth-last-child(3)').text(formatAsCurrency(subtotal));
                $row.find('td:nth-last-child(2) input[type=text]').val(subtotal);
                return subtotal;
            }


            //format as currency
            function formatAsCurrency(amount){
                return "₦"+Number(amount).toFixed(2);
            }
        });
    </script>
@endsection
