@extends('layouts.'.$data['language'].'.main')

@section('title')
    অর্ডার #{{$data['invoice']->id}}
@endsection

@section('content')
    

<!-- order-detail section start -->
<section class="section-big-py-space mt--5 bg-light">
    <div class="card order-container">
        <div class="row">
            <div class="col-md-12">
                <div class="row order-success-sec">
                    <div class="col-sm-6">
                        <h4>অর্ডার সারসংক্ষেপ</h4>
                        <ul class="order-detail">
                            <li>অর্ডার আইডিঃ {{\App\Http\Controllers\HomeController::bfn($data['invoice']->id)}}</li>
                            <li>অর্ডারের তারিখঃ {{\App\Http\Controllers\HomeController::bfn(date('d F, Y',strtotime($data['invoice']->created_at)))}}</li>
                            <li>সর্বমোট টাকাঃ &#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($data['invoice']->total,2))}}</li>
                            <li>পেমেন্ট মেথডঃ  @if ($data['invoice']->payment_type=='cod')
                                ক্যাশ অন ডেলিভারি
                                @elseif ($data['invoice']->payment_type=='bkash')
                                বিকাশ
                                @elseif ($data['invoice']->payment_type=='nagad')
                                নগদ
                                @elseif ($data['invoice']->payment_type=='cash')
                                ক্যাশ
                                @endif</li>
                            </ul>
                        </div>
                        
                        @php
                        if($data['invoice']->delivery_option == 'inside-dhaka'){
                            $add_time  = 1*24*3600;
                        }else {
                            $add_time = 2*24*3600;
                        }
                        @endphp

                    <div class="col-sm-6">
                        
                        <ul class="order-detail">
                            <li>কাস্টমারের নামঃ {{\App\Users::findOrFail($data['invoice']->user)->name}}</li>
                            <li>মোবাইল নাম্বারঃ {{\App\Http\Controllers\HomeController::bfn($data['invoice']->phone)}}</li>
                            <li>ডেলিভারি ঠিকানাঃ {{$data['invoice']->address}}</li>
                            @if ($data['invoice']->status==0)
                            <li>আশানরুপ ডেলিভারির সময়ঃ {{\App\Http\Controllers\HomeController::bfn(date('d F, Y',strtotime($data['invoice']->created_at) + $add_time))}}</li>
                            @endif
                            <li>অর্ডারের অবস্থাঃ 
                                @if ($data['invoice']->status==0)
                            <span class="text-info">প্লেইস হয়েছে</span>
                            @elseif ($data['invoice']->status==1)
                            <span class="text-info">প্রসেসিং এ আছে</span>
                            @elseif ($data['invoice']->status==2)
                            <span class="text-success">ডেলিভারি সম্পন্ন হয়েছে</span>
                            @elseif ($data['invoice']->status==403)
                            <span class="text-danger">অর্ডারটি বাতিল হয়েছে</span>
                            @elseif ($data['invoice']->status==127)
                            <span class="text-danger">অর্ডারটি ফেরত এসেছে</span>
                            @endif
                            </li>
                        </ul>
                    </div>

            </div>
            <div class="col-md-12 col-12">
                <div class="product-order">
                    <h4 class="text-center">অর্ডারের বিস্তারিত</h4>

                    <table class="table cart-table">
        
                        <tr class="table-head">
                            <th>পণ্যের নাম</th>
                            <th>মূল্য</th>
                            <th>পরিমাণ</th>
                            <th>মোট</th>
                        </tr>
    

                    @foreach ($data['orders'] as $order)

                    @php
                        $product = \App\Products::findOrFail($order->product);
                    @endphp
                        <tr>
                            <td>{{$product->name}}</td>
                            <td> @if($order->orginal_price>$order->price)<small><del>&#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($order->orginal_price,2))}}</del></small> @endif&#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($order->price,2))}}</td>
                            <td>{{\App\Http\Controllers\HomeController::bfn($order->quantity)}}</td>
                            <td>&#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($order->total_price,2))}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                    </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>মোট</td>
                            <td>&#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($data['invoice']->subtotal,2))}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>ডেলিভারি চার্জ</td>
                            <td>&#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($data['invoice']->delivery_charge,2))}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>ডিস্কাউন্ট</td>
                            <td>&#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($data['invoice']->discount,2))}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>সর্বমোট</td>
                            <td>&#2547;{{\App\Http\Controllers\HomeController::bfn(number_format($data['invoice']->total,2))}}</td>
                        </tr>
            
                    </table>
                </div>
            </div>
  
        </div>
    </div>
</section>
<!-- Section ends -->
@endsection