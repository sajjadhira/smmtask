@extends('layouts.'.$data['language'].'.main')

@section('title')
    Order #{{$data['invoice']->id}}
@endsection

@section('content')
    

<!-- order-detail section start -->
<section class="section-big-py-space mt--5 bg-light">
    <div class="card order-container">
        <div class="row">
            <div class="col-md-12">
                <div class="row order-success-sec">
                    <div class="col-sm-6">
                        <h4>Order Summery</h4>
                        <ul class="order-detail">
                            <li>Order ID: {{$data['invoice']->id}}</li>
                            <li>Order Date: {{date('d F, Y',strtotime($data['invoice']->created_at))}}</li>
                            <li>Order Total: &#2547;{{$data['invoice']->total}}</li>
                            <li>Payment Method:  @if ($data['invoice']->payment_type=='cod')
                                Cash On Delivery
                                @elseif ($data['invoice']->payment_type=='bkash')
                                bKash
                                @elseif ($data['invoice']->payment_type=='nagad')
                                Nagad
                                @elseif ($data['invoice']->payment_type=='cash')
                                Cash
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
                            <li>Customer Name: <b>{{\App\Users::findOrFail($data['invoice']->user)->name}}</b></li>
                            <li>Contact No: {{$data['invoice']->phone}}</li>
                            <li>Shipping Address: {{$data['invoice']->address}}</li>
                            @if ($data['invoice']->status==0)
                            <li>Expected Delivery: {{date('d F, Y',strtotime($data['invoice']->created_at) + $add_time)}}</li>
                            @endif
                            <li>Order Status: 
                            @if ($data['invoice']->status==0)
                            <span class="text-info">Placed</span>
                            @elseif ($data['invoice']->status==1)
                            <span class="text-info">Processing</span>
                            @elseif ($data['invoice']->status==2)
                            <span class="text-success">Delivered</span>
                            @elseif ($data['invoice']->status==403)
                            <span class="text-danger">Cancled</span>
                            <span class="text-success">Delivered</span>
                            @elseif ($data['invoice']->status==127)
                            <span class="text-danger">Returned</span>
                            @endif
                            </li>
                        </ul>
                    </div>

            </div>
            <div class="col-md-12 col-12">
                <div class="product-order">
                    <h4 class="text-center">Order details</h4>

                    <table class="table cart-table">
        
                        <tr class="table-head">
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
    

                    @foreach ($data['orders'] as $order)

                    @php
                        $product = \App\Products::findOrFail($order->product);
                    @endphp
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>&#2547;{{$order->price}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>&#2547;{{$order->total_price}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                    </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Subtotal</td>
                            <td>&#2547;{{$data['invoice']->subtotal}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Shipping Charge</td>
                            <td>&#2547;{{$data['invoice']->delivery_charge}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Discount</td>
                            <td>&#2547;{{$data['invoice']->discount}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>&#2547;{{$data['invoice']->total}}</td>
                        </tr>
            
                    </table>
                </div>
            </div>
  
        </div>
    </div>
</section>
<!-- Section ends -->
@endsection