$(document).ready(function () {



    function countdown() {

        var i = document.getElementById('counter');
    
        
        if(parseInt(i.innerHTML) >0){
        i.innerHTML = parseInt(i.innerHTML)-1;
        }

    if(parseInt(i.innerHTML)<=0) {
    
    //  window.close();
    
    }
    
    }

    


    

    $(document).on("click",".action",function( e ) {


            const doTask = function(){

                var timmer = $('#counter').html();

                var sec = parseInt(timmer);
                var origin = $('#origin_time').data("time");
                this.clearInterval(interval);
                if(sec>0 && sec!=origin){
                    $("#message").slideDown('fast').html('<div class="alert alert-danger text-center">Sorry! your task wasn\'t completed</div>');
                    $(".action").attr('disabled', false);
                    $('#counter').html(origin);
                    return false;
                }

                var reward = $("#reward").html();
                $("#message").slideDown('fast').html('<div class="alert alert-success text-center">Successfull! your task has successfully completed.</div>');

                setTimeout(function(){
                    $("#message").slideDown('fast').html('<div class="alert alert-success text-center">Verifying and addeding your reward.</div>');
                },1000);

                setTimeout(function(){
                    var url = $(".action").data("url");
                    var id = $(".action").data("id");
                    var hash = $("#task_hash").data("token");
                    var go_url = url + '/dotasks/?task&complete=true&task_id=' + id + '&token=' + hash;
                    $("#message").slideDown('fast').html('<div class="alert alert-success text-center">Getting new task.</div>');
                    window.location.href = go_url;
                    return false;

                }, 2000);
            }

            window.addEventListener('focus', function (event) {
                setTimeout(function(){
                doTask();
                }, 1000)
            });
            

        // },100);

        var id = $(this).data("id");
        var type = $(this).data("type");
        var url = $(this).data("url");
        var duration = $(this).data("duration");

        var go_url = url + '/' + 'go/task/' + id;
        // if(type == "newwindow"){
            window.open(go_url, '', '_blank');
        // }


        // setTimeout(function(){

        // var ele = '<a href="'+window.base_url+'/claim/reward/'+id+'"><button class="btn btn-default btn-action btn-transform-primary">Claim Reward</button></a>';
        // $('.purchase-area').html(ele).slideDown("fast");

        // },(duration*1000));

        // window.onbeforeunload = function () {
        // setTimeout(function(){
        var interval = setInterval(function(){ countdown(); },1000);
    // }, 7000);
        // }
        

        $(document).on("focusout","body",function( e ) {
            $(".action").attr('disabled', true);
            
          });

        $(document).on("focus","body",function( e ) {
            
          });
        

    });

});