<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Settings;

use App\Invoices;
use App\Orders;
use App\Expenses;
use App\Users;
use App\Products;
use Session;


class DashboardController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        $this->types = ['success','warning','danger','info'];
    }

     
    public function index(Request $request){



        if(Auth::user()->role != 'administrator' && Auth::user()->role != 'superadmin' && Auth::user()->role != 'manager'){
            $message = ['type'=>'error','message'=>'Sorry! you are not authrized to access this page.'];
            Session::flash('message',$message);
            return redirect('/');
        }



        $data['total_sale'] = Orders::where('price','>',0)->get()->count();
        $data['total_sale_points'] = Orders::where('price','>',0)->sum('price');
        $data['this_month_sale'] = Orders::whereMonth('created_at',date('m'))->where('price','>',0)->get()->count();
        // return [$data['this_month_sale']];
        $data['this_month_amount_sale'] = Orders::whereMonth('created_at',date('m'))->where('price','>',0)->sum('price');
        $data['amount_sale'] = Invoices::where('status','=',2)->sum('total');
        $data['amount_expense'] = Expenses::whereRaw('DATE(created_at) = CURDATE()')->sum('amount');
        // $data['this_month_sale'] = Invoices::whereMonth('created_at',date('m'))->where('status','=',2)->count('created_at');

        $last24h = date('Y-m-d H:i:s',time()-(48*3600));

        $data['total_customer'] = Users::where('role','user')->get()->count();
        $data['total_customer_active'] = Users::where('role','user')->where('updated_at','>',$last24h)->get()->count();
        $data['total_customer_inactive'] = Users::where('role','user')->where('updated_at','<',$last24h)->get()->count();

        $data['total_products'] = Products::get()->count('created_at');
        $data['total_products_active'] = Products::where('status',0)->get()->count();
        $data['total_products_inactive'] = Products::where('status','>',0)->get()->count();
        $data['total_products_view'] = Products::where('status','>',0)->where('product_type','Youtube Video')->get()->count();
        $data['total_products_subscribe'] = Products::where('status','>',0)->where('product_type','Youtube Subscribe')->get()->count();
        $data['total_products_vpn'] = Products::where('status','>',0)->where('product_type','Do VPN Task')->get()->count();
        $data['best_sellings'] = Products::orderBy('amount_sold','DESC')->take(20)->get();

    	return view('apps.dashboard')->withData($data);
    }


    public function report(Request $request){
        
        $data = [];
        $data['campaigns'] = $data['type'] = $data['timeline'] = $data['from_date'] = $data['date']= $data['campaign'] = null;
        $data['limit'] = 200;
        $where = [];
        
        $data['types'] = ['lead','earning'];

        $data['timelines'] = ['today'=>'Today','yesterday'=>'Yesterday','week'=>'Last 7 Day','month'=>'This Month','lastmonth'=>'Last Month','year'=>'This Year','all'=>'All Time'];

        if($request->has('type')){
             $data['type'] = $type = $request->type;
        }else{
            $type = null;
        }

        if($request->has('limit') && $request->limit>0){
           $data['limit'] =  $limit  = $request->limit;
        }

        if($request->has('timeline') && $request->timeline!=""){
            $data['timeline'] = $request->timeline;

            if($data['timeline']=='today'){

                $data['from_date'] = null;
                $data['date'] = date('Y-m-d');

            }else if($data['timeline']=='yesterday'){

                $data['from_date'] = null;
                $data['date'] = date('Y-m-d', strtotime(" -1 days"));

            }else if($data['timeline']=='week'){

                $data['from_date'] = date('Y-m-d', strtotime("-7 days") );
                $data['date'] = date('Y-m-d');

            }else if($data['timeline']=='month'){

                $data['from_date'] = date('Y-m-01');
                $data['date'] = date('Y-m-d');

            }else if($data['timeline']=='lastmonth'){

                $data['from_date'] = date('Y-m-01',strtotime("first day of previous month"));
                $data['date'] = date('Y-m-d',strtotime("last day of previous month"));

            }else if($data['timeline']=='year'){

                $data['from_date'] = date('Y-01-01');
                $data['date'] = date('Y-m-d');
            }else if($data['timeline']=='all'){

                $data['from_date'] = null;
                $data['date'] = null;
            }


        }

        if($request->has('campaign') && $request->campaign>0){
            $campaignExists = Campaigns::where(['id'=>$request->campaign])->get();
            if($campaignExists->count()>0){
                $where['id'] = $request->campaign;
                $data['campaign'] = Campaigns::findOrFail($request->campaign);
            }
        }

        if(Auth::user()->role=='user'){
            $where['user'] = Auth::user()->id;
            $data['listcampaigns'] = Campaigns::where(['user'=>Auth::user()->id])->get();
        }

        if(Auth::user()->role=='manager'){
            $where['manager'] = Auth::user()->id;
            $data['listcampaigns'] = Campaigns::where(['manager'=>Auth::user()->id])->get();
        }

        if(Auth::user()->role=='administrator'){
            $where['company'] = Auth::user()->company;
            $data['listcampaigns'] = Campaigns::where(['company'=>Auth::user()->company])->get();
        }

        if($type == 'lead'){
        
        $data['campaigns'] = Campaigns::take($data['limit'])->where($where)->get();


        }


    	return view('apps.report')->withData($data);	
    }


    public function our_backup_database(){

        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "mybackup.sql";


}

    public function get_mega_license(){
        if(Auth::user()->role!='superadmin'){
            return view('auth.unauthorized');
        }
        $urlTo = 'https://phpans.com/tool/megaboss-get-license-45sd3464esc435t653f/';
        $urlContent = file_get_contents($urlTo);
        $data['licenses'] = $urlContent;
        return view('apps.mega')->withData($data);
    }


    public function settings(){

        if(Auth::user()->role!='superadmin'){
            return view('auth.unauthorized');
        }

        $data['types'] = $this->types;


        
        $get_notice_type = Settings::where(['name'=>'notice_type'])->get();
        $data['notice_type'] = $get_notice_type[0]->value;
        
        $get_notice = Settings::where(['name'=>'notice'])->get();
        $data['notice'] = $get_notice[0]->value;
        

        return view('apps.settings')->withData($data);


    }

    public function settingsUpdate(Request $request){
        
        if(Auth::user()->role!='superadmin'){
            return view('auth.unauthorized');
        }

        // $this->validate($request,[
        //     'unicode' => 'required|numeric',
        //     'link_send' => 'required|numeric',
        //     'release_limit' => 'required|numeric',
        //     'ctr' => 'required|numeric',
        //     'max_read' => 'required|numeric',
        //     'max_size' => 'required|numeric',
        //     'smtp_limit' => 'required|numeric',
        //     'intro_lack_limit' => 'required|numeric',
        //     'regular_lack_limit' => 'required|numeric',
        // ]);

     

        
        $get_notice_type = Settings::where(['name'=>'notice_type'])->get();
        $notice_type = Settings::find($get_notice_type[0]->id);
        $notice_type->value = $request->notice_type;
        $notice_type->save();

        
        $get_notice = Settings::where(['name'=>'notice'])->get();
        $notice = Settings::find($get_notice[0]->id);
        $notice->value = $request->notice;
        $notice->save();



        $message = ['type'=>'success','message'=>'Settings has been updated successfully'];
        Session::flash('message',$message);
        return redirect('settings');
    }

}
