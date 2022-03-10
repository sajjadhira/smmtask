@extends('layouts.dashboard')
@section('title')
Edit Company
@endsection

@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
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

                        </div>
                    </div>
                </div>
                <div class="content-header-right text-lg-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                            <a href="{{ url('companies/') }}"><button class="btn-icon btn btn-primary btn-round btn-md" type="button"><i class="feather icon-command"></i> All Companies</button></a>
                    </div>
                </div>
            </div>


                <!-- Form wizard with step validation section start -->
                <section id="validation">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" action="{{ url('companies/update/'.$data['company']->id) }}" class="steps-validation wizard-circle" id="form" enctype='multipart/form-data'>
                                            @method('PATCH')
                                            <!-- Step 1 -->
                                            <h6><i class="step-icon feather icon-home"></i> Company Information</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">
                                                                Company Name
                                                            </label>
                                                            <input type="text" class="form-control required" id="name" name="name" placeholder="Input name of company" value="{{$data['company']->name}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address">
                                                                Address
                                                            </label>
                                                            <input type="text" class="form-control required" id="address" name="address" placeholder="Ex - 122/3 Royal State, California 50002" value="{{$data['company']->address}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="domain">
                                                                Domain Address
                                                            </label>
                                                            <input type="text" class="form-control required" id="domain" name="domain" placeholder="example.com" value="{{$data['company']->domain}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="administrator">
                                                                Base Administrator
                                                            </label>
                                                            <select class="@if(Auth::user()->role!='user') select2-data-ajax @endif form-control required" id="administrator" name="administrator">
                                                                <option  value="{{$data['company']->administrator}}"><?php if(\App\Users::where(['id'=>$data['company']->administrator])->get()->count()>0){ echo \App\Users::find($data['company']->administrator)->name; }else{ echo 'Deleted!'; }?></option>
                                    
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="contact">
                                                                Contact
                                                            </label>
                                                            <input type="text" class="form-control required" id="contact" name="contact" placeholder="+880181xxxxxxx" value="{{$data['company']->contact}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="homepage">
                                                                Homepage Template
                                                            </label>
                                                            <select name="homepage" class="form-control">
                                                                <option value="">Select Template</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>
                                            <!-- Step 2 -->
                                            <h6><i class="step-icon feather icon-image"></i> Company Logo</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6 text-center">
										              <input type="file" name="image" class="form-control">
                                                     </div>
<br/>
                                                     @if($data['company']->logo!="")
                                                     <a href="{{url('images/'.$data['company']->logo)}}" data-featherlight="image"><img src="{{url('images/'.$data['company']->logo)}}" height="70" width="150"></a>
                                                     @endif
                                                     <br/>
                                                     <br/>
                                                     <br/>
                                                </div>
                                            </fieldset>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with step validation section end -->




@endsection

@section('javascript')
<!-- BEGIN: Page JS-->
<script src="{!! asset('app-assets/vendors/js/extensions/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/forms/wizard-steps.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
<!-- END: Page JS-->

<script type="text/javascript">
$(document).ready(function () {
    
   @if(Auth::user()->role!='user')          
             $('#administrator').select2();

            // var token = $("meta[name='csrf-token']").attr("content");
            $('#administrator').select2({
            placeholder: "Choose Administrator",
            minimumInputLength: 1,
            ajax: {
                url: '{{ url('users/find') }}',
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
                    // alert(JSON.stringify(data))
                },
                cache: true
            }
        });            
            @endif


});            
</script>
@endsection