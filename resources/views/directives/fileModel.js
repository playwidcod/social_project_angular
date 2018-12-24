app.directives('fileModel',[$parse,function($parse){
	return {
		restrict:'A',
		link : function(scope,elem,attr){
			var model = $parse(attr.fileModel);
			var modeSetter = model.assign;
			elem.bind('change',function(){
				scope.$apply(function(){
					modeSetter(scope,elem[0].files[0])
				})
			})
		}
	}
}])
app.service('multipartForm',['$http',function(){
	this.post = function(uploadUrl,data){
		var fd = FormData();
		for(var key in data)
			fd.append(key,data[key]);
		$http.post(uploadUrl,fd,{
			transformRequest : angular.identity,
			headers : {'Content-type' : undefined}
		})
	}
}])