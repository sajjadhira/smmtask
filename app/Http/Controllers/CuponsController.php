<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cupons;
use Session;
class CuponsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        if(Auth::user()->role == 'superadmin'){
            $data['cupons'] = Cupons::paginate(10);
        }else if(Auth::user()->role == 'administrator' || Auth::user()->role == 'manager'){
            $data['cupons'] = Cupons::where(['company'=>Auth::user()->company])->paginate(10);
        }

        return view('admin.cupons.index')->withData($data);
    }


    public function create(){
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        return view('admin.cupons.create');
    }


    public function store(Request $request){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }
        
        $this->validate($request,[
            'code'=>'required',
            'discount_type'=>'required',
            'discount'=>'required|numeric',
            'starting_at'=>'required',
            'ending_at'=>'required',
        ]);


        $insert = new Cupons;
        $insert->code = $request->code; 
        $insert->discount_type = $request->discount_type; 
        if(Auth::user()->role != "superadmin"){
            $insert->company = Auth::user()->company; 
        }
        $insert->discount = $request->discount; 
        $insert->starting_at = date('Y-m-d 00:00:00',strtotime($request->starting_at)); 
        $insert->ending_at = date('Y-m-d 23:59:59',strtotime($request->ending_at)); 
        $insert->save();

        $message = ['type'=>'success','message'=>'Your cupon has added successfully.'];
        Session::flash('message',$message);
        return redirect('dashboard/cupons');


    }

    
    public function edit($id){
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        

        $data['cupon'] = Cupons::findOrFail($id);

        if(Auth::user()->role == 'administrator'){

            if (Auth::user()->company != $data['cupon']->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        return view('admin.cupons.edit')->withData($data);
    }


    
    public function update(Request $request,$id){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }
        
        $data['cupon'] = $insert =  Cupons::findOrFail($id);

        if(Auth::user()->role == 'administrator'){

            if (Auth::user()->company != $data['cupon']->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        $this->validate($request,[
            'code'=>'required',
            'discount_type'=>'required',
            'discount'=>'required|numeric',
            'starting_at'=>'required',
            'ending_at'=>'required',
        ]);

        $insert->code = $request->code; 
        $insert->discount_type = $request->discount_type; 
        if(Auth::user()->role != "superadmin"){
            $insert->company = Auth::user()->company; 
        }
        $insert->discount = $request->discount; 
        $insert->starting_at = date('Y-m-d 00:00:00',strtotime($request->starting_at)); 
        $insert->ending_at = date('Y-m-d 23:59:59',strtotime($request->ending_at)); 
        $insert->save();

        $message = ['type'=>'success','message'=>'Your cupon has updated successfully.'];
        Session::flash('message',$message);
        return redirect('dashboard/cupons');


    }


}
