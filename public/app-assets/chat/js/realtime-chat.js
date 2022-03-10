$(document).ready(function(){





$(function() {




setTimeout(function() {
	

var send_data = 'get_latest_updates=true';
var url = window.location.href;
   $.ajax({   
    type : 'GET',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : send_data,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
        {
		if(data!="" ){
			
    var SohoExamle = {
        Message: {
            add: function (name, avatar, type, message, attachment, attachment_display, sid, time) {
                var chat_body = $('.layout .content .chat .chat-body');
                if (chat_body.length > 0) {


if(type=='outgoing-message' && attachment!="" && message==""){
	var show_message_box = 'none';
}else{
	var show_message_box = 'block';
}
                    type = type ? type : '';
                    message = message ? message : '<span class="text-typing">Typing...</span>';
                    attachment_display = attachment_display ? attachment_display : 'block';
					
                    attachment_info = attachment ? '<figure id="attachment'+sid+'" style="display:'+attachment_display+'"><a href="'+attachment+'" data-toggle="lightbox"><img src="'+attachment+'" class="w-25 img-fluid rounded" alt="'+attachment+'"></a></figure>' : '';


if(type !== 'outgoing-message'){
	var add_height = '';
}else{
	var add_height = '';
}


                    $('.layout .content .chat .chat-body .messages').append(`<div class="message-item ` + type + `">
                        <div class="message-avatar">
                            <figure class="avatar">
                                <img src="` + (type == 'outgoing-message' ? avatar : avatar) + `" class="rounded-circle">
                            </figure>
                            <div>
                                <h5>` + (type == 'outgoing-message' ? name : name) + `</h5>
                                <div class="time" style="display:` + attachment_display + `" id="time` + sid +`"> ` + time + ' ' + (type == 'outgoing-message' ? '<span class="tik_tik">sent</span>' : '') + `</div>
                            </div>
                        </div>` + add_height + `
                        <div class="message-content" style="display:` + show_message_box + `" id="` + sid + `">
                            ` + message + `
                        </div>
						` + attachment_info + `
                    </div>`);

                    setTimeout(function () {
                        chat_body.scrollTop(chat_body.get(0).scrollHeight, -1).niceScroll({
                            cursorcolor: 'rgba(66, 66, 66, 0.20)',
                            cursorwidth: "4px",
                            cursorborder: '0px'
                        }).resize();
                    }, 200);
                }
            }
        }
    };
	
var your_name = $('#name').html();
var your_image = $('#your_image').html();
var agent_name = $('#agent_name').html();
var agent_image = $('#agent_image').html();

var sent_attach = return_attach = return_message = null;


// if (data !== null && typeof (data) === 'object') {
try{
    
var result = $.parseJSON(data);

if(result.result!="" && result.result == 'true'){
    return false;
}
if(result.uploaded_image!=""){
	var sent_attach = result.uploaded_image;
}
if(result.return_image!=""){
	var return_attach = result.return_image;
}
if(result.return_message!=""){
	var return_message = result.return_message;
}
var sid = result.sid;
var system_sid = result.system_sid;

function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

$('.additional-height').hide('fast');

setTimeout(function () {
SohoExamle.Message.add(agent_name,agent_image,null,null,return_attach,'none', system_sid, formatAMPM(new Date));
},3000);


var min = 20;
var max = 25;
// and the formula is:
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var show_time = random*1000;
setTimeout(function () {
$('#'+system_sid).html(return_message);
$('#time'+system_sid).show('fast').html(formatAMPM(new Date));
$('#attachment'+system_sid).show('fast');

var base_url = $('#base_url').html()
$('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/eventually.ogg" type="audio/ogg">').appendTo('body');
$('#notify')[0].play();

	var token = $("meta[name='csrf-token']").attr("content");
	var form = $('#message_form')[0];
	var formData = new FormData(form);
	formData.append('submit_comment', 'true');
	formData.append('_token', token);
	var description = $('#description').val();
	var words  = description.split(' ').length;
// update message status
var data = 'submit_comment=true&sid='+system_sid;
var url = window.location.href;
   $.ajax({   
    type : 'POST',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : formData,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
        {
			
		}
		
   });
   
 // end of update message status
 

},show_time);


} catch (e) {
        return false;
    }

		}
		
		}

    });
	
}, 1000);
		


	});




$(document).on('click','#submit',function( e ) {
	
var name = $('#name').html();
var email = $('#email').html();

if(name.length==0 || name==""){
$('#nameTour').modal('show');
setTimeout(function(){ 	
$('#contact_name').focus();	
},1000);
return false;
}

if(email.length==0 || email==""){
$('#emailTour').modal('show');
setTimeout(function(){ 	
$('#contact_email').focus();	
},1000);
return false;
}

	var token = $("meta[name='csrf-token']").attr("content");
	var form = $('#message_form')[0];
	var formData = new FormData(form);
	formData.append('submit_comment', 'true');
	formData.append('_token', token);
	var description = $('#description').val();
	var words  = description.split(' ').length;

	if(words<1){
			$('#message').html('<div class="animated fadeIn fixed-alert-message alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">Ã—</button> Please type a clear message.</div>');
            $('html, body').stop().animate({
            'scrollTop': $('#description').offset().top - 60
        	}, 1200);

			$('#description').focus();
			return false;
	}

	
$('#description').val(null).focus();
var data = 'submit_comment=true&description='+description;
var url = $('#current_url').html() + '/push';
   $.ajax({   
    type : 'POST',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : formData,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
        {
		$('#message_form')[0].reset();

		// alert(data);return false;
    var SohoExamle = {
        Message: {
            add: function (name, avatar, type, message, attachment, attachment_display, sid, time, canswitch, realbody) {
                var chat_body = $('.layout .content .chat .chat-body');
                if (chat_body.length > 0) {

					if(type=='outgoing-message' && attachment!="" && message==""){
						var show_message_box = 'none';
					}else{
						var show_message_box = 'block';
					}
                    type = type ? type : '';
                    message = message ? message : '<span class="text-typing">Typing...</span>';
                    attachment_display = attachment_display ? attachment_display : 'block';
					
                    attachment_info = attachment ? '<figure id="attachment'+sid+'" style="display:'+attachment_display+'"><a href="'+attachment+'" data-toggle="lightbox"><img src="'+attachment+'" class="w-25 img-fluid rounded" alt="'+attachment+'"></a></figure>' : '';


					if(type == 'outgoing-message'){
						var add_height = '';
					}else{
						var add_height = '';
					}
					
					
					if(canswitch == 'true'){
						var starter_div = '<div id="canswitch" data-sid="'+ sid +'"><div id="body-'+sid+'" style="display:none;">'+realbody+'</div>';
						var enderer_div = '</div>'
					}else{
						var starter_div = enderer_div = '';
					}

                    $('.layout .content .chat .chat-body .messages').append(starter_div + `<div class="message-item ` + type + ` message-` + sid + `">
                        <div class="message-avatar">
                            <figure class="avatar">
                                <img src="` + (type == 'outgoing-message' ? avatar : avatar) + `" class="rounded-circle">
                            </figure>
                            <div>
                                <h5>` + (type == 'outgoing-message' ? name : name) + `</h5>
                                <div class="time" style="display:` + attachment_display + `" id="time` + sid +`"> ` + time + ' ' + (type == 'outgoing-message' ? '<span class="tik_tik">sent</span>' : '') + `</div>
                            </div>
                        </div>` + add_height + `
                        <div class="message-content" style="display:` + show_message_box + `" id="` + sid + `">
                            ` + message + `
                        </div>
						` + attachment_info + `
                    </div>` + enderer_div);

                    setTimeout(function () {
                        chat_body.scrollTop(chat_body.get(0).scrollHeight, -1).niceScroll({
                            cursorcolor: 'rgba(66, 66, 66, 0.20)',
                            cursorwidth: "4px",
                            cursorborder: '0px'
                        }).resize();
                    }, 200);
                }
            }
        }
    };
	
var your_name = $('#name').html();
var your_image = $('#your_image').html();
var agent_name = $('#agent_name').html();
var agent_image = $('#agent_image').html();

var sent_attach = return_attach = return_message = null;

var result = $.parseJSON(data);
if(result.uploaded_image!=""){
	var sent_attach = result.uploaded_image;
}
if(result.return_image!=""){
	var return_attach = result.return_image;
}
if(result.return_message!=""){
	var return_message = result.return_message;
	var system_sid = result.system_sid;
}
var sid = result.sid;

function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}


var min = 2;
var max = 5;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var seen_time = random*1000;

var min = 5;
var max = 10;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var typing_show_time = random*1000;


var min = 35;
var max = 40;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var display_time = random*1000;

var reserved_content = '';

if($('#canswitch').length >0 ){
	var system_sid = $('#canswitch').data('sid');
	var return_message = $('#body-'+system_sid).html();
	var reserved_content = $('#canswitch').html();
	$('#canswitch').hide();

	var min = 10;
	var max = 15;
	var random = Math.floor(Math.random() * (max - min + 1)) + min;
	var display_time = random*1000;


}

SohoExamle.Message.add(your_name,your_image, 'outgoing-message', description, sent_attach, null, sid, formatAMPM(new Date));

setTimeout(function () {
    var base_url = $('#base_url').html()
	$('.tik_tik').html('<span class="text-info">seen</span>');
    // $('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/knob.mp3" type="audio/mpeg">').appendTo('body');
    // $('#notify')[0].play();
},seen_time);

if(return_message!=""){
	
if($('#canswitch').length > 0 ){
	$('div#canswitch').removeAttr('id').html('');
	$('.layout .content .chat .chat-body .messages').append('<div id="canswitch">'+reserved_content+'</div>');
	$('.additional-height').hide();
}

setTimeout(function () {

if($('#canswitch').length == 0 ){
SohoExamle.Message.add(agent_name,agent_image,null,null,return_attach,'none', system_sid, formatAMPM(new Date),'true',return_message);
$('.additional-height').hide();
}

},typing_show_time);

}


if($('#in_progress').html() == '' ){

$('#in_progress').html('inprogress');

setTimeout(function () {

$('.message-'+system_sid).hide();
SohoExamle.Message.add(agent_name,agent_image,null,return_message,return_attach,'block', system_sid, formatAMPM(new Date),'true',return_message);


var base_url = $('#base_url').html()
$('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/eventually.ogg" type="audio/ogg">').appendTo('body');
$('#notify')[0].play();

$('#in_progress').html('');

// update message status
var send_data = 'get_latest_updates=true&regular_update=true';
var url = window.location.href;
   $.ajax({   
    type : 'GET',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : send_data,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
        {
			$('div#canswitch').removeAttr('id');
		}
		
   });


},display_time);

}

}
    });
return false;
});

$(document).on('click','#add_attchment',function( e ) {
	$('#attachment').click();
});

$(document).on('keypress','#description',function( e ) {

if(e.which==13){
	
var name = $('#name').html();
var email = $('#email').html();

if(name.length==0 || name==""){
$('#nameTour').modal('show');
setTimeout(function(){ 	
$('#contact_name').focus();	
},1000);
return false;
}

if(email.length==0 || email==""){
$('#emailTour').modal('show');
setTimeout(function(){ 	
$('#contact_email').focus();	
},1000);
return false;
}

	var token = $("meta[name='csrf-token']").attr("content");
	var form = $('#message_form')[0];
	var formData = new FormData(form);
	formData.append('submit_comment', 'true');
	formData.append('_token', token);
	var description = $('#description').val();
	var words  = description.split(' ').length;

	if(words<1){
			$('#message').html('<div class="animated fadeIn fixed-alert-message alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">Ã—</button> Please type a clear message.</div>');
            $('html, body').stop().animate({
            'scrollTop': $('#description').offset().top - 60
        	}, 1200);

			$('#description').focus();
			return false;
	}

	
$('#description').val(null).focus();
var data = 'submit_comment=true&description='+description;
var url = $('#current_url').html() + '/push';
   $.ajax({   
    type : 'POST',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : formData,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
        {
		$('#message_form')[0].reset();

		// alert(data);return false;
    var SohoExamle = {
        Message: {
            add: function (name, avatar, type, message, attachment, attachment_display, sid, time, canswitch, realbody) {
                var chat_body = $('.layout .content .chat .chat-body');
                if (chat_body.length > 0) {

					if(type=='outgoing-message' && attachment!="" && message==""){
						var show_message_box = 'none';
					}else{
						var show_message_box = 'block';
					}
                    type = type ? type : '';
                    message = message ? message : '<span class="text-typing">Typing...</span>';
                    attachment_display = attachment_display ? attachment_display : 'block';
					
                    attachment_info = attachment ? '<figure id="attachment'+sid+'" style="display:'+attachment_display+'"><a href="'+attachment+'" data-toggle="lightbox"><img src="'+attachment+'" class="w-25 img-fluid rounded" alt="'+attachment+'"></a></figure>' : '';


					if(type == 'outgoing-message'){
						var add_height = '';
					}else{
						var add_height = '';
					}
					
					
					if(canswitch == 'true'){
						var starter_div = '<div id="canswitch" data-sid="'+ sid +'"><div id="body-'+sid+'" style="display:none;">'+realbody+'</div>';
						var enderer_div = '</div>'
					}else{
						var starter_div = enderer_div = '';
					}

                    $('.layout .content .chat .chat-body .messages').append(starter_div + `<div class="message-item ` + type + ` message-` + sid + `">
                        <div class="message-avatar">
                            <figure class="avatar">
                                <img src="` + (type == 'outgoing-message' ? avatar : avatar) + `" class="rounded-circle">
                            </figure>
                            <div>
                                <h5>` + (type == 'outgoing-message' ? name : name) + `</h5>
                                <div class="time" style="display:` + attachment_display + `" id="time` + sid +`"> ` + time + ' ' + (type == 'outgoing-message' ? '<span class="tik_tik">sent</span>' : '') + `</div>
                            </div>
                        </div>` + add_height + `
                        <div class="message-content" style="display:` + show_message_box + `" id="` + sid + `">
                            ` + message + `
                        </div>
						` + attachment_info + `
                    </div>` + enderer_div);

                    setTimeout(function () {
                        chat_body.scrollTop(chat_body.get(0).scrollHeight, -1).niceScroll({
                            cursorcolor: 'rgba(66, 66, 66, 0.20)',
                            cursorwidth: "4px",
                            cursorborder: '0px'
                        }).resize();
                    }, 200);
                }
            }
        }
    };
	
var your_name = $('#name').html();
var your_image = $('#your_image').html();
var agent_name = $('#agent_name').html();
var agent_image = $('#agent_image').html();

var sent_attach = return_attach = return_message = null;

var result = $.parseJSON(data);
if(result.uploaded_image!=""){
	var sent_attach = result.uploaded_image;
}
if(result.return_image!=""){
	var return_attach = result.return_image;
}
if(result.return_message!=""){
	var return_message = result.return_message;
	var system_sid = result.system_sid;
}
var sid = result.sid;

function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}


var min = 2;
var max = 5;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var seen_time = random*1000;

var min = 5;
var max = 10;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var typing_show_time = random*1000;


var min = 35;
var max = 40;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var display_time = random*1000;

var reserved_content = '';

if($('#canswitch').length >0 ){
	var system_sid = $('#canswitch').data('sid');
	var return_message = $('#body-'+system_sid).html();
	var reserved_content = $('#canswitch').html();
	$('#canswitch').hide();

	var min = 10;
	var max = 15;
	var random = Math.floor(Math.random() * (max - min + 1)) + min;
	var display_time = random*1000;


}

SohoExamle.Message.add(your_name,your_image, 'outgoing-message', description, sent_attach, null, sid, formatAMPM(new Date));

setTimeout(function () {
    var base_url = $('#base_url').html()
	$('.tik_tik').html('<span class="text-info">seen</span>');
    // $('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/knob.mp3" type="audio/mpeg">').appendTo('body');
    // $('#notify')[0].play();
},seen_time);

if(return_message!=""){
	
if($('#canswitch').length > 0 ){
	$('div#canswitch').removeAttr('id').html('');
	$('.layout .content .chat .chat-body .messages').append('<div id="canswitch">'+reserved_content+'</div>');
	$('.additional-height').hide();
}

setTimeout(function () {

if($('#canswitch').length == 0 ){
SohoExamle.Message.add(agent_name,agent_image,null,null,return_attach,'none', system_sid, formatAMPM(new Date),'true',return_message);
$('.additional-height').hide();
}

},typing_show_time);

}


if($('#in_progress').html() == '' ){

$('#in_progress').html('inprogress');

setTimeout(function () {

$('.message-'+system_sid).hide();
SohoExamle.Message.add(agent_name,agent_image,null,return_message,return_attach,'block', system_sid, formatAMPM(new Date),'true',return_message);


var base_url = $('#base_url').html()
$('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/eventually.ogg" type="audio/ogg">').appendTo('body');
$('#notify')[0].play();

$('#in_progress').html('');

// update message status
var send_data = 'get_latest_updates=true&regular_update=true';
var url = window.location.href;
   $.ajax({   
    type : 'GET',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : send_data,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
        {
			$('div#canswitch').removeAttr('id');
		}
		
   });


},display_time);

}

}
    });
return false;
}

});

$(document).on('click','#contact_name_submit',function( e ) {
	
var name = $('#contact_name').val();
if(name.length>0 && name!=""){

	var form = $('#message_form')[0];
	var formData = new FormData(form);
	formData.append('submit_comment', 'true');
	formData.append('name', name);
	
	var url = window.location.href;
   $.ajax({   
    type : 'POST',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : formData,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
	{

		$('#nameTour').modal('hide');
		$('#emailTour').modal('show');
		setTimeout(function(){ 	
		$('#contact_email').focus();	
		},1000);
		
		$('#name').html(name);
		$('#your_name').html(name);

	}

   });

return false;
}else{
	$("#contact_name").addClass('is-invalid').focus();
	return false;
}

});

$(document).on('keypress','#contact_name',function( e ) {
if(e.which==13){
	
var name = $('#contact_name').val();

if(name.length>0 && name!=""){


	var form = $('#message_form')[0];
	var formData = new FormData(form);
	formData.append('submit_comment', 'true');
	formData.append('name', name);
	
	var url = window.location.href;
   $.ajax({   
    type : 'POST',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : formData,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
	{
		$('#nameTour').modal('hide');
		$('#emailTour').modal('show');
		setTimeout(function(){ 	
		$('#contact_email').focus().val("");	
		},1000);
		
		$('#name').html(name);
		$('#your_name').html(name);

	}

   });

return false;
}else{
	$("#contact_name").addClass('is-invalid').focus();
	return false;
}

}
	
});


$(document).on('click','#contact_email_submit',function( e ) {
	
var email = $('#contact_email').val();
var description = $('#description').val();

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

if(email.length>0 && email!="" && isEmail(email)){


	var form = $('#message_form')[0];
	var formData = new FormData(form);
	formData.append('submit_comment', 'true');
	formData.append('email', email);
	
	var url = window.location.href;
   $.ajax({   
    type : 'POST',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : formData,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
	{
		$('#emailTour').modal('hide');
		setTimeout(function(){ 	
		$('#description').focus();	
		},1000);
		$('#email').html(email);
		$('#message_form')[0].reset();

    var SohoExamle = {
        Message: {
            add: function (name, avatar, type, message, attachment, attachment_display, sid, time, canswitch, realbody) {
                var chat_body = $('.layout .content .chat .chat-body');
                if (chat_body.length > 0) {

					if(type=='outgoing-message' && attachment!="" && message==""){
						var show_message_box = 'none';
					}else{
						var show_message_box = 'block';
					}
                    type = type ? type : '';
                    message = message ? message : '<span class="text-typing">Typing...</span>';
                    attachment_display = attachment_display ? attachment_display : 'block';
					
                    attachment_info = attachment ? '<figure id="attachment'+sid+'" style="display:'+attachment_display+'"><a href="'+attachment+'" data-toggle="lightbox"><img src="'+attachment+'" class="w-25 img-fluid rounded" alt="'+attachment+'"></a></figure>' : '';


					if(type != 'outgoing-message'){
						var add_height = '';
					}else{
						var add_height = '';
					}
					
					
					if(canswitch == 'true'){
						var starter_div = '<div id="canswitch" data-sid="'+ sid +'"><div id="body-'+sid+'" style="display:none;">'+realbody+'</div>';
						var enderer_div = '</div>'
					}else{
						var starter_div = enderer_div = '';
					}

                    $('.layout .content .chat .chat-body .messages').append(starter_div + `<div class="message-item ` + type + ` message-` + sid + `">
                        <div class="message-avatar">
                            <figure class="avatar">
                                <img src="` + (type == 'outgoing-message' ? avatar : avatar) + `" class="rounded-circle">
                            </figure>
                            <div>
                                <h5>` + (type == 'outgoing-message' ? name : name) + `</h5>
                                <div class="time" style="display:` + attachment_display + `" id="time` + sid +`"> ` + time + ' ' + (type == 'outgoing-message' ? '<span class="tik_tik">sent</span>' : '') + `</div>
                            </div>
                        </div>` + add_height + `
                        <div class="message-content" style="display:` + show_message_box + `" id="` + sid + `">
                            ` + message + `
                        </div>
						` + attachment_info + `
                    </div>` + enderer_div);

                    setTimeout(function () {
                        chat_body.scrollTop(chat_body.get(0).scrollHeight, -1).niceScroll({
                            cursorcolor: 'rgba(66, 66, 66, 0.20)',
                            cursorwidth: "4px",
                            cursorborder: '0px'
                        }).resize();
                    }, 200);
                }
            }
        }
    };
	
var your_name = $('#name').html();
var your_image = $('#your_image').html();
var agent_name = $('#agent_name').html();
var agent_image = $('#agent_image').html();

var sent_attach = return_attach = return_message = null;

var result = $.parseJSON(data);
if(result.uploaded_image!=""){
	var sent_attach = result.uploaded_image;
}
if(result.return_image!=""){
	var return_attach = result.return_image;
}
if(result.return_message!=""){
	var return_message = result.return_message;
	var system_sid = result.system_sid;
}
var sid = result.sid;

function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}


var min = 2;
var max = 5;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var seen_time = random*1000;

var min = 5;
var max = 10;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var typing_show_time = random*1000;


var min = 35;
var max = 40;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var display_time = random*1000;

var reserved_content = '';

if($('#canswitch').length >0 ){
	var system_sid = $('#canswitch').data('sid');
	var return_message = $('#body-'+system_sid).html();
	var reserved_content = $('#canswitch').html();
	$('#canswitch').hide();

	var min = 10;
	var max = 15;
	var random = Math.floor(Math.random() * (max - min + 1)) + min;
	var display_time = random*1000;


}



SohoExamle.Message.add(your_name,your_image, 'outgoing-message', description, sent_attach, null, sid, formatAMPM(new Date));

setTimeout(function () {
    var base_url = $('#base_url').html()
	$('.tik_tik').html('<span class="text-info">seen</span>');
    // $('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/knob.mp3" type="audio/mpeg">').appendTo('body');
    // $('#notify')[0].play();
},seen_time);

if(return_message!=""){
	
if($('#canswitch').length > 0 ){
	$('div#canswitch').removeAttr('id').html('');
	$('.layout .content .chat .chat-body .messages').append('<div id="canswitch">'+reserved_content+'</div>');

}

setTimeout(function () {

if($('#canswitch').length == 0 ){
SohoExamle.Message.add(agent_name,agent_image,null,null,return_attach,'none', system_sid, formatAMPM(new Date),'true',return_message);
}

},typing_show_time);

}

if($('#in_progress').html() == '' ){

$('#in_progress').html('inprogress');

setTimeout(function () {

$('.message-'+system_sid).hide();
SohoExamle.Message.add(agent_name,agent_image,null,return_message,return_attach,'block', system_sid, formatAMPM(new Date),'true',return_message);


var base_url = $('#base_url').html()
$('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/eventually.ogg" type="audio/ogg">').appendTo('body');
$('#notify')[0].play();

$('#in_progress').html('');

// update message status
var send_data = 'get_latest_updates=true&regular_update=true';
var url = window.location.href;
   $.ajax({   
    type : 'GET',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : send_data,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
        {
			$('div#canswitch').removeAttr('id');
		}
		
   });
   
 // end of update message status

},display_time);

}

	}

   });

return false;
}else{
	$("#contact_email").addClass('is-invalid').focus();
	return false;
}

});

$(document).on('keypress','#contact_email',function( e ) {
if(e.which==13){
	
var email = $('#contact_email').val();
var description = $('#description').val();

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

if(email.length>0 && email!="" && isEmail(email)){


	var form = $('#message_form')[0];
	var formData = new FormData(form);
	formData.append('submit_comment', 'true');
	formData.append('email', email);
	
	var url = window.location.href;
   $.ajax({   
    type : 'POST',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : formData,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
	{
		$('#emailTour').modal('hide');
		setTimeout(function(){ 	
		$('#description').focus().val("");	
		},1000);
		
		$('#email').html(email);
		
		$('#message_form')[0].reset();

    var SohoExamle = {
        Message: {
            add: function (name, avatar, type, message, attachment, attachment_display, sid, time, canswitch, realbody) {
                var chat_body = $('.layout .content .chat .chat-body');
                if (chat_body.length > 0) {

					if(type=='outgoing-message' && attachment!="" && message==""){
						var show_message_box = 'none';
					}else{
						var show_message_box = 'block';
					}
                    type = type ? type : '';
                    message = message ? message : '<span class="text-typing">Typing...</span>';
                    attachment_display = attachment_display ? attachment_display : 'block';
					
                    attachment_info = attachment ? '<figure id="attachment'+sid+'" style="display:'+attachment_display+'"><a href="'+attachment+'" data-toggle="lightbox"><img src="'+attachment+'" class="w-25 img-fluid rounded" alt="'+attachment+'"></a></figure>' : '';


					if(type != 'outgoing-message'){
						var add_height = '<div class="additional-height" style="height:300px;overflow:hidden;display:block;"></div>';
					}else{
						var add_height = '';
					}
					
					
					if(canswitch == 'true'){
						var starter_div = '<div id="canswitch" data-sid="'+ sid +'"><div id="body-'+sid+'" style="display:none;">'+realbody+'</div>';
						var enderer_div = '</div>'
					}else{
						var starter_div = enderer_div = '';
					}

                    $('.layout .content .chat .chat-body .messages').append(starter_div + `<div class="message-item ` + type + ` message-` + sid + `">
                        <div class="message-avatar">
                            <figure class="avatar">
                                <img src="` + (type == 'outgoing-message' ? avatar : avatar) + `" class="rounded-circle">
                            </figure>
                            <div>
                                <h5>` + (type == 'outgoing-message' ? name : name) + `</h5>
                                <div class="time" style="display:` + attachment_display + `" id="time` + sid +`"> ` + time + ' ' + (type == 'outgoing-message' ? '<span class="tik_tik">sent</span>' : '') + `</div>
                            </div>
                        </div>` + add_height + `
                        <div class="message-content" style="display:` + show_message_box + `" id="` + sid + `">
                            ` + message + `
                        </div>
						` + attachment_info + `
                    </div>` + enderer_div);

                    setTimeout(function () {
                        chat_body.scrollTop(chat_body.get(0).scrollHeight, -1).niceScroll({
                            cursorcolor: 'rgba(66, 66, 66, 0.20)',
                            cursorwidth: "4px",
                            cursorborder: '0px'
                        }).resize();
                    }, 200);
                }
            }
        }
    };
	
var your_name = $('#name').html();
var your_image = $('#your_image').html();
var agent_name = $('#agent_name').html();
var agent_image = $('#agent_image').html();

var sent_attach = return_attach = return_message = null;

var result = $.parseJSON(data);
if(result.uploaded_image!=""){
	var sent_attach = result.uploaded_image;
}
if(result.return_image!=""){
	var return_attach = result.return_image;
}
if(result.return_message!=""){
	var return_message = result.return_message;
	var system_sid = result.system_sid;
}
var sid = result.sid;

function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

var min = 2;
var max = 5;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var seen_time = random*1000;

var min = 5;
var max = 10;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var typing_show_time = random*1000;


var min = 35;
var max = 40;
var random = Math.floor(Math.random() * (max - min + 1)) + min;
var display_time = random*1000;

var reserved_content = '';

if($('#canswitch').length >0 ){
	var system_sid = $('#canswitch').data('sid');
	var return_message = $('#body-'+system_sid).html();
	var reserved_content = $('#canswitch').html();
	$('#canswitch').hide();


	var min = 10;
	var max = 15;
	var random = Math.floor(Math.random() * (max - min + 1)) + min;
	var display_time = random*1000;


}



SohoExamle.Message.add(your_name,your_image, 'outgoing-message', description, sent_attach, null, sid, formatAMPM(new Date));

setTimeout(function () {
    var base_url = $('#base_url').html()
	$('.tik_tik').html('<span class="text-info">seen</span>');
    // $('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/knob.mp3" type="audio/mpeg">').appendTo('body');
    // $('#notify')[0].play();

},seen_time);

if(return_message!=""){
	
if($('#canswitch').length > 0 ){
	$('div#canswitch').removeAttr('id').html('');
	$('.layout .content .chat .chat-body .messages').append('<div id="canswitch">'+reserved_content+'</div>');
}

setTimeout(function () {

if($('#canswitch').length == 0 ){
SohoExamle.Message.add(agent_name,agent_image,null,null,return_attach,'none', system_sid, formatAMPM(new Date),'true',return_message);
}

},typing_show_time);

}

if($('#in_progress').html() == '' ){

$('#in_progress').html('inprogress');

setTimeout(function () {

$('.message-'+system_sid).hide();
SohoExamle.Message.add(agent_name,agent_image,null,return_message,return_attach,'block', system_sid, formatAMPM(new Date),'true',return_message);

var base_url = $('#base_url').html()
$('<audio id="notify"><source src="'+base_url+'/app-assets/chat/sounds/eventually.ogg" type="audio/ogg">').appendTo('body');
$('#notify')[0].play();

$('#in_progress').html('');

// update message status
var send_data = 'get_latest_updates=true&regular_update=true';
var url = window.location.href;
   $.ajax({   
    type : 'GET',
    url  : url,
    mimeType:"multipart/form-data",
	xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
      	},
    data : send_data,
    cache:false,
    contentType: false,
    processData: false,
	timeout: 10000 ,
    success : function(data)
        {
			$('div#canswitch').removeAttr('id');
		}
		
   });
   
 // end of update message status

},display_time);

}
					
	}

   });

return false;
}else{
	$("#contact_email").addClass('is-invalid').focus();
	return false;
}

}
	
});



$(document).on('click','#show_phone',function( e ) {
	
	$('#showPhone').modal('show');
	
});


$(document).on('click','#show_email',function( e ) {
	
	$('#showEmail').modal('show');
	
});

});