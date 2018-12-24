@include('layouts.crud')
<script src="https://cdn.jsdelivr.net/jpages/0.7/js/jPages.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{URL('/')}}/storage/Client-Side-Pagination-Plugin-jQuery-cPager/css/cPager.css">
<style type="text/css">
   .olderview {
    background-color: #3498DB;
    color: white;
    /*padding: 3px;*/
    font-size: 12px;
    border: 1px solid grey;
    cursor: pointer;
}

.olderview:hover, .olderview:focus {
    background-color: #2980B9;
}

.older {
    position: relative;
    display: inline-block;
}
  
.older-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    width: 352px;
    margin-left: -78px;
}

.older-content li {
    color: black;
    /*padding: 12px 16px;*/
    text-decoration: none;
    display: block;
        margin-left: -39px;
}

.older li:hover {background-color: #ddd;}

.show {display: block;} 
</style>
<style type="text/css">
.title{
	border:4px outset #dad2d2;
	width: 320px;
    padding: 2px;
    background: #ccd6e2;
    float: left;
    margin-left: 10px;
}
h3{
	margin-left: 124px;
    margin-bottom: -21px;
    margin-top: 5px;
}
p{
	margin-left: 12px;
}
.pagination{
	float: left;
    margin-top: 343px;
    margin-left: -120px;
    /*background: grey;*/
}
.post{
    height: 500px;
    width: 841px;
    border:1px solid #806262;
}
.post_by_img{
        height: 36px;
}
.post_by_img:hover{
        height: 38px;
        border:1px solid white;
}
video{
    margin-left: 26px;
    margin-top: 30px;
    border: 2px solid grey;
    float: left;
}
.likedby{
        margin-left: 89px;
}
.comment{
    height: 50px;
}
.comment:hover{
  height: 50px;
  border:1px solid #3187aa;
}
button.user_comment{
    background:#3187aa;
    color:white;
}
.ul_class{
        width: 326px;
}
</style>
<h1 align="center">Home</h1>

<script type="text/javascript">
    function skeleton(element){
        var file = element.post_vdo.split('.');
        return $(".posts_of_friends").append('<div class="post li-item hide" style="background: #cde5ef;"><item><img id="' + element.id + '" class="post_by_img" src="{{URL('/')}}/storage/downloads/' + element.profile_pic + '"><b><br><name>' + element.name + '</name></b><hr><h3>Title: ' + element.title + '</h3><div class="video"><img src="{{URL('/')}}/storage/downloads/thumbnail/'+file[0]+'.jpg" height="240" width="450" style="float:left;"><video autoplay muted style="display:none;" height="250" width="450" controls><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/mp4"><source class="vdo" src="{{URL('/ ')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/ogg"><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/webm">Your browser does not support the video tag.</video></div><div class="description"><p><b>Description:</b>&nbsp;' + element.description + '</p></div></item><likecomment><button align="left" class="user_like {{ session()->get('id') }}" id="' + element.id + '"  style="background:#3187aa;color:white;">like</button><br><label id="'+element.id+'" class="total_likes">Total Likes:</label>&nbsp;&nbsp;<clk class="clk"></clk>&nbsp;&nbsp;<br><label>Total comments :</label>&nbsp;<cmt_count id="cmt_count" class="'+element.id+'"></cmt_count><br><textarea class="comment" placeholder="comment here..."></textarea><br><button class="user_comment" style="background:#3187aa;color:white;">Comment</button>&nbsp;&nbsp;&nbsp;<hr><br><likes class="likes1"></likes></likecomment><commentsection class="'+element.id+'"></commentsection><div class="dropdown"><button class="dropbtn '+element.id+'"  id="oldercomments">Older comments</button><div class="dropdown-content old-cont"></div></div></li></ul></div></div><br>');
    }
    function viewcomments(post_id){
        $("commentsection").children().remove();
        $("button#oldercomments").parent().find(".old-cont").children().remove();
        $.ajax({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "/view_oldr_cmts",
            type: 'post',
            data: {
                post_id: post_id
            },
            dataType: 'json',
            success: function(data) {
                $(".comment").val('');
                $("commentsection."+this.post_id+"").children().remove();
                // $("cmt_count#"+this.id+"").append('test');
                
                $.each(data,function(){
                    $(document).children().find('cmt_count#cmt_count.'+this.post_id+'').html(data.length);
                    if(data.length > 3){
                        
                        $(".allcomments").hide();
                        
                        $("button#oldercomments."+this.post_id+"").css({"display":"block"});
                        src = "http://localhost:8000/storage/downloads/"+this.profile_pic+"";
                        $("button#oldercomments."+this.post_id+"").parent().find(".old-cont").append('<ul class="ul_class"><li id="'+this.post_id+'"><img style="    float: left;" height="50" width="50" src="' + src + '" class="cmtd_frd"><div class="cmtd_name">' + this.name + '</div><label style="color:#3187aa;">comment: </label><div class ="frd_cmt" id="' + this.id + '">' + this.user_comments + '</div><button class="'+this.id+'" id="deleteoldcomt">Dedlete</button></li></ul>');
                      $("button#oldercomments."+this.post_id+"").parent().parent().addClass('active'+this.post_id+'');
                        
                           $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").slice(3, $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").length).hide();
                    }else{
                        $("button#oldercomments."+this.post_id+"").css({"display":"none"});
                    return $("commentsection."+this.post_id+"").append('<div class="allcomments"><comment id="'+this.post_id+'"><img src="http://localhost:8000/storage/downloads/thumbnail/'+this.profile_pic+'"><name id="'+this.id+'">'+this.name+'&nbsp;</name><label>Comment :</label><text>'+this.user_comments+'</text>&nbsp;<button class="'+this.id+'" id="deleteoldcomt">delfete</button></comment></div>');
                    }
                    $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().find('.testing').remove();
                    $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().append('<div class="testing"><button class="LoadMore">Load More</button>&nbsp;<p class="totop">&nbsp;&nbsp;<a href="#top" class="tp" style="margin-left:15px;">Back to top</a></p></div>');
                });
            }
        });
    }
 
    function usercomment(post_id,user_id,comment){
        $.ajax({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "/comment",
            type: 'post',
            data: {
                user_id: user_id,
                post_id: post_id,
                comment: comment
            },
            dataType: 'html',
            success: function(data) {
                $("commentsection").children().remove();
                viewcomments(post_id);
            }
        });
    }
    function deletecomments(commentid,post_id){

         $.ajax({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "/deletecomment",
            type: 'post',
            dataType: 'json',
            data: {
                comt_id: commentid
            },
            success: function(data) {
                if(data == 'You are not allowed to delete'){
                    alert("You are not allowed to delete");
                }else{
                    viewcomments(post_id);
                }
                
            }
        });
    }
    function innerfunc_getlk(data){

        if( $(document).children().find("label#"+data.post_id+"").next("clk").html() !== ''){
            var old = $(document).children().find("label#"+data.post_id+"").next("clk").html();
            console.log(old)
            $(document).children().find("label#"+data.post_id+"").next("clk").html(parseInt(data.user_like) + parseInt(old));
        }else{
            $(document).children().find("label#"+data.post_id+"").next("clk").html(data.user_like);
        }
        if(data.user_id == "{{ session()->get('id') }}"){
          $(document).children().find("button#"+data.post_id+".user_like."+data.user_id+"").css({"background":"red"}).html('unlike');
        }
    }
 $(document).ready(function(){
   
    $.ajax({
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        url: "/home",
        type: 'get',
        dataType: 'json',
        success: function(data) {
           var i =0;
            $.each(data,function(index,element){
                i++;
                if(i == data.length){
                        $.each(element.likes,function(){
                            innerfunc_getlk(data = this);
                        });
                }else{ 
                        skeleton(element);
                        var post_id = element.id;
                        viewcomments(post_id);
                    
                        $(".video").hover(function(){
                            $(this).parent().find(".video").children("img").css({"display":"none"});
                            $(this).parent().find(".video").children("video").css({"display":""});
                            }, function(){
                            $(this).parent().find(".video").children("img").css({"display":""});
                            $(this).parent().find(".video").children("video").css({"display":"none"});
                        });
                        if (this.user_like == '1') {
                            $(document).find('button#' + element.id + '.user_like').html('unlike').css({
                                "background": "red"
                            }).addClass("unlike");
                        } else {
                            $(document).find('button#' + element.id + '.user_like').html('like');
                        }
                }    
            });
            
        }
    });
    $(document).on('click',"button#deleteoldcomt",function(){
        var commentid = $(this).attr('class');
        var post_id = $(this).parent().attr('id');
        deletecomments(commentid,post_id);
    });

     $(document).on('click', ".user_like", function() {

        var post_id = $(this).attr('id');
        var user_id = "{{ session()->get('id') }}";
        $(this).parent().parent().find(".user_like").css({
            "background": "red"
        });

        if ($(this).parent().parent().find(".user_like").html() == "unlike") {
            $(this).parent().parent().find(".user_like").html("like").removeClass("unlike").css({
                "background": "#3898da"
            });
            $(this).parent().parent().find("clk").html(parseInt($(this).parent().parent().find("clk").html()) - 1);
        }else if( $(this).parent().parent().find("clk").html() == '' ){
            $(this).parent().parent().find(".user_like").html("unlike").addClass("unlike");
            $(this).parent().parent().find("clk").html(parseInt(1));
        }else {
            $(this).parent().parent().find(".user_like").html("unlike").addClass("unlike");
            $(this).parent().parent().find("clk").html(parseInt($(this).parent().parent().find("clk").html()) + 1);
        } //return false;
        $.ajax({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "/like",
            type: 'post',
            data: {
                user_id: user_id,
                post_id: post_id
            },
            dataType: 'html',
            success: function(data) {
                
            }
        });
    });
    $(document).on('click', ".user_comment", function() {
        var post_id = $(this).parent().parent().find('.post_by_img').attr('id');
        var user_id = "{{ session()->get('id') }}";
        var comment = $(this).parent().parent().find('.comment').val();
        if (comment == '') {
            alert("please enter your comment");
        }
        usercomment(post_id,user_id,comment);
    });
    $(document).on('click',".LoadMore", function(e) {
        e.preventDefault();
        $(".ul_class:hidden").slice(0, 3).slideDown();
            if ($(".ul_class:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
            $('html,body').animate({
                scrollTop: $(this).offset().top
            }, 1500);
    });
 });   
</script>

<div class="posts_of_friends" id="listShow" ></div>
{{ csrf_field() }}
