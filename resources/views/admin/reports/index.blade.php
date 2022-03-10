@extends('layouts.dashboard')
@section('title')
Reports
@endsection

@section('stylesheet')


@endsection

@section('content')

@php
    $total_expense = 0;
    $total_sale = 0;
    $base_profit = 0;
    $profit = 0;
    $cod_T = 0;
    $pure_sale = 0;
    $base_profit_in = 0;
@endphp

<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Income vs Expense</h5>

            <div class="pull-right">
                {{-- <a href="{{url('dashboard/expenditures/create')}}">Add Expense</a> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="row product-adding">
                <div class="col-xl-6">

                    <table class="table">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>ID</th>
                            <th>Sale</th>
                            <th>Estimated Profit</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['invoices'] as $invoices)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($invoices->created_at))}}</td>
                                <td>{{$invoices->id}}</td>
                                <td>&#2547;{{ $invoices->subtotal}}</td>
                                @php
                                    $total_sale+=$invoices->subtotal;
                                    $base_profi_int=$invoices->base_profit;

                                    $base_profit+=$base_profi_int;

                                    if(\App\Deliveryagents::findOrFail($invoices->delivery_agent)->name == "RedX"){
                                        $cod = ceil(($invoices->total * 1)/100);
                                    }else if(\App\Deliveryagents::findOrFail($invoices->delivery_agent)->name == "Delivery Tiger"){
                                        $cod = ceil(($invoices->total * 1)/100);
                                        if($cod<10){
                                            $cod = 10;
                                        }
                                    }

                                    $cod_T+=$cod;

                                    $profit_witout_cod = $base_profit_in- $cod;
                                    $sale_witout_cod = $invoices->subtotal- $cod;

                                    $pure_sale+=$sale_witout_cod;
                                    $profit+=$profit_witout_cod;

                                @endphp
                                <td>&#2547;{{ $sale_witout_cod }} <small>(base &#2547;{{$invoices->base_profit}} cod &#2547;{{$cod}} - profit &#2547;{{$profit_witout_cod}})</small></td>
                              </tr>          
                            @endforeach

                            <tr>
                                <td colspan="2" class="text-right"><b>Total = </b></td>
                                <td><b>&#2547;{{number_format($total_sale,2)}}</b></td>
                                <td><b>&#2547;{{number_format($pure_sale,2)}}</b> <small>(base &#2547;{{$base_profit}} cod &#2547;{{$cod_T}} - profit &#2547;{{$profit}})</small></td>
                            </tr>
        
                        </tbody>
                      </table>
         
                </div>

                <div class="col-xl-6">

                    <table class="table">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Expense</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['expenses'] as $expenses)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($expenses->created_at))}}</td>
                                <td>{{$expenses->name}}</td>
                                <td>&#2547;{{ $expenses->amount}}</td>
                                @php
                                    $total_expense+=$expenses->amount;
                                @endphp
                              </tr>          
                            @endforeach

                            <tr>
                                <td colspan="2" class="text-right"><b>Total = </b></td>
                                <td><b>&#2547;{{number_format($total_expense,2)}}</b></td>
                            </tr>
        
                        </tbody>
                      </table>
         
                </div>


                <div class="col-xl-12">

                    <br/>
                    <h3 class="text-center">Summary</h3>
                    <br/>

                    <table class="table">
                        <thead>
                          <tr>
                            <th class="text-left">Total Sale (without COD charge)</th>
                            <th class="text-right">Total Expense</th>
                          </tr>
                        </thead>
                        <tbody>
                           
                            <tr>
                                <td class="text-left"><b>&#2547;{{number_format($pure_sale,2)}}</b></td>
                                <td class="text-right"><b>&#2547;{{number_format($total_expense,2)}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <b>Cash in Hand</b>
                                </td>
                            </tr>
                            <tr>
                            <td colspan="2" class="text-center"><b>&#2547;{{number_format(($pure_sale-$total_expense),2)}}</b></td>
                            </tr>
        
                        </tbody>
                      </table>
         
                </div>


                

                <div class="col-xl-12">

                    <br/>
                    <h3 class="text-center">Pending</h3>
                    <br/>

                    <table class="table">
                        <thead>
                          <tr>
                            <th class="text-left">Sale</th>
                            <th class="text-right">COD</th>
                            <th class="text-right">Rest</th>
                          </tr>
                        </thead>
                        <tbody>
                           
                            <tr>
                                <td class="text-left"><b>&#2547;{{number_format($data['pending_sale'],2)}}</b></td>
                                <td class="text-right"><b>&#2547;{{number_format($data['pending_cod'],2)}}</b></td>
                                <td class="text-right"><b>&#2547;{{number_format($data['pending_sale']-$data['pending_cod'],2)}}</b> <small>base &#2547;{{number_format($data['pending_profit'],2)}}</small></td>
                            </tr>
   
                        </tbody>
                      </table>
         
                </div>

            </div>

        </div>

    </div>

</div>

@endsection



