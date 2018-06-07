var myapp = angular.module('MyApp' , []);

myapp.controller("Ctrl" , ["$scope" , "$http" , function($scope , $http){
	$http({
		method: 'GET' , 
		url: 'account_exist.php' , 
		params: {
			type: 'teacher_exist'
		}
	}).error(function(err){
		console.log(err);
	}).success(function(response){
		$scope.teacher = response;
	});
}]);