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
</style>
<h1 align="center">Home</h1>
<script type="text/javascript">
//functions

//functions    
 $(document).ready(function(){

    var fg = 0;
    $.ajax({
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        url: "/home",
        type: 'post',
        dataType: 'json',
        data: {
            offset: 0,
            limit: 2
        },
        success: function(data) {
          // console.log(data);
           
            $.each(data, function(index, element) {     
                fg += 1;
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "/comments_viewable",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        lk_ct: element.id
                    },
                    success: function(data) {
                        // console.log(data);

                        $.each(data, function() {
                            if (data.length > 3) {
                                $(document).find('comment#' + this.post_id + '.cmtd').css({
                                    "display": "block"
                                }).children('cmtcount').html(data.length);

                            } else {
                                src = "{{URL('/')}}/storage/downloads/" + this.profile_pic;
                                $(document).find('comment#' + this.post_id + '.cmtd').css({
                                    "display": "block"
                                }).children('defaultt').append('<div class="comtbox"><input type="hidden" id="' + this.id + '" class="comtid" value="' + this.id + '"><img style="float:left;" height="15" width="15" src="' + src + '"><namee>' + this.name + '</namee><label style="float:left;color:#3187aa;">comment: </label><div>' + this.user_comments + '&nbsp;&nbsp;&nbsp;<button class="deletecomnt" id="deletecomnt">Delete</button></div><hr></div>').parent().find('div.older').css({
                                    "display": "none"
                                });
                            }
                        });
                    }
                });
                var file = element.post_vdo.split('.');
                $(".posts_of_friends").append('<div class="post li-item hide" style="background: #cde5ef;"><!--input type="text" class="10" value=""--><img id="' + element.id + '" class="post_by_img" src="{{URL('/')}}/storage/downloads/' + element.profile_pic + '"><b><br><name>' + element.name + '</name></b><hr><h3>Title: ' + element.title + '</h3><div class="video"><img src="{{URL('/')}}/storage/downloads/thumbnail/'+file[0]+'.jpg" height="240" width="450" style="float:left;"><video autoplay muted style="display:none;" height="250" width="450" controls><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/mp4"><source class="vdo" src="{{URL('/ ')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/ogg"><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/webm">Your browser does not support the video tag.</video></div><div class="description"><p><b>Description:</b>&nbsp;' + element.description + '</p></div><div class="likedby"><button align="left" class="user_like" id="' + element.id + '"  style="background:#3187aa;color:white;">like</button><br><label class="total_likes">Total Likes:</label>&nbsp;&nbsp;<clk class="clk">' + element.user_like + '</clk><br><textarea class="comment" placeholder="comment here..."></textarea><br><button class="user_comment" style="background:#3187aa;color:white;">Comment</button>&nbsp;&nbsp;&nbsp;<hr><br><likes class="likes1"></likes></div><comment style="display:none;" class="cmtd" id="' + element.id + '">&nbsp;<cmtcount style="background:red;color:white;border-radius:100px;width:15px;border:0px solid red;"></cmtcount>&nbsp;&nbsp;<defaultt style="float:left;margin-left:2px;"></defaultt><div class="older"><button class="olderview">Older Comments</button><div id="older_cmt" class="older-content"></div></div></comment></div><br>');
                $(".video").hover(function(){
                    $(this).parent().find(".video").children("img").css({"display":"none"});
                    $(this).parent().find(".video").children("video").css({"display":""});
                    }, function(){
                    $(this).parent().find(".video").children("img").css({"display":""});
                    $(this).parent().find(".video").children("video").css({"display":"none"});
                });
                // $.each(element.auth_lkd, function() {
                    // console.log(this.user_like);
                    if (this.user_like == '1') {
                        // console.log(element);
                        $(document).find('button#' + element.id + '.user_like').html('unlike').css({
                            "background": "red"
                        }).addClass("unlike");
                    } else {
                        $(document).find('button#' + element.id + '.user_like').html('like');
                    }
                // });
            });
        }
    });
    // $(window).scroll(function() {
    //     if ($(window).scrollTop() == $(document).height() - $(window).height()) {
    //         console.log(fg)
    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-Token': "{{csrf_token()}}"
    //             },
    //             url: '/home',
    //             dataType: 'html',
    //             data: {
    //                 offset: fg,
    //                 limit: 2    
    //             },
    //             type: 'post',
    //             success: function(data) {
    //                 $.each($.parseJSON(data), function(index, element) {
    //                     fg += 1;

    //                     lk_ct = element.id;
    //                     var file = element.post_vdo.split('.');
    //                     $(".posts_of_friends").append('<div class="post li-item hide" style="background: #cde5ef;"><!--input type="text" class="10" value=""--><img id="' + element.id + '" class="post_by_img" src="{{URL('/')}}/storage/downloads/' + element.profile_pic + '"><b><br><name>' + element.name + '</name></b><hr><h3>Title: ' + element.title + '</h3><div class="video"><img src="{{URL('/')}}/storage/downloads/thumbnail/'+file[0]+'.jpg" height="240" width="450" style="float:left;"><video style="display:none;" height="250" width="450"  autoplay muted controls><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/mp4"><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/ogg"><source class="vdo" src="{{URL('/')}}/storage/downloads/videofolder/' + element.post_vdo + '" type="video/webm">Your browser does not support the video tag.</video></div><div class="description"><p><b>Description:</b>&nbsp;' + element.description + '</p></div><div class="likedby"><button align="left" class="user_like" id="' + element.id + '"  style="background:#3187aa;color:white;">like</button><br><label class="total_likes">Total Likes:</label>&nbsp;&nbsp;<clk class="clk">' + element.user_like + '</clk><br><textarea class="comment" placeholder="comment here..."></textarea><br><button class="user_comment" style="background:#3187aa;color:white;">Comment</button>&nbsp;&nbsp;&nbsp;<hr><br><likes class="likes1"></likes></div><comment style="display:none;" class="cmtd" id="' + element.id + '">&nbsp;<cmtcount style="background:red;color:white;border-radius:100px;width:15px;border:0px solid red;"></cmtcount>&nbsp;&nbsp;<defaultt style="float:left;margin-left:2px;"></defaultt><div class="older"><button class="olderview">Older Comments</button><div id="older_cmt" class="older-content"></div></div></comment></div><br>');
    //                     $.ajax({
    //                         headers: {
    //                             'X-CSRF-Token': "{{csrf_token()}}"
    //                         },
    //                         url: "/comments_viewable",
    //                         type: 'post',
    //                         dataType: 'json',
    //                         data: {
    //                             lk_ct: element.id
    //                         },
    //                         success: function(data) {
    //                             //    console.log(data);

    //                             $.each(data, function() {

    //                                 if (data.length > 3) {
    //                                  $(document).find('comment#' + this.post_id + '.cmtd').css({
    //                                         "display": "block"
    //                                     }).children('cmtcount').html('');
    //                                     $(document).find('comment#' + this.post_id + '.cmtd').css({
    //                                         "display": "block"
    //                                     }).children('cmtcount').html(data.length);

    //                                 } else {
    //                                     src = "{{URL('/')}}/storage/downloads/" + this.profile_pic;
    //                                     $(document).find('comment#' + this.post_id + '.cmtd').css({
    //                                         "display": "block"
    //                                     }).children('defaultt').children().remove();

    //                                     $(document).find('comment#' + this.post_id + '.cmtd').css({
    //                                         "display": "block"
    //                                     }).children('defaultt').append('<div class="comtbox"><input type="hidden" id="' + this.id + '" class="comtid" value="' + this.id + '"><img style="float:left;" height="15" width="15" src="' + src + '"><namee>' + this.name + '</namee><label style="float:left;color:#3187aa;">comment: </label><div>' + this.user_comments + '&nbsp;&nbsp;&nbsp;<button class="deletecomnt" id="deletecomnt">Delete</button></div><hr></div>').parent().find('div.older').css({
    //                                         "display": "none"
    //                                     });
    //                                 }
    //                             });
    //                         }
    //                     });
    //                     // $.each(element.auth_lkd, function() {
    //                         // console.log(this.user_like);
    //                         if (this.user_like == '1') {
    //                             // console.log(element);
    //                             $(document).find('button#' + element.id + '.user_like').html('unlike').css({
    //                                 "background": "red"
    //                             }).addClass("unlike");
    //                         } else {
    //                             $(document).find('button#' + element.id + '.user_like').html('like');
    //                         }
    //                     // });
    //                 });
    //             }
    //         });
    //     }
    // });
});
</script>  
<div class="posts_of_friends" id="listShow" ></div>

<!-- <div class="turn-page" id="pager"></div> -->
<!-- ul_class to be load more -->
<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '#deletecomnt', function() {
        $(this).attr("disabled", "disabled");
        var comt_id = $(this).parent().parent().find('.comtid').val();
        $.ajax({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "/deletecomment",
            type: 'post',
            dataType: 'json',
            data: {
                comt_id: comt_id
            },
            success: function(data) {
                if (data == "deleted") {
                    $(document).find("input#" + comt_id + ".comtid").parent().remove();
                } else {
                    $(document).find("input#" + comt_id + ".comtid").siblings("div").find("button#deletecomnt").prop('disabled', false);
                    alert(data);
                }
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
        // $(this).attr("disabled","disabled");
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
                $("div.post, .li-item").find('comment#' + post_id + '').children("defaultt").children().remove();
                //comment update
                $(".comment").val('');
                $(".defaultt").val('');
                $.ajax({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    url: "/comments_viewable",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        lk_ct: post_id
                    },
                    success: function(data) {

                        $.each(data, function() {

                            if (data.length > 3) {
                                $(document).find('comment#' + this.post_id + '.cmtd').css({
                                    "display": "block"
                                }).children('cmtcount').html(data.length);
                                $(document).find('comment#' + this.post_id + '.cmtd').children("div.older").css({
                                    "display": ""
                                });
                            } else {

                                src = "{{URL('/')}}/storage/downloads/" + this.profile_pic;
                                // $(document).find('comment#' + this.post_id + '.cmtd').css({
                                //          "display": "block"
                                //      }).children('defaultt').children().remove();
                                // $(document).find('comment#' + this.post_id + '.cmtd').children('div.older').css({
                                //     "display": ""
                                // });
                                $(document).find('comment#' + this.post_id + '.cmtd').children("div.older").css({
                                    "display": ""
                                });
                                $(document).find('comment#' + this.post_id + '.cmtd').css({
                                    "display": "block"
                                }).children('defaultt').append('<div class="comtbox"><input type="hidden" id="' + this.id + '" class="comtid" value="' + this.id + '"><img style="float:left;" height="15" width="15" src="' + src + '"><namee>' + this.name + '</namee><label style="float:left;color:#3187aa;">comment: </label><div>' + this.user_comments + '&nbsp;&nbsp;&nbsp;<button class="deletecomnt" id="deletecomnt">Delete</button></div><hr></div>').parent().find('div.older').css({
                                    "display": "none"
                                });
                            }
                        });
                    }
                });
                //comment update
            }
        });
    });
    $(document).on('click', ".user_like", function() {

        var post_id = $(this).parent().parent().find('.post_by_img').attr('id');
        var user_id = "{{ session()->get('id') }}";
        $(this).parent().parent().find(".user_like").css({
            "background": "red"
        });

        if ($(this).parent().parent().find(".user_like").html() == "unlike") {
            $(this).parent().parent().find(".user_like").html("like").removeClass("unlike").css({
                "background": "#3898da"
            });
            $(this).parent().parent().find("clk").html(parseInt($(this).parent().parent().find("clk").html()) - 1);
        } else {
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
                // window.location.reload();
            }
        });
    });
    $(document).on('click', ".olderview", function() {
        var post_id = $(this).parent().parent().parent().find('.post_by_img').attr('id');
        var user_id = "{{ session()->get('id') }}";
        $(".olderview").parent().parent().parent().removeClass('active');
        $(this).parent().parent().parent().addClass('active');

        $(this).siblings('.older-content').toggle();
        $("button.loadMore").remove();
        $("a.tp").remove();

        $.ajax({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            url: "/view_oldr_cmts",
            type: 'post',
            data: {
                user_id: user_id,
                post_id: post_id
            },
            dataType: 'json',
            success: function(data) {
                $(this).find(".olderview").siblings('.older-content').toggle();
                // console.log(data);
                $(".ul_class").remove();

                $.each(data, function(key, value) {

                    src = "{{URL('/')}}/storage/downloads/" + value.profile_pic;
                    $(".active").children().children('div.older').find("div#older_cmt.older-content").append('<ul class="ul_class"><li><img style="    float: left;" height="50" width="50" src="' + src + '" class="cmtd_frd"><div class="cmtd_name">' + value.name + '</div><label style="float:left;color:#3187aa;">comment: </label><div class ="frd_cmt" id="' + value.id + '">' + value.user_comments + '</div><button class="deleteoldcomt">Delete</button></li></ul>');
                });
                //chekcing
                //checking
                //working

                $(".active").children().children('div.older').find("div#older_cmt.older-content").append('<button style="float:left;" class="loadMore">Load more</button>');
                $(".ul_class").slice(3, $(".active").children().children('div.older').find("div#older_cmt.older-content").children().length).hide();
                //loadmore
                // $(".ul_class:last-child").after('<button class="loadMore">Load more</button>');
                $(".active").children().children('div.older').find("div#older_cmt.older-content").find(".loadMore").after('<p class="totop"><a href="#top" class="tp" style="margin-left:15px;">Back to top</a></p>');

                $(".loadMore").on('click', function(e) {
                    e.preventDefault();
                    $(".ul_class:hidden").slice(0, 3).slideDown();
                    if ($(".ul_class:hidden").length == 0) {
                        $("#load").fadeOut('slow');
                    }
                    $('html,body').animate({
                        scrollTop: $(this).offset().top
                    }, 1500);
                });
                $('a[href=#top]').click(function() {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 1000);
                    return false;
                });
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 50) {
                        $('.top a').fadeIn();
                    } else {
                        $('.top a').fadeOut();
                    }
                });
                //loadmore

                //delete from older comments
                $(document).on('click', ".deleteoldcomt", function() {
                    var comt_id = $(this).parent().parent().find('.frd_cmt').attr('id');
                    // alert(comt_id);return false;
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': "{{csrf_token()}}"
                        },
                        url: "/deletecomment",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            comt_id: comt_id
                        },
                        success: function(data) {
                            // alert(data);
                            var err = 0;
                            if (data == "deleted") {
                                var post_idd = $(document).find("#"+comt_id+"").parent().parent().parent().parent().parent().parent().children(".post_by_img").attr('id');
                                var test = parseInt($(document).find("div#" + comt_id + ".frd_cmt").parent().parent().parent().parent().parent().children("cmtcount").html());
                                $(document).find("div#" + comt_id + ".frd_cmt").parent().parent().parent().parent().parent().children("cmtcount").html(test - 1);
                                $(document).find("div#" + comt_id + ".frd_cmt").parent().parent().remove();
                                // $(document).find("div#"+comt_id+".frd_cmt").parent().parent().parent().parent().parent().children("cmtcount").html();
                                if (test <= 4) {
                                    ajx_reload_cmt(post_idd);
                                    
                                    function ajx_reload_cmt(post_idd){
                                        $(document).find('comment#'+post_idd+'.cmtd').children("cmtcount").html('');
                                        $.ajax({
                                            headers: {
                                                'X-CSRF-Token': "{{csrf_token()}}"
                                                },
                                                url: "/comments_viewable",
                                                type: 'post',
                                                dataType: 'json',
                                                data: {
                                                    lk_ct: post_idd
                                                },
                                                success: func,
                                            });
                                    }
                                    $(document).find('comment#' + this.post_id + '.cmtd').css({"display": "block"});
                                    function func(response){
                                    
                                      return $.each(response,function(){
                                        $(document).find('comment#' + this.post_id + '.cmtd').css({"display": "block"}).children('defaultt').append('<div class="comtbox"><input type="hidden" id="' + this.id + '" class="comtid" value="' + this.id + '"><img style="float:left;" height="15" width="15" src="' + src + '"><namee>' + this.name + '</namee><label style="float:left;color:#3187aa;">comment: </label><div>' + this.user_comments + '&nbsp;&nbsp;&nbsp;<button class="deletecomnt" id="deletecomnt">Delete</button></div><hr></div>').parent().find('div.older').css({"display": "none"});
                                        });
                                    }

                                    $(document).find('comment#'+post_idd+'.cmtd').children("div.older").children("#older_cmt").css({"display":"none"}).children().remove();

                                   //three comments now
                                }
                                //haveto
                                $.ajax({
                                    headers: {
                                        'X-CSRF-Token': "{{csrf_token()}}"
                                    },
                                    url: "/comments_viewable",
                                    type: 'post',
                                    dataType: 'json',
                                    data: {
                                        lk_ct: comt_id
                                    },
                                    success: function(data) {
                                        // alert(data);


                                        $.each(data, function() {
                                            // console.log(data);
                                            // console.log(data.length);
                                            if (data.length > 3) {
                                                $(document).find('comment#' + this.post_id + '.cmtd').css({
                                                    "display": "block"
                                                }).children('cmtcount').html(data.length);
                                                $(document).find('comment#' + this.post_id + '.cmtd').children("div.older").css({
                                                    "display": ""
                                                });
                                            } else {
                                                src = "{{URL('/')}}/storage/downloads/" + this.profile_pic;
                                                // console.log(ost_id);
                                                // $(document).find('comment#' + this.post_id + '.cmtd').children("div.older").css({"display":""});

                                                $(document).find('comment#' + this.post_id + '.cmtd').css({
                                                    "display": "block"
                                                }).children('defaultt').append('<div class="comtbox"><input type="hidden" id="' + this.id + '" class="comtid" value="' + this.id + '"><img style="float:left;" height="15" width="15" src="' + src + '"><namee>' + this.name + '</namee><label style="float:left;color:#3187aa;">comment: </label><div>' + this.user_comments + '&nbsp;&nbsp;&nbsp;<button class="deletecomnt" id="deletecomnt">Delete</button></div><hr></div>').parent().find('div.older').css({
                                                    "display": "none"
                                                });
                                            }
                                        });
                                    }
                                });
                            } else {
                                if (data == "You are not allowed to delete") {
                                    //heve to
                                }
                            }

                        }
                    });
                });

            }
        });
    });
 });   
</script>