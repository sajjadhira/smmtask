<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Users;
use App\Products;
use App\Invoices;
use App\Orders;
use App\Ratings;
use App\Transactions;
use App\Iptables;
use App\Categories;
use Session;
use File;
use DB;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function find(Request $request){

    	$q = trim($request->input('q'));

        if (empty($q)) {
            return \Response::json([]);
        }



        if (Auth::user()->role=='superadmin'){
        $where = null;
        $users = Users::where('name', 'LIKE', '%'.$request->input('q', '').'%')->get(['id', 'name']);
        }else if(Auth::user()->role=='administrator'){
        $where = ['company'=>Auth::user()->company];
        $users = Users::where('name', 'LIKE', '%'.$request->input('q', '').'%')->where($where)->get(['id', 'name']);
        }else if(Auth::user()->role=='manager'){
        $where = ['manager'=>Auth::user()->id];
        $users = Users::where('name', 'LIKE', '%'.$request->input('q', '').'%')->where($where)->get(['id', 'name']);
        }


        $json = [];
        foreach ($users as $key => $user) {
        	$json[] = ['id'=>$user->id, 'text'=>$user->name];
        }


		return \Response::json($json);

    }

    public function index(Request $request, $role = null){


        if(!is_null($role) && Auth::user()->role!='superadmin'){
        return view('auth.unauthorized');    
        }

        if($request->has('name')){
            $name = $request->name;


        if (Auth::user()->role=='superadmin'){
        $data['users'] =  Users::where('name', 'like', "%$name%")->paginate(10);
        }else if(Auth::user()->role=='administrator'){
        $data['users'] =  Users::where('name', 'like', "%$name%")->where('company',Auth::user()->company)->paginate(10);
        }else if(Auth::user()->role=='manager'){
        $data['users'] =  Users::where('name', 'like', "%$name%")->where('manager',Auth::user()->id)->paginate(10);
        }else{
        return view('auth.unauthorized');
        }
        if(!is_null($role) && Auth::user()->role=='superadmin'){
        $data['users'] =  Users::where('name', 'like', "%$name%")->where('role',$role)->paginate(10);
        }

    }else{


        if (Auth::user()->role=='superadmin'){
        $data['users'] =  Users::orderBy('id', 'DESC')->paginate(10);
        }else if(Auth::user()->role=='manager'){
        $data['users'] =  Users::where('manager',Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        }else if(Auth::user()->role=='administrator'){
        $data['users'] =  Users::where('company',Auth::user()->company)->orderBy('id', 'DESC')->paginate(10);
        }else{
        return view('auth.unauthorized');
        }
        if(!is_null($role) && Auth::user()->role=='superadmin'){
        $data['users'] =  Users::where('role',$role)->orderBy('id', 'DESC')->paginate(10);
        }

    }

        return view('admin.users.list')->withData($data);
    }

    public function create(){

        if (Auth::user()->role=='user'){
            return view('auth.unauthorized');
        }

        $data = [];
        return view('admin.users.create')->withData($data);

    }

    public function store(Request $request){

        if (Auth::user()->role=='user'){
            return view('auth.unauthorized');
        }

        $this->validate($request,[
            'name'      =>  'required|min:3',
            'email'     =>  'required|email',
            'password'  =>  'required|min:8',
            'role'      =>  'required'
        ]);

        $roles = ['user'];
        if(Auth::user()->role=='manager'){
            $roles  = ['user','manager'];
        }
        if(Auth::user()->role=='administrator'){
            $roles  = ['user','manager','administrator'];
        }
        if(Auth::user()->role=='superadmin'){
            $roles  = ['user','manager','administrator','superadmin'];
        }

        if(!in_array($request->role, $roles)){
            return view('auth.unauthorized');
        }


        $user  = new Users;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->default_billing_address = $request->default_billing_address;
        $user->default_billing_phone = $request->default_billing_phone;
        $user->verification = 1;
        if(Auth::user()->role=='manager'){
            $user->manager = Auth::user()->id;
            $user->administrator = Auth::user()->administrator;
            $user->company = Auth::user()->company;
        }
        if(Auth::user()->role=='administrator'){
            $user->administrator = Auth::user()->id;
            $user->company = Auth::user()->company;
        }
        if($request->role=='administrator'){
            $user->manager = NULL;
        }
        $user->save();

        $message = ['type'=>'success','message'=>'User has been created successfully'];
        Session::flash('message',$message);

        return redirect('dashboard/users');



    }

    public function edit($id){

    $user = $data['user'] = Users::findOrFail($id);

    if(Auth::user()->role!="superadmin" && Auth::user()->id!=$user->manager){
        return view('auth.unauthorized');
    }    

    if(Auth::user()->id!=1 && $id==1){
        return view('auth.unauthorized');
    }

    return view('admin.users.edit')->withData($data);

    }


    public function update(Request $request, $id){

        $user = $data['user'] = Users::findOrFail($id);

        if(Auth::user()->role!="superadmin" && Auth::user()->id!=$user->manager){
            return view('auth.unauthorized');
        }


        if(Auth::user()->id!=1 && $id==1){
            return view('auth.unauthorized');
        }

        $this->validate($request,[
            'name'      =>  'required|min:3',
            'email'     =>  'required|email',
            'role'      =>  'required'
        ]);

        $roles = ['user'];
        if(Auth::user()->role=='manager'){
            $roles  = ['user','manager'];
        }
        if(Auth::user()->role=='superadmin'){
            $roles  = ['user','manager','administrator','superadmin'];
        }

        if(!in_array($request->role, $roles)){
            return view('auth.unauthorized');
        }


        $user->name = $request->name;
        $user->email = $request->email;
        
        if($request->password!=""){
        $user->password = Hash::make($request->password);
        }

        $user->role = $request->role;
        /*if(Auth::user()->role=='manager'){
            $user->manager = Auth::user()->id;
            $user->administrator = Auth::user()->administrator;
            $user->company = Auth::user()->company;
        }
        if(Auth::user()->role=='administrator'){
            $user->administrator = Auth::user()->administrator;
            $user->company = Auth::user()->company;
        }*/
        if($request->role=='administrator'){
            $user->manager = NULL;
        }
        $user->save();

        $message = ['type'=>'success','message'=>'User has been updated successfully'];
        Session::flash('message',$message);

        return redirect('dashboard/users');



    }

    public function updateprofile(){
        $data['user'] = Users::findOrFail(Auth::user()->id);
        return view('admin.users.update')->withData($data);
    }

    public function updatestore(Request $request){

        $user = $data['user'] = Users::findOrFail(Auth::user()->id);
        // validating 
        $this->validate($request, [
            'name' =>'required|min:3',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile('image')){

                File::delete(public_path('images/'.$user->image));
                $image =  'avatar'.Auth::user()->id . time().'.'.$request->image->extension(); 
                $request->image->move(public_path('images'), $image);
                
        }else{
                $image = $user->image;
        }

        $user->name = $request->name;
        if($request->password!=""){
        $user->password = Hash::make($request->password);
        }
        $user->image = $image;

        if(Auth::user()->role=='manager'){
        $user->footer = $request->footer;
        }
        $user->save();


        $message = ['type'=>'success','message'=>'Account information has been updated successfully'];
        Session::flash('message',$message);

        return redirect('dashboard');

    }

    function verification(Request $request){


        $id = Auth::user()->id;
        $invalid_number = false;
        if($request->has('send_code')){

            $attempt_timing = strtotime(Auth::user()->verification_attempt_time) + (24*3600);
            // return [Auth::user()->verification_attempt>=3];
            if(time()>$attempt_timing && Auth::user()->verification_attempt>=3){

                $user_update_attempt = Users::findOrFail($id);
                $user_update_attempt->verification_attempt = 0;
                $user_update_attempt->save();

            }

            $operators = ['013','014','015','016','017','018','019'];
            $operator = substr(Auth::user()->email,0,3);

            if (in_array($operator, $operators)) {
                if (Auth::user()->verification_attempt<3 && Auth::user()->verfication == 0) {
                    // send code here

                    $the_new_code = rand(111111, 999999);

                    $user_code_update = Users::find($id);
                    $user_code_update->verification_token = $the_new_code;
                    $user_code_update->verification_attempt = Auth::user()->verification_attempt+1;
                    $user_code_update->verification_attempt_time = date('Y-m-d H:i:s');
                    $user_code_update->save();


                    /* SMS */ 

                                        
                    //POST Method example
                    /*
                    $url = "http://66.45.237.70/api.php";
                    $number="88017,88018,88019";
                    $text="Please use the code - ".$the_new_code.' for Jekuno.com verification.';
                    $data= array(
                    'username'=>"01811525626",
                    'password'=>"TG32NYS6",
                    'number'=>Auth::user()->email,
                    'message'=>$text
                    );

                    $ch = curl_init(); // Initialize cURL
                    curl_setopt($ch, CURLOPT_URL,$url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $smsresult = curl_exec($ch);
                    $p = explode("|",$smsresult);
                    $sendstatus = $p[0];
                    */


                    /* SMS */

                    return redirect('verification');
                }
            }else{
                $invalid_number = true;
            }




        }
        // return Auth::user()->verification;
        if(Auth::user()->verification == 1){
            
            $data['process'] = 200;

        }elseif(Auth::user()->verification_attempt>=3){
            $data['process'] = 403;
            $data['process_time'] = date('d F Y, h:i A',strtotime(Auth::user()->verification_attempt_time) + (24*3600));
        }else if($invalid_number == true){
            $data['process'] = 401;
        }
        else{
            $data['process'] = 302;
        }

        return view('website.user.verification')->withData($data);

    }

    function verify(Request $request){

        $this->validate($request,[
            'code' => 'required|numeric|digits:6'
        ]);

        
        if (Auth::user()->verification_token == $request->code) {
            // return [Auth::user()->verification_token == $request->code];
            
            $u_update = Users::findOrFail(Auth::user()->id);
            $u_update->verification = 1;
            $u_update->save();
            $message = ['type'=>'success','message'=>'Your account has verified successfully.'];
    
            Session::flash('message',$message);
            return redirect('my-account');
        }else{
            $message = ['type'=>'error','message'=>'Your submitted code doesn\'t match.'];
        
        Session::flash('message',$message); 
        return redirect('verification');
        }

    }


    function set_default_delivery(Request $request){

        $delivery_charge = 60;
        if($request->type == 'inside-dhaka'){
            $delivery_charge = 60;
        }else{
            $delivery_charge = 120;
        }
    
        $uUp = Users::findOrFail(Auth::user()->id);
        $uUp->defaut_delivery_option = $request->type;
        $uUp->save();

        $delivery = ['status'=>'true','type'=>$request->type,'charge'=>$delivery_charge];
        session()->put('delivery', $delivery);

        return response()->json($delivery);
    }


    public function downloads(Request $request){
        $data['orders'] = Orders::where('user',Auth::user()->id)->paginate(20);
        return view('website.download')->withData($data);
    }

    public function downloads_item($id){

        $order = Orders::where('id',$id)->get();

        if($order->count() == 0){

            $message = ['type'=>'error','message'=>'Purchase not found'];
            Session::flash('message',$message);
            return redirect('downloads');
        }

        $order = $order[0];

        if($order->user != Auth::user()->id){
            $message = ['type'=>'error','message'=>'Purchase not found'];
            Session::flash('message',$message);
            return redirect(url('/'));
        }

        $product = Products::findOrFail($order->product);

        $make_file = 'inihub-'.$order->id.'-'.make_slug($product->name);

        $private_direcory = 'assets/private/files/';
        $admin_directory = $private_direcory.'administration/';
        $user_directory = $private_direcory.'user/';


        $origin_file = $admin_directory.$product->file; 
        

        $find = ["{{product_name}}","{{product_url}}","{{license_type}}","{{key}}","{{purchase_date}}"];
        $repo = [$product->name,url('product/'.make_slug($product->name).'/'.$product->id),license_name($order->type),$order->license,$order->created_at];
        
        // writting license file
        $license_content = $admin_directory.'license.txt';
        $get_license_content = \file_get_contents($license_content);
        $chnage_license_conetnt = str_replace($find,$repo,$get_license_content);
        $license_file = 'inihub-'.$order->id.'-license-information.txt';
        $destination_license_file = $user_directory.$license_file;
        
        if (!file_exists($destination_license_file)) {
            \file_put_contents($destination_license_file, $chnage_license_conetnt);
        }
        // writting license file


        $filinfo = pathinfo($product->file);

        $new_file = $user_directory . $make_file . '.' . $filinfo['extension'];
        
        if (!file_exists($new_file)) {
            File::copy($origin_file, $new_file);
        }


        $zip_filename = 'inihub-'.make_slug($product->name).'-'.$order->id . '.zip';
        $zip_file = $zip_filename;
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $zip->addFile($new_file,basename($new_file));
        $zip->addFile($destination_license_file,basename($destination_license_file));
        $zip->close();



        return response()->download($zip_file);

        
    }

    
    public function my_account(){

        /*
        if(Auth::user()->verification == 0){
            
            return redirect('verification');
        }
        */

        return view('website.user.myaccount');
    }

    
    public function my_orders(){


        if (!Auth::check()) {
            return redirect('login');
        }

        $data['parameter'] = request()->segments();

    
        $data['orders'] = Invoices::orderBy('id','DESC')->where(['user'=>Auth::user()->id])->paginate(10);

        return view('website.orders')->withData($data);
        

    }

    public function deposit(Request $request){

        if($request->has('submit') && $request->submit == "true"){

        }
        return view('website.user.deposit');
    }

    public function depositSubmit(Request $request){

        $this->validate($request,[
            'type'      =>  'required',
            'from_number'      =>  'required',
            'amount'      =>  'required|numeric',
            'points'      =>  'required|numeric',
            'agree'     =>  'required'
        ]);


        
        $deposit["type"] = $request->type;
        $deposit["from_number"] = $request->from_number;
        $deposit["amount"] = $request->amount;
        $deposit["points"] = $request->amount * 100;
        // $deposit["charge"] = ceil($request->amount * 5) / 100;
        // $deposit["total"] = $deposit["amount"] + $deposit["charge"];
        session()->put('deposit', $deposit);

        
        return redirect('deposit-preview');
    }

    public function depositPreview(){
        return view('website.user.deposit-preview');
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

     public function dotask(Request $request){

        $ipdata = Session::put('ip');
        $ip = request()->ip();

        if(is_null($ipdata) || $ipdata!=$ip){

            $location_URL = 'http://ip-api.com/json/'. $ip;
            $location_JSON = json_decode($this->scrap($location_URL));
            if ($location_JSON->status == 'success') {
                if($location_JSON->countryCode == "BD"){
                    Session::put('ip', $ip);
                    if(Auth::check()){
                        $ipc = Iptables::where('ip',$ip)->where('browser',$_SERVER['HTTP_USER_AGENT'])->get();

                        if($ipc->count() > 0 ){
                            $ipdbinfo = $ipc[0];
                            if($ipdbinfo->user != Auth::user()->id){
                                $msg = ['message'=>'Multiple user login prohabited!'];
                                return response()->json($msg);               
                            }
                        }else{
                            $ips = new Iptables;
                            $ips->user = Auth::user()->id;
                            $ips->ip = $ip;
                            $ips->browser = $_SERVER['HTTP_USER_AGENT'];
                            $ips->save();
                        }
                    }
                }else{
                    $msg = ['message'=>'You can\'t access this page without accepted country!'];
                    return response()->json($msg);
                }
            }

        }

        $data['err_message'] = NULL;

        $data['message'] = 'normal';
        $data['categories'] = Categories::get();
        $data['recent_products'] = Products::orderBy('created_at','DESC')->take(20)->get();
        $data['suggested_products'] = Products::where('pinned',1)->orderBy('created_at','DESC')->take(6)->get();
        $data['popular_products'] = Products::orderBy('sales','DESC')->take(20)->get();

        
        $info = [];
        $data['task_count'] = 0;

        if (Auth::check()) {
                
            if($request->has('complete') && $request->has('task_id') && $request->has('token')){
                $info['response'] = 'success';
                $approve_time = Session::get('claim_time');

                if($approve_time == null){
                    $info['response'] = 'failed';
                }
                else if(time()>$approve_time){

                    $task_id = $request->task_id;
                    $task_find = Products::where('id',$task_id)->get();
                    if($task_find->count() == 0){
                        $info['response'] = 'failed';
                    }else{
                        $the_task = $task_find[0];
                        $token_meta = $the_task->name . $the_task->id . $the_task->preview_url . $the_task->created_at;
                        $task_hash = md5($token_meta);
                        $requested_token = $request->token;
                        if($task_hash != $requested_token){
                            $info['response'] = 'failed';
                        }

                        
                    }

                    $taskinfo = $task_find[0];

                    $order_count = Orders::whereRaw('DATE(created_at) = ?', [Carbon::now()->format('Y-m-d')] )->where('user',Auth::user()->id)->where('product',$taskinfo->id)->get();
                    if($order_count->count() >0){
                        $info['response'] = 'failed';
                    }


                }else{
                    $info['response'] = 'failed';
                }


                
                if($info['response'] == 'success'){


                    
                    
                    
                    $userUpdate = Users::findOrFail(Auth::user()->id);
                    $point = $userUpdate->point + $taskinfo->price;
                    $userUpdate->point = $point;
                    $userUpdate->save();
                    
                    
                    // update the task
                    $old_sales = $taskinfo->sales;
                    $old_amount_sold = $taskinfo->amount_sold;
                    
                    $new_sales = $old_sales + 1;
                    $new_amount_sold = $old_amount_sold + $taskinfo->price;
                    
                    $remain = $taskinfo->budget - $new_amount_sold;
                    
                    $c_task = Products::findOrFail($taskinfo->id);
                    
                    if($remain < $taskinfo->price){
                        $c_task->status = 1;
                    }
                    $c_task->sales = $new_sales;
                    $c_task->amount_sold = $new_amount_sold;
                    $c_task->save();
                    
                    // order entry
                    $orderUpdate = new orders;
                    $orderUpdate->user = Auth::user()->id;
                    $orderUpdate->product = $taskinfo->id;
                    $orderUpdate->price = $taskinfo->price;
                    $orderUpdate->save();
                    
                    $message = ['type'=>'success','message'=>'Task has been completed and verified successfully, '.$taskinfo->price.' point has added to your account.'];

                    Session::flash('message',$message);
                    return redirect(url('/dotasks'));


                }else{
                    $message = ['type'=>'error','message'=>'There is an error during completing the task.'];
                    Session::flash('message',$message);
                    return redirect(url('/dotasks'));

                }

            }

            $tasks = DB::table('products')
            ->where('status',0)
            ->where('user','!=',Auth::user()->id)
            ->get();

            foreach($tasks as $task){
                $order = Orders::whereRaw('DATE(created_at) = ?', [Carbon::now()->format('Y-m-d')] )->where('user',Auth::user()->id)->where('product',$task->id)->get();
                // $order = Orders::where('user',Auth::user()->id)->where('product',$task->id)->get();
                if($order->count() == 0){
                    $data['task_count'] = 1;
                    $data['task'] = $task;
                    continue;

                    // return $task->id;
                }
            }

            if($request->has('task') && $data['task_count']>0){


                $info['id'] = $data['task']->id;
                $info['name'] = $data['task']->name;
                $info['product_type'] = $data['task']->product_type;
                $info['reward'] = $data['task']->price;
                $info['duration'] = $data['task']->duration;
                $info['open_type'] = $data['task']->checkout_type;
                // $info['open_type'] = $data['task']->checkout_type;
                return response()->json($info);
            }

            

            }

            if (!$this->canaccess()) {
                $data['err_message'] = '<div class="alert alert-danger">You will not get task without google chrome and windows/android.</div>';
                $data['task_count'] = 0;
                $message = ['message' => 'You will not get task without google chrome and android.'];
                return response()->json($message);
            }


            return view('website.user.dotask')->withData($data);



     }

    public function newtask(){
        $data['categories'] = Categories::get();
        return view('website.user.newtask')->withData($data);
    }

    public function storetask(Request $request){

        
        $this->validate($request,[
            'name'      =>  'required|min:3',
            'category'     =>  'required',
            'subcategory'  =>  'required',
            'type'      =>  'required',
            'price'      =>  'required|numeric|min:10',
            'duration'      =>  'required|numeric|min:6',
            'budget'      =>  'required|numeric|min:1000',
            'netfee'      =>  'required|numeric|min:50',
            'preview_url'      =>  'required',
        ]);

        $name = $request->name;
        $category = $request->category;
        $subcategory = $request->subcategory;
        $type = $request->type;
        $price = $request->price;
        $getduration = $request->duration;
        $budget = $request->budget;
        $getnetfee = $request->netfee;
        $preview_url = $request->preview_url;
        $description = $request->description;
        $netfee = ($budget / 100) * 5;
        $duration = $price*6;

        $available_point = Auth::user()->point - $netfee;

        if($available_point<$budget){

            $message = ['type'=>'error','message'=>'You don\'t have enough points, your budget is '.$budget.' and your available point is '.$available_point. ' after netword free for this budget. Please add point and try again for publish the task.'];
        
            Session::flash('message',$message); 
            return redirect()->back();

        }

        $newtask = new Products;
        $newtask->name = $name;
        $newtask->category = $category;
        $newtask->subcategory = $subcategory;
        $newtask->product_type = $type;
        $newtask->price = $price;
        $newtask->duration = $duration;
        $newtask->preview_url = $preview_url;
        $newtask->checkout_type = 'newwindow';
        $newtask->budget = $budget;
        $newtask->description = $description;
        $newtask->user = Auth::user()->id;
        $newtask->save();

        // now cut off the points from user account //

        $oldPoint = Auth::user()->point;
        $newPoint = $oldPoint-$budget-$netfee;
        $user = Users::findOrFail(Auth::user()->id);
        $user->point = $newPoint;
        $user->save();

        // now cut off the netfee for the user


        $netfeeTaka = $netfee/100;

        
        $transaction = new Transactions;
        $transaction->type = 'debit';
        $transaction->user = Auth::user()->id;
        $transaction->role = Auth::user()->role;
        $transaction->balance = Auth::user()->balance;
        $transaction->paid = $netfeeTaka;
        $transaction->new_balance = Auth::user()->balance;
        $transaction->method = 'fee';
        $transaction->status = 1;
        $transaction->save();


        $message = ['type'=>'success','message'=>'Your campaign has added successfully.'];
        Session::flash('message',$message); 
        return redirect('my-account');


    }
    public function edittask($id){
        $data['categories'] = Categories::get();
        return view('website.user.newtask_edit')->withData($data);
    }

    public function mytask(){

        $tasks = Products::where('user', Auth::user()->id)->paginate(5);
        return view('website.user.mytask', compact(['tasks']));
    }

    public function mytask_details($id){
        return view('website.user.mytask_details');
    }

    public function depositConfirm(){
       $deposit = session()->get('deposit');
       $encode = 'type='.$deposit['type'] . '&amount='.$deposit['amount'] . '&from_number='.$deposit['from_number'] . 'points='.$deposit['points'];
        $url = url('deposit-success/?response='.base64_encode($encode));
        
        return redirect($url);
    }

    public function depositSuccess(Request $request){
            
        $response = [];

        
        if($request->has('response')){
            $response  = base64_decode($request->response);

            $amount = get_string_between($response,'&amount=','&charge=');
            $from_number = get_string_between($response,'&from_number=','&points=');
            $type = get_string_between($response,'&from_number=','&points=');

        

            $deposit = session()->get('deposit');

            // if($amount!=$deposit['amount']){
            //     $message = ['type'=>'error','message'=>'There is an error'];
        
            //     Session::flash('message',$message); 
            //     return redirect('deposit');
            // }

            $deposit_amount = $deposit['amount'];
            $from_number = $deposit['from_number'];


            

            $transaction = new Transactions;
            $transaction->type = 'credit';
            $transaction->user = Auth::user()->id;
            $transaction->role = Auth::user()->role;
            $transaction->balance = 0;
            $transaction->paid = $deposit_amount;
            $transaction->note = $from_number;
            $transaction->new_balance = 0;
            $transaction->method = $deposit['type'];
            $transaction->status = 0;
            $transaction->save();

            session()->forget('deposit');
            


        }

            $message = ['type'=>'success','message'=>'Your request has sent successfully.'];
        
            Session::flash('message',$message); 

        return redirect('my-account');
    }

    // rating 
    public function ratings($id){
        
        $data['order'] = $order = Orders::findOrFail($id);
        if($order->user != Auth::user()->id ){
            $message = ['type'=>'error','message'=>'Order not found.'];
        
            Session::flash('message',$message); 
            return redirect(url('downloads'));
        }

        $ratings_count = Ratings::where('order_id',$id)->get()->count();
        if($ratings_count>0){
            $message = ['type'=>'error','message'=>'You already gave ratings on this purcahse.'];
        
            Session::flash('message',$message); 
            return redirect(url('downloads'));
        }

        $data['product'] = $product = Products::findOrFail($order->product);

        return view('website.rating',compact(['product','order']));
    }

    // submit rating

    public function submit_rating(Request $request, $id){
                
        $data['order'] = $order = Orders::findOrFail($id);
        if($order->user != Auth::user()->id ){
            $message = ['type'=>'error','message'=>'Order not found.'];
        
            Session::flash('message',$message); 
            return redirect(url('downloads'));
        }

        $ratings_count = Ratings::where('order_id',$id)->get()->count();
        if($ratings_count>0){
            $message = ['type'=>'error','message'=>'You already gave ratings on this purcahse.'];
        
            Session::flash('message',$message); 
            return redirect(url('downloads'));
        }


        $this->validate($request,[
            'agree'      =>  'required',
            'rating'      =>  'required|numeric'
        ]);


        $rating = new Ratings;
        $rating->user = Auth::user()->id;
        $rating->product = $order->product;
        $rating->order_id = $order->id;
        $rating->rating = $request->rating;
        $rating->comment = $request->comment;
        $rating->save();

        $message = ['type'=>'success','message'=>'Your rating has submitted successfully.'];
        
        Session::flash('message',$message); 
        return redirect(url('downloads'));




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

    function go($id){

        $ipdata = Session::put('ip');
        $ip = request()->ip();

        if(is_null($ipdata) || $ipdata!=$ip){

            $location_URL = 'http://ip-api.com/json/'. $ip;
            $location_JSON = json_decode($this->scrap($location_URL));
            if ($location_JSON->status == 'success') {
                if($location_JSON->countryCode == "BD"){
                    Session::put('ip', $ip);
                    if(Auth::check()){
                        $ipc = Iptables::where('ip',$ip)->where('browser',$_SERVER['HTTP_USER_AGENT'])->get();

                        if($ipc->count() >0 ){
                            $ipdbinfo = $ipc[0];
                            if($ipdbinfo->user != Auth::user()->id){
                                $msg = ['message'=>'Multiple user login prohabited!'];
                                return response()->json($msg);               
                            }
                        }else{
                            $ips = new Iptables;
                            $ips->user = Auth::user()->id;
                            $ips->ip = $ip;
                            $ips->browser = $_SERVER['HTTP_USER_AGENT'];
                            $ips->save();
                        }
                    }
                }else{
                    $msg = ['message'=>'You can\'t access this page without accepted country!'];
                    return response()->json($msg);
                }
            }

        }
                
        $message = ['message'=>'you can\'t access this page without google chrome and windows'];
        // if (Auth::check() && Auth::user()->role != 'superadmin') {
            if (!$this->canaccess()) {
                return response()->json($message);
            }
        // }

        
        
        $product = Products::findOrFail($id);
        
        $time = time() + $product->duration;
        Session::put('claim_time', $time);
        
        $url = $product->preview_url;
        if(strtolower($product->product_type) == "website"){
            $url = $product->preview_url.'/?t='.time().'-'.$product->id.'-'.$product->duration.'-'.$product->page_visit.'-'.Auth::user()->id.'-'.uniqid();
        }

        $redirects = [
            'https://l.facebook.com/l.php?u={{url}}&h=AT1-OV-4JrWXzyWFkFUcN4UrMWv_bd3yhUaHhHWIDBsmK-yGiKx1pqhPv7c8C_0w6-KmZp62rCFiWlT5UbHoWAPXub8hccUkjdlCxvXCKQUwLeGGt7Bsk-SF0bYo3f-fYDAaYw',
            'https://l.instagram.com/?u={{url}}&e=ATMXunKIbWatQDPPCyEjFnoR-EcI0E0SuZBpAt3KY_ERtu1-f_qucbKI6r2pLaDaAFr8MakjDvO3EUQgqTtToQ&s=1'
        ];
        shuffle($redirects);
        
        $social = $redirects[0];
        $go_url = str_replace('{{url}}',urlencode($url),$social);
        return redirect($go_url);
        
    }


    public function convertpoints(){
        return view('website.convert');
    }


    public function convertaction(){


        if(Auth::user()->point<1){

            $message = ['type'=>'error','message'=>'0 point can\'t be convert.'];
    
            Session::flash('message',$message);  
            return redirect()->back();
        }


    
        $taka = Auth::user()->point/100;

        $netFee = ($taka/100)*5;

        $newTaka = $taka - $netFee;

        $newBalance = Auth::user()->balance +  $newTaka;
   
        $user = Users::findOrFail(Auth::user()->id);
        $user->point = 0;
        $user->balance = $newBalance;
        $user->save();

        $transaction = new Transactions;
        $transaction->type = 'debit';
        $transaction->user = Auth::user()->id;
        $transaction->role = Auth::user()->role;
        $transaction->balance = 0;
        $transaction->paid = $netFee;
        $transaction->new_balance = 0;
        $transaction->method = 'fee';
        $transaction->status = 1;
        $transaction->save();

        $transaction = new Transactions;
        $transaction->type = 'credit';
        $transaction->user = Auth::user()->id;
        $transaction->role = Auth::user()->role;
        $transaction->balance = Auth::user()->balance;
        $transaction->paid = $newTaka;
        $transaction->new_balance = $newBalance;
        $transaction->method = 'convert';
        $transaction->status = 1;
        $transaction->save();

        
        $message = ['type'=>'success','message'=>'Your point has been converted and your new balace is '.$newBalance. ' taka.'];
    
        Session::flash('message',$message);  
        return redirect('my-account');

    }

    
    public function paymentmethod(){
        return view('website.user.payment_method');
    }


    public function paymentmethodsave(Request $request){
        
        $this->validate($request,[
            'method'      =>  'required',
            'account'      =>  'required|numeric'
        ]);


        $user =  Users::findOrFail(Auth::user()->id);
        $user->payment_account = $request->account;
        $user->payment_method = $request->method;
        $user->save();

                
        $message = ['type'=>'success','message'=>'Your payment information has updated successfully.'];
    
        Session::flash('message',$message);  
        return redirect('my-account');


    }

    public function withdrawrequest(){



        if(Auth::user()->balance<10){

            $message = ['type'=>'error','message'=>'You can\'t make a withdraw request less then 10 taka.'];
    
            Session::flash('message',$message);  
            return redirect()->back();
        }



        $findExisitngInvoice = Invoices::where('user',Auth::user()->id)->where('status',0)->get();
        if($findExisitngInvoice->count() > 0){
            
            $message = ['type'=>'error','message'=>'You have already a ongoing payment request, wait till sattle the payment.'];
    
            Session::flash('message',$message);  
            return redirect()->back();
        }

        $invoice = new Invoices;
        $invoice->user = Auth::user()->id;
        $invoice->total = Auth::user()->balance;
        $invoice->payment_type = 'withdraw';
        $invoice->save();


        $message = ['type'=>'success','message'=>'A payment request has been sent to the accounts section, we will review and sattle it soon.'];
    
        Session::flash('message',$message);  
        return redirect('my-account');

        

    }

    public function claim($id){

        $product = Products::findOrFail($id);

        $find_existing = Orders::where('product',$id)->where('user',Auth::user()->id)->whereRaw('date(created_at) = ?',  Carbon::now()->format('Y-m-d') )->get();

        if($find_existing->count() >0){
            $message = ['type'=>'error','message'=>'Your already claimed this task.'];
    
            Session::flash('message',$message);  
            return redirect()->back();
        }

        $newOrder = new Orders;
        $newOrder->user = Auth::user()->id;
        $newOrder->product = $id;
        $newOrder->price = $product->price;
        $newOrder->save();

        $userUpdate = Users::findOrFail(Auth::user()->id);
        $point = $userUpdate->point + $product->price;
        $userUpdate->point = $point;
        $userUpdate->save();
        
        
        $message = ['type'=>'success','message'=>'Your task reward '.$product->point.' has claimed successfully.'];
        Session::flash('message',$message); 
        return redirect(url('/'));

        
    }


    /* destroy users */
    public function destroy($id){
        if (Auth::user()->role!='superadmin'){
            return response()->json(['data'=>['message'=>'403 Access Denied!']]);
        }
        if ($id==1){
            return response()->json(['data'=>['message'=>'403 Access Denied!']]);
        }
        $user = Users::findOrFail($id);
        $delete = $user->delete();
        
        return response()->json(['data'=>['message'=>'User has been deleted successfully!']]);


    }


/* end of destroy users */


}
