//angular js
var myapp = angular.module('MyApp' , []);

myapp.controller("Ctrl" , ["$scope" , "$http" , function($scope , $http){

	//board exist
	$http({
		method: 'GET' , 
		url: 'exist.php' , 
		params: {
			type: 'exist_board'
		}
	}).error(function(err){
		alert(err);
	}).success(function(response){
		$scope.board = response;
	});

	//personnel exist
	$http({
		method: 'GET' , 
		url: 'exist.php' , 
		params: {
			type: 'exist_personnel'
		}
	}).error(function(err){
		alert(err);
	}).success(function(response){
		$scope.personnel = response;
	});

	//Lab exist
	$http({
		method: 'GET' , 
		url: 'exist.php' , 
		params: {
			type: 'exist_lab'
		}
	}).error(function(err){
		alert(err);
	}).success(function(response){
		$scope.lab = response;
	});

	//Law exist
	$http({
		method: 'GET' , 
		url: 'exist.php' , 
		params: {
			type: 'exist_law'
		}
	}).error(function(err){
		alert(err);
	}).success(function(response){
		$scope.law = response;
	});

	//AdmissionList exist
	$http({
		method: 'GET' , 
		url: 'exist.php' , 
		params: {
			type: 'exist_admissionList'
		}
	}).error(function(err){
		alert(err);
	}).success(function(response){
		$scope.admissionList = response;
	});

	//maplink exist
	$http({
		method: 'GET' , 
		url: 'exist.php' , 
		params: {
			type: 'exist_maplink'
		}
	}).error(function(err){
		alert(err);
	}).success(function(response){
		$scope.maplink = response;
	});

	//achievement exist
	$http({
		method: 'GET' , 
		url: 'exist.php' , 
		params: {
			type: 'exist_achievement'
		}
	}).error(function(err){
		alert(err);
	}).success(function(response){
		$scope.result = response;
	});

	//course exist
	// $http({
	// 	method: 'GET' , 
	// 	url: 'exist.php' , 
	// 	params: {
	// 		type: 'exist_course' ,
	// 		grade: '1'
	// 	}
	// }).error(function(err){
	// 	alert(err);
	// }).success(function(response){
	// 	$scope.course1 = response;
	// });

	// $http({
	// 	method: 'GET' , 
	// 	url: 'exist.php' , 
	// 	params: {
	// 		type: 'exist_course' ,
	// 		grade: '2'
	// 	}
	// }).error(function(err){
	// 	alert(err);
	// }).success(function(response){
	// 	$scope.course2 = response;
	// });

	// $http({
	// 	method: 'GET' , 
	// 	url: 'exist.php' , 
	// 	params: {
	// 		type: 'exist_course' ,
	// 		grade: '3'
	// 	}
	// }).error(function(err){
	// 	alert(err);
	// }).success(function(response){
	// 	$scope.course3 = response;
	// });

	// $http({
	// 	method: 'GET' , 
	// 	url: 'exist.php' , 
	// 	params: {
	// 		type: 'exist_course' ,
	// 		grade: '4'
	// 	}
	// }).error(function(err){
	// 	alert(err);
	// }).success(function(response){
	// 	$scope.course4 = response;
	// });

	// $http({
	// 	method: 'GET' , 
	// 	url: 'exist.php' , 
	// 	params: {
	// 		type: 'exist_course' ,
	// 		grade: '5'
	// 	}
	// }).error(function(err){
	// 	alert(err);
	// }).success(function(response){
	// 	$scope.course5 = response;
	// });

	// $http({
	// 	method: 'GET' , 
	// 	url: 'exist.php' , 
	// 	params: {
	// 		type: 'exist_course' ,
	// 		grade: '6'
	// 	}
	// }).error(function(err){
	// 	alert(err);
	// }).success(function(response){
	// 	$scope.course6 = response;
	// });

	// $http({
	// 	method: 'GET' , 
	// 	url: 'exist.php' , 
	// 	params: {
	// 		type: 'exist_course' ,
	// 		grade: '7'
	// 	}
	// }).error(function(err){
	// 	alert(err);
	// }).success(function(response){
	// 	$scope.course7 = response;
	// });

	// $http({
	// 	method: 'GET' , 
	// 	url: 'exist.php' , 
	// 	params: {
	// 		type: 'exist_course' ,
	// 		grade: '8'
	// 	}
	// }).error(function(err){
	// 	alert(err);
	// }).success(function(response){
	// 	$scope.course8 = response;
	// });

}]);

