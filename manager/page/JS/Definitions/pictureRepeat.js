var myapp = angular.module('MyApp' , []);

myapp.controller("Ctrl" , ["$scope" , "$http" , function($scope , $http){
	$http({
		method: 'GET' , 
		url: 'picture_exist.php' , 
		params: {
			type: 'picture_exist'
		}
	}).error(function(err){
		console.log(err);
	}).success(function(response){
		$scope.pic = response;
	});
}]);