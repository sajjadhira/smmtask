@extends('layouts.dashboard')
@section('title')
Cupons
@endsection

@section('stylesheet')


@endsection

@section('content')


<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>Cupons</h5>

            <div class="pull-right">
                
            </div>
        </div>
        <div class="card-body">
            <div class="row product-adding">
                <div class="col-xl-12">

                    <table class="table">
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Discount Type</th>
                            <th>Discount</th>
                            <th>Sold</th>
                            <th>Starting At</th>
                            <th>Ending At</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['cupons'] as $cupon)
                            <tr>
                                <td>{{$cupon->code}}</td>
                                <td>{{$cupon->discount_type}}</td>
                                <td>{{ $cupon->discount}}@if($cupon->discount_type=="parcent")%@endif</td>
                                <td>{{ $cupon->sold}}</td>
                                <td>{{ date('d F Y, h:i A',strtotime($cupon->starting_at))}}</td>
                                <td>{{ date('d F Y, h:i A',strtotime($cupon->ending_at))}}</td>
                                <td>@if(time()>strtotime($cupon->ending_at))<span class="badge badge-danger">Expired<span>@else<span class="badge badge-success">Active<span>@endif</td>
                                <td><a href="{{ url('dashboard/cupons/edit/'.$cupon->id) }}">Edit</a></td>
                              </tr>          
                            @endforeach

        
                        </tbody>
                      </table>
                      
                      <div class="text-center">
                      {{$data['cupons']->links()}}
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection



