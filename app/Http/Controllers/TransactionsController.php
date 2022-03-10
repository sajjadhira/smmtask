<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Transactions;
use App\Users;

class TransactionsController extends Controller
{
    public function generate(){

        $fiveDays = date('Y-m-d H:i:s',time()-(1*24*3600));
        $users = Users::where('balance','>',0)
        ->where('payment_generated','<',$fiveDays)
        ->orderBy('id','DESC')
        ->take(10)
        ->get();
        
        foreach($users as $user){
            $countPending = Transactions::where(['user'=>$user->id,'status'=>0])->get();
            if($countPending->count()==0){
                $invoiceInfo = new Transactions;
                $invoiceInfo->type = 'debit';
                $invoiceInfo->user = $user->id;
                $invoiceInfo->manager = $user->manager;
                $invoiceInfo->administrator = $user->administrator;
                $invoiceInfo->company = $user->company;
                $invoiceInfo->role = $user->role;
            }else{
                $invoiceInfo = Transactions::findOrFail($countPending[0]->id);
            }

                $invoiceInfo->balance = $user->balance;
                $invoiceInfo->save();


                $userUpdate = Users::findOrFail($user->id);
                $userUpdate->payment_generated = date('Y-m-d H:i:s');
                $userUpdate->save();

        }

    }


    public function index(Request $request,$type='paid',$group=null){

        if (!Auth::check()) {
            return redirect('login');
        }
   
            if($type=='paid'){
                $data['cardtitle'] = 'Paid';
                $status = 1;
            }else{
                $data['cardtitle'] = 'Unpaid';
                $status = 0;
            }

        $where = ['status'=>1];

        if(Auth::user()->role=='superadmin' && $group == null){
            $data['invoices'] = Transactions::where($where)
            ->whereIn('role', ['administrator', 'superadmin'])
            ->orderBy('created_at','DESC')
            ->paginate(10);
        }else if(Auth::user()->role=='administrator' && $group == null){

            $data['invoices'] = Transactions::where($where)
            ->where('company','=',Auth::user()->company)
            ->where('role','=','manager')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        }else if(Auth::user()->role=='manager' && $group == null){

            $data['invoices'] = Transactions::where($where)
            ->where('manager','=',Auth::user()->id)
            ->where('role','=','user')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        }else if($group=='my'){
       
            $data['invoices'] = Transactions::where($where)
            ->where('user','=',Auth::user()->id)
            ->orderBy('created_at','DESC')
            ->paginate(10);

        }else if($type=='pending'){
       
            $data['invoices'] = Transactions::where($where)
            ->where('status',0)
            ->orderBy('created_at','DESC')
            ->paginate(10);

        }
        else{

            $data['invoices'] = Transactions::where($where)
            ->where('user','=',Auth::user()->id)
            ->orderBy('created_at','DESC')
            ->paginate(10);
        }


        return  view('transactions.list')->withData($data);
    }


    public function list(Request $request,$type='paid'){

        if($type == 'paid'){

            $status  = 1;
            
        }else{
            $status = 0;
        }
        $data['transactions'] = $transactions = Transactions::where('status',$status)
        ->whereIn('method', ['bkash','nagad'])
        ->where('type','credit')
        // ->join('users', 'users.id', '=', 'transactions.user')
        ->orderBy('transactions.id','DESC')
        ->paginate(50);

        return view('admin.transactions.index',compact(['transactions']));

    }
    
    
    public function payment_done($id,$status){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        // return [$id,$status];

        $transactions =  Transactions::findOrFail($id);
        $transactions->status = $status;
        $transactions->save();

        if ($status == 1) {
            $user = Users::findOrFail($transactions->user);
            $point = $user->point;
            $amount = $transactions->paid;
            $newPoint = $amount * 100;
            $newPointBalance = $point + $newPoint;
            $user->point = $newPointBalance;
            $user->save();
        }else if($status == 0) {
            $user = Users::findOrFail($transactions->user);
            $point = $user->point;
            $amount = $transactions->paid;
            $newPoint = $amount * 100;
            $newPointBalance = $point - $newPoint;
            $user->point = $newPointBalance;
            $user->save();
        }


        $message = ['type'=>'success','message'=>'Transaction has updated successfully'];
        Session::flash('message', $message);
        return redirect()->back();
        
    }


    public function pay($id){

        if (!Auth::check()) {
            return redirect('login');
        }
        $data['invoice'] = $invoice = Transactions::findOrFail($id);
        if(Auth::user()->role=='superadmin'  && ($invoice->role!='superadmin' && $invoice->role!='administrator')){
            return view('auth.unauthorized');
        }else if (Auth::user()->role=='administrator' && $invoice->company!=Auth::user()->company && $invoice->role!='manager'){
            return view('auth.unauthorized');
        }else if (Auth::user()->role=='manager' && $invoice->manager!=Auth::user()->id && $invoice->role!='user'){
            return view('auth.unauthorized');
        }else if (Auth::user()->role=='user'){
            return view('auth.unauthorized');
        }

        return view('transactions.pay')->withData($data);
    }


    public function update(Request $request,$id){
        
        if (!Auth::check()) {
            return redirect('login');
        }
        $data['invoice'] = $invoice = Transactions::findOrFail($id);
        if(Auth::user()->role=='superadmin'  && ($invoice->role!='superadmin' && $invoice->role!='administrator')){
            return view('auth.unauthorized');
        }else if (Auth::user()->role=='administrator' && $invoice->company!=Auth::user()->company && $invoice->role!='manager'){
            return view('auth.unauthorized');
        }else if (Auth::user()->role=='manager' && $invoice->manager!=Auth::user()->id && $invoice->role!='user'){
            return view('auth.unauthorized');
        }else if (Auth::user()->role=='user'){
            return view('auth.unauthorized');
        }else if ($invoice->status!=0){
            abort(401);
        }

        $this->validate($request,[
            'pay' => 'required|between:1,'.$data['invoice']->balance
        ]);

        $method = $request->method;
        $note = $request->note;
        $pay = $request->pay;
        $remain = $invoice->balance-$pay;
        
        $invoice->paid = $pay;
        $invoice->new_balance = $remain;
        $invoice->method= $method;
        $invoice->note = $note;
        $invoice->status = 1;
        $invoice->host = Auth::user()->id;
        $invoice->save();

        $userUpdate = Users::findOrFail($invoice->user);
        $balanceUpdate = $userUpdate->balance-$pay;
        $userUpdate->balance = $balanceUpdate;
        $userUpdate->save();


        $message = ['type'=>'success','message'=>'Payment has been completed successfully'];
        Session::flash('message',$message);

        return redirect('transactions');
        
        
    }
}
