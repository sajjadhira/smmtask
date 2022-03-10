<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Products;
use App\Categories ;
use App\Subcategories ;
use Session;
class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('my-account');
        }


        $data['products'] = Products::orderBy('id','DESC')->paginate(20);
        // return  $data['products'];
        return view('admin.products.list')->withData($data);
    }

    
    public function create()
    {

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }

        $data['categories'] = Categories::get();
        return view('admin.products.create')->withData($data);
        
    }


    public function load_image($filename, $type) {
        if( $type == IMAGETYPE_JPEG ) {
            $image = imagecreatefromjpeg($filename);
        }
        elseif( $type == IMAGETYPE_PNG ) {
            $image = imagecreatefrompng($filename);
        }
        elseif( $type == IMAGETYPE_GIF ) {
            $image = imagecreatefromgif($filename);
        }
        return $image;
    }

    public function resize_image($new_width, $new_height, $image, $width, $height) {
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        return $new_image;
    }

    public function save_image($new_image, $new_filename, $new_type='jpeg', $quality=80) {
        if( $new_type == 'jpeg' ) {
            imagejpeg($new_image, $new_filename, $quality);
         }
         elseif( $new_type == 'png' ) {
            imagepng($new_image, $new_filename);
         }
         elseif( $new_type == 'gif' ) {
            imagegif($new_image, $new_filename);
         }
    }
    
    

    public function store(Request $request){

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }


        $this->validate($request,[
            'name' => 'required|min:3',
            'category' => 'required|numeric',
            'subcategory' => 'required|numeric',
            'price' => 'required|numeric',
            'preview_url' => 'required',
            'checkout_type' => 'required',
            'type' => 'required',
            'duration' => 'required|numeric',

        ]);

        $url = '';

        if ($request->hasFile('image')) {
            $allowedfileExtension=['jpeg','jpg','png'];
            $check=in_array($request->image->extension(),$allowedfileExtension);
            if ($check) {
                $url = 'p_' . time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $url);
                
                $filename = public_path('images/uploads').'/'.$url;
                list($width, $height, $type) = getimagesize($filename);
                $old_image = $this->load_image($filename, $type);
                $new_image = $this->resize_image(200, 200, $old_image, $width, $height);
                $this->save_image($new_image, public_path('images').'/thumb_'.basename($filename), 'jpeg', 75);

            }
        }




        $product = new Products;
        $images = [];

        if ($request->hasFile('images')) {

            $allowedfileExtension=['jpeg','jpg','png'];

            foreach ($request->file('images') as $key=>$file) {
                // $name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if ($check) {
                    $url =  'p_' . time().$key.'.'.$extension;
                    $file->move(public_path('images/uploads'), $url);
                    $images[] = $url;
                }
            }

            $product->images = json_encode($images);
        }

        $product->name = $request->name;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->product_type = $request->type;
        $product->price = $request->price;
        $product->preview_url = $request->preview_url;
        $product->checkout_type = $request->checkout_type;
        $product->duration = $request->duration;
        $product->description = $request->description;
        $product->save();

        
        $message = ['type'=>'success','message'=>'Product has been created successfully'];
        Session::flash('message',$message);
        return redirect('dashboard/products');


    }
    public function edit($id)
    {

        $data['product'] = $product = Products::findOrFail($id);

        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }


        if(Auth::user()->role == 'administrator' && Auth::user()->role == 'manager'){

            if ($product->company != Auth::user()->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }
       

        $data['categories'] = Categories::get();
        $data['subcategories'] = Subcategories::where('category','=',$product->category)->get();
        return view('admin.products.edit')->withData($data);
        
    }

    
    public function update(Request $request,$id){
        
        $data['product'] = $product = Products::findOrFail($id);

        
        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'manager' && Auth::user()->role != 'superadmin'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('dashboard');
        }


        if(Auth::user()->role == 'administrator' && Auth::user()->role == 'manager'){

            if ($product->company != Auth::user()->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }


        $this->validate($request,[
            'name' => 'required|min:3',
            'category' => 'required|numeric',
            'subcategory' => 'required|numeric',
            'price' => 'required|numeric',
            'preview_url' => 'required',
            'checkout_type' => 'required',
            'type' => 'required',
            'duration' => 'required|numeric',
        ]);


        $product->name = $request->name;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->product_type = $request->type;
        $product->price = $request->price;
        $product->preview_url = $request->preview_url;
        $product->checkout_type = $request->checkout_type;
        $product->duration = $request->duration;
        $product->description = $request->description;
        $url = '';

        if ($request->hasFile('image')) {

            // File::delete(public_path('images/'.$image->url));
            if ($request->hasFile('image')) {
                $allowedfileExtension=['jpeg','jpg','png'];
                $check=in_array($request->image->extension(), $allowedfileExtension);
                if ($check) {
                    $url =  'p_' . time().'.'.$request->image->extension();
                    $request->image->move(public_path('images/uploads'), $url);
                    $product->thumbnail = $url;

                    $filename = public_path('images/uploads').'/'.$url;
                    list($width, $height, $type) = getimagesize($filename);
                    $old_image = $this->load_image($filename, $type);
                    $new_image = $this->resize_image(200, 200, $old_image, $width, $height);
                    $this->save_image($new_image, public_path('images').'/thumb_'.basename($filename), 'jpeg', 75);
                }
            }
        }

        $images = [];
        if ($request->hasFile('images')) {

            $allowedfileExtension=['jpeg','jpg','png'];

            foreach ($request->file('images') as $key=>$file) {
                // $name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if ($check) {
                    $url =  'p_' . time().$key.'.'.$extension;
                    $file->move(public_path('images/uploads'), $url);
                    $images[] = $url;
                }
            }

            $product->images = json_encode($images);
        }

        $product->save();

        
        $message = ['type'=>'success','message'=>'Product has been upadted successfully'];
        Session::flash('message',$message);
        return redirect('dashboard/products');


    }


}
