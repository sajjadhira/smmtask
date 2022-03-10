@extends('layouts.dashboard')
@section('title')Dashboard @endsection

@section('stylesheet')


@endsection

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="row no-gutters">

      
      <div class="col-md-6 col-xxl-3 mb-3 pr-md-2">
        <div class="card h-md-100  w-md-d-card">
          <div class="card-header pb-0">
            <h6 class="mb-0 mt-2 d-flex align-items-center">Total Sales</h6>
            
            <span class="iconic bg-200 text-primary">
              <span data-feather="trending-up"></span>
          </span>
          </div>
          
          <div class="card-body d-flex align-items-end">
            <div class="row flex-grow-1">
              <div class="col">
                <div class="font-size-2-rm font-weight-normal text-sans-serif text-700 line-height-1 mb-1"><span class="data-default-currency"></span>{{number_format($data['amount_sale'])}}</div>
                <span class="badge badge-pill fs--2 bg-200 text-primary"><i class="fa fa-caret-up"></i> {{number_format($data['total_sale'])}} Orders</span>
              </div>
              <div class="col-auto pl-0">
                <div class="echart-bar-weekly-sales h-100" _echarts_instance_="ec_1619381486585" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;"><div style="position: relative; width: 136px; height: 61px; padding: 0px; margin: 0px; border-width: 0px;"><canvas data-zr-dom-id="zr_0" width="170" height="76" style="position: absolute; left: 0px; top: 0px; width: 136px; height: 61px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-xxl-3 mb-3 pr-md-2">
        <div class="card h-md-100  w-md-d-card">
          <div class="card-header pb-0">
            <h6 class="mb-0 mt-2 d-flex align-items-center">This Month Sale</h6>

            <span class="iconic bg-light-green text-success">
              <span data-feather="shopping-cart"></span>
          </span>


          </div>
          <div class="card-body d-flex align-items-end">
            <div class="row flex-grow-1">
              <div class="col">
                <div class="font-size-2-rm font-weight-normal text-sans-serif text-700 line-height-1 mb-1"><span class="data-default-currency"></span>{{number_format($data['this_month_amount_sale'])}}</div>
                
                <span class="badge badge-pill fs--2 badge-soft-success">{{number_format($data['this_month_sale'])}} Orders</span>
              </div>
              <div class="col-auto pl-0">
                <div class="echart-bar-weekly-sales h-100" _echarts_instance_="ec_1619381486585" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;"><div style="position: relative; width: 136px; height: 61px; padding: 0px; margin: 0px; border-width: 0px;"><canvas data-zr-dom-id="zr_0" width="170" height="76" style="position: absolute; left: 0px; top: 0px; width: 136px; height: 61px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <div class="col-md-6 col-xxl-3 mb-3 pr-md-2">
        <div class="card h-md-100  w-md-d-card">
          <div class="card-header pb-0">
            <h6 class="mb-0 mt-2 d-flex align-items-center">Total Customers<span class="ml-1 text-400" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calculated according to last week's sales"><svg class="svg-inline--fa fa-question-circle fa-w-16" data-fa-transform="shrink-1" aria-hidden="true" focusable="false" data-prefix="far" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.9375, 0.9375)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm107.244-255.2c0 67.052-72.421 68.084-72.421 92.863V300c0 6.627-5.373 12-12 12h-45.647c-6.627 0-12-5.373-12-12v-8.659c0-35.745 27.1-50.034 47.579-61.516 17.561-9.845 28.324-16.541 28.324-29.579 0-17.246-21.999-28.693-39.784-28.693-23.189 0-33.894 10.977-48.942 29.969-4.057 5.12-11.46 6.071-16.666 2.124l-27.824-21.098c-5.107-3.872-6.251-11.066-2.644-16.363C184.846 131.491 214.94 112 261.794 112c49.071 0 101.45 38.304 101.45 88.8zM298 368c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="far fa-question-circle" data-fa-transform="shrink-1"></span> Font Awesome fontawesome.com --></span></h6>
          

            <span class="iconic bg-light-yellow text-warning">
              <span data-feather="users"></span>
          </span>

          </div>
          <div class="card-body d-flex align-items-end">
            <div class="row flex-grow-1">
              <div class="col">
                <div class="font-size-2-rm font-weight-normal text-sans-serif text-700 line-height-1 mb-1">{{number_format($data['total_customer'])}}</div>
                <span class="badge badge-pill fs--2 badge-soft-success">+3.5%</span>
              </div>
              <div class="col-auto pl-0">
                <div class="echart-bar-weekly-sales h-100" _echarts_instance_="ec_1619381486585" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;"><div style="position: relative; width: 136px; height: 61px; padding: 0px; margin: 0px; border-width: 0px;"><canvas data-zr-dom-id="zr_0" width="170" height="76" style="position: absolute; left: 0px; top: 0px; width: 136px; height: 61px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-xxl-3 mb-3 pr-md-2">
        <div class="card h-md-100  w-md-d-card">
          <div class="card-header pb-0">
            <h6 class="mb-0 mt-2 d-flex align-items-center">Total Products <span class="ml-1 text-400" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calculated according to last week's sales"><svg class="svg-inline--fa fa-question-circle fa-w-16" data-fa-transform="shrink-1" aria-hidden="true" focusable="false" data-prefix="far" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.9375, 0.9375)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm107.244-255.2c0 67.052-72.421 68.084-72.421 92.863V300c0 6.627-5.373 12-12 12h-45.647c-6.627 0-12-5.373-12-12v-8.659c0-35.745 27.1-50.034 47.579-61.516 17.561-9.845 28.324-16.541 28.324-29.579 0-17.246-21.999-28.693-39.784-28.693-23.189 0-33.894 10.977-48.942 29.969-4.057 5.12-11.46 6.071-16.666 2.124l-27.824-21.098c-5.107-3.872-6.251-11.066-2.644-16.363C184.846 131.491 214.94 112 261.794 112c49.071 0 101.45 38.304 101.45 88.8zM298 368c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="far fa-question-circle" data-fa-transform="shrink-1"></span> Font Awesome fontawesome.com --></span></h6>
          
            <span class="iconic bg-light-purple text-purple">
              <span data-feather="trello"></span>
          </span>
          
          </div>
          <div class="card-body d-flex align-items-end">
            <div class="row flex-grow-1">
              <div class="col">
                <div class="font-size-2-rm font-weight-normal text-sans-serif text-700 line-height-1 mb-1">{{number_format($data['total_products'])}}</div>
                <span class="badge badge-pill fs--2 bg-200 text-primary"><svg class="svg-inline--fa fa-caret-up fa-w-10 mr-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M288.662 352H31.338c-17.818 0-26.741-21.543-14.142-34.142l128.662-128.662c7.81-7.81 20.474-7.81 28.284 0l128.662 128.662c12.6 12.599 3.676 34.142-14.142 34.142z"></path></svg>13.6%</span>
                <span class="badge badge-pill fs--2 badge-soft-success">+3.5%</span>
              </div>
              <div class="col-auto pl-0">
                <div class="echart-bar-weekly-sales h-100" _echarts_instance_="ec_1619381486585" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;"><div style="position: relative; width: 136px; height: 61px; padding: 0px; margin: 0px; border-width: 0px;"><canvas data-zr-dom-id="zr_0" width="170" height="76" style="position: absolute; left: 0px; top: 0px; width: 136px; height: 61px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>


    <div class="row no-gutters">
      <div class="col-sm-6 col-xxl-6 pr-sm-2 mb-3 mb-xxl-0">
        <div class="card">
          <div class="card-header d-flex flex-between-center bg-light py-2">
            <h6 class="mb-0">Active Users</h6>
            <div class="dropdown text-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" id="dropdown-active-user" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
              <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown-active-user">
                <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body py-2">
            <div class="media align-items-center mb-3">
              <div class="avatar avatar-2xl status-online">
                <img class="rounded-circle" src="../assets/img/team/1-thumb.png" alt="" />
              </div>
              <div class="media-body ml-3">
                <h6 class="mb-0 font-weight-semi-bold"><a class="text-900" href="../pages/profile.html">Emma Watson</a></h6>
                <p class="text-500 fs--2 mb-0">Admin</p>
              </div>
            </div>
            <div class="media align-items-center mb-3">
              <div class="avatar avatar-2xl status-online">
                <img class="rounded-circle" src="../assets/img/team/2-thumb.png" alt="" />
              </div>
              <div class="media-body ml-3">
                <h6 class="mb-0 font-weight-semi-bold"><a class="text-900" href="../pages/profile.html">Antony Hopkins</a></h6>
                <p class="text-500 fs--2 mb-0">Moderator</p>
              </div>
            </div>
            <div class="media align-items-center mb-3">
              <div class="avatar avatar-2xl status-away">
                <img class="rounded-circle" src="../assets/img/team/3-thumb.png" alt="" />
              </div>
              <div class="media-body ml-3">
                <h6 class="mb-0 font-weight-semi-bold"><a class="text-900" href="../pages/profile.html">Anna Karinina</a></h6>
                <p class="text-500 fs--2 mb-0">Editor</p>
              </div>
            </div>
            <div class="media align-items-center mb-3">
              <div class="avatar avatar-2xl status-offline">
                <img class="rounded-circle" src="../assets/img/team/4-thumb.png" alt="" />
              </div>
              <div class="media-body ml-3">
                <h6 class="mb-0 font-weight-semi-bold"><a class="text-900" href="../pages/profile.html">John Lee</a></h6>
                <p class="text-500 fs--2 mb-0">Admin</p>
              </div>
            </div>
            <div class="media align-items-center mb-3">
              <div class="avatar avatar-2xl status-offline">
                <img class="rounded-circle" src="../assets/img/team/5-thumb.png" alt="" />
              </div>
              <div class="media-body ml-3">
                <h6 class="mb-0 font-weight-semi-bold"><a class="text-900" href="../pages/profile.html">Rowen Atkinson</a></h6>
                <p class="text-500 fs--2 mb-0">Editor</p>
              </div>
            </div>
          </div>
          <div class="card-footer bg-light p-0"><a class="btn btn-sm btn-link btn-block py-2" href="../pages/people.html">All active users<span class="fas fa-chevron-right ml-1 fs--2"></span></a></div>
        </div>
      </div>
      <div class="col-sm-6 col-xxl-6 pl-sm-2 order-xxl-1 mb-3 mb-xxl-0">
        <div class="card h-100">
          <div class="card-header bg-light d-flex flex-between-center py-2">
            <h6 class="mb-0">Bandwidth Saved</h6>
            <div class="dropdown text-sans-serif btn-reveal-trigger"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" id="dropdown-bandwidth-saved" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
              <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown-bandwidth-saved">
                <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body d-flex flex-center">
            <div>
              <div class="progress-circle progress-circle-dashboard" data-options='{"color":"url(#gradient)","progress":93,"strokeWidth":5,"trailWidth":5}'></div>
              <div class="text-center mt-4">
                <h6 class="fs-0 mb-1"><span class="fas fa-check text-success mr-1" data-fa-transform="shrink-2"></span>35.75 GB saved</h6>
                <p class="fs--1 mb-0">38.44 GB total bandwidth</p>
              </div>
            </div>
          </div>
          <div class="card-footer bg-light py-2">
            <div class="row flex-between-center">
              <div class="col-auto"><select class="custom-select custom-select-sm">
                  <option>Last 6 Months</option>
                  <option>Last Year</option>
                  <option>Last 2 Year</option>
                </select></div>
              <div class="col-auto"><a class="fs--1" href="#!">Help</a></div>
            </div>
          </div>
        </div>
      </div>

    </div>

    
    <div class="row no-gutters">
        <div class="col-lg-12 col-xl-12 pr-lg-2 mb-3">
          <div class="card h-lg-100 overflow-hidden">
            <div class="card-body p-0">
              <table class="table table-dashboard mb-0 table-borderless fs--1">
                <thead class="bg-light">
                  <tr class="text-900">
                    <th>Best Selling Products</th>
                    <th class="text-right">Revenue (<span class="data-default-currency"></span>{{number_format($data['amount_sale'])}})</th>
                    <th class="pr-card text-right" style="width: 8rem">Revenue (%)</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($data['best_sellings'] as $item)
                  
                  @php

                      $total_sale = $data['amount_sale'];
                      if($total_sale>0){
                      $this_item_sale = $item->amount_sold;

                      $parcent = (100*$item->amount_sold)/$total_sale;

                      if($parcent>100){
                        $cssparcent = 100;
                      }else{
                        $cssparcent = ceil($parcent);
                      }
                    }else{
                      $cssparcent = 0;
                      $parcent = 0;
                    }
                  @endphp
                  <tr class="border-bottom border-200">
                    <td>
                      <div class="media align-items-center position-relative"><img class="rounded border border-200" src="{{url('images/uploads/'.$item->thumbnail)}}" width="60" alt="" />
                        <div class="media-body ml-3">
                          <h6 class="mb-1 font-weight-semi-bold"><a class="text-dark stretched-link" target="_blank" href="{{url('product/'.make_slug($item->name).'/'.$item->id)}}">{{$item->name}}</a></h6>
                          <p class="font-weight-semi-bold mb-0 text-500">{{\App\Categories::find($item->category)->name}}</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-right font-weight-semi-bold"><span class="data-default-currency"></span>{{number_format($item->amount_sold)}}</td>
                    <td class="align-middle pr-card">
                      <div class="d-flex flex-between-center">
                        <div class="progress w-100 mr-3 rounded-soft bg-200" style="height: 5px; max-width: 54px">
                          <div class="progress-bar rounded-capsule" role="progressbar" style="width: {{$cssparcent}}%;" aria-valuenow="{{$cssparcent}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="font-weight-semi-bold">{{number_format($parcent,2)}}%</div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer bg-light py-2">
              <div class="row flex-between-center">
                <div class="col-auto"><a class="btn btn-sm btn-falcon-default" href="{{url('dashboard/products')}}">View All Products</a></div>
              </div>
            </div>
          </div>
        </div>
  
      </div>
  

  </main>
@endsection