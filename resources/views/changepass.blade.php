
@include('layouts.crud')

<h1 align="center">Change Your password</h1>
<form name="changepass" id="changepass" action="/changepwd" method="post">
    <input type = "hidden" id="tk" name = "_token" value = "{{csrf_token()}}">
  <label>Current password:</label><br> <input type="password" name="current" class="current"><br>  
  <label>New password:</label><br> <input type="password" name="new" class="new">  <br>
  <label>Retype password:</label><br> <input type="password" name="retype" class="retype"><br>
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
  <input type="submit" name="submit" value="submit">  
</form>
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
<script>
        $('form[id="changepass"]').validate({
  rules: {
    current: 'required',
    retype: 'required',
    new: 'required',
    current: {
      required: true,
      minlength: 6,
    },
    new: {
      required: true,
      minlength: 6,
    },
    retype:{  
    required:true,    
    equalTo: ".new"
    }
  },
  messages: {
    current: 'This field is required',
    password:'this is required',
    password: {
      minlength: 'Password must be at least 6 characters long'
    },
    current: {
      minlength: 'Password must be at least 6 characters long'
    },
    new: {
      minlength: 'Password must be at least 6 characters long'
    } 
  },
  submitHandler: function(form) {
    form.submit();
  }
});
</script>