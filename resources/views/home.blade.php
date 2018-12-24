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
        return $(".posts_of_friends").append('<div class="post li-item hide" style="background: #cde5ef;"><item><img id="' + element.id + '" class="post_by_img" src="{{URL('/')}}/storage/downloads/' + element.profile_pic + '"><b><br><name>' + element.name + '</name></b><hr><h3>Title: ' + element.title + '</h3><div class="video"><img src="{{URL('/')}}/storage/downloads/thumbnail/'+file[0]+'.jpg" height="240" width="450" style="float:left;"><video autoplay muted style="display:none;" height="250" width="450" controls><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/mp4"><source class="vdo" src="{{URL('/ ')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/ogg"><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/webm">Your browser does not support the video tag.</video></div><div class="description"><p><b>Description:</b>&nbsp;' + element.description + '</p></div></item><likecomment><button align="left" class="user_like {{ session()->get('id') }}" id="' + element.id + '"  style="background:#3187aa;color:white;">like</button><br><label id="'+element.id+'" class="total_likes">Total Likes:</label>&nbsp;&nbsp;<clk class="clk">0</clk>&nbsp;&nbsp;<br><label>Total comments :</label>&nbsp;<cmt_count id="cmt_count" class="'+element.id+'"></cmt_count><br><textarea class="comment" placeholder="comment here..."></textarea><br><button class="user_comment" style="background:#3187aa;color:white;">Comment</button>&nbsp;&nbsp;&nbsp;<hr><br><likes class="likes1"></likes></likecomment><commentsection class="'+element.id+'"></commentsection><div class="dropdown"><button style="display:none;" class="dropbtn '+element.id+'"  id="oldercomments">Older comments</button><div id="'+element.id+'" class="dropdown-content old-cont"></div></div></li></ul></div></div><br>');
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
                
                $.each(data,function(){

                    if(data.length > 3){
                        $("button#oldercomments."+this.post_id+"").show();
                      
                        $("button#oldercomments."+this.post_id+"").css({"display":"block"});
                        src = "http://localhost:8000/storage/downloads/"+this.profile_pic+"";
                        $("button#oldercomments."+this.post_id+"").parent().find(".old-cont").append('<ul id="'+this.id+'" class="ul_class"><li id="'+this.post_id+'"><img style="    float: left;" height="50" width="50" src="' + src + '" class="cmtd_frd"><div class="cmtd_name">' + this.name + '</div><label style="color:#3187aa;">comment: </label><div class ="frd_cmt" id="' + this.id + '">' + this.user_comments + '</div><button class="'+this.id+'" id="deleteoldcomt">Delete</button></li></ul>');
                      $("button#oldercomments."+this.post_id+"").parent().parent().addClass('active'+this.post_id+'');
                           $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").slice(3, $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").length).hide();
                    }else{
                        
                    return $("commentsection."+this.post_id+"").append('<div class="allcomments"><comment id="'+this.post_id+'"><img height="20" width="20" src="http://localhost:8000/storage/downloads/'+this.profile_pic+'"><name id="'+this.id+'">'+this.name+'&nbsp;</name><label>Comment :</label><text>'+this.user_comments+'</text>&nbsp;<button class="'+this.id+'" id="deleteoldcomt">delete</button></comment></div>');
                    }
                    $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().find('.testing').remove();
                    $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().append('<div class="testing"><button class="LoadMore">Load More</button>&nbsp;<p class="totop">&nbsp;&nbsp;<a href="#top" class="tp" style="margin-left:15px;">Back to top</a></p></div>');
                });
            }
        });
    }
    function viewcomments2(post_id){
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
                $(document).find(".comment").val('');
                $(document).find("commentsection."+this.post_id+"").children().remove();
                
                $.each(data,function(){

                    if(data.length > 3){
                        $(document).find("button#oldercomments."+this.post_id+"").show();
                      
                        $(document).find("button#oldercomments."+this.post_id+"").css({"display":"block"});
                        src = "http://localhost:8000/storage/downloads/"+this.profile_pic+"";
                        $(document).find("button#oldercomments."+this.post_id+"").parent().find(".old-cont").append('<ul id="'+this.id+'" class="ul_class"><li id="'+this.post_id+'"><img style="    float: left;" height="50" width="50" src="' + src + '" class="cmtd_frd"><div class="cmtd_name">' + this.name + '</div><label style="color:#3187aa;">comment: </label><div class ="frd_cmt" id="' + this.id + '">' + this.user_comments + '</div><button class="'+this.id+'" id="deleteoldcomt">Delete</button></li></ul>');
                      $(document).find("button#oldercomments."+this.post_id+"").parent().parent().addClass('active'+this.post_id+'');
                           $(document).find('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").slice(3, $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").length).hide();
                    }else{
                        
                    return $(document).find("commentsection."+this.post_id+"").append('<div class="allcomments"><comment id="'+this.post_id+'"><img height="20" width="20" src="http://localhost:8000/storage/downloads/'+this.profile_pic+'"><name id="'+this.id+'">'+this.name+'&nbsp;</name><label>Comment :</label><text>'+this.user_comments+'</text>&nbsp;<button class="'+this.id+'" id="deleteoldcomt">delete</button></comment></div>');
                    }
                    $(document).find('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().find('.testing').remove();
                    $(document).find('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().append('<div class="testing"><button class="LoadMore">Load More</button>&nbsp;<p class="totop">&nbsp;&nbsp;<a href="#top" class="tp" style="margin-left:15px;">Back to top</a></p></div>');
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
                viewcomments2(post_id);
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
                // console.log(data);
                if(data == 'You are not allowed to delete'){
                    alert("You are not allowed to delete");
                }
                get_parent = $("button#deleteoldcomt."+commentid+"").parent();
                tag = get_parent[0].tagName;
                if(tag == 'COMMENT'){
                    console.log("comment ya");
                   
                     old_val = $(document).find("button#deleteoldcomt."+commentid+"").parents("div.post").children("likecomment").find("cmt_count#cmt_count."+post_id+"").html();
                     $(document).find("button#deleteoldcomt."+commentid+"").parents("div.post").children("likecomment").find("cmt_count#cmt_count."+post_id+"").html('');
                    $(document).find("button#deleteoldcomt."+commentid+"").parents("div.post").children("likecomment").find("cmt_count#cmt_count."+post_id+"").html(parseInt(old_val) - 1);
                     $("button."+commentid+"").parent().parent().remove();
                }else if(tag == 'LI'){
                    console.log("Li tag");
                    oldr_val = $(document).find("button#deleteoldcomt."+commentid+"").parents("div.post").children("likecomment").find("cmt_count#cmt_count."+post_id+"").html();
                    console.log(oldr_val);
                    $(document).find("button#deleteoldcomt."+commentid+"").parents("div.post").children("likecomment").find("cmt_count#cmt_count."+post_id+"").html('');
                    $(document).find("button#deleteoldcomt."+commentid+"").parents("div.post").children("likecomment").find("cmt_count#cmt_count."+post_id+"").html(parseInt(oldr_val) - 1);
                    new_val = $(document).find("button#deleteoldcomt."+commentid+"").parents("div.post").children("likecomment").find("cmt_count#cmt_count."+post_id+"").html();

                    $("button."+commentid+"").parent().parent().remove();

                    if(parseInt(new_val) == 3){
                        console.log(parseInt(new_val));
                        console.log("make changes");
                        $(document).find("div#6.old-cont").children().remove();
                        $(document).find("div#"+post_id+".old-cont").parent().find("button#oldercomments.dropbtn."+post_id+"").css({"display":"none"});

                        $.ajax({
                            headers: {
                                'X-CSRF-Token': "{{csrf_token()}}"
                            },
                            url: "/view_oldr_cmts",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                post_id: post_id
                            },
                            success:function(data){
                                $.each(data,function(){
                                    $(document).find("commentsection."+this.post_id+"").append('<div class="allcomments"><comment id="'+this.post_id+'"><img height="20" width="20" src="http://localhost:8000/storage/downloads/'+this.profile_pic+'"><name id="'+this.id+'">'+this.name+'&nbsp;</name><label>Comment :</label><text>'+this.user_comments+'</text>&nbsp;<button class="'+this.id+'" id="deleteoldcomt">delfete</button></comment></div>');
                                });
                            }
                        });
                    }
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
    function innerfunc_getcmts(data){
        return    $(document).find(".post, .li-item").children("likecomment").children("cmt_count#cmt_count."+data.post_id+"").html(data.count);
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
                        $.each(element.total_comments,function(){
                            innerfunc_getcmts(data = this);
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
            return false;
        }
        if (comment !== '') {
            old_val = $(this).parent().children("cmt_count#cmt_count."+post_id+"").html();
       $(this).parent().children("cmt_count#cmt_count."+post_id+"").html('');
       $(this).parent().children("cmt_count#cmt_count."+post_id+"").html(parseInt(old_val)+1);
        }
       
        usercomment(post_id,user_id,comment);
    });
    $(document).on('click',".LoadMore", function(e) {
        e.preventDefault();
        post_id = $(this).parent().parent().parent().prev("commentsection").attr('class');
              lth = $(this).parent().parent().children("ul.ul_class").length;
              $(this).parent().parent().children("ul.ul_class").css({"display":""});
              // lth = $(this).parent().parent().children("ul.ul_class").css({"display":"block"});

            not_need = new Array();
            for (var i = 0; i < lth; i++) {
                // console.log(i)
                comt_id = $(this).parent().parent().children("ul.ul_class").eq(i).attr('id');
                        not_need.push(comt_id);             
                        } 
                        // console.log(not_need)
        $.ajax({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "/view_oldr_cmts_opt",
            type: 'post',
            data: {
                post_id: post_id,
                not_need: not_need,
                limit: 3,
            },
            dataType: 'json',
            success: function(data) {

                if(data.length == 0){
                    $('.active'+post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().find('.testing').remove();
                     $('.active'+post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().append('<nomorecomts style="color:red;">No more comments<nomorecomts>');
                }
                $.each(data,function(){
                   $("button#oldercomments."+this.post_id+"").parent().find(".old-cont").append('<ul id="'+this.id+'" class="ul_class"><li id="'+this.post_id+'"><img style="    float: left;" height="50" width="50" src="' + src + '" class="cmtd_frd"><div class="cmtd_name">' + this.name + '</div><label style="color:#3187aa;">comment: </label><div class ="frd_cmt" id="' + this.id + '">' + this.user_comments + '</div><button class="'+this.id+'" id="deleteoldcomt">Delete</button></li></ul>');
                    $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().find('.testing').remove();
                    $('.active'+this.post_id+'').children("div.dropdown").children(".old-cont").children(".ul_class").children().last().parent().parent().append('<div class="testing"><button class="LoadMore">Load More</button>&nbsp;<p class="totop">&nbsp;&nbsp;<a href="#top" class="tp" style="margin-left:15px;">Back to top</a></p></div>');
                });
            }
        });
    });
 });   
</script>

<div class="posts_of_friends" id="listShow" ></div>
{{ csrf_field() }}
<!--script type="text/javascript">
        $(window).scroll(function() {
            fis = $(window).scrollTop();
            sec = $(document).height() - $(window).height() ;
            if(parseInt(fis) == parseInt(sec)){
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
                                $.each(element.total_comments,function(){
                                    innerfunc_getcmts(data = this);
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
            }
    });
</script-->
