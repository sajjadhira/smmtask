<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Invoices;
use App\Expenses; 
use App\Deliveryagents; 

class ReportingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){

		if (Auth::user()->role!='superadmin' && Auth::user()->role!='administrator'){
			return view('auth.unauthorized');
		}

        $data['invoices'] = Invoices::where('company',Auth::user()->company)->where('status',2)->get();
        
        $data['expenses'] = Expenses::where('company',Auth::user()->company)->get();
        $pendings = Invoices::where('company',Auth::user()->company)->where('status',1)->get();

        $total_in_progress_sale = 0;
        $total_in_progress_base_profit = 0;
        $total_in_progress_cod = 0;
        $total_in_progress_profit = 0;

        foreach($pendings as $pending){
            $total_in_progress_sale+=$pending->subtotal;
            $total_in_progress_base_profit+=$pending->base_profit;

            if (Deliveryagents::findOrFail($pending->delivery_agent)->name == "RedX") {
                $cod = ceil(($pending->total*1)/100);
            }else if(Deliveryagents::findOrFail($pending->delivery_agent)->name == "Delivery Tiger"){
                $cod = ceil(($pending->total * 1)/100);
                if($cod<10){
                    $cod = 10;
                }
            }

            $total_in_progress_cod+= $cod;

            $total_in_progress_profit+=  $pending->base_profit -$cod;
        }


        $data['pending_sale'] = $total_in_progress_sale;
        $data['pending_base_profit'] = $total_in_progress_base_profit;
        $data['pending_cod'] = $total_in_progress_cod;
        $data['pending_profit'] = $total_in_progress_profit;

        return view('admin.reports.index')->withData($data);

    }
}
