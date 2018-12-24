@extends('app')
@section('content')
<script>
	$(document).ready(function(){
		$.ajax({ 
		   type: 'GET', 
		   url: '{{URL('/')}}/test', 
		   dataType: 'json',
		  success: function(data){
		  	$(".username").val(data['name']);
		  	$(".email").val(data['email']);
		  	$(".password").val(data['password']);
		  	$(".phone").val(data['phone']);
		  	$(".city").val(data['city']);
		   }
		});
	});      
</script>
{{$test}}	
<h1 align="center">Register</h1>
<form method="post" action="/savee"> 
Username:<br> 
<input type="text" name="username" class="username"> 
<br> 
Email:<br> 
<input type="text" name="email" class="email"> 
<br> 
Password:<br> 
<input type="password" name="password" class="password"> 
<br> 
Phone:<br> 
<input type="number" name="phone" class="phone"> 
<br>
<br> 
city:<br> 
<input type="text" name="city" class="city"> 
<br>
<br> 
<input type="submit" value="Submit" class="submit"> 

</form>
<script>
	$(".submit").click(function(e){
		e.preventDefault();
		var username = $(".username").val();
		var email = $(".email").val();
		var password = $(".password").val();
		var phone = $(".phone").val();
		var city = $(".city").val();
		$.ajax({ 
		   type: 'POST', 
		   url: '{{URL('/')}}/savee', 
		   data:{username:username,email:email,password:password,phone:phone,city:city},
		   dataType: 'json',
		  success: function(data){
		  	alert(data);
		   }
		});
	});
</script>
@endsection	