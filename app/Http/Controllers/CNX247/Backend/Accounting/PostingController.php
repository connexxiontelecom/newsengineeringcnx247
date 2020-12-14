<?php

namespace App\Http\Controllers\CNX247\Backend\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Invoice;
use App\Receipt;
use App\Client;
use App\ReceiptItem;
use App\ReceiptInvoice;
use App\InvoiceItem;
use App\DefaultAccount;
use App\BudgetFinance;
use App\ProjectBudget;
use App\BillMaster;
use Carbon\Carbon;
use Auth;
use DB;
use Schema;

class PostingController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function receipt(){
        $receipts = Receipt::where('tenant_id', Auth::user()->tenant_id)
        ->where('posted',0)->where('trash',0)->get();
        return view('backend.accounting.postings.receipt', ['receipts'=>$receipts]);
    }

    public function invoice(){
        $invoices = Invoice::where('posted', 0)->where('trash', 0)->where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.accounting.postings.invoice', ['invoices'=>$invoices]);
    }

    public function receiptDetail($slug){

        $receipt = Receipt::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($receipt)){

            return view('backend.accounting.postings.receipt-detail', ['receipt'=>$receipt]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
    public function postReceipt($slug)
    {
        $receipt = Receipt::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if (!empty($receipt)) {
            $receipt->posted = 1;
            $receipt->date_posted = now();
            $receipt->save();
            $client = Client::where('tenant_id', Auth::user()->tenant_id)->where('id', $receipt->client_id)->first();
            $detail = ReceiptItem::where('receipt_id', $receipt->id)->where('tenant_id', Auth::user()->tenant_id)->get();
            # Post to GL
            $bankGl = [
                'glcode' => $receipt->bank,
                'posted_by' => Auth::user()->id,
                'narration' => 'Payment received from ' . $receipt->client->first_name ?? '',
                'dr_amount' => $receipt->amount,
                'cr_amount' => 0,
                'ref_no' => $receipt->ref_no ?? '',
                'bank' => 0,
                'ob' => 0,
                'posted' => 1,
                'created_at' => $receipt->issue_date,
                'transaction_date' => $receipt->issue_date
            ];
            DB::table(Auth::user()->tenant_id . '_gl')->insert($bankGl);
            foreach ($detail as $d) {
                    $customerGl = [
                        'glcode' => $client->glcode,
                        'posted_by' => Auth::user()->id,
                        'narration' => 'Payment received for Invoice #: '.$d->invoice_id,
                        'dr_amount' => 0,
                        'cr_amount' => $d->payment ?? 0,
                        'ref_no' => $receipt->ref_no ?? '',
                        'bank' => 0,
                        'ob' => 0,
                        'posted' => 1,
                        'created_at' => $receipt->issue_date,
                        'transaction_date' => $receipt->issue_date
                    ];
										DB::table(Auth::user()->tenant_id . '_gl')->insert($customerGl);
										$temp = ReceiptInvoice::where('tenant_id',Auth::user()->tenant_id)
																						->where('receipt_id', $receipt->id)
																						->where('invoice_id', $d->invoice_id)
																						->first();
										if(!empty($temp)){
											$temp->posted = 1;
											$temp->save();
										}
								$invoice = Invoice::where('id', $d->invoice_id)->where('tenant_id', Auth::user()->tenant_id)->first();
								$invoice->paid_amount += $d->payment;
								if($invoice->paid_amount >= $invoice->total){
										$invoice->status = 1; //payment completed
										$invoice->posted = 1; //posted
										$invoice->posted_by = Auth::user()->id;
										$invoice->post_date = now();
								}
								$invoice->save();
								#BudgetFinance
								$budgetFinance = BudgetFinance::where('invoice_id', $d->invoice_id)
																								->where('tenant_id', Auth::user()->tenant_id)
																								->where('project_id', $invoice->project_id)
																								->first();
								if(!empty($budgetFinance)){
									#project budget table
									$budget = ProjectBudget::where('project_id', $invoice->project_id)
																					->where('tenant_id', Auth::user()->tenant_id)
																					->where('id', $budgetFinance->budget_id)
																					->first();
										if(!empty($budget)){
											$budget->actual_amount += $d->payment;
											$budget->save();
											$budgetFinance->receipt_id = $receipt->id;
											$budgetFinance->save();
										}

								}
						}

            session()->flash("success", "<strong>Success!</strong> Receipt posted.");
            return redirect()->route('receipt-posting');
        }
		}


		public function declineReceipt($slug){
			$receipt = Receipt::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($receipt)){
            $receipt->trash = 1;
						$receipt->save();
						#update pivot table
						$temp = ReceiptInvoice::where('tenant_id',Auth::user()->tenant_id)
																						->where('receipt_id', $receipt->id)
																						->where('trash',0)
																						->first();
						$temp->trash = 1;
						$temp->save();
            session()->flash("success", "<strong>Success!</strong> Receipt posting declined.");
            return redirect()->route('receipt-list');
        }
		}

		public function declineBill($slug){
			$bill = BillMaster::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
			if(!empty($bill)){
				$bill->status = 2; //declined
				$bill->save();
				$ref_no = $bill->ref_no;
				#delete record in GL table
				$records = DB::table(Auth::user()->tenant_id.'_gl')->where('ref_no', $ref_no)->delete();
				if($records){
					session()->flash("success", "<strong>Success!</strong> Bill trashed.");
				return redirect()->route('vendor-bills');
				}

			}else{
				session()->flash("error", "<strong>Ooops!</strong> No record found.");
			}
		}
}
