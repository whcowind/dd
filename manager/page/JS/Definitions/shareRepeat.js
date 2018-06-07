var myapp = angular.module('MyApp' , []);

myapp.controller("Ctrl" , ["$scope" , "$http" , function($scope , $http){
	$http({
		method: 'GET' , 
		url: 'share_exist.php' , 
		params: {
			type: 'share_exist'
		}
	}).error(function(err){
		console.log(err);
	}).success(function(response){
		$scope.share = response;
	});
}]);