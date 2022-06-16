<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Cupons;
use App\Invoices;
use App\Iptables;
use App\Orders;
use App\Products;
use App\Subcategories;
use App\Transactions;
use App\Users;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $tmp_dir = public_path('assets/private/files/user/');
        $files = glob($tmp_dir . '*');
        $file_time = time() - 1800;
        foreach ($files as $file) {
            if (is_file($file) && filemtime($file) < $file_time) {
                @unlink($file);
            }
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        // return [Session::get('affiliate')];

        if (!Auth::check()) {
            return redirect('/login');
        }

        $ip = $request->ip();
        $user_agent = $request->header('User-Agent');
        $location_URL = 'http://ip-api.com/json/' . $ip;
        $location_JSON = json_decode($this->scrap($location_URL));

        $countrCode = $location_JSON->countryCode;

        $noVPNList = ['BD', 'IN', 'PK'];
        if (!in_array($countrCode, $noVPNList)) {

            Auth::logout();
            $message = ['type' => 'error', 'message' => 'Sorry we do not support your country yet.'];
            Session::flash('message', $message);
            return redirect('/');
        }

        $check_ip = Iptables::where('ip', $ip)->where('browser', $user_agent)->get();
        if ($check_ip->count() > 0) {
            $userInfo = Users::where('id', $check_ip->first()->user)->get();
            if (Auth::user()->email != $userInfo->first()->email) {
                Auth::logout();
                $message = ['type' => 'error', 'message' => 'You can only login with ' . $userInfo->first()->email . ', please login with this email.'];
                Session::flash('message', $message);
                return redirect('/');
            }

        }

        if (Session::get('affiliate')) {

            $affiliate = Session::get('affiliate');

            if (Auth::check()) {

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

        $ipEntry = new Iptables;
        $ipEntry->ip = $request->ip();
        $ipEntry->browser = $request->header('User-Agent');
        $ipEntry->user = Auth::user()->id;
        $ipEntry->save();

        $redirect = session()->get('redirect');
        if ($redirect) {
            $redirect_to = session('redirect');
            session()->forget('redirect');
            return redirect($redirect_to);
        }

        if (Auth::user()->role == 'user') {
            return redirect(url('/'));
        }

        return redirect('dashboard');

    }

    public function scrap($url)
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $html = curl_exec($curl);
        curl_close($curl);

        return $html;
    }

    public function reffer($id)
    {

        if (!Auth::check()) {
            $userFind = Users::where('id', $id)->get();
            if ($userFind->count() > 0) {
                Session::put('affiliate', $id);

                // return [Session::get('affiliate')];
            }
        }

        return redirect('signup');
    }

    public function DeviceAccess($browser)
    {
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (substr_count($ua, $browser) == 0) {
            return false;
        }

        return true;

    }

    public function signup(Request $request)
    {

        if (Auth::check()) {
            return redirect('/');
        }

        if ($this->DeviceAccess('chrome') == false) {
            $title = 'We only Support Chrome';
            $message = "Please browse this page using Google Chrome.";
            return view('error', compact(['title', 'message']));
        }

        $user_agent = $request->header('User-Agent');

        $ip = $request->ip();
        $user_agent = $request->header('User-Agent');
        $location_URL = 'http://ip-api.com/json/' . $ip;
        $location_JSON = json_decode($this->scrap($location_URL));

        $countrCode = $location_JSON->countryCode;

        $noVPNList = ['BD', 'IN', 'PK'];
        if (!in_array($countrCode, $noVPNList)) {

            $message = ['type' => 'error', 'message' => 'Sorry we do not support your country yet.'];
            Session::flash('message', $message);
            return redirect('/');
        }
        // check ip and user agent
        $check_ip = Iptables::where('ip', $ip)->where('browser', $user_agent)->get();
        if ($check_ip->count() > 0) {

            $userInfo = Users::where('id', $check_ip->first()->user)->get();
            $message = ['type' => 'error', 'message' => 'You have already registered with ' . $userInfo->first()->email . ' please login with this email.'];
            Session::flash('message', $message);
            return redirect('/');
        }

        return redirect('register');

        return [$ip, $user_agent];
    }

    public function canaccess()
    {
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (substr_count($ua, 'chrome') == 0) {
            return false;
        }
        // if(substr_count($ua,'windows') == 0 && substr_count($ua,'android') == 0){
        if (substr_count($ua, 'android') == 0) {
            return false;
        }
        // if(substr_count($ua,'android') == 0){
        //     return false;
        // }
        return true;

    }
    public function check_access()
    {

        $message = ['message' => 'you can\'t access this page without google chrome and windows'];
        if (Auth::check() && Auth::user()->role != 'superadmin') {
            if (!$this->canaccess()) {
                return response()->json($message);
            }
        }
    }

    public function track(Request $request, $rand)
    {

        if ($request->has('t')) {

            $trackT = $request->t;
            Session::put('t', $trackT);

            return redirect(url('track/verify'));
        } else {
            $message = ['type' => 'error', 'message' => 'Sorry, something wrong!'];

            Session::flash('message', $message);
            return redirect(url('dotasks/Website'));
        }

    }

    public function track_verify()
    {

        if (!Auth::check()) {

            $message = ['type' => 'error', 'message' => 'You are maybe not logged in'];

            Session::flash('message', $message);
            return redirect('my-account');
        }

        $trackT = Session::get('t');
        // $visit = Session::get('v');

        $explodeTrack = explode('-', $trackT);
        $product = Products::findOrFail($explodeTrack[1]);

        // return[$explodeTrack,$visit];

        if ($product->duration == $explodeTrack[2] && $product->page_visit == $explodeTrack[3] && Auth::user()->id == $explodeTrack[4]) {

            // confirm the task

            $userUpdate = Users::findOrFail(Auth::user()->id);
            $reward_amount = $product->price;
            $point = $userUpdate->point + $reward_amount;
            $userUpdate->point = $point;
            $userUpdate->save();

            $old_sales = $product->sales;
            $old_amount_sold = $product->amount_sold;

            $new_sales = $old_sales + 1;
            $new_amount_sold = $old_amount_sold + $reward_amount;

            $remain = $product->budget - $new_amount_sold;

            $product->sales = $new_sales;
            $product->amount_sold = $new_amount_sold;

            if ($remain <= $product->price) {
                $product->status = 1;
            }

            $product->save();

            // order entry
            $orderUpdate = new Orders;
            $orderUpdate->user = Auth::user()->id;
            $orderUpdate->product = $product->id;
            $orderUpdate->price = $reward_amount;
            $orderUpdate->task_type = $product->product_type;

            // do something for reffer

            if (!is_null(Auth::user()->affiliate)) {

                $orderUpdate->affiliate = Auth::user()->affiliate;

                $aff_reward = ($reward_amount / 100) * 5;

                $aff_user = Users::findOrFail(Auth::user()->affiliate);
                $aff_points = $aff_user->point;
                $new_point_with_aff = $aff_points + $aff_reward;
                $aff_user->point = $new_point_with_aff;
                $aff_user->save();

                $affPromoteCharge = $aff_reward / 100;

                // $note = 'fee for a complete subscribe action for task id #'.$taskinfo->id. ' and completed user '.Auth::user()->name . ' ID #'.Auth::user()->id;

                $transaction = new Transactions;
                $transaction->type = 'debit';
                $transaction->user = 0;
                $transaction->role = 'affiliate';
                $transaction->balance = 0;
                $transaction->paid = -abs($affPromoteCharge);
                $transaction->new_balance = 0;
                $transaction->method = 'fee';
                // $transaction->note = $note;
                $transaction->status = 1;
                $transaction->save();

            }

            $orderUpdate->save();

            $message = ['type' => 'success', 'message' => 'task completed successfully.'];
            Session::flash('message', $message);
            return redirect(url('dotasks/' . $product->product_type));

            // confirm the task

        } else {
            $message = ['type' => 'error', 'message' => 'we did not found any valid task for you!'];
            Session::flash('message', $message);
            return redirect(url('dotasks/' . $product->product_type));
        }

    }

    public function front(Request $request, $type = null)
    {

        // Session::put('claim_time', $time);

        $data['err_message'] = null;

        $data['message'] = 'normal';
        $data['categories'] = Categories::get();
        $data['recent_products'] = Products::orderBy('created_at', 'DESC')->take(20)->get();
        $data['suggested_products'] = Products::where('pinned', 1)->orderBy('created_at', 'DESC')->take(6)->get();
        $data['popular_products'] = Products::orderBy('sales', 'DESC')->take(20)->get();

        $data['paid_total'] = Invoices::where('status', 1)->where('payment_type', 'withdraw')->sum('total');

        $data['modified_time'] = '1615289554';
        $data['title'] = '';
        if ($type == '6faca6101d67946abb67669efa143e41') {
            $data['message'] = 'ok';
            return response()->json($data);
        } elseif ($type != null) {
            return response()->json(['message' => '403 forbidden']);
        }

        // if (Auth::user()->role == 'user') {

        // }
        $data['task_count'] = DB::table('products')
            ->where('status', 0)
            ->get()->count();

        // if (Auth::check() && Auth::user()->role != 'superadmin') {
        if (!$this->canaccess()) {
            $data['err_message'] = '<div class="alert alert-danger">You will not get task without google chrome and windows/android.</div>';
            // $data['task_count'] = 0;
            $message = ['message' => 'You will not get task without google chrome and android.'];
            // return response()->json($message);
        }

        $data['orders'] = Invoices::orderBy('id', 'desc')->paginate(50);
        // }

        return view('website.index')->withData($data);
    }

    public function product(Request $request, $name, $id, $type = null)
    {
        $data['message'] = 'normal';
        $data['categories'] = Categories::get();
        $data['product'] = Products::findOrFail($id);
        $data['recent_products'] = Products::orderBy('created_at', 'DESC')->take(20)->get();
        $data['popular_products'] = Products::orderBy('sales', 'DESC')->take(20)->get();
        $data['title'] = $data['product']->name;
        $data['description'] = substr($data['product']->description, 0, 155);
        $data['keywords'] = $data['product']->name;
        $data['og_image'] = url('images/uploads/' . $data['product']->thumbnail);
        $data['modified_time'] = strtotime($data['product']->updated_at);

        $keys = explode(' ', $data['product']->name);
        $keyword_count = count($keys);
        foreach ($keys as $key => $keyword) {
            if ($key != $keyword_count) {
                $data['keywords'] .= ", ";
            }
            $data['keywords'] .= $keyword;
        }

        $info = [];
        $data['task_count'] = 0;

        if ($request->has('raw')) {
            return count(session()->get('cart'));
        }
        if ($type == '6faca6101d67946abb67669efa143e41') {
            $data['message'] = 'ok';
            return response()->json($data);
        } elseif ($type != null) {
            return response()->json(['message' => '403 forbidden']);
        }

        $hyphen_name = strtolower(preg_replace('#[ -]+#', '-', $data['product']->name));
        if ($name != $hyphen_name) {
            abort(404);
        }

        return view('website.product')->withData($data);
    }

    public function category(Request $request, $slug, $type = null)
    {
        $cateF = Categories::where(['slug' => $slug])->get();
        if ($cateF->count() == 0) {
            abort(404);
        }
        $data['categories'] = Categories::take(12)->get();
        $data['category'] = Categories::findOrFail($cateF[0]->id);
        $data['products'] = Products::where(['category' => $data['category']->id])->paginate(12);
        $data['title'] = $data['category']->name;
        if ($type == '6faca6101d67946abb67669efa143e41') {
            $data['message'] = 'ok';
            return response()->json($data['products']);
        } elseif ($type != null) {
            return response()->json(['message' => '403 forbidden']);
        }
        return view('website.category')->withData($data);
    }

    public function about_us()
    {
        $data['language'] = $this->language;
        $data['side_categories'] = Categories::take(12)->get();
        $data['hidden_categories'] = Categories::skip(12)->take(50)->get();
        $data['categories'] = $data['drop_categories'] = Categories::get();
        $data['hide_side_category'] = true;
        return view('website.about')->withData($data);
    }

    public function contact_us()
    {
        $data['language'] = $this->language;
        $data['side_categories'] = Categories::take(12)->get();
        $data['hidden_categories'] = Categories::skip(12)->take(50)->get();
        $data['categories'] = $data['drop_categories'] = Categories::get();
        $data['hide_side_category'] = true;
        return view('website.contact')->withData($data);
    }

    public function tos()
    {
        $data['language'] = $this->language;
        $data['side_categories'] = Categories::take(12)->get();
        $data['hidden_categories'] = Categories::skip(12)->take(50)->get();
        $data['categories'] = $data['drop_categories'] = Categories::get();
        $data['hide_side_category'] = true;
        return view('website.tos')->withData($data);
    }

    public function privacy()
    {
        $data['language'] = $this->language;
        $data['side_categories'] = Categories::take(12)->get();
        $data['hidden_categories'] = Categories::skip(12)->take(50)->get();
        $data['categories'] = $data['drop_categories'] = Categories::get();
        $data['hide_side_category'] = true;
        return view('website.privacy')->withData($data);
    }

    public function cart(Request $request)
    {

        if ($request->has('raw')) {
            return session()->get('cart');
        }

        $data = [];

        return view('website.cart')->withData($data);
    }

    public function place_order(Request $request)
    {

        if (!Auth::check()) {
            return redirect('login');
        }

        $user_id = Auth::user()->id;

        $subtotal = $total = $base_peofit = 0;

        foreach (session('cart') as $details) {
            $product = Products::findOrFail($details['id']);
            $license = $details['license'];
            $price = $product->$license;
            $subtotal += $price;
        }

        $grand_total = $total = $subtotal;

        $cupon_code = $request->cupon;
        $discount = 0;
        if ($cupon_code != "") {
            $f_cupon = Cupons::where(['code' => $cupon_code])->where('ending_at', '>=', date('Y-m-d H:i:s'))->get();
            if ($f_cupon->count() > 0) {
                $cupon = $f_cupon[0];

                if ($cupon->discount_type == 'flat') {
                    $discount = ceil($cupon->discount);
                    $grand_total = $total - $discount;
                } else {
                    $discount = ceil(($subtotal * $cupon->discount) / 100);
                    $grand_total = $total - $discount;
                }

            }
        }

        if ($grand_total > Auth::user()->balance) {

            $message = ['type' => 'error', 'message' => 'You do not have enough balance, please add balance first'];

            Session::flash('message', $message);
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

        foreach (session('cart') as $details) {

            $license = $details["license"];
            $key = license_key(6);

            $product = Products::findOrFail($details['id']);
            $product->sales = $product->sales + 1;
            $product->amount_sold = $product->amount_sold + $product->$license;
            $product->save();
            $quantity = 1;
            $total_price = $quantity * $product->$license;

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
        $transaction->note = '<a href="' . url("invoice/details/" . $invoice->id) . '">Invoice #' . $invoice->id . '</a>';
        $transaction->save();

        $user->save();

        session()->forget('cart');
        session()->forget('cupon');

        $message = ['type' => 'success', 'message' => 'Thank You, Your purchase has been completed successfully. Transaction ID:' . $invoice->id];

        Session::flash('message', $message);

        return redirect('downloads');

    }

    public function get_cpoun_info(Request $request)
    {

        $cupon = ['status' => 'false'];
        $f_cupon = Cupons::where(['code' => $request->code])->where('ending_at', '>=', date('Y-m-d H:i:s'))->get();
        if ($f_cupon->count() > 0) {
            $cupon_info = $f_cupon[0];
            $cupon = ['status' => 'true', 'cupon' => $request->code, 'discount_type' => $cupon_info->discount_type, 'discount' => $cupon_info->discount];
            // $session = session()->get('cupon');
            session()->put('cupon', $cupon);

        }

        return response()->json($cupon);

    }

    public function order(Request $request, $id)
    {

        $data['language'] = $this->language;

        if ($request->has('language')) {
            $data['language'] = $request->language;
        }

        if ($data['language'] == 'bn') {
            $data['title'] = "অর্ডার #" . $this->bfn($id);
        } else {
            $data['title'] = "Order #" . $id;
        }

        // return $data['language'];

        if (!Auth::check()) {
            return redirect('login');
        }

        $data['invoice'] = $invoice = Invoices::findOrFail($id);

        if (Auth::user()->role == 'user') {
            if ($invoice->user != Auth::user()->id) {
                $message = ['type' => 'error', 'message' => 'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        if (Auth::user()->role == 'administrator' || Auth::user()->role == 'manager') {
            if ($invoice->company != Auth::user()->company) {
                $message = ['type' => 'error', 'message' => 'Sorry! you are not authrized to access this page.'];
                Session::flash('message', $message);
                return redirect('dashboard');
            }
        }

        $data['orders'] = Orders::where(['invoice' => $id])->get();

        return view('website.order')->withData($data);

    }

    public function invoice($id)
    {

        $data['language'] = $this->language;

        if (!Auth::check()) {
            return redirect('login');
        }

        $data['invoice'] = Invoices::findOrFail($id);

        $data['orders'] = Orders::where(['invoice' => $id])->get();

        return view('website.' . $this->language . '.invoice')->withData($data);

    }

    public function bulk_invoice($id)
    {

        $data['language'] = $this->language;

        if (!Auth::check()) {
            return redirect('login');
        }

        $data['invoices'] = Invoices::where('id', '>=', $id)->where('status', '=', 1)->get();

        return view('website.' . $this->language . '.bulk-invoice')->withData($data);

    }

    public function bulk_list(Request $request, $id)
    {

        $data['language'] = $this->language;

        if (!Auth::check()) {
            return redirect('login');
        }

        if ($request->has('price')) {
            $data['show_price'] = true;
        }
        $data['invoices'] = Invoices::where('id', '>=', $id)->where('status', '=', 1)->get();

        return view('website.' . $this->language . '.product-buy-list')->withData($data);

    }

    public function products_find(Request $request)
    {
        $product_listv = [];
        if ($request->has('name')) {
            $name = $request->name;

            $products = Products::where('name', 'like', "%$name%")->get();

            foreach ($products as $product) {
                $product_listv[$product->id] = ['id' => $product->id, 'name' => $product->name, 'price' => $product->price];
            }
        }
        return response()->json($product_listv);
    }

    public function get_invoice_info(Request $request)
    {
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

    public function update_delivery_tracking(Request $request, $id)
    {
        $dt = $request->dt;
        $invoice = Invoices::findOrFail($id);
        $invoice->delivery_tracking = $dt;
        $invoice->save();
        return ['success'];
    }

    public function get_subcategories($category)
    {

        $cateExists = Categories::where(['id' => $category])->get();
        if ($cateExists->count() == 0) {
            return [];
        }

        $scates = Subcategories::where(['category' => $category])->get();

        return json_encode($scates);
    }
}
