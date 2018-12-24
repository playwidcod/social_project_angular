@include('layouts.crud')
<div class="content">
<style type="text/css">
.error{
	color:red;
}	
</style>
<h1 align="center">Post</h1>
<div ng-controller="usercontroller">
<!-- <form method="post" id="post" action="/user_post" enctype="multipart/form-data"> -->
<form method="post" id="post" name="post" ng-submit="user_post()" enctype="multipart/form-data" novalidate>
	<input type = "hidden" name="_token" value = "{{csrf_token()}}">
	<label>Title</label><br><input my-title ng-minlength="4" ng-maxlength="10" ng-model="title" type="text" name="title" required>

<span ng-show="post.title.$error.minlength" style="color:red">Title is too short.</span>
<span ng-show="post.title.$error.maxlength" style="color:red">Title max character ended.</span>
<span ng-show="post.title.$error.required" style="color:black;margin-left: 96px;">Please enter your Title.</span>

  <br>
	<label>Description</label><br><input ng-minlength="5" ng-maxlength="100" ng-model="description" type="text" name="description" required>
<span ng-show="post.description.$error.minlength" style="color:red">Description is too short.</span>
<span ng-show="post.description.$error.maxlength" style="color:red">Description max character ended.</span>
<span ng-show="post.description.$error.required" style="color:black;margin-left: 96px;">Please enter your Description.</span>

<br>
	<label>Upload Your Post</label><br><input type="file" ng-model="post_vdo" file-post="files" id="vid" name="post_vdo" accept="video/*" required>
<span ng-show="post.post_vdo.$invalid" style="color:black;margin-left:2px;">Please upload your File.</span>
  <br>

	<br><input type="submit" name="submit" value="Post" style="width: 155px;" ng-disabled="post.title.$dirty && post.title.$invalid || post.title.$error.maxlength || post.title.$error.minlength || post.description.$error.minlength || post.description.$error.maxlength || post.description.$error.required || post.post_vdo.$invalid">

</form>
</div>
<p id="demo"></p>
<script type="text/javascript">
var myVideos = [];
window.URL = window.URL || window.webkitURL;

document.getElementById('vid').onchange = setFileInfo;

function setFileInfo() {
  var files = this.files;
  myVideos.push(files[0]);
  var video = document.createElement('video');
  video.preload = 'metadata';

  video.onloadedmetadata = function() {
    window.URL.revokeObjectURL(video.src);
    var duration = video.duration;
    myVideos[myVideos.length - 1].duration = duration;
    updateInfos();
  }

  video.src = URL.createObjectURL(files[0]);
}


function updateInfos() {
  var infos = document.getElementById('infos');
  infos.textContent = "";
  for (var i = 0; i < myVideos.length; i++) {
    infos.textContent += myVideos[i].name + " duration: " + myVideos[i].duration + '\n';
    var test = myVideos[i].duration > 301.634;
    // alert(test); 
     if(test == true){
     	alert("Video duration is must be 5minutes and low");
     	$("#vid").val('');
     }
  }
}
</script>

<script>
  app.directive('filePost',function(){
  return {
    require:'ngModel',
    link:function(scope,el,attrs,ngModel){
      //change event is fired when file is selected
      el.bind('change',function(){
        scope.$apply(function(){
          ngModel.$setViewValue(el.val());
          ngModel.$render();
        });
      });
    }
  }
});
      app.directive("filePost", function($parse){  
      return{  
           link: function($scope, element, attrs){  
                element.on("change", function(event){  
                     var files = event.target.files;  
                     //console.log(files[0].name);  
                     $parse(attrs.filePost).assign($scope, element[0].files);  
                     $scope.$apply();  
                });  
           }  
      }  
 }); 

    app.controller("usercontroller", function($scope,$http) {

        $scope.user_post = function(){
                         var form_data = new FormData();  
                           angular.forEach($scope.files, function(file){ 
                                form_data.append('post_vdo', file);  
                           });  
                           form_data.append('description',$scope.description);
                           form_data.append('title',$scope.title);

                           $http.post('/user_post', form_data,  
                           {  
                                transformRequest: angular.identity,  
                                headers: {'Content-Type': undefined,'Process-Data': false}  
                           }).then(function(data, status, headers, config){ 
                            console.log(data.message)
                                alert(data.data);   
                           }); 
                     }

    });
</script>
<!--script>
	$('form[id="post"]').validate({
  rules: {
    title: 'required',
    description: 'required',
    post_vdo: 'required',
    title: {
      required: true,
      minlength: 5,
    },
    description: {
      required: true,
      minlength: 8,
    },
    post_vdo: {
      required: true,
    }
  },
  messages: {
    title: 'This is not a valid required',
    description:'This is required',
    post_vdo:'This is required',
    title: {
          minlength: 'Minmium length of the Title should be 5'
       },
    description: {
          minlength: 'Minmium length of the Description should be 8'
    }   
  },
  submitHandler: 
  function(form) {
    form.submit();
    alert("Posted successfully");
  }
});
</script-->
<pre id="infos"></pre>
</div>
