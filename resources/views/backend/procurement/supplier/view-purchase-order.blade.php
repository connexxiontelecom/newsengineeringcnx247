@extends('layouts.app')

@section('title')
    Purchase Order
@endsection

@section('extra-styles')

<style>
/* The heart of the matter */

.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.procurement.supplier.common._procurement-slab')
    </div>
</div>
    <div class="card" id="purchaseContainer">
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
                            <tbody class="float-right pr-5">
                                <tr>
                                    <td>
                                        <h5>Purchase Order</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Purchase Order #: </strong>{{$purchase->purchase_order_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong for="">Date Submitted: </strong> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($purchase->created_at))}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong for="">Due Date: </strong> <span class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($purchase->delivery_date))}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong for="">PO Status: </strong> {{$purchase->status}}
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
                <div class="col-md-6 col-xs-12 invoice-client-info">
                    <h6 class="sub-title">Supplier Information :</h6>
                    <h6 class="m-0"><strong>Company Name: </strong>{{$purchase->getSupplier->company_name ?? ''}}</h6>
                    <p class="m-0 m-t-10"><strong>Address: </strong>{{$purchase->getSupplier->address ?? ''}}</p>
                    <p class="m-0"><strong>Phone: </strong>{{$purchase->getSupplier->company_phone ?? ''}}</p>
                    <p><strong>Email: </strong><a href="mailto:{{$purchase->getSupplier->company_email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[ {{$purchase->getSupplier->company_email ?? ''}} ]</a></p>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <h6 class="sub-title">Delivery Address</h6>
                    <p class="m-0 m-t-10 text-left"><strong>Address: </strong>{{Auth::user()->tenant->street_1 ?? 'Street here'}} {{ Auth::user()->tenant->city ?? ''}} {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}</p>
                    <p class="m-0 text-left"><strong>Email: </strong>{{Auth::user()->tenant->email ?? ''}}</p>
                    <p class="text-left"><strong>Phone: </strong>{{Auth::user()->tenant->phone ?? 'Phone Number here'}}</p>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <th>Delivery Date</th>
                            <th>Requested By</th>
                            <th>Approved By</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{date('d F, Y', strtotime($purchase->created_at))}}</td>
                                <td>{{$purchase->orderedBy->first_name ?? ''}} {{$purchase->orderedBy->surname ?? ''}}</td>
                                <td>{{$purchase->approvedBy->first_name ?? '-'}} {{$purchase->approvedBy->surname ?? ''}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <th>Instruction/Note</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$purchase->instruction}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                    <th>Total({{Auth::user()->tenant->currency->symbol ?? 'N'}})</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr class="item">
                                        <td>
                                            {{$item->product ?? ''}}
                                        </td>
                                        <td>
                                            {{$item->quantity ?? '0'}}
                                        </td>
                                        <td>
                                            {{number_format($item->unit_price,2) ?? '0'}}
                                        </td>
                                        <td>{{number_format($item->total,2)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <input type="hidden" id="supplier" value="{{$purchase->getSupplier->id}}"/>
                                <td colspan="4" class="text-right"><strong>Total: </strong>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($purchase->total,2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top:-25px;">
        <div class="card-block">
            <div class="row text-center">
                <div class="col-sm-12 purchase-btn-group text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-mini btn-print-purchase m-b-10 btn-sm waves-effect waves-light m-r-20" type="button" id="printInvoice"><i class="icofont icofont-printer mr-2"></i> Print</button>
                        <a href="{{url()->previous()}}" class="btn btn-secondary btn-mini waves-effect m-b-10 btn-sm waves-light"><i class="ti-arrow-left mr-2"></i> Back</a>
                        @if ($purchase->status == 'delivered')
                        <button type="button" class="btn btn-success btn-mini btn-approve m-b-10 btn-sm waves-effect waves-light m-r-20" id="poConfirmBtn" data-toggle="modal" data-target="#poReviewModal" value="{{$purchase->id}}"> <i class="ti-check mr-2"></i> Confirm </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')
		@if ($status == 1)
			<div class="modal fade" id="poReviewModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
							<div class="modal-content">
									<div class="modal-header bg-primary">
											<h6 class="modal-title">Service GL</h6>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true" class="text-white">&times;</span>
											</button>
									</div>
									<div class="modal-body">
											<form action="">
													<div class="form-group">
															<label>GL Account</label>
															<select name="service_account" id="service_account" class="form-control">
																<option disabled selected>Select service</option>
																@foreach ($accounts as $account)
																		<option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - {{$account->glcode ?? ''}}</option>
																@endforeach
															</select>
													</div>
													<div class="form-group">
														<label for="">Vendor Invoice</label>
														<input type="file" id="vendor_invoice" class="form-control-file">
													</div>
											</form>
									</div>
									<div class="modal-footer d-flex justify-content-center">
											<div class="btn-group">
													<button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
													<button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="submitSupplierReviewBtn"><i class="mr-2 ti-check"></i>Submit</button>
											</div>
									</div>
							</div>
					</div>
			</div>
		@else
		<div class="modal fade" id="poReviewModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
					<div class="modal-content">
							<div class="modal-header bg-danger">
									<h6 class="modal-title">Are you sure?</h6>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true" class="text-white">&times;</span>
									</button>
							</div>
							<div class="modal-body">
									<form action="">
											<div class="form-group">
													<label>This action cannot be undone. Are you sure you want to confirm this purchase order?</label>
											</div>
									</form>
							</div>
							<div class="modal-footer d-flex justify-content-center">
									<div class="btn-group">
											<button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Cancel</button>
											<button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="submitSupplierReviewBtn"><i class="mr-2 ti-check"></i>Yes</button>
									</div>
							</div>
					</div>
			</div>
	</div>
		@endif
@endsection
@section('extra-scripts')
<script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
<script src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/axios-progress.js')}}"></script>
<script>
    $(document).ready(function(){
        var po = null;
        var attachment = null;
        //print without commission
        $(document).on('click', '#printInvoice', function(event){
            $('#purchaseContainer').printThis({
                header:"<p></p>",
                footer:"<p></p>",
            });
        });

        //send purchase
        $(document).on('click', '#sendInvoiceViaEmail', function(e){
            $('#sendEmailAddon').text('Processing...');
            axios.post('/send/purchase/email/',{id:$(this).val()})
            .then(response=>{
                $('#sendEmailAddon').text('Done!');
            })
            .catch(error=>{
                $('#sendEmailAddon').text('Error!');
            });
        });

        $(document).on('click', '#poConfirmBtn', function(e){
            e.preventDefault();
            po = $(this).val();

        });
        $(document).on('change', '#vendor_invoice', function(e){
						e.preventDefault();
						var extension = $(this).val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif','ppt', 'pptx']) == -1) {
                $.notify("Error! Please upload a supported file format: ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']", "error");
            }else{
								attachment = $('#vendor_invoice').prop('files')[0];

            }

        });
        $(document).on('click', '#submitSupplierReviewBtn', function(e){
						e.preventDefault();
						form_data = new FormData;
						form_data.append('supplier', $('#supplier').val());
						form_data.append('vendor_invoice', attachment);
						form_data.append('service_account', $('#service_account').val());
						form_data.append('po',po);

            axios.post('/procurement/review/purchase-order', form_data)
            .then(response=>{
                $.notify(response.data.message, 'success');
                $('#poReviewModal').modal('hide');
            })
            .catch(error=>{
                $.notify('Ooops! Something went wrong.', 'error');
            });
        });
    });
</script>
@endsection
