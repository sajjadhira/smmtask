<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Categories ;
use App\Subcategories;
use App\Products;
use Session;
use File;
class SubcategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function hyphen($string) {
        $string = strtolower( preg_replace('@[\W_]+@', '-', $string) );
        $string = rtrim($string,'-');
        $string = strtolower($string);
        return $string; // Removes special chars.
    }
 
    public function index(){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }

        $data['active_sidebar'] = 'subcategories';
        $data['subcategories'] = Subcategories::paginate(20);
        foreach($data['subcategories'] as $cat){
            $data['productcount_'.$cat->id] = Products::where(['subcategory'=>$cat->id])->get()->count();
        }

        return view('admin.subcategories.index')->withData($data);
    }


    public function create(){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }



        $data['categories'] = Categories::get();
        return view('admin.subcategories.create')->withData($data);
    }


    
    public function store(Request $request){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }


        $this->validate($request,[
            'name' => 'required',
            'category' => 'required',
        ]);
        //$url = 'subcategory' . time().'.'.$request->image->extension(); 
        //$request->image->move(public_path('images'), $url);

        // $slug = preg_replace('#[ -]+#', '-', trim($request->name));
        $slug = trim(preg_replace('/\s+/', '-', trim($request->name)));
        $subcategory = new Subcategories;
        $subcategory->name = $request->name;
        $subcategory->category = $request->category;
        $subcategory->slug = $slug;
        // $subcategory->company = Auth::user()->company;
        //$subcategory->thumbnail = $url;
        $subcategory->save();
        
        
        $message = ['type'=>'success','message'=>'Product subcategory has been created successfully'];
        Session::flash('message',$message);
        return redirect('dashboard/subcategories');

    }

    public function edit($id){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }


        $data['subcategory'] = Subcategories::findOrFail($id);
        $data['categories'] = Categories::get();
        return view('admin.subcategories.edit')->withData($data);
    }

        
    public function update(Request $request,$id){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }


        
        $subcategory = Subcategories::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'category' => 'required',
        ]);


        $slug = trim(preg_replace('/\s+/', '-', trim($request->name)));
        $subcategory->name = $request->name;
        $subcategory->category = $request->category;

        $subcategory->slug = $slug;
        if ($request->hasFile('image')) {
            
            $url = $request->name . time().'.'.$request->image->extension(); 
            $request->image->move(public_path('images'), $url);
    
            $subcategory->thumbnail = $url;
        }
        $subcategory->save();
        
        
        $message = ['type'=>'success','message'=>'Product subcategory has been updated successfully'];
        Session::flash('message',$message);
        return redirect('dashboard/subcategories');

    }


}
