<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Invoices;
use App\Users;
use App\Transactions;
use Session;
class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function orders(Request $request){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        if($request->has('page')){
            Session::put('pageNum', $request->page);
        }
        
        if (Auth::user()->role == 'superadmin') {
            $data['orders'] = Invoices::orderBy('id', 'desc')->paginate(10);
        }else if(Auth::user()->role == 'administrator' ||  Auth::user()->role == 'manager'){
            $data['orders'] = Invoices::where(['company'=>Auth::user()->company])->orderBy('id', 'desc')->paginate(10);
            // return $data['orders'];
        }
        return view('admin.sales.orders')->withData($data);

    }

    public function payment_done($id){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        $data['invoice'] = $invoice =  Invoices::findOrFail($id);
        if(Auth::user()->role == 'administrator'  || Auth::user()->role == 'manager'){

            if ($invoice->company != Auth::user()->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        if($invoice->status > 0){
            $message = ['type'=>'error','message'=>'Sorry! this invoice is already paid.'];
            Session::flash('message', $message);
            return redirect('dashboard');
        }
        

        $invoice->status = 1;
        $invoice->save();

        
        $user = Users::findOrFail($invoice->user);
        $balance = $user->balance;
        $amount = $invoice->total;
        $newBalance = $balance - $amount;
        $user->balance = $newBalance;
        $user->save();

        $transaction = new Transactions;
        $transaction->type = 'debit';
        $transaction->user = $invoice->user;
        $transaction->role = $user->role;
        $transaction->balance = $balance;
        $transaction->paid = $amount;
        $transaction->new_balance = $newBalance;
        $transaction->method = $user->payment_method;
        $transaction->status = 1;
        $transaction->save();

        $message = ['type'=>'success','message'=>'Invoice has been marked as paid'];
        Session::flash('message', $message);

        $pageNum = Session::get('pageNum');
        if($pageNum!=""){
            $pageToGo = '?page='.$pageNum;
        }else{
            $pageToGo = NULL;
        }
        return redirect('dashboard/invoices'.$pageToGo);
        
    }

    
    public function payment_undone($id){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        $data['invoice'] = $invoice =  Invoices::findOrFail($id);
        if(Auth::user()->role == 'administrator'  || Auth::user()->role == 'manager'){

            if ($invoice->company != Auth::user()->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }
        

        if($invoice->status > 1){
            $message = ['type'=>'error','message'=>'Sorry! this invoice is already marked as declined.'];
            Session::flash('message', $message);
            return redirect('dashboard');
        }

        $invoice->status = 2;
        $invoice->save();

        $message = ['type'=>'success','message'=>'Payment request denied!'];
        Session::flash('message', $message);

        $pageNum = Session::get('pageNum');
        if($pageNum!=""){
            $pageToGo = '?page='.$pageNum;
        }else{
            $pageToGo = NULL;
        }
        return redirect('dashboard/invoices'.$pageToGo);
        
    }

    public function orders_edit($id){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        $data['invoice'] = $invoice =  Invoices::findOrFail($id);
        if(Auth::user()->role == 'administrator'  || Auth::user()->role == 'manager'){

            if ($invoice->company != Auth::user()->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }
        

        return view('admin.sales.orders_edit')->withData($data);
    }

    public function order_update(Request $request, $id){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        $data['invoice'] = $invoice =  Invoices::findOrFail($id);
        if(Auth::user()->role == 'administrator'  || Auth::user()->role == 'manager'){

            if ($invoice->company != Auth::user()->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }


        $this->validate($request,[
        	'order_status' => 'required',
        ]);

        $cod = 0;

        if($invoice->status != $request->order_status){

            $invoice->delivery_agent = $request->delivery_agent;
            
            $da = Deliveryagents::findOrFail($invoice->delivery_agent);
            

            $delivery_package = Deliverypackages::find($invoice->delivery_option);
            $delivery_charge = $delivery_package->price;
            
            $cod = ceil(( $invoice->subtotal * $delivery_package->cod)/100);
            if($cod<10 && $da->name == "Delivery Tiger"){
                $cod = 10;
            }

            if($request->order_status == 1){
                $da->product_balance = $da->product_balance + $invoice->total;
                $da->balance = $da->balance + $invoice->total;

                $da->order_handled = $da->order_handled + 1;


                if($request->paid>0){
                    $invoice->paid = $request->paid;
                    $due_amount = $invoice->total - $request->paid;
                    $invoice->due = $due_amount;
                }


            }else if($request->order_status == 2 ){
                $da->total_paid = $da->total_paid + $delivery_charge + $cod;
                $invoice->delivery_payment = $delivery_charge;
                $da->cod_paid = $da->cod_paid + $cod;

                $invoice->paid = $invoice->total;
                $invoice->due = 0;

            }else if($request->order_status == 127){

                if ($request->delivery_area == 'around-dhaka') {
                    $return_charge =  ceil(($da->charge_inside_subcity * $da->refund_charge_on_charge)/100);

                    $product_charge = ceil(( $invoice->total * $da->refund_charge_on_product)/100);
                    $total_refund_charge = $return_charge + $product_charge;
                    
                    $da->refund_balance = $da->refund_balance + $total_refund_charge;
                    
                    $da->product_balance = $da->product_balance - $invoice->total;

                    $da->balance = $da->product_balance - $da->refund_balance;

                    $da->total_paid = $da->total_paid + $total_refund_charge;
                    $invoice->delivery_payment = $total_refund_charge;
                    // return $total_refund_charge;
                    
                }else if ($request->delivery_area == 'outside-dhaka') {
                    $return_charge =  ceil(($da->charge_outside_city * $da->refund_charge_on_charge)/100);
                    $product_charge = ceil(( $invoice->total*$da->refund_charge_on_product)/100);
                    $total_refund_charge = $return_charge + $product_charge;
                    
                    $da->refund_balance = $da->refund_balance + $total_refund_charge;
                    
                    $da->product_balance = $da->product_balance - $invoice->total;

                    $da->balance = $da->product_balance - $da->refund_balance;
                    
                    $da->total_paid = $da->total_paid + $total_refund_charge;
                    $invoice->delivery_payment = $total_refund_charge;
                }

                
                
                
            }
            // return $request;
            $da->save();

        }

        if($request->has('sale_tracking')){
            $invoice->sale_tracking = $request->sale_tracking;
        }


        

        $invoice->cod_charge = $cod;
        $invoice->status = $request->order_status;
        $invoice->delivery_tracking = $request->delivery_tracking;
        $invoice->save();

        $message = ['type'=>'success','message'=>'Success! Order has updated successfully.'];
        Session::flash('message', $message);
        return redirect('dashboard/orders');

    }
}
