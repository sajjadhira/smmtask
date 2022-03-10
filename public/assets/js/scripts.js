$(document).ready(function () {
    $('.data-default-currency').html('৳');
  });

$(document).ready(function(){

    var width = $(window).width(); 
    // alert(width);

    if(width >= 640){
    
    $(".dropdown").hover(function(){
        var dropdownMenu = $(this).children(".dropdown-menu");
        dropdownMenu.toggleClass("show");
    });

    }


    if(width <= 640){

    $(function($) {
        $(window).scroll(function fix_collaps() {
          
            $(window).scrollTop() > 50
            ? $('.navbar-collapse').addClass('navitem-collapse-minimal')
            : $('.navbar-collapse').removeClass('navitem-collapse-minimal')
        
          return fix_collaps;
        }());
      });


    }
    

    $(".navbar-toggler").click(function(){
        var dropdownMenu = $(this).children(".navbar-toggler-icon");
        dropdownMenu.toggleClass("rottate-it");
    });
    
});   



$(document).ready(function(e) {



    
	// $(".navbar-toggler-icon").on("click", function(e) {

	// 	if($(this).hasClass('fa-rotate-180')){
	// 	$(this).removeClass('fa-rotate-180');
	// 	}else{
	// 	$(this).addClass('fa-rotate-180');
	// 	}

	// });

    var t = e(".cd-top");
    $(window).scroll(function() {
        $(this).scrollTop() > 300 ? $(".cd-top").addClass("cd-is-visible") : $(".cd-top").removeClass("cd-is-visible cd-fade-out"), $(this).scrollTop() > 1200 && $(".cd-top").addClass("cd-fade-out")
    }); 

    $(".cd-top").on("click", function(t) {
        t.preventDefault(), $("body,html").animate({
            scrollTop: 0
        }, 700)
    }); 

    $(".counter-count").each(function() {
        $(this).prop("Counter", 0).animate({
            Counter: $(this).text()
        }, {
            duration: 5e3,
            easing: "swing",
            step: function(e) {
                $(this).text(Math.ceil(e))
            }
        })
    }); 

    var a = document.getElementById("header"),
        s = document.getElementById("navbar");

    $(".smoothscroll").on("click", function(e) {
        e.preventDefault();
        var t = this.hash;
        $("html, body").stop().animate({
            scrollTop: $(t).offset().top - 60
        }, 1200)
    });
    a.offsetTop;

    $(function($) {
        $(window).scroll(function fix_element() {
          
            $(window).scrollTop() > 50
            ? $('.navbar').addClass('sticky')
            : $('.navbar').removeClass('sticky')
        
          return fix_element;
        }());
      });

    $(document).on("click", "#send-message", function(e) {
        var t = $("#name").val(),
            a = $("#email").val(),
            s = $("#message").val();
        if (0 == t.length || "" == t) return $(".contact-message").fadeIn("fast").html('<div class="alert alert-warning text-center">Please type your name!</div>').delay(2e3).fadeOut("fade"), $("#name").focus(), !1;
        if ($(".contact-message").fadeIn("fast").html(null).delay(2e3).fadeOut("fade"), 0 == a.length || "" == a || !/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(a)) return $(".contact-message").fadeIn("fast").html('<div class="alert alert-warning text-center">Please type a valid email!</div>').delay(2e3).fadeOut("fade"), $("#email").focus(), !1;
        if ($(".contact-message").fadeIn("fast").html(null).delay(2e3).fadeOut("fade"), 0 == s.length || "" == s) return $(".contact-message").fadeIn("fast").html('<div class="alert alert-warning text-center">Message should not empty!</div>').delay(2e3).fadeOut("fade"), $("#message").focus(), !1;
        $(".contact-message").fadeIn("fast").html(null).delay(2e3).fadeOut("fade");
        var n = window.location.href,
            l = "message=true&name=" + t + "&email=" + a + "&message=" + s;
        return t.length > 0 && a.length > 0 && s.length > 0 && $.ajax({
            type: "POST",
            url: n,
            data: l,
            timeout: 1e4,
            success: function(e) {
                $(".contact-message").fadeIn("fast").html(e).delay(3e3).fadeOut("fade")
            }
        }), !1
    })
});