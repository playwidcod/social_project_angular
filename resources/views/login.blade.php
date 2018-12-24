<div class="header" style="height:75px;background: #3187ab;">
  <img class="logo" src="">
  <h1><a href="/" style="text-decoration: none;color:black;">Friendship Stories</a></h1>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.error{
	color:red;
}
.alert-danger{
  width: 263px;
}	
input:hover{ 
  border-bottom-color: #3187ab;
}
button:hover{ 
  border-bottom-color: #3187ab;
}
h1:hover{
  text-decoration: underline;
  text-decoration-color: #3187ab;
}
h2{
  text-decoration: none;
  position: relative;
}
h2:after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0%;
  border-bottom: 2px solid #3187ab;;
  transition: 0.6s;
}
h2:hover:after {
  width: 100%;
} 

</style>
<h2 align="center">Login</h2>
<form method="post" action="/ck_login" id="log" align="left" style="margin-left: 700px;"> 
	<input type = "hidden" class="_token" name = "_token" value = "{{csrf_token()}}">
Email:<br> 
<input type="text" name="email" class="email" data-validation="email"> 
<br> 
Password:<br> 
<input type="password" name="password" class="password" data-validation="required"> 
<br>
<br>
 <!--   @if(!isset(Auth::user()->email))
    <script>window.location="/login";</script>
   @endif -->

   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif
<input type="submit" class="submit" value="login" style="width: 155px;"> 
<a href="login/facebook">Login with social</a>
</form>
<center>
<label style="margin-left:30px;">Or</label><br>
<button type="submit" class="register" style="margin-left: 18px;width: 155px;" onclick="location.href = '/create'"> Register here</button>
</center>
<script>
 $(document).ready(function(){
         $('input[type=password]').bind('keypress', function (e) {
    if ($('input[type=password]').val().length == 0) {
        if (e.which == 32) { //space bar
            e.preventDefault();
        }
        var valid = (e.which >= 48 && e.which <= 57) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122);
        if (!valid) {
            e.preventDefault();
        }
    } else {
        var valid = (e.which >= 48 && e.which <= 57) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122 || e.which == 32 || e.which == 95 || e.which == 8);
        if (!valid) {
            e.preventDefault();
        }
    }
});
       }); 
</script>
<!--script>
 $(document).ready(function(){
    $(".submit").click(function(e){
      e.preventDefault();
      var email = $(".email").val();
      var password = $(".password").val();
      $.ajax({
        url:"/ck_login",
        data:{email:email},
        type:'post',
        dataType:'html',
        success:function(){
          alert(data);
        }
      });
    });
 }); 
</script-->
<!--script>
$.validate({
  // modules : ''
});  
</script-->
<!-- <script>
	$('form[class="submit"]').validate({
  rules: {
    email: 'required',
    password: 'required',
    email: {
      required: true,
      email: true,
    },
    password: {
      required: true,
    }
  },
  messages: {
    email: 'This is not a valid required'
    password:'This is required'
  },
  submitHandler: function(form) {
    form.submit();
  }
});
</script> -->
