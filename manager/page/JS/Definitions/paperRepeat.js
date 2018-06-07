var myapp = angular.module('MyApp' , []);

myapp.controller("Ctrl" , ["$scope" , "$http" , function($scope , $http){
	$http({
		method: 'GET' , 
		url: 'paper_exist.php' , 
		params: {
			type: 'paper_exist'
		}
	}).error(function(err){
		console.log(err);
	}).success(function(response){
		// console.log(response);
		$scope.paper = response;
	});
}]);