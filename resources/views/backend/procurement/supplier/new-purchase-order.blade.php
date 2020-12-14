@extends('layouts.app')

@section('title')
    Add New Purchase Order
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
                <form action="{{route('store-purchase-order')}}" method="post">
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
                                         <tbody class="float-right pr-5">
                                             <tr>
                                                 <td>
                                                     <h5>Purchase Order</h5>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td><strong>Purchase Order #: </strong>{{$poNumber}}</td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <div class="form-group">
                                                         <label for="">Latest Delivery Date:</label>
                                                         <input type="date" placeholder="Delivery Date" class="form-control" name="delivery_date">
                                                         @error('delivery_date')
                                                             <i class="text-danger mt-2">{{$message}}</i>
                                                         @enderror
                                                     </div>
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
                                 <h6 class="m-0">{{$supplier->company_name ?? ''}}</h6>
                                 <p class="m-0 m-t-10">{{$supplier->address ?? ''}}</p>
                                 <p class="m-0">{{$supplier->company_phone ?? ''}}</p>
                                 <p><a href="mailto:{{$supplier->company_email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[ {{$supplier->company_email ?? ''}} ]</a></p>
                             </div>
                             <div class="col-md-6 col-sm-6 ">
                                 <h6 class="sub-title">Delivery Address</h6>
                                 <p class="m-0 m-t-10 text-left">{{Auth::user()->tenant->street_1 ?? 'Street here'}} {{ Auth::user()->tenant->city ?? ''}} {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}</p>
                                 <p class="m-0 text-left"><strong>Email: </strong>{{Auth::user()->tenant->email ?? ''}}</p>
                                 <p class="text-left"><strong>Phone: </strong>{{Auth::user()->tenant->phone ?? 'Phone Number here'}}</p>
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
                                                 <th>Unit Price</th>
                                                 <th>Total</th>
                                                 <th class="text-danger">Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr class="item">
                                                 <td>
                                                     <input type="text" name="item_name[]" placeholder="Item Name" class="form-control">
                                                     @error('item_name')
                                                         <i class="text-danger mt-2">{{$message}}</i>
                                                     @enderror
                                                 </td>
                                                 <td>
                                                     <input type="number" placeholder="Quantity" name="quantity[]" class="form-control">
                                                     @error('quantity')
                                                         <i class="text-danger mt-2">{{$message}}</i>
                                                     @enderror
                                                 </td>
                                                 <td>
                                                     <input type="number" step="0.01" placeholder="Unit Price" class="form-control" name="unit_price[]">
                                                     @error('unit_price')
                                                         <i class="text-danger mt-2">{{$message}}</i>
                                                     @enderror
                                                 </td>
                                                 <td><input type="text" name="total[]" readonly style="width: 120px;"></td>
                                                 <td>
                                                     <i class="ti-trash text-danger remove-line" style="cursor: pointer;"></i>
                                                 </td>

                                             </tr>
                                             <tr>
                                                 <td colspan="5">
                                                     <button class="btn btn-mini btn-primary add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-sm-12">
                                 <input type="hidden" name="supplier" value="{{$supplier->id}}">
                                 <input type="hidden" name="purchase_order_no" value="{{$poNumber}}">
                                 <input type="hidden" name="totalAmount" id="totalAmount">
                                 <table class="table table-responsive invoice-table invoice-total">
                                     <tbody>
                                         <tr class="text-info">
                                             <td>
                                                 <hr>
                                                 <h5 class="text-primary">Total :</h5>
                                             </td>
                                             <td>
                                                 <hr>
                                                 <h5 class="text-primary total">0.00</h5>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-sm-12">
                                 <div class="form-group">
                                     <label for="">Instruction/Note</label>
                                     <textarea name="instruction" id="instruction" placeholder="Leave a note or instruction" style="resize: none;" class="form-control"></textarea>
                                 </div>
                             </div>
                         </div>
                         <div class="row text-center">
                             <div class="col-sm-12 invoice btn-group d-flex justify-content-center">
                                 <a href="{{url()->previous()}}" class="btn btn-danger btn-mini waves-effect m-b-10 btn-sm waves-light"><i class="ti-close mr-2"></i> Cancel</a>
                                 <button type="submit" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-check mr-2"></i>Submit Purchase Order</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script>
    $(document).ready(function(){
        var grand_total = 0;
        $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());

        $(document).on('click', '.add-line', function(e){
            e.preventDefault();
            const $lastRow = $('.item:last');
            const $newRow = $lastRow.clone();

            $newRow.find('input').val('');
            $newRow.find('td:nth-last-child(2) input[type=text]').text('0.00');
            $newRow.insertAfter($lastRow);

            $newRow.find('input:first').focus();
        });

        //Remove line
        $(document).on('click', '.remove-line', function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
            calculateTotals();
        });

        //calculate totals
        function calculateTotals(){
            const subTotals = $('.item').map((idx, val)=> calculateSubTotal(val)).get();
            const total = subTotals.reduce((a, v)=> a + Number(v), 0);
            grand_total = total;
            $('#totalAmount').val(grand_total);
            $('.total').text(formatAsCurrency(total));
           // $('.balance').text(formatAsCurrency(total));
        }

        //calculate subtotals
        function calculateSubTotal(row){
            const $row = $(row);
            const inputs = $row.find('input');
            const subtotal = inputs[1].value * inputs[2].value;
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
