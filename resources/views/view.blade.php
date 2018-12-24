
@extends('app')
@section('content')
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<h1 align="center">View</h1>
	<table class='mytable'>
		<th>Id</th><th>Name</th><th>Date of birth</th><th>Gender</th><th>Email</th><th>Phone</th><th>Catagories</th><th>Edit</th><th>Delete</th>
	</table>
<script>
	$(document).ready(function(){
		$.ajax({ 
		   type: 'GET', 
		   url: '{{URL('/')}}/test', 
		   dataType: 'json',
		  success: function(data){ 
		  	$.each(data, function(index, element) {
		  		// alert(element.datee);
            	$(".mytable").append('<tr><td class="id">'+element.id+'<td>'+element.name+'</td><td>'+element.datee+'</td><td>'+element.gender+'</td><td>'+element.email+'</td><td>'+element.phone+'</td><td>'+element.catagories+'</td><td><a href="/edit" class="upd">Edit</a></td><td><a class="btn">Delete</a></td></tr>');
        	});
		   }
		});
	});	
</script>

@endsection	
