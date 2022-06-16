<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Transactions;
use App\Expenses; 

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

        $income = Transactions::where('method', 'fee')
        ->sum('paid');
        
        $expense = Expenses::where('amount','>',0)->sum('amount');


        $profit =  $income - $expense;

    

        return view('admin.reports.index', compact('income','expense','profit'));

    }
}
