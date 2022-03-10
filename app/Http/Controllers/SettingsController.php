<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function settings(){
        if (Auth::user()->role!="superadmin") {
            return view('auth.unauthorized');
        }
        
        $data[''] = null;
        return view('settings.settings')->withData($data);
    }


    public function update(Request $request){
        if (Auth::user()->role!="superadmin") {
            return view('auth.unauthorized');
        }
        
        $this->validate($request,[
            'company_name' => 'required',
            'contact_address' => 'required',
            'encoding' => 'required'
        ]);
    }
}
