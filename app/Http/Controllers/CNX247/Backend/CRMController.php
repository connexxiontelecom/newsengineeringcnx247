<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Client;
use App\ClientLog;
use App\ClientMessaging;
use App\Mail\ClientMessaging as ClientMessagingMail;
use App\Mail\SendInvoice;
use App\Mail\SendReceipt;
use App\Ticket;
use App\Lead;
use App\Deal;
use App\Invoice;
use App\InvoiceItem;
use App\Receipt;
use App\ReceiptItem;
use App\ReceiptInvoice;
use App\Product;
use App\Feedback;
use App\ProductCategory;
use App\DefaultAccount;
use App\Policy;
use App\Bank;
use App\Currency;
use Auth;
use Image;
use DB;
use Schema;
use DateTime;

class CRMController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //Load CRM dashboard
    public function crmDashboard(){
        $clients = Client::where('tenant_id', Auth::user()->tenant_id)->count();
        $deals = Deal::where('tenant_id', Auth::user()->tenant_id)->count();
        $income = Receipt::where('tenant_id', Auth::user()->tenant_id)->sum('amount');
        $invoice = Invoice::where('tenant_id', Auth::user()->tenant_id)->sum('total');
        $client_logs = ClientLog::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->take(5)->get();
        $tickets = Ticket::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->take(10)->get();
        #Duration stats
            #Leads
                $leads = Lead::where('tenant_id', Auth::user()->tenant_id)->count();
                #This months's clients
                $month_clients = Client::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereMonth('created_at', Carbon::now()->isCurrentMonth())
                                    ->count();
                #This months's leads
                $month_leads = Lead::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereMonth('created_at', Carbon::now()->isCurrentMonth())
                                    ->count();
                #Today's clients
                $today_clients = Client::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereDay('created_at', Carbon::today())
                                    ->count();
                #Today's leads
                $today_leads = Lead::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereDay('created_at', Carbon::today())
                                    ->count();
            #Deals
                #This months's deals
                $month_deals = Deal::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereMonth('created_at', Carbon::now()->isCurrentMonth())
                                    ->count();
                #Today's deals
                $today_deals = Deal::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereDate('created_at', Carbon::today())
                                    ->count();

        return view('backend.crm.dashboard',[
            'clients'=>$clients,
            'income'=>$income,
            'invoice'=>$invoice,
            'deals'=>$deals,
            'client_logs'=>$client_logs,
            'leads'=>$leads,
            'month_clients'=>$month_clients,
            'month_leads'=>$month_leads,
            'today_clients'=>$today_clients,
            'today_leads'=>$today_leads,
            'month_deals'=>$month_deals,
            'today_deals'=>$today_deals,
            'tickets'=>$tickets
        ]);
    }

    /*
    * Leads
    */
    public function leads(){
        return view('backend.crm.leads.index');
    }

    #Contacts/clients
    public function clients(){
        return view('backend.crm.clients.index');
    }

    #Contacts/uploadClientAvatar
    public function uploadClientAvatar(Request $request){
        $this->validate($request,[
            'avatar'=>'required'
        ]);
        if($request->avatar){
    	    $file_name = time().'.'.explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
    	    //avatar image
    	    \Image::make($request->avatar)->resize(300, 300)->save(public_path('assets/images/clients/avatars/medium/').$file_name);
    	    \Image::make($request->avatar)->resize(150, 150)->save(public_path('assets/images/clients/avatars/thumbnails/').$file_name);


    	}
        $client = Client::where('id',$request->client)->where('tenant_id', Auth::user()->tenant_id)->first();
        $client->avatar = $file_name;
        $client->save();
        return response()->json(['message'=>'Success! Client avatar updated.']);

    }

    /*
    * Create new client
    */
    public function createClient(){
        return view('backend.crm.clients.create');
    }

    /*
    * view client
    */
    public function viewClient($slug){
        $client = Client::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        return view('backend.crm.clients.view',['client'=>$client]);
    }
    /*
    * view client
    */
    public function editClient($slug){
        return view('backend.crm.clients.edit');
    }

    /*
    * Convert client to lead
    */
    public function convertClientToLead($slug){
        $status = null;
        $client = Client::where('slug', $slug)->first();
        $invoice = Invoice::orderBy('id', 'DESC')->first();
				$products = Product::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
				$currencies = Currency::all();
        $invoiceNo = null;
        if(!empty($client) ){
            if(!empty($invoice) ){
                $invoiceNo = $invoice->invoice_no + rand(11, 99);
            }else{
                $invoiceNo = rand(111, 999);
            }
            if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
                $status = 1; //subscribed for accounting package
                $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->get();
                return view('backend.crm.clients.convert-to-lead',
                ['client'=>$client,
                'invoice_no'=>$invoiceNo,
                'products'=>$products,
                'status'=>$status,
								'accounts'=>$accounts,
								'currencies'=>$currencies
                ]);
            }else{
                return view('backend.crm.clients.convert-to-lead',
                ['client'=>$client,
                'invoice_no'=>$invoiceNo,
                'products'=>$products,
								'status'=>0,
								'currencies'=>$currencies
                ]);
            }
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }

        return view('backend.crm.clients.convert-to-lead', ['client'=>$client, 'invoice_no'=>$invoiceNo, 'products'=>$products]);
    }

    /*
    * Raise an invoice
    */
    public function raiseAnInvoice(Request $request){
        if($request->status == 1){
            $this->validate($request,[
                'issue_date'=>'required',
                'due_date'=>'required|after_or_equal:issue_date',
                'description.*'=>'required',
                'quantity.*'=>'required',
								'client_account'=>'required',
								'currency'=>'required'
            ]);
        }else{
            $this->validate($request,[
                'issue_date'=>'required',
                'due_date'=>'required|after_or_equal:issue_date',
                'description.*'=>'required',
								'quantity.*'=>'required',
								'currency'=>'required'
            ]);

        }
        $totalAmount = 0;
        if(!empty($request->total)){
            for($i = 0; $i<count($request->total); $i++){
                $totalAmount += $request->total[$i];
            }
        }
        $productGlCodes = [];
        if(!empty($request->description)){
            for($d = 0; $d < count($request->description); $d ++){
                $product = Product::where('tenant_id', Auth::user()->tenant_id)
                                    ->where('id',$request->description[$d])->first();
                array_push($productGlCodes, $product->glcode);
            }
        }
        //Check if client already exist
        $clientExist = Lead::where('client_id', $request->clientId)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(empty($clientExist)){
            $lead = new Lead;
            $lead->client_id = $request->clientId;
            $lead->tenant_id = Auth::user()->tenant_id;
            $lead->converted_by = Auth::user()->id;
            $lead->save();
        }
				$ref_no = strtoupper(substr(sha1(time()), 32,40));
        #Generate invoice
        $invoice = new Invoice;
        $invoice->invoice_no = $request->invoiceNo;
        $invoice->ref_no = $ref_no;
        $invoice->client_id = $request->clientId;
        $invoice->tenant_id = Auth::user()->tenant_id;
				$invoice->issued_by = Auth::user()->id;

				$startDateInstance = new DateTime($request->issue_date);
				$invoice->issue_date = $startDateInstance->format('Y-m-d H:i:s');

					$dueDateInstance = new DateTime($request->due_date);
				$invoice->due_date = $dueDateInstance->format('Y-m-d H:i:s');

        $invoice->total = $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $request->exchange_rate + ($totalAmount*$request->tax_rate)/100 * $request->exchange_rate ) : ($totalAmount + ($totalAmount*$request->tax_rate)/100 ) ;
        $invoice->sub_total = $request->currency != Auth::user()->tenant->currency->id ? $request->subTotal * $request->exchange_rate : $request->subTotal;
        $invoice->tax_rate = $request->tax_rate ?? 0;
        $invoice->tax_value = $request->currency != Auth::user()->tenant->currency->id ?  $request->tax_amount * $request->exchange_rate : $request->tax_amount;
				$invoice->currency_id = $request->currency;
				$invoice->exchange_rate = $request->exchange_rate ?? 1;
        $invoice->slug = substr(sha1(time()), 23,40);
        $invoice->save();
        #invoiceId
        $invoiceId = $invoice->id;
        #Enter invoice items
        for($i = 0; $i<count($request->description); $i++ ){
            $pro = Product::find($request->description[$i]);
            $item = new InvoiceItem;
            $item->description = $pro->product_name ?? '';
            $item->product_id = $pro->id;
            $item->quantity = $request->quantity[$i];
            $item->unit_cost = $request->unit_cost[$i];
            $item->total = $request->currency != Auth::user()->tenant->currency->id ? (($request->quantity[$i] * $request->unit_cost[$i]) * $request->exchange_rate) : $request->quantity[$i] * $request->unit_cost[$i];
            $item->invoice_id = $invoiceId;
            $item->client_id = $request->clientId;
            $item->tenant_id = Auth::user()->tenant_id;
            $item->save();
        }
        $client = Client::where('id',$request->clientId)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(empty($client->glcode)){
            $client->glcode = $request->client_account;
            $client->save();
        }
        #Check for accounting module
        if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $detail = InvoiceItem::where('invoice_id', $invoice->id)->where('tenant_id', Auth::user()->tenant_id)->get();
            $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
                # Post GL
                $invoicePost = [
                    'glcode' => $client->glcode,
                    'posted_by' => Auth::user()->id,
                    'narration' => 'Invoice generation for ' . $invoice->client->company_name ?? '',
                    'dr_amount' => $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $request->exchange_rate + ($totalAmount*$request->tax_rate)/100 * $request->exchange_rate ) :  ($totalAmount + ($totalAmount*$request->tax_rate)/100 ) ,
                    'cr_amount' => 0,
                    'ref_no' => $ref_no,
                    'bank' => 0,
                    'ob' => 0,
                    //'transaction_date' => $invoice->created_at,
                    'created_at' => $invoice->created_at
                ];
                DB::table(Auth::user()->tenant_id . '_gl')->insert($invoicePost);
                $VATPost = [
                    'glcode' => $policy->glcode,
                    'posted_by' => Auth::user()->id,
                    'narration' => 'VAT on invoice no. '.$invoice->invoice_no.' for '.$invoice->client->company_name,
                    'dr_amount' => 0,
                    'cr_amount' => $request->currency != Auth::user()->tenant->currency->id ?  $request->tax_amount * $request->exchange_rate : $request->tax_amount,
                    'ref_no' => $ref_no,
                    'bank' => 0,
                    'ob' => 0,
                    //'transaction_date' => $invoice->created_at,
                    'created_at' => $invoice->created_at
                ];
                DB::table(Auth::user()->tenant_id . '_gl')->insert($VATPost);
                foreach($detail as $d){
                    $receiptPost = [
                        'glcode' => $d->getProduct->glcode,
                        'posted_by' => Auth::user()->id,
                        'narration' => 'Invoice generation for ' . $d->description,
                        'dr_amount' => 0,
                        'cr_amount' => $request->currency != Auth::user()->tenant->currency->id ? (($d->quantity * $d->unit_cost) * $request->exchange_rate) : $d->quantity * $d->unit_cost,
                        'ref_no' => $ref_no,
                        'bank' => 0,
                        'ob' => 0,
                        //'transaction_date' => $invoice->created_at,
                        'created_at' => $invoice->created_at
                    ];
                    DB::table(Auth::user()->tenant_id . '_gl')->insert($receiptPost);
                }

        }

        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $request->clientId;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' Converted contact to lead.';
        $log->save();
        session()->flash("success", "<strong>Success! </strong> Client converted to lead. Invoice generated.");
        return redirect()->route('invoice-list');
    }

		public function declineInvoice($slug){
			$invoice = Invoice::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
			if(!empty($invoice)){
				$invoice->status = 2; //declined
				$invoice->trash = 1;
				$invoice->save();
				$ref_no = $invoice->ref_no;
				#delete record in GL table
				$records = DB::table(Auth::user()->tenant_id.'_gl')->where('ref_no', $ref_no)->delete();
				if($records){
					session()->flash("success", "<strong>Success!</strong> Invoice trashed.");
				return redirect()->route('invoice-list');
				}

			}else{
				session()->flash("error", "<strong>Ooops!</strong> No record found.");
			}
		}
    public function sendEmailToClient(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'subject'=>'required',
            'content'=>'required'
        ]);
        $client = Client::where('id', $request->client)->where('tenant_id', Auth::user()->tenant_id)->first();
        $message = new ClientMessaging;
        $message->tenant_id = Auth::user()->tenant_id;
        $message->sent_by = Auth::user()->id;
        $message->client_id = $request->client;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->content = $request->content;
        $message->type = 1;//email
        $message->save();
        \Mail::to($client)->send(new ClientMessagingMail($client, $message));
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $request->client;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' Sent an email.';
        $log->save();
        if($message){
            return response()->json(['message'=>'Success! Mail sent.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not send email. Try again'], 400);
        }
    }

    public function sendSmsToClient(Request $request){
        $this->validate($request,[
            'mobile_no'=>'required',
            'sms'=>'required'
        ]);
    }

        /*
    * Convert client to lead
    */
    public function receivePayment($slug){
        $invoice = Invoice::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        if(!empty($invoice) ){
						$total = 0;
						$status = ReceiptInvoice::where('tenant_id', Auth::user()->tenant_id)
																			->where('invoice_id', $invoice->id)
																			->where('trash',0)
																			->where('posted', 0)
																			->get();

            $charts = DB::table(Auth::user()->tenant_id.'_coa as c')
                        ->join('banks as b', 'b.bank_gl_code', '=', 'c.glcode')
                        ->get();
            $pending_invoices = Invoice::where('tenant_id', Auth::user()->tenant_id)
																				->where('status', '!=',2)
																				->where('client_id', $invoice->client_id)
																				->where('currency_id', $invoice->currency_id)
																				->get();
            return view('backend.crm.clients.receive-payment', [
                'invoice'=>$invoice,
                'pending_invoices'=>$pending_invoices,
                'total'=>$total,
								'charts'=>$charts,
								'status'=>$status
                ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return redirect()->back();
        }
    }

    public function receiveInvoicePayment(Request $request){
         $this->validate($request,[
            'payment_date'=>'required|date',
            'payment_method'=>'required',
            'reference_no'=>'required',
            'bank'=>'required'
				]);
				//return dd($request->all());
				$totalAmount = 0;
				$arrayCount = 0;
				$currencyArray = [];
				$exchangeRateArray = [];
				for($i = 0;  $i<count($request->payment); $i++){
					if(str_replace(',','',$request->payment[$i]) != null || str_replace(',','',$request->payment[$i]) != ''){
						$totalAmount += (int)str_replace(',','',$request->payment[$i]) * $request->exchange_rate[$i];
							$arrayCount++;
						array_push($currencyArray, $request->currency[$i]);
						array_push($exchangeRateArray, $request->exchange_rate[$i]);
					}
			}
			$currency = array_values($currencyArray);
			$exchange_rate = array_values($exchangeRateArray);
        //Check if deal already exist
        $dealExist = Deal::where('client_id', $request->clientId)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(empty($dealExist)){
            $lead = new Deal;
            $lead->client_id = $request->clientId;
            $lead->tenant_id = Auth::user()->tenant_id;
            $lead->converted_by = Auth::user()->id;
            $lead->save();
        }
        $receipt = new Receipt();
        $receipt->tenant_id = Auth::user()->tenant_id;
        $receipt->issued_by = Auth::user()->id;
				$receipt->client_id = $request->clientId;

				$startDateInstance = new DateTime($request->payment_date);
				$receipt->issue_date = $startDateInstance->format('Y-m-d H:i:s');

        $receipt->amount = $totalAmount ;
        $receipt->currency_id = $request->currency[0];
        $receipt->exchange_rate = $request->exchange_rate[0];
        $receipt->payment_type = $request->payment_method;
        $receipt->ref_no = $request->reference_no;
        $receipt->memo = $request->memo;
        $receipt->bank = $request->bank;
        $receipt->slug = substr(sha1(time()), 28,40);
        $receipt->save();
				$receiptId = $receipt->id;
				$payment = array_filter($request->payment);
				$reIndexed = array_values($payment);
        #Details
        for($j = 0; $j<$arrayCount; $j++){
            $detail = new ReceiptItem;
            $detail->tenant_id = Auth::user()->tenant_id;
            $detail->invoice_id = $request->invoices[$j];
            $detail->receipt_id = $receiptId;
            $detail->currency_id = $currency[$j];
            $detail->exchange_rate = $exchange_rate[$j];
            $detail->payment = (str_replace(',','',$reIndexed[$j]) * $request->exchange_rate[$j]);
            $detail->save();
						#Update invoice
						$receiptInvoice =  new ReceiptInvoice;
						$receiptInvoice->receipt_id = $receiptId;
						$receiptInvoice->invoice_id = $request->invoices[$j];
						$receiptInvoice->amount = (str_replace(',','',$reIndexed[$j]) * $request->exchange_rate[$j]);
						$receiptInvoice->tenant_id = Auth::user()->tenant_id;
						$receiptInvoice->save();
        }
            session()->flash("success", "<strong>Success!</strong> Receipt saved!");
            return redirect()->route('receipt-list');
    }

    /*
    * view lead
    */
    public function viewLead($slug){
        return view('backend.crm.leads.view');
    }

    /*
    * Invoice list [index]
    */
    public function invoiceList(){
        $now = Carbon::now();
        $invoices = Invoice::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $monthly = Invoice::where('tenant_id', Auth::user()->tenant_id)
                            ->whereMonth('created_at', date('m'))
														->whereYear('created_at', date('Y'))
														->where('trash', '!=',1)
                            ->sum(\DB::raw('total'));
        $last_month = Invoice::where('tenant_id', Auth::user()->tenant_id)
														 ->whereMonth('created_at', '=', $now->subMonth()->month)
														 ->where('trash', '!=',1)
														 ->sum(\DB::raw('total'));
        $thisYear = Invoice::where('tenant_id', Auth::user()->tenant_id)
														->whereYear('created_at', date('Y'))
														->where('trash', '!=',1)
                            ->sum(\DB::raw('total'));
        $this_week = Invoice::where('tenant_id', Auth::user()->tenant_id)
														->whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
														->where('trash', '!=',1)
                            ->sum(\DB::raw('total'));
        return view('backend.crm.invoice.index',
        [
            'invoices'=>$invoices,
            'monthly'=>$monthly,
            'last_month'=>$last_month,
            'this_week'=>$this_week,
            'thisYear'=>$thisYear
        ]);
    }

    /*
    * Print invoice
    */
    public function printInvoice($slug){
        $invoice = Invoice::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($invoice)){

            return view('backend.crm.invoice.print-invoice', ['invoice'=>$invoice]);
        }else{
            return "Invoice not found";
        }
    }

    /*
    * Send invoice via email
    */
    public function sendInvoiceViaEmail(Request $request){
        $invoice = Invoice::where('id', $request->id)->where('tenant_id', Auth::user()->tenant_id)->first();
        //$client = Client::where('client_id', $invoice->client_id)->where('tenant_id', Auth::user()->tenant_id)->first();
        \Mail::to($invoice->client->email)->send(new SendInvoice($invoice));
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $invoice->client_id;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' sent invoice('.$invoice->invoice_no.") via mail.";
        $log->save();
        return response()->json(['message'=>'Sent!']);
    }

        /*
    * Convert lead to deal
    */
    public function convertLeadToDeal($slug){
        $client = Client::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $receipt = Receipt::orderBy('id', 'DESC')->where('tenant_id', Auth::user()->tenant_id)->first();
        $charts = DB::table(Auth::user()->tenant_id.'_coa')->orderBy('glcode', 'ASC')->get();
        $invoices = Invoice::where('client_id', $client->id)
                            ->where('tenant_id', Auth::user()->tenant_id)
                            ->where('posted',0)
                            ->where('trash',0)
                            //->having('')
                            ->get();
        $receiptNo = null;
        if(!empty($receipt) ){
            $receiptNo = $receipt->receipt_no + 1;
        }else{
            $receiptNo = rand(111, 999);
        }
        return view('backend.crm.leads.convert-to-deal', [
            'client'=>$client,
            'receipt_no'=>$receiptNo,
            'invoices'=>$invoices,
            'charts'=>$charts
        ]);
    }

    /*
    * Convert lead to deal
    */
    public function raiseReceipt(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'payment_date'=>'required',
            'invoices.*'=>'required',
            'payment.*'=>'required',
            'reference_no'=>'required',
            'payment_method'=>'required',
        ]);
        $totalAmount = 0;
        for($i = 0; $i<count($request->payment); $i++){
            $totalAmount += $request->payment[$i];
        }
        $client = Deal::where('tenant_id', Auth::user()->tenant_id)->where('client_id', $request->clientId)->first();
        $clientObj = Client::where('id',$request->clientId)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(empty($client)){
            $deal = new Deal;
            $deal->client_id = $request->clientId;
            $deal->tenant_id = Auth::user()->tenant_id;
            $deal->converted_by = Auth::user()->id;
            $deal->save();
        }
        #Generate receipt
        $receipt = new Receipt;
        $receipt->client_id = $request->clientId;
        $receipt->tenant_id = Auth::user()->tenant_id;
        $receipt->issue_date = $request->payment_date;
        $receipt->issued_by = Auth::user()->id;
        $receipt->ref_no = $request->reference_no;
        $receipt->payment_type = $request->payment_method;
        $receipt->amount = $totalAmount;
        $receipt->slug = substr(sha1(time()), 23,40);
        $receipt->save();
        #receiptId
        $receiptId = $receipt->id;
        #Enter receipt items
        for($i = 0; $i<count($request->invoices); $i++ ){
            $item = new ReceiptItem;
            $item->payment = $request->payment[$i];
            $item->receipt_id = $receiptId;
            $item->invoice_id = $request->invoices[$i];
            $item->tenant_id = Auth::user()->tenant_id;
            $item->save();
            #Update invoice
            $update = Invoice::where('id', $request->invoices[$i])->where('tenant_id', Auth::user()->tenant_id)->first();
            $update->paid_amount += $request->payment[$i];
            $update->save();
        }
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $request->clientId;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' Converted contact to deal.';
        $log->save();
        session()->flash("success", "<strong>Success! </strong> Invoice generated. Proceed to print it or send via mail.");
        return redirect()->route('receipt-list');
    }


    /*
    * Receipt list [index]
    */
    public function receiptList(){
        $now = Carbon::now();
        $receipts = Receipt::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $monthly = Receipt::where('tenant_id', Auth::user()->tenant_id)
                            ->whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->sum('amount');
        $last_month = Receipt::where('tenant_id', Auth::user()->tenant_id)
                             ->whereMonth('created_at', '=', $now->subMonth()->month)
                            ->sum('amount');
        $thisYear = Receipt::where('tenant_id', Auth::user()->tenant_id)
                            ->whereYear('created_at', date('Y'))
                            ->sum('amount');
        $this_week = Receipt::where('tenant_id', Auth::user()->tenant_id)
                            ->whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                            ->sum('amount');
        return view('backend.crm.receipt.index',
        ['receipts'=>$receipts,
        'monthly'=>$monthly,
        'last_month'=>$last_month,
        'this_week'=>$this_week,
        'thisYear'=>$thisYear
        ]);
    }

    /*
    * Print invoice
    */
    public function printReceipt($slug){
        $receipt = Receipt::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($receipt)){
						$invoices = ReceiptItem::where('tenant_id', Auth::user()->tenant_id)->where('receipt_id', $receipt->id)->get();
						$invoiceIds = [];
						foreach($invoices as $in){
							array_push($invoiceIds, $in->invoice_id);
						}
						$invoiceBalance = Invoice::where('tenant_id', Auth::user()->tenant_id)
																			->where('client_id', $receipt->client_id)
																			->whereIn('id', $invoiceIds)
																			->get();

						return view('backend.crm.receipt.print-receipt',
						['receipt'=>$receipt,
						'invoices'=>$invoices,
						'invoiceBalance'=>$invoiceBalance,
						'invoiceBalance'=>$invoiceBalance
						]);
        }else{
            return "receipts not found";
        }
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $receipt->client_id;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' printed receipt('.$receipt->receipt_no.")";
        $log->save();
    }

    /*
    * Send receipt via email
    */
    public function sendReceiptViaEmail(Request $request){
        $receipt = Receipt::where('id', $request->id)->where('tenant_id', Auth::user()->tenant_id)->first();
        \Mail::to($receipt->client->email)->send(new SendReceipt($receipt));
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $receipt->client_id;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' sent receipt('.$receipt->receipt_no.") via mail.";
        $log->save();
        return response()->json(['message'=>'Sent!']);
    }

    /*
    * Deals
    */
    public function deals(){
        return view('backend.crm.deals.index');
    }

    /*
    * view deal
    */
    public function viewDeal($slug){
        return view('backend.crm.deals.view');
    }

    /*
    * Products [index]
    */
    public function products(){
        $products = Product::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.crm.products.index', ['products'=>$products]);
    }

    /*
    * Add new product [add]
    */
    public function addNewProduct(){
        $exist = null;
        $categories = ProductCategory::where('tenant_id', Auth::user()->tenant_id)->orderBy('category', 'ASC')->get();
        if(!Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $exist = 'no';
            return view('backend.crm.products.create', ['categories'=>$categories, 'exist'=>$exist]);
        }else{
            $exist = 'yes';
            $charts = DB::table(Auth::user()->tenant_id.'_coa')->orderBy('glcode', 'ASC')->get();
            return view('backend.crm.products.create', ['categories'=>$categories, 'exist'=>$exist, 'charts'=>$charts]);
        }


    }

    /*
    * Save product
    */
    public function saveProduct(Request $request){
        if($request->exist == 'yes'){
            $this->validate($request,[
                'product_name'=>'required',
                'product_description'=>'required',
                'price'=>'required',
                'featured_image'=>'required',
                'account'=>'required'
            ]);

        }else{
            $this->validate($request,[
                'product_name'=>'required',
                'product_description'=>'required',
                'price'=>'required',
                'featured_image'=>'required'
            ]);
        }
        if(!empty($request->file('featured_image'))){
            $extension = $request->file('featured_image');
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $dir = 'assets/uploads/featuredImage/';
            $featured_image = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('featured_image')->move(public_path($dir), $featured_image);
        }else{
            $featured_image = '';
        }

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->price = $request->price;
        $product->added_by = Auth::user()->id;
        $product->tenant_id = Auth::user()->tenant_id;
        $product->category_id = $request->product_category ?? 1;
        $product->slug = substr(sha1(time()), 23,40);
        $product->glcode = $request->account;
        $product->featured_image = $featured_image;
        $product->save();
        session()->flash("success", "<strong>Success! </strong> Product saved.");
        return redirect()->route('products');
    }

    /*
    * View product
    */
    public function viewProduct($slug){
        $product = Product::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($product)){
            return view('backend.crm.products.view', ['product'=>$product]);
        }else{
            return redirect()->route('404');
        }
    }

    /*
    * Edit product
    */
    public function editProduct($slug){
        $product = Product::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $categories = ProductCategory::where('tenant_id', Auth::user()->tenant_id)->orderBy('category', 'ASC')->get();
        if(!empty($product)){
            return view('backend.crm.products.edit', ['product'=>$product, 'categories'=>$categories]);
        }else{
            return redirect()->route('404');
        }
    }

    /*
    * Save product changes
    */
    public function saveProductChanges(Request $request){
        $this->validate($request,[
            'product_name'=>'required',
            'product_description'=>'required',
            'price'=>'required',
            'product_category'=>'required',
            'featured_image'=>'required'
        ]);
        //return dd($request->all());
        if(!empty($request->file('featured_image'))){
            $extension = $request->file('featured_image');
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $dir = 'assets/uploads/featuredImage/';
            $featured_image = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('featured_image')->move(public_path($dir), $featured_image);
        }else{
            $featured_image = '';
        }

        $product = Product::find($request->productId);
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->price = $request->price;
        $product->added_by = Auth::user()->id;
        $product->tenant_id = Auth::user()->tenant_id;
        $product->category_id = $request->product_category;
        $product->slug = substr(sha1(time()), 23,40);
        $product->featured_image = $featured_image;
        $product->save();
        session()->flash("success", "<strong>Success! </strong> Product saved.");
        return redirect()->route('products');
    }

    /*
    * Delete product
    */
    public function deleteProduct($slug){
        $product = Product::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($product)){
            $product->delete();
            return redirect()->route('products');
        }else{
            return redirect()->route('404');
        }
    }

    public function feedbacks(){
        $feedbacks = Feedback::orderBy('id', 'DESC')->get();
        return view('backend.crm.feedback.index', ['feedbacks'=>$feedbacks]);
    }

    public function feedbackStatus(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'value'=>'required'
        ]);
        $feed = Feedback::find($request->id);
        $feed->favourite = $request->value;
        $feed->save();
        return response()->json(['message'=>'Success! Feedback updated.']);
    }

    public function getClientGlcode(Request $request){
        $client = Client::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->id)->first();
        return response()->json(['client'=>$client], 200);
    }
}
