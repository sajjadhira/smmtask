<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Products;
use App\Categories;
use App\Subcategories;
use App\Invoices;
use App\Orders;
use App\Cupons;
use App\Users;
use App\Iptables;
use App\Transactions;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');

        // auto delete user downloaded files
        $tmp_dir =  public_path('assets/private/files/user/');
        $files = glob($tmp_dir.'*');
        $file_time = time()-1800;
        foreach($files as $file){
          if(is_file($file)&&filemtime($file)<$file_time){
            @unlink($file);
          }
        }



        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // return [Session::get('affiliate')];

        if(Session::get('affiliate')){

            $affiliate = Session::get('affiliate');

            if(Auth::check()){

                //

                if (Auth::user()->id != $affiliate) {
                    
                    $affUpdate = Users::findOrFail(Auth::user()->id);
                    $affUpdate->affiliate = $affiliate;
                    $affUpdate->save();
                    Session::forget('affiliate');
                    
                }

                //

            }
        }

        $redirect = session()->get('redirect');
        if($redirect){
            $redirect_to = session('redirect');
            session()->forget('redirect');
            return redirect($redirect_to);
        }


        if(Auth::user()->role == 'user'){
            return redirect(url('/'));    
        }

        return redirect('dashboard');

    }

    public function reffer($id){

        if (!Auth::check()) {
            $userFind = Users::where('id', $id)->get();
            if ($userFind->count() > 0) {
                Session::put('affiliate', $id);

                // return [Session::get('affiliate')];
            }
        }


        return redirect('register');
    }


    public function canaccess(){
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
        if(substr_count($ua,'chrome') == 0){
            return false;
        }
        // if(substr_count($ua,'windows') == 0 && substr_count($ua,'android') == 0){
        if(substr_count($ua,'android') == 0){
            return false;
        }
        // if(substr_count($ua,'android') == 0){
        //     return false;
        // }
            return true;
        
    }
    public function check_access(){


        $message = ['message'=>'you can\'t access this page without google chrome and windows'];
        if (Auth::check() && Auth::user()->role != 'superadmin') {
            if (!$this->canaccess()) {
                return response()->json($message);
            }
        }
    }

    public function scrap($url)	{
        $curl = curl_init($url);
    
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $html = curl_exec($curl);
        curl_close($curl);
    
        return $html;
    }

    public function front(Request $request, $type = NULL){


        // Session::put('claim_time', $time);
        
        $data['err_message'] = NULL;

        $data['message'] = 'normal';
        $data['categories'] = Categories::get();
        $data['recent_products'] = Products::orderBy('created_at','DESC')->take(20)->get();
        $data['suggested_products'] = Products::where('pinned',1)->orderBy('created_at','DESC')->take(6)->get();
        $data['popular_products'] = Products::orderBy('sales','DESC')->take(20)->get();

        $data['modified_time'] = '1615289554';
        $data['title']  = '';
        if($type == '6faca6101d67946abb67669efa143e41'){
            $data['message'] = 'ok';
            return response()->json($data);
        }elseif($type != NULL){
            return response()->json(['message'=>'403 forbidden']);
        }

        // if (Auth::user()->role == 'user') {

        // }
        $data['task_count'] = DB::table('products')
            ->where('status',0)
            ->get()->count();
                
        // if (Auth::check() && Auth::user()->role != 'superadmin') {
            if (!$this->canaccess()) {
                $data['err_message'] = '<div class="alert alert-danger">You will not get task without google chrome and windows/android.</div>';
                // $data['task_count'] = 0;
                $message = ['message' => 'You will not get task without google chrome and android.'];
                // return response()->json($message);
            }


            $data['orders'] = Invoices::where('status',1)->orderBy('id', 'desc')->paginate(50);
        // }

        return view('website.index')->withData($data);
    }



    public function product(Request $request,$name,$id,$type=NULL){
        $data['message'] = 'normal';
        $data['categories'] = Categories::get();
        $data['product'] = Products::findOrFail($id);
        $data['recent_products'] = Products::orderBy('created_at','DESC')->take(20)->get();
        $data['popular_products'] = Products::orderBy('sales','DESC')->take(20)->get();
        $data['title']  = $data['product']->name;
        $data['description']  = substr($data['product']->description,0,155);
        $data['keywords']  = $data['product']->name;
        $data['og_image']  = url('images/uploads/'.$data['product']->thumbnail);
        $data['modified_time'] = strtotime($data['product']->updated_at);

        $keys = explode(' ',$data['product']->name);
        $keyword_count = count($keys);
        foreach($keys as $key=>$keyword){
            if($key!=$keyword_count){
                $data['keywords'].= ", ";
            }
            $data['keywords'].= $keyword;
        }

            
        $info = [];
        $data['task_count'] = 0;

        if($request->has('raw')){
            return  count(session()->get('cart'));
        }
        if($type == '6faca6101d67946abb67669efa143e41'){
            $data['message'] = 'ok';
            return response()->json($data);
        }elseif($type != NULL){
            return response()->json(['message'=>'403 forbidden']);
        }

                
        $hyphen_name = strtolower(preg_replace('#[ -]+#', '-', $data['product']->name));
        if($name != $hyphen_name){
            abort(404);
        }

        return view('website.product')->withData($data);
    }

    public function category(Request $request,$slug,$type = NULL){
        $cateF = Categories::where(['slug'=>$slug])->get();
        if($cateF->count() == 0){
            abort(404);
        }
        $data['categories'] = Categories::take(12)->get();
        $data['category'] = Categories::findOrFail($cateF[0]->id);
        $data['products'] = Products::where(['category'=>$data['category']->id])->paginate(12);
        $data['title'] = $data['category']->name;
        if($type == '6faca6101d67946abb67669efa143e41'){
            $data['message'] = 'ok';
            return response()->json($data['products']);
        }elseif($type != NULL){
            return response()->json(['message'=>'403 forbidden']);
        }
        return view('website.category')->withData($data);
    }




    public function about_us(){
        $data['language'] = $this->language;
        $data['side_categories'] = Categories::take(12)->get();
        $data['hidden_categories'] = Categories::skip(12)->take(50)->get();
        $data['categories'] = $data['drop_categories'] = Categories::get();
        $data['hide_side_category'] = true;
        return view('website.about')->withData($data);
    }

    public function contact_us(){
        $data['language'] = $this->language;
        $data['side_categories'] = Categories::take(12)->get();
        $data['hidden_categories'] = Categories::skip(12)->take(50)->get();
        $data['categories'] = $data['drop_categories'] = Categories::get();
        $data['hide_side_category'] = true;
        return view('website.contact')->withData($data);
    }

    public function tos(){
        $data['language'] = $this->language;
        $data['side_categories'] = Categories::take(12)->get();
        $data['hidden_categories'] = Categories::skip(12)->take(50)->get();
        $data['categories'] = $data['drop_categories'] = Categories::get();
        $data['hide_side_category'] = true;
        return view('website.tos')->withData($data);
    }

    public function privacy(){
        $data['language'] = $this->language;
        $data['side_categories'] = Categories::take(12)->get();
        $data['hidden_categories'] = Categories::skip(12)->take(50)->get();
        $data['categories'] = $data['drop_categories'] = Categories::get();
        $data['hide_side_category'] = true;
        return view('website.privacy')->withData($data);
    }

    public function cart(Request $request){


        if($request->has('raw')){
            return session()->get('cart');
        }

        $data = [];

        return view('website.cart')->withData($data);
    }

    public function place_order(Request $request){


        if (!Auth::check()) {
            return redirect('login');
        }



        $user_id = Auth::user()->id;
    



        $subtotal = $total = $base_peofit = 0;

        foreach(session('cart')  as $details){
            $product = Products::findOrFail($details['id']);
            $license = $details['license'];
            $price = $product->$license;
            $subtotal+=$price;
        }  

        $grand_total = $total = $subtotal;

        $cupon_code = $request->cupon;
        $discount = 0;
        if($cupon_code!=""){
            $f_cupon = Cupons::where(['code'=>$cupon_code])->where('ending_at','>=',date('Y-m-d H:i:s'))->get();
            if($f_cupon->count()>0){
                $cupon = $f_cupon[0];

                if($cupon->discount_type == 'flat'){
                    $discount = ceil($cupon->discount);
                    $grand_total = $total - $discount;
                }else{
                    $discount = ceil(($subtotal*$cupon->discount)/100);
                    $grand_total = $total - $discount;
                }

            }
        }


        if($grand_total>Auth::user()->balance){

            $message = ['type'=>'error','message'=>'You do not have enough balance, please add balance first'];

            Session::flash('message',$message);
            return redirect()->back();

        }

        $invoice = new Invoices;
        $invoice->user = $user_id;

        $invoice->subtotal = $subtotal;
        $invoice->cupon = $cupon_code;
        $invoice->discount = $discount;
        $invoice->total = $grand_total;
        $invoice->status = 2;
        $invoice->payment_type = 'account-fund';
        $invoice->save();

        
        
        foreach (session('cart')  as $details) {

            $license = $details["license"];
            $key = license_key(6);

            $product = Products::findOrFail($details['id']);
            $product->sales = $product->sales+1;
            $product->amount_sold = $product->amount_sold+$product->$license;
            $product->save();
            $quantity = 1;
            $total_price = $quantity*$product->$license;
        
            $order = new Orders;
            $order->user = $user_id;
            $order->invoice = $invoice->id;
            $order->product = $details['id'];
            $order->price = $product->$license;
            $order->quantity = $quantity;
            $order->total_price = $total_price;
            $order->license = $key;
            $order->type = $license;
            $order->save();
            
        }
        

        $user = Users::findOrFail($user_id);

        $old_balance = $user->balance;
        $new_balance = $user->balance - $grand_total;
        $user->balance = $new_balance;


        /* save some transaction */
        
        $transaction = new Transactions;
        $transaction->type = 'debit';
        $transaction->user = Auth::user()->id;
        $transaction->role = Auth::user()->role;
        $transaction->balance = $old_balance;
        $transaction->paid = $grand_total;
        $transaction->new_balance = $new_balance;
        $transaction->method = 'purchase';
        $transaction->status = 1;
        $transaction->note = '<a href="'.url("invoice/details/".$invoice->id).'">Invoice #'.$invoice->id.'</a>';
        $transaction->save();
        


        $user->save();

        session()->forget('cart');
        session()->forget('cupon');

        $message = ['type'=>'success','message'=>'Thank You, Your purchase has been completed successfully. Transaction ID:'.$invoice->id];

        Session::flash('message',$message);

        return redirect('downloads');
    



        
        

    }

    function get_cpoun_info(Request $request){

        $cupon = ['status'=>'false'];
        $f_cupon = Cupons::where(['code'=>$request->code])->where('ending_at','>=',date('Y-m-d H:i:s'))->get();
        if($f_cupon->count()>0){
            $cupon_info = $f_cupon[0];
            $cupon = ['status'=>'true','cupon'=>$request->code,'discount_type'=>$cupon_info->discount_type,'discount'=>$cupon_info->discount];
            // $session = session()->get('cupon');
            session()->put('cupon', $cupon);

        }

        return response()->json($cupon);


    }


    public function order(Request $request, $id){

        $data['language'] = $this->language;

        if($request->has('language')){
            $data['language'] = $request->language;
        }

    
        if($data['language'] == 'bn'){
            $data['title']  = "অর্ডার #".$this->bfn($id);
        }else{
            $data['title'] = "Order #".$id;
        }

        // return $data['language'];
        
        if (!Auth::check()) {
            return redirect('login');
        }

 

        $data['invoice'] = $invoice = Invoices::findOrFail($id);

        if(Auth::user()->role == 'user'){
            if ($invoice->user != Auth::user()->id) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

                
        if(Auth::user()->role == 'administrator' || Auth::user()->role == 'manager'){
            if ($invoice->company != Auth::user()->company) {
                $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        $data['orders'] = Orders::where(['invoice'=>$id])->get();

        return view('website.order')->withData($data);
        
    }

    public function invoice($id){

        $data['language'] = $this->language;
        
        if (!Auth::check()) {
            return redirect('login');
        }

        $data['invoice'] = Invoices::findOrFail($id);

        $data['orders'] = Orders::where(['invoice'=>$id])->get();

        return view('website.'.$this->language.'.invoice')->withData($data);
        
    }

    public function bulk_invoice($id){

        $data['language'] = $this->language;
        
        if (!Auth::check()) {
            return redirect('login');
        }

        $data['invoices'] = Invoices::where('id','>=',$id)->where('status','=',1)->get();


        return view('website.'.$this->language.'.bulk-invoice')->withData($data);

    }
    
    public function bulk_list(Request $request, $id){

        $data['language'] = $this->language;
        
        if (!Auth::check()) {
            return redirect('login');
        }


        if($request->has('price')){
            $data['show_price'] = true;
        }
        $data['invoices'] = Invoices::where('id','>=',$id)->where('status','=',1)->get();

        return view('website.'.$this->language.'.product-buy-list')->withData($data);

    }
    



    public function products_find(Request $request){
        $product_listv= [];
        if ($request->has('name')) {
            $name = $request->name;

            $products =  Products::where('name', 'like', "%$name%")->get();

            foreach($products as $product){
                $product_listv[$product->id] = ['id'=>$product->id,'name'=>$product->name,'price'=>$product->price];
            }
        }
        return response()->json($product_listv);
    }

    public function get_invoice_info(Request $request){
        $id = $request->id;
        $invoice = Invoices::findOrFail($id);

        $user = Users::findOrFail($invoice->user);
        $agent = Deliveryagents::findOrFail($invoice->delivery_agent);
        $information = [];
        $information['id'] = $invoice->id;
        $information['name'] = $user->name;
        $information['phone'] = $invoice->phone;
        $information['address'] = $invoice->address;
        $information['total'] = $invoice->total;
        $information['delivery_charge'] = $invoice->delivery_charge;
        $information['agent'] = $agent->name;
        

        return $information;

    }

    function update_delivery_tracking(Request $request, $id){
        $dt = $request->dt;
        $invoice = Invoices::findOrFail($id);
        $invoice->delivery_tracking = $dt;
        $invoice->save();
        return ['success'];
    }

    
    public function get_subcategories($category){

        $cateExists = Categories::where(['id'=>$category])->get();
        if($cateExists->count() == 0){
            return [];
        }


        $scates = Subcategories::where(['category'=>$category])->get();
       

        return json_encode($scates);
    }
}
