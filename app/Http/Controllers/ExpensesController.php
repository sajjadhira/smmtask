<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Expenses;
use App\Expensecategories;
use Session;

class ExpensesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->types = ['success','warning','danger','info'];
    }

        
    public function index(){
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        if(Auth::user()->role == 'superadmin'){
            $data['expenses'] = Expenses::orderBy('id','DESC')->paginate(100);
        }else if(Auth::user()->role == 'administrator' || Auth::user()->role == 'manager'){
            $data['expenses'] = Expenses::where(['company'=>Auth::user()->company])->orderBy('id','DESC')->paginate(100);
        }

        return view('admin.expenses.index')->withData($data);
    }


    public function create(){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }


        if (Auth::user()->role == 'superadmin') {
            $data['categories'] = Expensecategories::get();
        }else if(Auth::user()->role == 'administrator' || Auth::user()->role == 'manager'){
            $data['categories'] = Expensecategories::where(['company'=>Auth::user()->company])->get();
        }
        return view('admin.expenses.create')->withData($data);
    }

    public function store(Request $request){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        
        $this->validate($request,[
            'name'=>'required',
            'category'=>'required',
            'amount'=>'required|numeric',
        ]);


        $insert = new Expenses;
        $insert->name = $request->name; 
        $insert->category = $request->category; 
        $insert->amount = $request->amount; 
        $insert->remark = $request->remark; 
        $insert->created_at = date('Y-m-d H:i:s',strtotime($request->date)); 
        // if(Auth::user()->role != "superadmin"){
            $insert->company = Auth::user()->company; 
            $insert->user = Auth::user()->id; 
        // }
        $insert->save();

        $message = ['type'=>'success','message'=>'Expense has added successfully.'];
        Session::flash('message',$message);
        return redirect('dashboard/expenditures');


    }


    public function edit($id){
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        

        $data['expense'] = Expenses::findOrFail($id);

        if(Auth::user()->role == 'administrator' || Auth::user()->role == 'manager'){

            if (Auth::user()->company != $data['expense']->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        if (Auth::user()->role == 'superadmin') {
            $data['categories'] = Expensecategories::get();
        }else if(Auth::user()->role == 'administrator' || Auth::user()->role == 'manager'){
            $data['categories'] = Expensecategories::where(['company'=>Auth::user()->company])->get();
        }

        return view('admin.expenses.edit')->withData($data);
    }


    public function update(Request $request,$id){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        

        $data['expense'] = $insert = Expenses::findOrFail($id);

        if(Auth::user()->role == 'administrator' || Auth::user()->role == 'manager'){

            if (Auth::user()->company != $data['expense']->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        $this->validate($request,[
            'name'=>'required',
            'category'=>'required',
            'amount'=>'required|numeric',
        ]);


        $insert->name = $request->name; 
        $insert->category = $request->category; 
        $insert->amount = $request->amount; 
        $insert->remark = $request->remark; 
        $insert->created_at = date('Y-m-d H:i:s',strtotime($request->date)); 
        if(Auth::user()->role != "superadmin"){
            $insert->company = Auth::user()->company; 
        }
        $insert->save();

        $message = ['type'=>'success','message'=>'Expense has update successfully.'];
        Session::flash('message',$message);
        return redirect('dashboard/expenditures');


    }


}
