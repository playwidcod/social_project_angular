@include('layouts.crud')

    <h1 align="center">Edit Profile</h1>
    <img ng-src="@{{testtpro}}" class="profile" align="center" style="border:2px solid grey;height: 60px;width: 60px;"></img><br>
    <b>
      <label>Hi </label><username ng-bind="namepro"></username></b>
    <form id="form" method="post" name="postme"  ng-submit="editpro_upd()" enctype="multipart/form-data" novalidate> 
    <!-- <form id="form" method="post" enctype="multipart/form-data">  -->
    	<input type = "hidden" name = "_token" value = "{{csrf_token()}}">
    <br>
    Date of Birth:<br> 
    <input ng-model="mydateOfBirth" ng-change="formo()" type="date" name="datee" class="datee" data-validation="birthdate" data-validation-help="" ng-value="dateepro" required> 
    <br>
    Your age:<input type="text" readonly style="width:25px;" name="bday" class="bday" data-validation="birthdate" data-validation-help="" ng-value="bdaypro"> 
    <br> 
    <br> 
    gender:<br> 
    male
    <input type="radio" name="gender" id="male" class="gender" value="male" ng-checked="malepro" ng-model="$parent.gender"> 
    female<input type="radio" id="female" name="gender" class="gender" value="female" ng-checked="femalepro"  ng-model="$parent.gender"> 
    <br> <br> 
    <input type="hidden" name="email" class="email" data-validation="email" readonly ng-model="emailpro" ng-value="emailpro">
    Phone:<br> 
    <input type="text" name="phone" class="phone" ng-minlength="10" ng-maxlength="10" ng-model="phonepro" ng-value="phonepro" required> 
    <span ng-show="postme.phone.$error.maxlength" style="color:red">Number not valid.</span>
    <span ng-show="postme.phone.$error.minlength" style="color:red">Number not valid.</span>
    <br> 
    <br> 
    Upload profile Picture:<br> 
    <input type="file" file-input="files" name="profile_pic" class="profile_pic" accept="image/*"> 
    <br>
    <br> 
    <input type="submit" value="Submit" class="submit" ng-disabled="postme.phone.$error.maxlength || postme.phone.$error.minlength"> 
    </form>

</div>
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
$(document).ready(function(){
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

	$(".email").on('change',function(){
		var em = $(".email").val();
		$.ajax({ 
		   type: 'GET', 
		   url: '{{URL('/')}}/test', 
		   dataType: 'json',
		  success: function(data){
		  	if(data['email'] == em){
		  		alert("email exists");
		  		$(".email").val('');
		  	}
		   }
		});
	});	
		
	$(".datee").focusout(function(){
    $(".bday").val('');
    // alert($(".datee").val());
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


    // 		$('form[id="form"]').validate({
    //   rules: {
    //     username: 'required',
    //     datee: 'required',
    //     terms: 'required',
    //     phone: 'required',
    //     username: {
    //       required: true,
    //       minlength: 5,
    //     },
    //     email: {
    //       required: true,
    //       email: true
    //     },
    //     password: {
    //       required: true,
    //       minlength: 6,
    //     },
    //     phone:{
    //     required:true,		
    //      number:true,
    //      minlength:10,
    //      maxlength:12
    //     },
    //     bday:{		
    //      number:true,
    //      min:18,
    //      max:100
    //     }
    //   },
    //   messages: {
    //     username: 'This field is required',
    //     datee: 'This field is required',
    //     phone: 'This field is required',
    //     email: 'Enter a valid email',
    //     password: {
    //       minlength: 'Password must be at least 6 characters long'
    //     },
    //     username: {
    //       minlength: 'Password must be at least 5 characters long'
    //     },
    //     phone: {
    //       minlength: 'enter below 10 not valid number',
    //       maxlength: 'not valid number'
    //     },
    //     bday:{
    //       minlength:'Above 18 years of age is only allowed',
    //       max:'Not a valid date'
    //     } 
    //   },
    //   submitHandler: function(form) {
    //     // alert(form);
    //     form.submit();
    //     // sum_upd(form);
    //   }
    // });	
});
</script>
