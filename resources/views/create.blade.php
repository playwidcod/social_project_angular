@if(!Session::get('email'))
<style type="text/css">
input:hover{ 
  border-bottom-color: #3187ab;
}
button:hover{ 
  border-bottom-color: #3187ab;
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
  border-bottom: 2px solid red;
  transition: 0.4s;
}
h2:hover:after {
  width: 100%;
} 
h1:hover{
  text-decoration: underline;
  text-decoration-color: #3187ab;
}
</style>
<div class="header" style="height:75px;background: #3187ab;">
  <img class="logo" src="">
  <h1><a href="/" style="text-decoration: none;color:black;">Friendship Stories</a></h1>
</div>
<!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> -->
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<h1 align="center">Create</h1>
   <!-- @if(!isset(Auth::user()->email))
    <script>window.location="/create"</script>
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
<form id="form" method="post" action="/store" enctype="multipart/form-data"> 
	<input type = "hidden" name = "_token" value = "{{csrf_token()}}">
<b>Username:<br> 
<input type="text" value="{{old("username")}}" name="username" class="username" data-validation="length alphanumeric" data-validation-length="min5"> 
<br> 
dob:<br> 
<input type="date" value="{{old("datee")}}" name="datee" class="datee" data-validation="birthdate"> <br>
Your age:<input type="text" value="{{old("bday")}}"  readonly style="width:25px;" name="bday" class="bday" data-validation="birthdate" data-validation-help=""> 
<br> 
<br> 
gender:<br> 
male
<input type="radio" name="gender" class="gender" value="male" checked> 
female<input type="radio" name="gender" class="gender" value="female"> 
<br> <br>  
Email:<br> 
<input type="text" value="{{old("email")}}" name="email" class="email" data-validation="email"> 
<br> <br>

Password:<br> 
<input type="password" name="password" class="password" data-validation="strength" data-validation-strength="2"> 
<br> 
Confirm Password:<br> 
<input type="password" name="retype" class="retype" data-validation="strength" data-validation-strength="2"> 
<br>
<br>
Phone:<br> 
<input type="text" value="{{old("phone")}}" name="phone" class="phone" onkeypress="return isNumberKey(event)" maxlength="10"> 
<br> 
<br>
terms and conditions:<br> 
<input type="checkbox"  name="terms" class="terms" id="terms">
<br> 
<br>
Catagories:<br> 
<select class="catagories" name="catagories" value="{{old("catagories")}}">
  <option value="music">music</option>
  <option value="comedy">comedy</option>
  <option value="action">action</option>
  <option value="adventure">adventure</option>
</select>
<br> 
<input type="submit" value="Register" class="submit"> 
</form>
<style type="text/css">
form label {
  display: inline-block;
  width: 100px;
}
 
form div {
  margin-bottom: 10px;
}
 
.error {
  color: red;
  margin-left: 5px;
}
 
label.error {
  display: inline;
}	
</style>
<script>
 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
    }
  $(function() {
    $( '.password' ).on( 'keydown', function( e ) {
        if( !$( this ).data( "value" ) )
             $( this ).data( "value", this.value );
    });
    $( '.password' ).on( 'keyup', function( e ) {
        if (!/^[_0-9a-z]*$/i.test(this.value))
            this.value = $( this ).data( "value" );
        else
            $( this ).data( "value", null );
    });
});
  </script>    
  <script>
	$(document).ready(function(){
    //new
    $('.username').bind('keypress', function (e) {
    if ($('.username').val().length == 0) {
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
    $('.password').bind('keypress', function (e) {
    if ($('.password').val().length == 0) {
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
		
	$(".datee").change(function(){
		birthday = $(".datee").val().toString();
		var yearThen = parseInt(birthday.substring(0,4), 10);
        var monthThen = parseInt(birthday.substring(5,7), 10);
        var dayThen = parseInt(birthday.substring(8,10), 10);

        var today = new Date();
		var dob = new Date(yearThen, monthThen-1, dayThen);
		var differenceInMilisecond = today.valueOf() - dob.valueOf();
		var year_age = Math.floor(differenceInMilisecond / 31536000000);
        var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);
        // alert(day_age);
        if ((today.getMonth() == dob.getMonth()) && (today.getDate() == dob.getDate())) {
            alert("Happy B'day!!!");
        }
        var month_age = Math.floor(day_age/30);
        
        day_age = day_age % 30;
        if (isNaN(year_age) || isNaN(month_age) || isNaN(day_age)) {
            alert("Invalid birthday");
        }
        else {
            // alert("You are<br/><span id=\"age\">" + year_age + " years " + month_age + " months " + day_age + " days</span> old");
            $(".bday").val(year_age);
        }
	});	

      $('form[id="form"]').validate({
      rules: {
        username: 'required',
        datee: 'required',
        email: 'required',
        password: 'required',
        terms: 'required',
        phone: 'required',
        username: {
          required: true,
          minlength: 5
        },
        datee: {
          required: true,
        },
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 6
        },
        phone:{
        required:true,    
         number:true,
         minlength:10,
         maxlength:12
        },
        bday:{    
         number:true,
         min:18,
         max:100
        },
        terms: {
          required: true
        },
        retype:{  
        required:true,    
        equalTo: ".password"
        }
      },
      messages: {
        username: 'This field is required',
        datee: 'This field is required',
        phone: 'This field is required',
        email: 'Enter a valid email',
        password: {
          minlength: 'Password must be at least 6 characters long'
        },
        username: {
          minlength: 'Username must be at least 5 characters long'
        },
        phone: {
          minlength: 'entered not valid number',
          maxlength: 'not valid number'
        },
        bday:{
          min:'Above 18 years of age is only allowed',
          max:'not a valid date'
        } 
      },
      submitHandler: function(form) {
        form.submit();
      }
    }); 
});
</script>
@else
  <script>window.location="/";</script>
@endif