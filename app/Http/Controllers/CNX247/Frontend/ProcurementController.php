<?php

namespace App\Http\Controllers\CNX247\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use App\BillMaster;
use App\BillDetail;
use App\Supplier;
use Hash;
use Auth;
class ProcurementController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:supplier');
    }

    public function myAccount(){
        return view('frontend.procurement.supplier.my-account');
    }
    public function myPurchaseOrders(){
        return view('frontend.procurement.supplier.purchase-orders');
    }

    public function viewMyPurchaseOrders($slug){
        $order = PurchaseOrder::where('slug', $slug)->first();
        if(!empty($order) ){
            $items = PurchaseOrderDetail::where('po_id', $order->id)
                                        ->get();
            return view('frontend.procurement.supplier.view-purchase-order', ['order'=>$order, 'items'=>$items]);
        }else{
            return back();
        }
    }

    public function takeAction(Request $request){
        $this->validate($request,[
            'order'=>'required',
            'status'=>'required'
        ]);
        if($request->status == 'delivered'){
            $order = PurchaseOrder::find($request->order);
            $order->status = $request->status;
            $order->date_delivered = now();
            $order->delivered_by = Auth::user()->id;
            $order->save();
            return response()->json(['message'=>'Success! Purchase order '.$request->status], 200);
        }else{
            $order = PurchaseOrder::find($request->order);
            $order->status = $request->status;
            $order->save();
            return response()->json(['message'=>'Success! Purchase order '.$request->status], 200);
        }
    }

    public function settings(){
        return view('frontend.procurement.supplier.settings');
    }

    public function storeChanges(Request $request){
        $this->validate($request,[
            'office_email'=>'required|email',
            'office_phone'=>'required',
            'website'=>'required',
            'tagline'=>'required',
            'office_address'=>'required',
        ]);

        $supplier = Supplier::find(Auth::user()->id);
        $supplier->company_email = $request->office_email;
        $supplier->company_phone = $request->office_phone;
        $supplier->company_address = $request->office_address;
        $supplier->tagline = $request->tagline;
        $supplier->website = $request->website;
        $supplier->save();
        $message = "<div class='alert alert-outline-primary alert-pills' role='alert'>
            <span class='badge badge-pill badge-danger'> Success! </span>
            <span class='alert-content'> Changes saved. </span>
        </div>";

        session()->flash("success", $message);
        return redirect()->back();
    }

    public function updateContactPerson(Request $request){
        $this->validate($request, [
            'full_name'=>'required',
            'email_address'=>'required|email',
            'position'=>'required',
            'mobile_no'=>'required'
        ]);
        $supplier = Supplier::find(Auth::user()->id);
        $supplier->first_name = $request->full_name;
        $supplier->email_address = $request->email_address;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->position = $request->position;
        $supplier->save();
        $message = "<div class='alert alert-outline-primary alert-pills' role='alert'>
            <span class='badge badge-pill badge-danger'> Success! </span>
            <span class='alert-content'> Contact person details updated.</span>
        </div>";
        session()->flash("contact_success", $message);
        return redirect()->back();
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'current_password'=>'required',
            'password'=>'required|confirmed'
        ]);
        $user = Supplier::find(Auth::user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            $message = "<div class='alert alert-outline-primary alert-pills' role='alert'>
                        <span class='badge badge-pill badge-danger'> Success! </span>
                        <span class='alert-content'> Password changed.</span>
                    </div>";
            session()->flash("security_success", $message);
            return back();
        }else{
            $message = "<div class='alert alert-outline-warning alert-pills' role='alert'>
                        <span class='badge badge-pill badge-danger'> Ooops! </span>
                        <span class='alert-content'> Current password does not match our record. Try again.</span>
                    </div>";
            session()->flash("warning", $message);
            return back();
          }
    }
}
