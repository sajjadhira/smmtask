@extends('layouts.main')

@section('title'){{__("Publishing New Task")}}@endsection

@section('css')
<link rel="stylesheet" href="{{url('assets/css/marketplace.css')}}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/wizard.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
<style>
    .danger{
        color: #EA5455;
    }
</style>
@endsection

@section('content')

			
			<!-- Hero section -->
			
            <div class="container my-account">

				<div class="row nameplate">
					<div class="col-6">
						<div class="name">
                        @if (file_exists('public/images/users/'.Auth::user()->image))
                        <img src="{{url('public/images/users/'.Auth::user()->image)}}" alt="{{Auth::user()->name}}"><br/>
                        @else
						<img src="http://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=120" alt="..."><br/>
						{{Auth::user()->name}}
                        @endif
						</div>

						<div class="joined">
							<span class="text-muted">Member since {{date("jS F Y",strtotime(Auth::user()->created_at))}}</span>
						</div>
					</div>
					<div class="col-6 text-a-right wallet-information">
						<div class="account-balance"><span class="text-muted">Balance</span> <span class="data-default-currency"></span>{{(Auth::user()->balance)}} BDT</div>
                        @php
                            $purchased = \App\Orders::where('user',Auth::user()->id)->get()->count()
							@endphp
						<div class="purchased-total"><span class="text-muted">Completed</span> {{$purchased}} {{__("Task")}}@if($purchased>1){{__("s")}}@endif</div>
						<div class="account-balance"><span class="text-muted">Points</span> {{number_format(Auth::user()->point)}}</div>
					</div>
				</div>

				
                <div class="row app-content">


					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 details">


       
          <!-- columns starts here -->
          <div class="col-md-12 col-xxl-12 mb-3 pr-md-2">

            <!-- cards starts here -->
            <div class="card h-md-100  w-md-d-card">


                <div class="card-body ">
                    <form action="{{ url('newtask/store') }}"   class="steps-validation wizard-circle" id="form" novalidate="" method="POST" enctype="multipart/form-data">
                        @method('PATCH')

                          
                    <!-- Step 1 -->
                    <h6><span data-feather="trello"></span> Indentification Information</h6>
                    <fieldset>

                        <div class="row">

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input class="form-control required" id="name" type="text" name="name" required="" placeholder="Task Name">
                            </div>
                            
                            <br/>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Category*</label>
                                <select class="form-control digits required" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                @foreach ($data['categories'] as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>    
                                @endforeach
                            </select>
                            </div>                            
                            <br/>

                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Subcategory*</label>
                                <select class="form-control digits required" id="subcategory" name="subcategory" required>
                                    <option value="">Select Subcategory</option>
                            </select>
                            </div>
                            <br/>
                            </div>


                            @php
                                $types = ['Youtube Video', 'Youtube Subscribe', 'Website'];
                                if(Auth::user()->role == "superadmin"){
                                    array_push($types,'Do VPN Task');
                                    array_push($types,'Youtube VPN Chrome');
                                    array_push($types,'Do VPN Website Task');
                                }
                            @endphp
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Type*</label>
                                <select class="form-control required" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <br/>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="question">Question</label>
                                    <input class="form-control" id="question" type="text" name="question" placeholder="Verification Question">
                                </div>
                                
                                <br/>
                                <br/>
                                </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <input class="form-control" id="answer" type="text" name="answer" placeholder="Verification Answer">
                                </div>
                                
                                <br/>
                                <br/>
                                </div>

                        </div>

            

                    </fieldset>

                                                                                        
                    <!-- Step 3 -->
                    <h6><span data-feather="database"></span> Others Information</h6>
                    <fieldset>

                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">URL*</label>
                                <input class="form-control required" id="preview_url" type="text" name="preview_url" placeholder="https://www.youtube.com/watch?v=XXXXXXXXX" value="">
                                <input id="video_id" type="hidden" name="video_id">
                            </div>
                            <br/>
                            <br/>
                        </div>
                        
                        <div class="col-md-6 d-none" id="channel_url_section">
                            <div class="form-group">
                                <label for="code">Channel URL*</label>
                                <input class="form-control" id="channel_url" type="text" name="channel_url" placeholder="https://www.youtube.com/channel/UCD9vlEA-5Xich1RWjq6d6UQ" value="">
                                <input id="channel_id" type="hidden" name="channel_id">
                            </div>
                            <br/>
                            <br/>
                        </div>
                        
                        <div class="col-md-6 d-none" id="page_visit_section">
                            <div class="form-group">
                                <label for="page_visit">Total Page Visit*</label>
                                <input class="form-control" id="page_visit" type="text" name="page_visit" placeholder="3 or 4 or 5" value="0">
                            </div>
                            <br/>
                            <br/>
                        </div>

                    </div>

                    </fieldset>


                                               
                    <!-- Step 2 -->
                    <h6><span data-feather="dollar-sign"></span> Pricing Information</h6>
                    <fieldset>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">PPA For You (Points Per Action)*</label>
                                    <input class="form-control required" id="price" type="number" name="price" min="10" required="" placeholder="Points for The Action" >
                                </div>
                                <br/>

                            </div>


                            
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Duration (Second of Per Task)*</label>
                                <input class="form-control required" id="duration" type="number" name="duration" required placeholder="50" value="" readonly>
                            </div>
                            <br/>
                        </div>
                            
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Campaign Budget (Points)*</label>
                                <input class="form-control required" id="budget" type="number" name="budget" min="1000" placeholder="500000" value="">
                            </div>
                            <br/>
                            <br/>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Network Fee (Points)*</label>
                                <input class="form-control required" id="netfee" type="number" name="netfee" placeholder="5% Newtwork Free Based on Campaign Budget" value="" readonly>
                            </div>
                            <br/>
                            <br/>
                        </div>

                        

                        </div>

                    </fieldset>


                        @csrf
                    </form>

                </div>

                
                <div id="err_message"></div>
                <div id="action_message"></div>
            </div>
            <!-- cards ends here -->

        </div>
        <!-- table column ends here -->



					</div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">


						<div class="card ">
							<div class="card-header">
								Dashboard
							</div>
							<div class="card-body">

                                @include('website.user.menu')


							</div>
						  </div>
		
                    </div>


                </div>
            </div>
			
			<!-- Hero section END    -->
    
@endsection

@section('js')

<script src="{!! asset('app-assets/vendors/js/extensions/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('app-assets/js/scripts/forms/wizard-steps.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
<script type="text/javascript">

    $(document).ready(function(){

        $("#price").on('keyup', function(){
                const points = $(this).val()
                let taskType = $('#type').val();
                if(taskType == 'Do VPN Task'){
                    var sec = points * 4
                }else if(taskType == 'Youtube VPN Chrome'){
                    var sec = points * 5
                }else if(taskType == 'Website'){
                    var sec = 10
                }else if(taskType == 'Do VPN Website Task'){
                    var sec = 10
                }else{
                    var sec = points * 6
                }
                $('#duration').val(sec)
        });

        $("#budget").on('keyup', function(){
                const budget = $(this).val()
                const taka = budget
                const netfee = (taka/100)*5
                $('#netfee').val(netfee)
        });


        $("#preview_url").on('focusout', function(){
                const url = $(this).val()
                let type = $("#type").val();

                if(type != 'Website' && type != 'Do VPN Website Task'){


                if(url.indexOf('https://') == -1){
                    let verr = '<div class="alert alert-danger pt-3">Please provide a valid video URL.</div>';
                    $('#err_message').slideDown('fast').html(verr);
                    $('.actions').slideUp('fast');
                    return false
                }else{
                    $('#err_message').slideUp('fast').html('');
                    $('.actions').slideDown('fast');
                }

                if(url.indexOf('youtube.com/watch?v=') == -1 && url.indexOf('youtu.be/') == -1 && url.indexOf('facebook.com/watch/?v=') == -1 ){
                    let verr = '<div class="alert alert-danger pt-3">Please provide a valid video URL.</div>';
                    $('#err_message').slideDown('fast').html(verr);
                    $('.actions').slideUp('fast');
                    return false
                }else{
                    $('#err_message').slideUp('fast').html('');
                    $('.actions').slideDown('fast');

                    let video_id = '';
                    if(url.indexOf('?v=') > -1){

                        let splitVideo = url.split('v=');

                        // console.log(splitVideo);

                        splitVideo.map( part => {

                            if(type == 'Facebook Video'){
                                var len = 15;
                            }else{
                                var len = 11;
                            }
                            
                            if(part.length == len){
                                video_id = part;
                                $('#video_id').val(video_id);
                            }

                        })

                    }else{

                        let splitVideo = url.split('/');
                        splitVideo.map( part => {

                            // console.log(part);
                            if(part.length == 11){
                                video_id = part;
                                $('#video_id').val(video_id);
                            }
                        })

                    }
                
                    if(url.indexOf('facebook.com/watch/?v=') == -1 ){

                    let direction = '<div class="text-center"><img class="img-fluid" src="https://i3.ytimg.com/vi/'+video_id+'/hqdefault.jpg"></div>';
                    $('#action_message').slideDown('fast').html(direction);
                    
                }
                
                    
                }

            }else{

                $("#preview_url").attr('placeholder', 'Enter a valid URL');
                $('#page_visit_section').removeClass('d-none');

            }
        });

        
        $("#channel_url").on('focusout', function(){
                const url = $(this).val()
                if(url.indexOf('https://') == -1){
                    let err = '<div class="alert alert-danger pt-3">Please provide a valid channel URL.</div>';
                    $('#err_message').slideDown('fast').html(err);
                    $('.actions').slideUp('fast');
                    return false
                }else{
                    $('#err_message').slideUp('fast').html('');
                    $('.actions').slideDown('fast');
                }

                if(url.indexOf('youtube.com/channel/') == -1){
                    let err = '<div class="alert alert-danger pt-3">Please provide a valid channel URL.</div>';
                    $('#err_message').slideDown('fast').html(err);
                    $('.actions').slideUp('fast');
                    return false
                }else{
                    $('#err_message').slideUp('fast').html('');
                    $('.actions').slideDown('fast');
                }
                let channel_id = '';
                let splitChannel = url.split('/');
                splitChannel.map( part => {

                    // console.log(part);
                    if(part.length == 24){
                        channel_id = part;
                        $('#channel_id').val(channel_id);
                    }
                })


    var Gourl = "{{ url('get/channel/information') }}/";
    var data = 'channel='+channel_id;
    $.ajax({   
    type : 'GET',
    url  : Gourl,
    data: data,
    success : function(data)
        {

            if(data.result == 'success'){

                let err = '<div class="alert alert-success pt-3">'+data.message+'</div>';
                    $('#err_message').slideDown('fast').html(err);
                    $('.actions').slideDown('fast');
                
            }else{

                let err = '<div class="alert alert-danger pt-3">'+data.message+'</div>';
                    $('#err_message').slideDown('fast').html(err);
                    $('.actions').slideUp('fast');
                
            }

            // console.log(data.result);
            
            // alert(data);return false;

            // $('#subcategory').empty();
            // var opts = $.parseJSON(data);
            // // Use jQuery's each to iterate over the opts value
            // $.each(opts, function(i, d) {
            //     // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
            //     $('#subcategory').append('<option value="' + d.id + '">' + d.name + '</option>');
            // });

        }
    });


        });


$(document).on('change','#category',function( e ) {

    var category = $(this).val();
    var url = "{{ url('dashboard/subcates') }}/" + category;

    $.ajax({   
    type : 'GET',
    url  : url,
    success : function(data)
        {
            // alert(data);return false;

            $('#subcategory').empty();
            var opts = $.parseJSON(data);
            // Use jQuery's each to iterate over the opts value
            $.each(opts, function(i, d) {
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#subcategory').append('<option value="' + d.id + '">' + d.name + '</option>');
            });

        }
    });

});

$(document).on('change','#type',function( e ) {

    let type = $(this).val();

    // alert(type);

    if(type == "Youtube Subscribe"){
        let direction = '<div class="alert alert-warning pt-3">\
            <div class="text-center pb-3">-ঃনোটিশঃ-</div>\
            ১/ আমরা শুধু ১০০০ সাবস্ক্রাইবারের নিচের চ্যানেল প্রমোট করি, আপনার চ্যানেলের সাবস্ক্রাইবার যদি ১০০০ এর নিচে হয় তবেই কেবল ক্যাম্পেইন/টাস্ক এ এড করুন।<br/>\
            ২/ আপনার চ্যানেলের সাবক্রাইবার হিডেন রাখলে অবশ্যই তা পাবলিক/শো/আনহাইড করে নিন, অন্যথায় আপনার ক্যাম্পেইনটি/টাস্কটি আমরা এক্সেপ্ট করতে পারবো না।<br/>\
            ৩/ আপনার চ্যানেলের সাবস্ক্রাইবার ১০০০ হয়ে গেলে ক্যাম্পেইন/টাস্কটি অটোমেটিক স্টপ হয়ে যাবে।<br/>\
            ৪/ এই ক্যাম্পেইনের জন্য আপনাকে আলাদাভাবে পয়েন্ট সেট করতে হবে না, প্রতি সাবস্ক্রাইবের মূল্য ২০০ পয়েন্ট হবে।<br/>\
            ৫/ ক্যাম্পেইন/টাস্ক সেটাপ করার সময় অবশ্যই চ্যানেল লিংক নির্ভুলভাবে দিন প্রয়োজনে ইউটিউব থেকে কপি করে নিন এবং আমাদের সাপোর্টেড ফর্মেটে দিন।<br/>\
            ৬/ চ্যানেল লিংক সাপোর্টেড ফর্মেট উদাহারন - https://www.youtube.com/channel/UCD9vlEA-5Xich1RWjq6d6UQ <br/>\
            ৭/ আপনি একটি চ্যানেল দিয়ে একবার ই ক্যাম্পেইন করতে পারবেন।<br/>\
            ৮/ সাবক্রাইবার ড্রপ/স্প্যাম কাউন্ট এড়াতে আপনি যে ভিডিও দিবেন সেটা অবশ্যই ৩ মিনিট থেকে ৪ মিনিটের মাঝে দিন।<br/>\
            ৯/ ইউজার কমপক্ষে ২ মিনিট আপনার দেয়া ভিডিও দেখে আপনার চ্যানেল সাবস্ক্রাইব করবে।<br/>\
            ১০/ আপনি যে চ্যানেল প্রমোট করছেন এবং ইউজারদের দেখার জন্য যে ভিডিও তা অবশ্যই যেন একই চ্যানেলের হয়।<br/>\
            ১১/ প্রতিটি সাবস্ক্রাইব ই ইউনিক হবে, একজন SMMTASK ইউজার শুধুমাত্র একবারই এই চ্যানেল সাবস্ক্রাইব করতে পারবে ফলে পরবর্তিতে সে আর কখনই এই চ্যানেল সাবস্ক্রাইব করার জন্য পাবে না।<br/>\
            </div>';
        $('#action_message').slideDown('fast').html(direction);
        $('#price').val(100).prop('readonly',true);
        $('#duration').val(120);
        
        $('#channel_url_section').removeClass('d-none');
        $('#channel_url').prop('required',true);
        
    }else if(type == "Youtube Video"){

    }
    else{
        $('#action_message').slideUp('fast').html('');
        $('#price').val(0).prop('readonly',false);
        $('#duration').val(0);
        $('#channel_url_section').addClass('d-none');
        $('#channel_url').prop('required',false);
    }

});

/*
$(document).on('keyup','#price',function( e ) {

    var price = $('#price').val();
    
    var adv_price = price + ((price*100)/10);

    $('#price_advertiser').val(adv_price);

});
*/


});

</script>
    
@endsection