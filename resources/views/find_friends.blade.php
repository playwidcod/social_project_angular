@include('layouts.crud')
<!-- for friend request -->
<!-- <script src="{{URL('/')}}/storage/Client-Side-Pagination-Plugin-jQuery-cPager/js/cPager.js"></script> -->
<style type="text/css">
.btn{
  height: 38px;
    width: 99px;
}
.pending{
  height: 38px;
    width: 99px;
    background: skyblue;
}
.accepted{
  height: 38px;
    width: 99px;
    background: lightgreen; 
}
.delete_req{
  height: 20px;
  width: 97px;
  background: orange;
  border:1px solid white;
  color:white;
}
.accept_req{
  height: 20px;
  width: 97px;
  background: blue;
  border:1px solid white;
  color:white;
}   
</style>
<script>
$(document).ready(function(){
  var fg = 0;
    $.ajax({
          headers: {
             'X-CSRF-Token': "{{csrf_token()}}"
          },
          url: '/getstatus',
          dataType: 'html',
          data:{offset:0,limit:5},
          type: 'post',
          success: function(data) {
             fg += 4;
              $(".find").append(data);
            }
    }); 
$(window).scroll(function(){
    if($(window).scrollTop() == $(document).height() - $(window).height()){ 
      fg = fg+1;
        $.ajax({
          headers: {
             'X-CSRF-Token': "{{csrf_token()}}"
          },
          url: '/getstatus',
          dataType: 'html',
          data:{offset:fg,limit:5},
          type: 'post',
          success: function(data) {
             fg += 4;
              $(".find").append(data);
            }
    }); 
    }
});
$(document).on('click','button.btn',function(){
                        clicked = $(this).html('pending');
                         if($(this).html() == 'pending'){
                          $(this).addClass('pending');
                         }
                         $(this).attr('disabled','disabled');
                         requester = "<?php echo session()->get('id')?>";
                         user_requested = $(this).parent().parent().find(".frdid").val();
                         $.ajax({
                            headers: {
                                 'X-CSRF-Token': "{{csrf_token()}}"
                            },
                            url:'/request',
                            dataType:'html',
                            type:'post',
                            data:{user_requested:user_requested,requester:requester},
                            success:function(data){
                              
                            }
                         });
                      }); 
});  
</script>
<!-- for friend request -->
<h1 align="center">Find Friends</h1>

<div class="find" id="listShow"></div>