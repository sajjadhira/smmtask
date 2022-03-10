<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Expensecategories;
use Session;
class ExpensecategoriesController extends Controller
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
            $data['categories'] = Expensecategories::paginate(10);
        }else if(Auth::user()->role == 'administrator' || Auth::user()->role == 'manager'){
            $data['categories'] = Expensecategories::where(['company'=>Auth::user()->company])->paginate(10);
        }

        return view('admin.expensecategories.index')->withData($data);
    }

    public function create(){
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        return view('admin.expensecategories.create');
    }


    public function store(Request $request){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }
        
        $this->validate($request,[
            'name'=>'required',
        ]);


        $insert = new Expensecategories;
        $insert->name = $request->name; 
        if(Auth::user()->role != "superadmin"){
            $insert->company = Auth::user()->company; 
        }
        $insert->save();

        $message = ['type'=>'success','message'=>'Expense category has added successfully.'];
        Session::flash('message',$message);
        return redirect('dashboard/expenditures/categories');


    }

    public function edit($id){
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        

        $data['category'] = Expensecategories::findOrFail($id);

        if(Auth::user()->role == 'administrator'){

            if (Auth::user()->company != $data['category']->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        return view('admin.expensecategories.edit')->withData($data);
    }

    public function update(Request $request,$id){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }
        $data['category'] = $insert = Expensecategories::findOrFail($id);

        if(Auth::user()->role == 'administrator'){

            if (Auth::user()->company != $data['category']->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }
        
        $this->validate($request,[
            'name'=>'required',
        ]);


        
        $insert->name = $request->name;
        if(Auth::user()->role != "superadmin"){
            $insert->company = Auth::user()->company; 
        }
        $insert->save();

        $message = ['type'=>'success','message'=>'Expense category has updated successfully.'];
        Session::flash('message',$message);
        return redirect('dashboard/expenditures/categories');


    }


}
