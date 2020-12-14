<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\NewSupplier;
use App\SupplierReview;
use App\Supplier;
use App\BillDetail;
use App\BillMaster;
use App\Industry;
use App\Currency;
use App\PurchaseOrderDetail;
use App\PurchaseOrder;
use App\PaymentBill;
use App\Policy;
use App\BudgetFinance;
use App\ProjectBudget;
use App\Service;
use App\PayMaster;
use App\PayDetail;
use App\Invoice;
use App\Bank;
use Auth;
use Schema;
use DB;


class SupplierController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $purchase_orders = PurchaseOrder::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.procurement.supplier.index', ['suppliers'=>$suppliers,'purchase_orders'=>$purchase_orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industries = Industry::orderBy('industry', 'ASC')->get();
        if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa') || Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_gl')){
            $accounts = DB::table(Auth::user()->tenant_id.'_coa')
                        ->select('glcode', 'account_name')
                        ->where('type', 'Detail')
                        ->get();
					return view('backend.procurement.supplier.create',['industries'=>$industries,'accounts'=>$accounts, 'status'=>1]);
        }else{
					return view('backend.procurement.supplier.create',['industries'=>$industries,'status'=>0]);

				}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'company_name'=>'required',
            'company_email' =>'required',
            'company_phone' =>'required',
            'company_address' =>'required',
            'industry' =>'required',
            'first_name' =>'required',
            'email_address' =>'required',
            'mobile_no' =>'required',
            'vendor_account' =>'required'
        ]);
        $password = substr(sha1(time()), 32,40);
        $hashed = bcrypt($password);
        $supplier = Supplier::create(array_merge($request->all(),
        [
        'added_by'=>Auth::user()->id,
        'tenant_id'=>Auth::user()->tenant_id,
        'slug'=>substr(sha1(time()), 26,40),
        'password'=>$hashed,
        'glcode'=>$request->vendor_account,
        ]));
        \Mail::to($request->company_email)->send(new NewSupplier($supplier, $password));
        session()->flash("success", "<strong>Success!</strong> New supplier registered.");
        return redirect()->route('suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($slug)
    {
        $supplier = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        if(!empty($supplier) ){
            $account = DB::table(Auth::user()->tenant_id.'_coa')->select()->where('glcode', $supplier->glcode)->first();
            return view('backend.procurement.supplier.view', ['supplier'=>$supplier, 'account'=>$account]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record does not exist.");
            return back();
        }
    }

    public function purchaseOrder($slug){
        $supplier = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        $po = PurchaseOrder::where('tenant_id', Auth::user()->tenant_id)->first();
        $poNumber = null;
        if(!empty($po) ){
            $poNumber = $po->purchase_order_no + 1;
        }else{
            $poNumber = 100000;
        }
        if(!empty($supplier) ){
            return view('backend.procurement.supplier.new-purchase-order', ['supplier'=>$supplier, 'poNumber'=>$poNumber]);
        }else{
            return redirect()->route('404');
        }
		}

		public function createPurchaseOrder(){
			$suppliers = Supplier::where('tenant_id', Auth::user()->tenant_id)->get();
			$po = PurchaseOrder::where('tenant_id', Auth::user()->tenant_id)->first();
			$poNumber = null;
			if(!empty($po) ){
					$poNumber = $po->purchase_order_no + 1;
			}else{
					$poNumber = 100000;
			}
			return view('backend.procurement.supplier.create-purchase-order', ['suppliers'=>$suppliers, 'poNumber'=>$poNumber]);
		}

    public function storePurchaseOrder(Request $request){
        $this->validate($request,[
            'purchase_order_no'=>'required',
            'delivery_date'=>'required',
            'supplier'=>'required',
            'totalAmount'=>'required'
        ]);
        $purchaseOrder = new PurchaseOrder;
        $purchaseOrder->purchase_order_no = $request->purchase_order_no;
        $purchaseOrder->requested_by = Auth::user()->id;
        $purchaseOrder->tenant_id = Auth::user()->tenant_id;
        $purchaseOrder->supplier_id = $request->supplier;
        $purchaseOrder->total = $request->totalAmount;
        $purchaseOrder->instruction = $request->instruction;
        $purchaseOrder->delivery_date = $request->delivery_date;
        $purchaseOrder->slug = substr(sha1(time()), 21,40);
        $purchaseOrder->save();
        $poId = $purchaseOrder->id;
        for($i = 0; $i<count($request->item_name); $i++){
            $item = new PurchaseOrderDetail;
            $item->product = $request->item_name[$i];
            $item->quantity = $request->quantity[$i];
            $item->unit_price = $request->unit_price[$i];
            $item->total = ($request->quantity[$i] * $request->unit_price[$i]);
            $item->po_id = $poId;
            $item->tenant_id = Auth::user()->tenant_id;
            $item->save();
        }
        session()->flash("success", "<strong>Success!</strong> New purchase order submitted.");
        return redirect()->route('purchase-orders');

    }

    public function viewPurchaseOrder($slug){

        $purchase = PurchaseOrder::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($purchase) ){
            $items = PurchaseOrderDetail::where('po_id', $purchase->id)
                                        ->where('tenant_id', Auth::user()->tenant_id)
																				->get();
					if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
						$accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
						$status = 1; //subscribed for accounting package
            return view('backend.procurement.supplier.view-purchase-order', [
							'purchase'=>$purchase,
							'items'=>$items,
							'accounts'=>$accounts,
							'status'=>$status
							]);
					}else{
						return view('backend.procurement.supplier.view-purchase-order', [
							'purchase'=>$purchase,
							'items'=>$items,
							'status'=>0
							]);
					}
        }else{
            return back();
        }
    }

    public function purchaseOrders(){
        $orders = PurchaseOrder::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.procurement.supplier.purchase-orders', ['orders'=>$orders]);
    }
    public function reviewPurchaseOrder(Request $request){
        $this->validate($request,[
            'po'=>'required',
            'supplier'=>'required'
				]);
				if(!empty($request->file('vendor_invoice'))){
					$extension = $request->file('vendor_invoice');
					$extension = $request->file('vendor_invoice')->getClientOriginalExtension(); // getting excel extension
					$dir = 'assets/uploads/attachments/';
					$filename = 'vendor_invoice_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
					$request->file('vendor_invoice')->move(public_path($dir), $filename);
			}else{
					$filename = '';
			}

        $review = new SupplierReview;
        $review->supplier_id = $request->supplier;
        $review->po_id = $request->po;
        $review->tenant_id = Auth::user()->tenant_id;
        $review->rating = $request->rating ?? 5;
        $review->review = $request->review ?? 'No review';
        $review->user_id = Auth::user()->id;
				$review->save();
				$po = PurchaseOrder::where('id', $request->po)->where('tenant_id', Auth::user()->tenant_id)->first();
				#Convert purchase order to bill
				$ref_no = strtoupper(substr(sha1(time()), 32,40));
				$policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
        $bill = new BillMaster;
        $bill->tenant_id = Auth::user()->tenant_id;
        $bill->vendor_id = $request->supplier;
        $bill->bill_no = $po->purchase_order_no;
        $bill->ref_no = $ref_no;
        $bill->bill_date = now();
        $bill->bill_amount = $po->total;
        $bill->attachment = $filename;
        $bill->vat_amount = ($po->total * $policy->vat)/100;
        $bill->vat_charge = $policy->vat;
        $bill->billed_to = $po->supplier_id;
        $bill->instruction = $po->instruction;
        $bill->user_id = Auth::user()->id;
        $bill->slug = substr(sha1(time()), 32,40);
        $bill->save();
				$billId = $bill->id;
				$poDetailIds = [];
				$purchaseOrderDetails = PurchaseOrderDetail::where('po_id', $request->po)->get();

        foreach($purchaseOrderDetails as $detail){
            $details = new BillDetail;
            $details->tenant_id = Auth::user()->tenant_id;
            $details->bill_id = $billId;
            $details->service_id = $detail->product;
            $details->quantity = $detail->quantity;
            $details->rate = $detail->unit_price;
            $details->glcode = $request->service_account;
            $details->amount = $detail->quantity * $detail->unit_price;
            $details->vat_amount = (($detail->quantity * $detail->unit_price) * $policy->vat)/100;
						$details->save();

				}
				if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
        #Vendor
        $vendor = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->supplier)->first();
        $vendorGl = [
            'glcode'=>$vendor->glcode,
            'posted_by'=>Auth::user()->id,
            'narration'=>'Bill raised for '.$vendor->company_name,
            'dr_amount'=>0,
            'cr_amount'=>$po->total,
            'ref_no'=>$ref_no,
            'bank'=>0,
            'ob'=>0,
            'transaction_date'=>now(),
            'created_at'=>now() //$request->issue_date,
        ];
        #Register customer in GL table
        DB::table(Auth::user()->tenant_id.'_gl')->insert($vendorGl);
        #Vat
        $vatGl = [
            'glcode'=>$policy->glcode,
            'posted_by'=>Auth::user()->id,
            'narration'=>'VAT charged on bill no: '.$po->purchase_order_no.' for vendor '.$vendor->company_name,
            'dr_amount'=>0,
            'cr_amount'=>($po->total * $policy->vat)/100,
            'ref_no'=>$ref_no,
            'bank'=>0,
            'ob'=>0,
            'transaction_date'=>now(),
            'created_at'=>now(),
        ];
        #Register VAT in GL table
        DB::table(Auth::user()->tenant_id.'_gl')->insert($vatGl);
        #Service
				$billDetails = BillDetail::where('tenant_id', Auth::user()->tenant_id)->where('bill_id', $billId)->get();
        foreach($billDetails as $d){
            $serviceGl = [
                'glcode'=>$d->glcode,
                'posted_by'=>Auth::user()->id,
                'narration'=>"Bill raised for ".$vendor->company_name." Service ID: ".$d->id." - ".$d->description,
                'dr_amount'=>($d->rate * $d->quantity) + (($d->rate * $d->quantity) * $policy->vat)/100,
                'cr_amount'=>0,
                'ref_no'=>$ref_no,
                'bank'=>0,
                'ob'=>0,
                'transaction_date'=>now(),
                'created_at'=>now(),
            ];
            #Register service in GL table
						DB::table(Auth::user()->tenant_id.'_gl')->insert($serviceGl);

				}
			}
        return response()->json(['message'=>'Success! Review submitted'], 200);

    }

    public function vendorServices(){
        $services = DB::table(Auth::user()->tenant_id.'_coa as c')
                        ->join('services as s', 's.glcode', '=', 'c.glcode')
                        ->select()
                        ->get();
        //Service::where('tenant_id', Auth::user()->tenant_id)->get();
        $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', '=', 'Detail')->get();
        return view('backend.procurement.vendor.services', ['services'=>$services, 'accounts'=>$accounts]);
    }

    public function storeVendorService(Request $request){

        $this->validate($request,[
            'account'=>'required',
            'product'=>'required'
        ]);
        $service = new Service;
        $service->tenant_id = Auth::user()->tenant_id;
        $service->added_by = Auth::user()->id;
        $service->glcode = $request->account;
        $service->product = $request->product;
        $service->save();
        session()->flash("success", "<strong>Success!</strong> New service registered.");
        return back();
    }

    public function vendorBills()
    {
        $bills = BillMaster::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $coa = DB::table(Auth::user()->tenant_id.'_coa')
                ->select('glcode', 'account_name')
                ->where('type', 'Detail')
                ->get();
        return view('backend.procurement.vendor.bill',['bills'=>$bills]);
    }
    public function newVendorBill(){
        $vendors = Supplier::where('tenant_id', Auth::user()->tenant_id)->get();
        $services = Service::where('tenant_id', Auth::user()->tenant_id)->get();
				$bill = BillMaster::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->first();
				$currencies = Currency::all();
        $billNo = null;
        if(!empty($bill)){
            $billNo = $bill->bill_no + 1;
        }else{
            $billNo = 10000;
        }
        return view('backend.procurement.vendor.new-bill', ['vendors'=>$vendors, 'billNo'=>$billNo,'services'=>$services, 'currencies'=>$currencies]);
    }

    public function vendorDetails(Request $request){
        $this->validate($request,[
            'vendor'=>'required'
        ]);
        $vendor = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->vendor)->first();
        return response()->json(['vendor'=>$vendor], 200);
    }

    public function storeVendorBill(Request $request)
    {
			//return dd($request->all());
       /*  $this->validate($request,[
            'vendor'=>'required',
            'bill_to'=>'required',
            'bill_no'=>'required',
            'issue_date'=>'required|date'
        ]); */
        $ref_no = strtoupper(substr(sha1(time()), 32,40));
        $totalAmount = 0;
        if(!empty($request->total)){
            for($i = 0; $i<count($request->total); $i++){
                $totalAmount += $request->total[$i];
            }
        }
        $serviceIds = [];
        if(!empty($request->description)){
            for($x = 0; $x<count($request->description); $x++){
                array_push($serviceIds, $request->description[$x]);
            }
        }
        $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
        $bill = new BillMaster;
        $bill->tenant_id = Auth::user()->tenant_id;
        $bill->vendor_id = $request->vendor;
        $bill->bill_no = $request->bill_no;
        $bill->ref_no = $ref_no;
				$bill->bill_date = $request->issue_date;

        //$bill->bill_amount = $totalAmount;
				//$bill->vat_amount = ($totalAmount * $policy->vat)/100;
				$bill->bill_amount = $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $request->exchange_rate + ($totalAmount*$policy->vat)/100 * $request->exchange_rate ) : ($totalAmount + ($totalAmount*$policy->vat)/100 ) ;
				$bill->vat_amount = $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $policy->vat)/100 * $request->exchange_rate : ($totalAmount*$policy->vat)/100;
				$bill->currency_id = $request->currency;
				$bill->exchange_rate = $request->exchange_rate;

        $bill->vat_charge = $policy->vat;
        $bill->billed_to = $request->vendor;
        $bill->instruction = $request->payment_instruction;
        $bill->user_id = Auth::user()->id;
        $bill->slug = substr(sha1(time()), 32,40);
        $bill->save();
				$billId = $bill->id;
				$serviceGls = [];
				$services = Service::where('tenant_id', Auth::user()->tenant_id)->whereIn('id',$serviceIds)->get();
				foreach($services as $serve){
					array_push($serviceGls, $serve->glcode);
				}
        for($n = 0; $n<count($request->description); $n++){
            $details = new BillDetail;
            $details->tenant_id = Auth::user()->tenant_id;
            $details->bill_id = $billId;
            $details->service_id = $request->description[$n];
            $details->quantity = $request->quantity[$n];
            $details->rate = $request->unit_cost[$n];
            $details->glcode = $serviceGls[$n];
            $details->amount = $request->quantity[$n] * $request->unit_cost[$n];
            $details->vat_amount = (($request->quantity[$n] * $request->unit_cost[$n])*$policy->vat)/100;
						$details->save();

        }
        #Vendor
        $vendor = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->vendor)->first();
        $vendorGl = [
            'glcode'=>$vendor->glcode,
            'posted_by'=>Auth::user()->id,
            'narration'=>'Bill raised for '.$vendor->company_name,
            'dr_amount'=>0,
            'cr_amount'=>$request->currency != Auth::user()->tenant->currency->id ? $totalAmount*$request->exchange_rate : $totalAmount,
            'ref_no'=>$ref_no,
            'bank'=>0,
            'ob'=>0,
            'transaction_date'=>now(),
            'created_at'=>now() //$request->issue_date,
        ];
        #Register customer in GL table
        DB::table(Auth::user()->tenant_id.'_gl')->insert($vendorGl);
        #Vat
        $vatGl = [
            'glcode'=>$policy->glcode,
            'posted_by'=>Auth::user()->id,
            'narration'=>'VAT charged on bill no: '.$request->bill_no.' for vendor '.$vendor->company_name,
            'dr_amount'=>0,
            'cr_amount'=>$request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $policy->vat)/100 * $request->exchange_rate : ($totalAmount * $policy->vat)/100,
            'ref_no'=>$ref_no,
            'bank'=>0,
            'ob'=>0,
            'transaction_date'=>now(),
            'created_at'=>$request->issue_date,
        ];
        #Register VAT in GL table
        DB::table(Auth::user()->tenant_id.'_gl')->insert($vatGl);
        #Service
				$detail = BillDetail::where('tenant_id', Auth::user()->tenant_id)->whereIn('service_id', $serviceIds)->where('bill_id',$billId)->get();
        foreach($detail as $d){
            $serviceGl = [
                'glcode'=>$d->glcode,
                'posted_by'=>Auth::user()->id,
                'narration'=>"Bill raised for ".$vendor->company_name." Service ID: ".$d->id." - ".$d->description,
                'dr_amount'=>$request->currency != Auth::user()->tenant->currency->id ? ($d->amount + (($d->amount) * $policy->vat)/100) * $request->exchange_rate : ($d->amount + (($d->amount) * $policy->vat)/100) ,
								'cr_amount'=>0,
                'ref_no'=>$ref_no,
                'bank'=>0,
                'ob'=>0,
                'transaction_date'=>now(),
                'created_at'=>$request->issue_date,
            ];
            #Register service in GL table
						DB::table(Auth::user()->tenant_id.'_gl')->insert($serviceGl);

        }
        session()->flash("success", "<strong>Success!</strong> New Bill registered.");
        return redirect()->route('vendor-bills');
    }

    public function viewBill($slug)
    {
        $bill = BillMaster::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        $items = BillDetail::where('tenant_id', Auth::user()->tenant_id)->where('bill_id', $bill->id)->get();
        if(!empty($bill)){
            return view('backend.procurement.vendor.view-bill', ['bill'=>$bill, 'items'=>$items]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }



    public function payments(){
        $payments = DB::table('pay_masters as p')
                    ->join('banks as b', 'p.bank_id', '=', 'b.bank_gl_code')
                    ->select()
                    ->where('p.posted', 0)
                    ->where('p.trash',0)
                    ->where('p.tenant_id', Auth::user()->tenant_id)
                    ->get();
        return view('backend.procurement.payment.index',['payments'=>$payments]);
    }

    public function newPayment(){

        $invoice = Invoice::where('status', 0)->where('tenant_id', Auth::user()->tenant_id)->get();
				$banks = Bank::where('tenant_id', Auth::user()->tenant_id)->get();
				$vendors = Supplier::where('tenant_id', Auth::user()->tenant_id)->get();
				$status = PaymentBill::where('tenant_id', Auth::user()->tenant_id)
																			->where('bill_id', 1)
																			->where('trash',0)
																			->where('posted', 0)
																			->get();
        $totalAmount = 0;
				return view('backend.procurement.payment.create',[
					'invoice'=>$invoice,
				'banks'=>$banks,
				'totalAmount'=>$totalAmount,
				'status'=>$status,
				'vendors'=>$vendors
				]);
		}

		public function getVendorPendingBills(Request $request){
			$this->validate($request,[
				'vendor'=>'required'
			]);
			$pending_bills  = BillMaster::where('paid', 0)->where('tenant_id', Auth::user()->tenant_id)->where('vendor_id',$request->vendor)->get();
			if(count($pending_bills) > 0){
				return view('backend.procurement.payment.pending-bills', ['pending_bills'=>$pending_bills]);
			}

		}

    public function storePayment(Request $request){
			  //dd($request->all());
        /*  $request->validate([
            'bank'=>'required',
            'payment_amount'=>'required',
            'reference_no'=>'required',
            'bills.*'=>'required',
						'payment.*'=>'required',
						'vendor'=>'required',
            'issue_date'=>'required|date'
        ]); */
				$payment_total = 0;
				//$billTotal = 0;
				$arrayCount = 0;
				$exchangeRateArray = [];
				$currencyArray = [];
        for($p = 0; $p<count($request->payment); $p++){
					if(str_replace(',','',$request->payment[$p]) != null){
						$payment_total += str_replace(',','',$request->payment[$p]);
						//$billTotal += $request->billTotal[$p];
							$arrayCount++;
							array_push($exchangeRateArray, $request->exchange_rate[$p]);
							array_push($currencyArray, $request->currency[$p]);
					}
				}
				#exchange_rate
				$exchangeRate = array_filter($exchangeRateArray);
				$reIndexedExchangeRate = array_values($exchangeRate);
				#currency
				$currency = array_filter($currencyArray);
				$reIndexedCurrency = array_values($currency);

        if($payment_total > $request->payment_amount_placeholder){
            session()->flash("error", "<strong>Ooops!</strong> Your total payment cannot be more than due amount.");
            return back();
        }else{
            $pay = new PayMaster;
            $pay->tenant_id = Auth::user()->tenant_id;
            $pay->bank_id = $request->bank;
            $pay->date_inputed = $request->issue_date;
            $pay->amount = $payment_total * $reIndexedExchangeRate[0];
            $pay->vendor_id = $request->vendor;
            $pay->ref_no = $request->reference_no;
            $pay->memo = $request->memo;
            $pay->exchange_rate = $reIndexedExchangeRate[0];
            $pay->currency_id = $reIndexedCurrency[0];
            $pay->user_id = Auth::user()->id;
            $pay->date_now = now();
            $pay->slug = substr(sha1(time()),32,40);
            $pay->save();
						$paymentId = $pay->id;
						#Payment
						$payment = array_filter($request->payment);
						$reIndexedPayment = array_values($payment);

						#Description
						$description = array_filter($request->description);
						$reIndexedDescription = array_values($description);
						#Bill
						$bills = array_filter($request->bills);
						$reIndexedBills = array_values($bills);

            #payment details
            for($n = 0; $n < $arrayCount; $n++){
                $detail = new PayDetail();
                $detail->bill_id = $reIndexedBills[$n];
                $detail->pay_amount = str_replace(',','',$reIndexedPayment[$n])  * $reIndexedExchangeRate[$n];
                $detail->pay_id = $paymentId;
                $detail->tenant_id = Auth::user()->tenant_id;
                $detail->description = $reIndexedDescription[$n];
                $detail->save();
                #bill master
               /*  $bill = BillMaster::find($reIndexedBills[$n]);
                $bill->paid_amount += str_replace(',','',$reIndexedPayment[$n]);
                if($bill->paid_amount + $bill->vat_amount >= $bill->bill_amount){
                    $bill->status = 'paid';
                    $bill->paid = 1;
                    $bill->save();
                }
                if(str_replace(',','',$reIndexedPayment[$n]) < $bill->bill_amount){
                    $bill->status = 'partial';
                    $bill->save();
                }
								$bill->save(); */
								#register this in pivot table
								$paymentBill =  new PaymentBill;
								$paymentBill->bill_id = $reIndexedBills[$n];
								$paymentBill->payment_id = $paymentId;
								$paymentBill->amount = str_replace(',','',$reIndexedPayment[$n]);
								$paymentBill->tenant_id = Auth::user()->tenant_id;
								$paymentBill->save();
            }
            session()->flash("success", "<strong>Success!</strong> Payment submitted.");
            return redirect()->route('payments');
        }
    }

    public function paymentDetail($slug){
        $payment = PayMaster::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $items = PayDetail::where('pay_id', $payment->id)->where('tenant_id', Auth::user()->tenant_id)->get();
        if(!empty($payment) && count($items) > 0){

            return view('backend.procurement.payment.view',['payment'=>$payment, 'items'=>$items]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return redirect()->route('payments');
        }
    }
    public function declinePayment($slug){
        $payment = PayMaster::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($payment)){
            $payment->trash = 1;
            $payment->save();
            session()->flash("success", "<strong>Success!</strong> Payment trashed.");
            return redirect()->route('payments');
        }
    }
    public function postPayment($slug)
    {
        $payment = PayMaster::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if (!empty($payment)) {
					$ref_no = strtoupper(substr(sha1(time()), 32,40));
            $payment->posted = 1;
            $payment->posted_date = now();
            $payment->save();

        $bankGlCode = $payment->bank_id;
        $detail = PayDetail::where('pay_id', $payment->id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $bills = PayDetail::where('pay_id', $payment->id)->where('tenant_id', Auth::user()->tenant_id)->get();
        $bill = BillMaster::where('id', $detail->bill_id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $vendor = Supplier::where('id', $bill->vendor_id)->where('tenant_id', Auth::user()->tenant_id)->first();
        # Post GL
        $bankGl = [
            'glcode' => $bankGlCode,
            'posted_by' => Auth::user()->id,
            'narration' => 'Payment to ' . $vendor->company_name ?? '',
            'dr_amount' => 0,
            'cr_amount' => $payment->amount,
            'ref_no' => $ref_no ?? '',
            'bank' => 0,
            'ob' => 0,
            'posted' => 1,
            'transaction_date'=>$payment->date_inputed,
            'created_at' => $payment->date_inputed,
        ];
        DB::table(Auth::user()->tenant_id . '_gl')->insert($bankGl);
        foreach($bills as $b){
						$vendorGl = [
								'glcode' => $vendor->glcode,
								'posted_by' => Auth::user()->id,
								'narration' => 'Payment for ' . $b->description,
								'dr_amount' => $b->pay_amount ?? 0,
								'cr_amount' => 0,
								'ref_no' => $ref_no ?? '',
								'bank' => 0,
								'ob' => 0,
								'posted' => 1,
								'transaction_date'=>$payment->date_inputed,
								'created_at' => $payment->date_inputed,
						];
						DB::table(Auth::user()->tenant_id . '_gl')->insert($vendorGl);
					}
            $perBill = BillDetail::where('bill_id', $b->id)->get();
            foreach($bills as $per){

								$temp = PaymentBill::where('tenant_id',Auth::user()->tenant_id)
																		->where('bill_id', $per->bill_id)
																		->where('payment_id', $payment->id)
																		->first();
										if(!empty($temp)){
											$temp->posted = 1;
											$temp->save();
											$billMaster = BillMaster::find($per->bill_id);
											if(!empty($billMaster) ){
												$billMaster->paid_amount += $billMaster->bill_amount;
													if($billMaster->paid_amount + $bill->vat_amount >= $billMaster->bill_amount){
															$billMaster->status = 'paid';
															$billMaster->paid = 1;
														}
														$billMaster->save();
											}

										}
										$bill->paid_amount += $per->pay_amount;
										if($bill->paid_amount >= $bill->bill_amount){
												$bill->status = 1;
										}
										$bill->save();
										$budgetFinance = BudgetFinance::where('bill_id', $bill->id)
																					->where('tenant_id', Auth::user()->tenant_id)
																					->where('project_id', $bill->project_id)
																					->first();
										if(!empty($budgetFinance)){
										#project budget table
										$budget = ProjectBudget::where('project_id', $bill->project_id)
																	->where('tenant_id', Auth::user()->tenant_id)
																	->where('id', $budgetFinance->budget_id)
																	->first();
										if(!empty($budget)){
											$budget->actual_amount += $per->pay_amount;
											$budget->save();
											$budgetFinance->payment_id = $payment->id;
											$budgetFinance->save();
										}

										}
            }

        session()->flash("success", "<strong>Success!</strong> Payment posted.");
        return redirect()->route('payments');
    }

    }
}
