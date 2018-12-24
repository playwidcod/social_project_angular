@include('layouts.crud')
<style type="text/css">
.search{
	width: 400px;
    height: 30px;
}
#Go{
	width: 80px;
    height: 29px;
    margin-left: 5px;
    background: #3187aa;
    color: white;
}
.selected{
	background: #3187ab
}
td{
	padding: 5px;
    width: 300px;
}
.item{
	border: 2px solid black;
    width: 700px;
}	
.val_key{
	width: 100px;
    height: 29px;
    margin-left: 5px;
    background: #d9e0e2;
    color: #352e2e;
}
</style>
<center>
<div id="search_div">
	<select class="val_key">
		<option value="title">Title</option>
		<option value="description">Description</option>
		<!-- <option value="likes">likes</option> -->
	</select>
	<input type="search" name="search" class="search" id="search" placeholder="Search your posts here">
	<button id="Go">Go</button><br><br>
	<table id="mytable" border="1" style="display: none;">
		<thead style="font-weight: bold;"><tr><td>Title</td><td>Description</td><td>Post</td><td>Likes</td></tr></thead>
		<tbody></tbody>
	</table><br>
	<selected class="selected_item"></selected>
</div>

</center>
<script type="text/javascript">
	$(document).ready(function(){

		$("#search").on('keyup',function(){

			$("selected").children().remove();
			var search = $("#search").val();
			var keyy = $(".val_key").val();
			if(search == ''){
				$("#mytable").hide();
				$("tbody").children().remove();return false;
			}else{ 
			$.ajax({
				  headers: {
	             	'X-CSRF-Token': "{{csrf_token()}}"
		          },
		          url: '/on_search',
		          dataType: 'json',
		          data:{search:search,keyy:keyy},
		          type: 'post',
		          success: function(data) {

		          	$("tbody").children().remove();
		          	$("#mytable").show();
		          	$.each(data,function(){

		          		var get_img = this.post_vdo.split('.');
		          		$("tbody").append('<tr id='+this.id+' class="user"><td>'+this.title+'</td><td>'+this.description+'</td><td><img src="{{URL('/')}}/storage/downloads/thumbnail/'+get_img[0]+'.jpg" height="50" width="50"></td><td><likes>'+this.likes+'</likes></td></tr>');
		          	});
		          	$("tr.user").on('click',function(){
						$("tr.user").removeClass('selected');
						$(this).addClass('selected');
					});
		        }
			});
		}
		});
		$(document).on('click','.selected',function(){
			$(".selected_item").children().remove();
			var id = $(this).attr('id');
			var title = $(this).children().first().html();
			var description = $(this).children().next().html();
			var image = $(this).children().next().next().children("img").attr('src');
			var likes = $(this).children().next().next().next().find("likes").html();
			$(".selected_item").append('<div class="item"><h1>'+title+'</h1><br><post><img src="'+image+'" height="100" width="100"></post><br><label>Description :</label><description>'+description+'</description><br><label>Likes :<label><likes>'+likes+'</likes><br><br></div>').slideDown();
		});
		
	});
</script>

