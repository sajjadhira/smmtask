@extends('layouts.dashboard')
@section('title')
Update Profile
@endsection

@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
@endsection

@section('content')



    <!-- BEGIN: Content-->
    <div class="app-content content col-md-12">
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
                                        <form method="POST" action="{{ url('profile/update/store') }}" class="steps-validation wizard-circle" id="form" enctype='multipart/form-data'>
                                            @method('PATCH')
                                            <!-- Step 1 -->
                                            <h6><i class="step-icon feather icon-user"></i> Account Information</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">
                                                                Name
                                                            </label>
                                                            <input type="text" class="form-control required" id="name" name="name" placeholder="John Doe" minlength="3" value="{{$data['user']->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                Phone
                                                            </label>
                                                            <input type="text" class="form-control required" id="text" name="text" placeholder="john@example.com" value="{{$data['user']->email}}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">
                                                                Password (Leave it empty if you don't want to chnage)
                                                            </label>
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Minimum 8 Characters" autocomplete="off" minlength="8">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password_confirmation ">
                                                                Re-type Password  (Leave it empty if you don't want to chnage)
                                                            </label>
                                                            <input type="password" class="form-control" id="password_confirmation " name="password_confirmation " placeholder="Minimum 8 Characters" autocomplete="off" minlength="8">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="role">
                                                                Avatar
                                                            </label>
                                                            <input type="file" name="image" class="form-control">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="skype_id">
                                                                Skype ID
                                                            </label>
                                                            <input type="text" class="form-control" id="skype_id" name="skype_id" placeholder="Example: live:abcdefgh012345" value="{{$data['user']->skype_id}}">
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <!-- Step 2 -->
                                            <h6><i class="step-icon feather icon-server"></i> Payment Information</h6>
                                            <fieldset>
                                            	<div class="row">


                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="paypal">
                                                                Paypal
                                                            </label>
                                                            <input type="email" class="form-control" id="paypal" name="paypal" placeholder="Paypal Email Address" value="{{$data['user']->paypal}}">
                                                        </div>
                                                    </div>

                                                    

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="webmoney">
                                                                Webmoney
                                                            </label>
                                                            <input type="text" class="form-control" id="webmoney" name="webmoney" placeholder="Webmoney Email Address" value="{{$data['user']->webmoney}}">
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="bank_name">
                                                                Bank Name
                                                            </label>
                                                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Example: Ameriacan Express" value="{{$data['user']->bank_name}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="bank_account_number">
                                                                Bank Account Number
                                                            </label>
                                                            <input type="number" class="form-control" id="bank_account_number" name="bank_account_number" placeholder="Example: 14578965578" value="{{$data['user']->bank_account_number}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="bank_account_holder_name">
                                                                Bank Account Holder Name
                                                            </label>
                                                            <input type="text" class="form-control" id="bank_account_holder_name" name="bank_account_holder_name" placeholder="Example: {{Auth::user()->name}}" value="{{$data['user']->bank_account_holder_name}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="bank_routing_number">
                                                                Bank Routing Number
                                                            </label>
                                                            <input type="number" class="form-control" id="bank_routing_number" name="bank_routing_number" placeholder="Example: 14578965578" value="{{$data['user']->bank_routing_number}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="bank_swift_code">
                                                                Bank Swift Code
                                                            </label>
                                                            <input type="text" class="form-control" id="bank_swift_code" name="bank_swift_code" placeholder="Example: PDTS" value="{{$data['user']->bank_swift_code}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="text">
                                                                Bank Branch
                                                            </label>
                                                            <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="Example: Ohio" value="{{$data['user']->bank_branch}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="other_payment_type_name">
                                                                Other Payment Name
                                                            </label>
                                                            <input type="text" class="form-control" id="other_payment_type_name" name="other_payment_type_name" placeholder="Example: Bitcoin" value="{{$data['user']->other_payment_type_name}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="other_payment_type_account">
                                                                Other Payment Account Address
                                                            </label>
                                                            <input type="text" class="form-control" id="other_payment_type_account" name="other_payment_type_account" placeholder="Example: 36483646558389" value="{{$data['user']->other_payment_type_account}}">
                                                        </div>
                                                    </div>


                                            	</div>
                                            </fieldset>

                                            @if(Auth::user()->role=='manager')

                                            <!-- Step 2 -->
                                            <h6><i class="step-icon feather icon-slack"></i> Company Information</h6>
                                            <fieldset>
                                            	<div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="footer">
                                                                Copyright Footer
                                                            </label>
                                                            <input type="text" class="form-control" id="footer" name="footer" placeholder="Example: Company Name" value="{{$data['user']->footer}}">
                                                        </div>
                                                    </div>
                                            	</div>
                                            </fieldset>
                                            @endif
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
            
             $('#gateway').select2();

            // var token = $("meta[name='csrf-token']").attr("content");
            $('#gateway').select2({
            placeholder: "Select Gateway",
            minimumInputLength: 1,
            ajax: {
                url: '{{ url('gateways/find') }}',
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

});            
</script>
@endsection