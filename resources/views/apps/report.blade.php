@extends('layouts.main')
@section('title')
Reports
@endsection

@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
@endsection

@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Reports</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard/') }}">Dashboard</a>
                                    <li class="breadcrumb-item">Staticties
                                    </li>
                                    <li class="breadcrumb-item active">Reports
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-lg-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
      
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Generate Reports</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form method="get">
                                        <div class="row">

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="type">
                                                                Report Type<span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control required" id="type" name="type" required="required">
                                                                <option value="">Select Type</option>

                                                                @foreach($data['types'] as $type)
                                                                <option value="{{$type}}" @if($data['type']==$type) selected="selected" @endif>{{strtoupper($type)}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="campaign">
                                                                Campaign
                                                            </label>
                                                            <select class="@if(Auth::user()->role=="superadmin") select2-data-ajax @endif form-control required" id="campaign" name="campaign">
                                                                @if($data['campaign']!=null)
                                                                <option value="{{$data['campaign']->id}}">{{$data['campaign']->name}}</option>
                                                                @else
                                                                <option value="">Select Campaign</option>
                                                                @endif
                                                                @if(Auth::user()->role!="superadmin")
                                                                @foreach($data['listcampaigns'] as $campid)
                                                                <option value="{{$campid->id}}">{{$campid->name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="timeline">
                                                                Timeline
                                                            </label>
                                                            <select class="form-control" id="timeline" name="timeline">
                                                                @foreach($data['timelines'] as $timeline => $timelinename)
                                                                <option value="{{$timeline}}" @if($data['timeline']==$timeline) selected="selected" @endif>{{ $timelinename }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    Or
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="from_date">
                                                                From Date
                                                            </label>
                                                            <input class="form-control" id="from_date" name="from_date" type="date">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="to_date">
                                                                To Date
                                                            </label>
                                                            <input class="form-control" id="to_date" name="to_date" type="date">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="to_date">
                                                                Limit
                                                            </label>
                                                            <input class="form-control" id="limit" name="limit" type="number" value="{{$data['limit']}}">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Generate</button> 
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <a href="{{ url('staticties/reports')}}"><button type="button" class="btn btn-warning">Reset</button></a>
                                                            
                                                        </div>
                                                    </div>

                                        </div>
                                    </form>

                                    @if($data['campaigns']!="")

                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Campaign</th>
                                                    <th>User</th>
                                                    <th>Company</th>
                                                    <th>SMS</th>
                                                    <th>CHAT</th>
                                                    <th>CTR (SMS to CHAT)</th>
                                                    <th>EMAIL</th>
                                                    <th>CLICKS</th>
                                                    <th>SALES</th>
                                                    <th>SALE RATIO</th>
                                                    @if(Auth::user()->role=='superadmin')
                                                    <th>EARNING</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total_sms_leads = $total_chat_leads = $total_email_leads = $click_total = $sale_total = $total_earning =  0;
                                                ?>
                                                 @foreach ($data['campaigns'] as $campaign)
                                                 <?php 
                                                    $where = ['campaign'=>$campaign->id];
                                                    if($data['from_date']!="" && $data['date']!=""){

                                                    $clicks = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('clicks');
                                                    $sales = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('sales');
                                                    $sms_leads = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('sms_leads');
                                                    $chat_leads = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('chat_leads');
                                                    $email_leads = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('email_leads');
                                                    
                                                    if(Auth::user()->role=='superadmin'){
                                                        $earning = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('earning');
                                                    }else if(Auth::user()->role=='administrator'){
                                                        $where['company'] = Auth::user()->company;
                                                        $earning = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('earning');
                                                    }else if(Auth::user()->role=='manager'){
                                                        $where['manager'] = Auth::user()->id;
                                                        $earning = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('manager_earning');
                                                    }else if(Auth::user()->role=='user'){
                                                        $where['user'] = Auth::user()->id;
                                                        $earning = \App\Reporting::where($where)->whereBetween('date',[$data['from_date'],$data['date']])->sum('user_earning');
                                                    }
                                                   
                                                }else if($data['date']!=""){
                                                    $where['date'] = $data['date'];
                                                    $clicks = \App\Reporting::where($where)->sum('clicks');
                                                    $sales = \App\Reporting::where($where)->sum('sales');
                                                    $sms_leads = \App\Reporting::where($where)->sum('sms_leads');
                                                    $chat_leads = \App\Reporting::where($where)->sum('chat_leads');
                                                    $email_leads = \App\Reporting::where($where)->sum('email_leads');

                                                                                                        
                                                    if(Auth::user()->role=='superadmin'){
                                                        $earning = \App\Reporting::where($where)->sum('earning');
                                                    }else if(Auth::user()->role=='administrator'){
                                                        $where['company'] = Auth::user()->company;
                                                        $earning = \App\Reporting::where($where)->sum('earning');
                                                    }else if(Auth::user()->role=='manager'){
                                                        $where['manager'] = Auth::user()->id;
                                                        $earning = \App\Reporting::where($where)->sum('manager_earning');
                                                    }else if(Auth::user()->role=='user'){
                                                        $where['user'] = Auth::user()->id;
                                                        $earning = \App\Reporting::where($where)->sum('user_earning');
                                                    }

                                                }else if($data['from_date'] == "" && $data['date']== ""){
                                                    $clicks = \App\Reporting::where($where)->sum('clicks');
                                                    $sales = \App\Reporting::where($where)->sum('sales');
                                                    $sms_leads = \App\Reporting::where($where)->sum('sms_leads');
                                                    $chat_leads = \App\Reporting::where($where)->sum('chat_leads');
                                                    $email_leads = \App\Reporting::where($where)->sum('email_leads');

                                                    
                                                                                                        
                                                    if(Auth::user()->role=='superadmin'){
                                                        $earning = \App\Reporting::where($where)->sum('earning');
                                                    }else if(Auth::user()->role=='administrator'){
                                                        $where['company'] = Auth::user()->company;
                                                        $earning = \App\Reporting::where($where)->sum('earning');
                                                    }else if(Auth::user()->role=='manager'){
                                                        $where['manager'] = Auth::user()->id;
                                                        $earning = \App\Reporting::where($where)->sum('manager_earning');
                                                    }else if(Auth::user()->role=='user'){
                                                        $where['user'] = Auth::user()->id;
                                                        $earning = \App\Reporting::where($where)->sum('user_earning');
                                                    }
                                                }



                                                 ?>
                                                 @if($sms_leads>0 || $chat_leads>0 || $email_leads>0)
                                                <tr id="tr-{{ $campaign->id }}">
                                                    <td>{{ strtoupper($campaign->name) }}</td>
                                                    <td><?php if(\App\Users::where(['id'=>$campaign->user])->get()->count()>0){ echo \App\Users::find($campaign->user)->name; } ?> ({{$campaign->user}})</td>
                                                    <td><?php if(\App\Companies::where(['id'=>$campaign->company])->get()->count()>0){ echo \App\Companies::find($campaign->company)->name; } ?></td>
                                                    <td><?php $total_sms_leads+=$sms_leads; echo $sms_leads; ?></td>
                                                    <td><?php $total_chat_leads+=$chat_leads; echo $chat_leads; ?></td>
                                                    <td><?php
                                                    if($chat_leads>0 && $sms_leads>0){
                                                        $ctr = ($chat_leads/$sms_leads)*100;
                                                    }else{
                                                        $ctr = '0.00';
                                                    }
                                                        echo number_format($ctr,2); 
                                                     ?>%</td>
                                                    
                                                    <td><?php $total_email_leads+=$email_leads; echo $email_leads; ?></td>
                                                    <td><?php $click_total+=$clicks; ?>{{$clicks}}</td>
                                                    <td><?php $sale_total+=$sales; ?>{{$sales}}</td>

                                                    <td><?php
                                                        if($sales>0 && $clicks>0){
                                                            $thisRatio = ($sales/$clicks)*100;
                                                        }else{
                                                            $thisRatio = '0.00';
                                                        }
                                                        echo number_format($thisRatio,2);

                                                        $total_earning+=$earning;
                                                     ?>%</td>

                                                     @if(Auth::user()->role=='superadmin')
                                                    <td>${{number_format($earning,2)}}</td>
                                                    @endif

                                                </tr>
                                                @endif
                                                 @endforeach

                                                 <tr>
                                                     <th colspan=" @if(Auth::user()->role=='superadmin') 3 @else 2 @endif ">Total</th>
                                                     <th>{{$total_sms_leads}}</th>
                                                     <th>{{$total_chat_leads}}</th>
                                                     <th>Avg. CTR <?php
                                                    if($total_chat_leads>0 && $total_sms_leads>0){
                                                        $ctr = ($total_chat_leads/$total_sms_leads)*100;
                                                    }else{
                                                        $ctr = '0.00';
                                                    }
                                                        echo number_format($ctr,2); 
                                                     ?>%</th>
                                                     <th>{{$total_email_leads}}</th>
                                                     <th>{{$click_total}}</th>
                                                     <th>{{$sale_total}}</th>
                                                     <th>Avg. SR <?php 
                                                     if($click_total>0 && $sale_total>0){
                                                        $ratio = ($sale_total/$click_total)*100;
                                                     }else{
                                                        $ratio = '0.00';
                                                     }
                                                        echo number_format($ratio,2);
                                                     ?>%</th>
                                                     @if(Auth::user()->role=='superadmin')
                                                     <th>${{number_format($total_earning,2)}}</th>
                                                     @endif
                                                 </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    @endif
                                </div>
                               
                            </div>
                        </div>

                <!-- Responsive tables end -->

            </div>
        </div>
    </div>

   </div>
 </div>
    <!-- END: Content-->

@endsection

@section('javascript')
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
<script type="text/javascript">
$(document).ready(function () {
            @if(Auth::user()->role=="superadmin")
             $('#campaign').select2();

            // var token = $("meta[name='csrf-token']").attr("content");
            $('#campaign').select2({
            placeholder: "Select Campaign",
            minimumInputLength: 1,
            ajax: {
                url: '{{ url('campaigns/find') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

            @endif

});            
</script>
<!-- END: Page JS-->
@endsection


