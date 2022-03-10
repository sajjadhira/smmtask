<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Categories;
use App\Subcategories;
use App\Products;
use Session;
use File;
class CategoriesController extends Controller
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

        $data['categories'] = Categories::paginate(20);
        foreach($data['categories'] as $cat){
            $data['subcatcount_'.$cat->id] = Subcategories::where(['category'=>$cat->id])->get()->count();
            $data['productcount_'.$cat->id] = Products::where(['category'=>$cat->id])->get()->count();
        }

        // return  $data['products'];
        return view('admin.categories.index')->withData($data);
    }


    public function create(){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }



        return view('admin.categories.create');
    }

    public function store(Request $request){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }


        $this->validate($request,[
            'name' => 'required',
        ]);

        // $slug_part = strtolower(preg_replace('/[^ \w-]/', '-', trim($request->name)));
        $slug = trim(preg_replace('/\s+/', '-', trim($request->name)));
        $category = new Categories;
        $category->name = $request->name;
        $category->slug = $slug;
        if ($request->hasFile('image')) {
            $url = 'category'.time().'.'.$request->image->extension(); 
            $request->image->move(public_path('images'), $url);
            $category->thumbnail = $url;
        }
        $category->company = Auth::user()->company;
        $category->save();
        
        
        $message = ['type'=>'success','message'=>'Product category has been created successfully'];
        Session::flash('message',$message);
        return redirect('dashboard/categories');

    }

    
    public function edit($id){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }


        $data['category'] = Categories::findOrFail($id);
        return view('admin.categories.edit')->withData($data);
    }


    public function update(Request $request,$id){

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }


        $category = Categories::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
        ]);

        $findC = Categories::where('name','=',$request->name)->get();
        if($findC->count()>0 && $findC[0]->id!=$id){
            $message = ['type'=>'error','message'=>'Product category already exists'];
            Session::flash('message',$message);
            return redirect()->back();
        }


        $category->name = $request->name;
        // $category->slug = strtolower(preg_replace('#[ -]+#', '-', trim($request->name)));
        // $slug = strtolower(preg_replace('/[^ \w-]/', '-', trim($request->name)));
        // $category->slug = preg_replace('/\s+/', '', $slug);
        $slug = trim(preg_replace('/\s+/', '-', trim($request->name)));
        $category->slug = $slug;

        if ($request->hasFile('image')) {
            $url = $request->name . time().'.'.$request->image->extension(); 
            $request->image->move(public_path('images'), $url);
            $category->thumbnail = $url;
        }
        $category->company = Auth::user()->company;
        $category->save();
        
        
        $message = ['type'=>'success','message'=>'Product category has been update successfully'];
        Session::flash('message',$message);
        return redirect('dashboard/categories');

    }


}
