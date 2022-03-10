$(document).ready(function(){


    $(window).resize(function() {
    
        setTimeout(function(){ 
        var findNav = $("#sidebarMenu").width();
        $('.b-collapse-sidebar').css({"left": findNav +"px"});
    }, 150);

    });

        var findNav = $("#sidebarMenu").width();
        $('.b-collapse-sidebar').css({"left": findNav +"px"});


    $("#sidebarMenu").hover(function(){

        if($(this).hasClass("minimal-sidebar-added")){
            $(this).toggleClass('minimal-sidebar no-minimal-slider');
            $('.nav-link-text').toggleClass("d-block d-none");

            $('main').toggleClass("col-md-9 col-md-11");
            $('main').toggleClass("col-lg-10 col-lg-11");


            if($('.brand-text').hasClass("show")){

                setTimeout(function(){ 

                $('.brand-text').removeClass('show');
            }, 250);
        
            }else{

                setTimeout(function(){ 
                $('.brand-text').addClass('show');
            }, 110);
                
            }
        
            if($('.brand-img').hasClass("show")){
                
            setTimeout(function(){ 
                $('.brand-img').removeClass('show');

            }, 100);
        
            }else{
            
                setTimeout(function(){ 
                $('.brand-img').addClass('show');
            }, 300);

            }


        
            setTimeout(function(){ 
            var findNav = $("#sidebarMenu").width();
            $('.b-collapse-sidebar').css({"left": findNav +"px"});
        }, 150);
        }

    })

$("#toggle-sidebar-now").click(function(){

    $('.nav-link-text').toggleClass("d-block d-none");

    $('main').toggleClass("col-md-9 col-md-11");
    $('main').toggleClass("col-lg-10 col-lg-11");

    if($('#sidebarMenu').hasClass("minimal-sidebar")){
        $('#sidebarMenu').removeClass('minimal-sidebar');
    }else{
        $('#sidebarMenu').addClass('minimal-sidebar');
    }

    if($('.navbar-brand').hasClass("minimal-sidebar")){
        $('.navbar-brand').removeClass('minimal-sidebar');
    }else{
        $('.navbar-brand').addClass('minimal-sidebar');
    }
    

    if($('#sidebarMenu').hasClass("minimal-sidebar-added")){
        $('#sidebarMenu').removeClass('minimal-sidebar-added');
    }else {
        $('#sidebarMenu').addClass('minimal-sidebar-added');
    }

    if($('.navbar-brand').hasClass("minimal-sidebar-added")){
        $('.navbar-brand').removeClass('minimal-sidebar-added');
    }else{
        $('.navbar-brand').addClass('minimal-sidebar-added');
    }

    // $('.navbar-brand').removeClass('minimal-sidebar-added');
    // $('.navbar-brand').removeClass('minimal-sidebar-added');

    if($('.brand-text').hasClass("show")){

        setTimeout(function(){ 

        $('.brand-text').removeClass('show');
    }, 250);

    }else{

        setTimeout(function(){ 
        $('.brand-text').addClass('show');
    }, 110);
        
    }

    if($('.brand-img').hasClass("show")){
        
    setTimeout(function(){ 
        $('.brand-img').removeClass('show');

    }, 100);

    }else{
    
        setTimeout(function(){ 
        $('.brand-img').addClass('show');
    }, 300);

    }

    setTimeout(function(){ 
    var findNav = $("#sidebarMenu").width();
    $('.b-collapse-sidebar').css({"left": findNav +"px"});
}, 150);

});


$(".nav-item").click(function(){

    if ( $(this).children(".menu-sub").length > 0 ) {
    var dropdownMenu = $(this).children(".menu-sub");
    dropdownMenu.slideToggle("fast");

    
}
var icon = $(this).find("svg>polyline");


if(icon.attr("points") == "9 18 15 12 9 6"){
    icon.attr("points","6 9 12 15 18 9");
}
else
if(icon.attr("points") == "6 9 12 15 18 9"){
    icon.attr("points","9 18 15 12 9 6");
}


});


});