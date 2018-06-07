//use AngularJS to auto update existed True False Question
	var Aclass = $('.exam').find('.exam-allocate .allocateTable .selectPaper').attr('data-temp');
	var myapp = angular.module('MyApp' , []);

	myapp.controller("QCtrl" , ["$scope" , "$http" , function($scope , $http){

		$http({
			method: 'GET' , 
			url: 'QuestionExist.php' , 
			params: {
				Type: 'TFQExixt'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.TF = response;
			// console.log(response);
		});

		$http({
			method: 'GET' , 
			url: 'QuestionExist.php' , 
			params: {
				Type: 'CHQExist'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.CH = response;
			// console.log(response);
		});

		$http({
			method: 'GET' , 
			url: 'QuestionExist.php' , 
			params: {
				Type: 'GPExist'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.GP = response;
			// console.log(response);
		});

		$http({
			method: 'GET' , 
			url: 'QuestionExist.php' , 
			params: {
				Type: 'SAExist'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.SA = response;
			// console.log(response);
		});

		$http({
			method: 'GET' , 
			url: 'image.php'
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.IMG = response;
			// console.log($scope.IMG);
		});

		$http({
			method: 'GET' , 
			url: 'paperRepeat.php' , 
			params:{
				Type: 'paperTF'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.paperTF = response;
		});

		$http({
			method: 'GET' , 
			url: 'paperRepeat.php' , 
			params:{
				Type: 'paperCH'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.paperCH = response;
		});

		$http({
			method: 'GET' , 
			url: 'paperRepeat.php' , 
			params:{
				Type: 'paperGP'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.paperGP = response;

		});

		$http({
			method: 'GET' , 
			url: 'paperRepeat.php' , 
			params:{
				Type: 'paperSA'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.paperSA = response;
		});

		$http({
			method: 'GET' , 
			url: 'paperRepeat.php' , 
			params:{
				Type: 'paperExist'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			$scope.paperExist = response;

		});

		$http({
			method: 'GET' , 
			url: 'studentData.php' , 
			params:{
				Aclass: Aclass
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			// console.log(response);
			$scope.studentExist = response;
		});

		$http({
			method: 'GET' , 
			url: 'allocatePaper.php' ,
			params:{
				Aclass:Aclass , 
				Type: 'allocateList'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			// console.log(response);
			$scope.allocateExist = response;
		});

		// $http({
		// 	method: 'GET' , 
		// 	url: 'allocatePaper.php' ,
		// 	params:{
		// 		Type: 'List'
		// 	}
		// }).error(function(err){
		// 	alert(err);
		// }).success(function(response){
		// 	$scope.List = response;
		// });

		$http({
			method: 'GET' , 
			url: 'class_data.php' ,
			params:{
				Aclass:Aclass , 
				Type: 'class'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			// console.log(response);
			$scope.classlist = response;
		});

		$http({
			method: 'GET' , 
			url: 'papergrade.php' ,
			params:{
				Aclass:Aclass , 
				Type: 'paperlist'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			// console.log(response);
			$scope.papergradelist = response;
		});

		$http({
			method: 'GET' , 
			url: 'share.php' ,
			params:{
				Type: 'getList'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			// console.log(response);
			$scope.share = response;
		});

		$http({
			method: 'GET' , 
			url: 'result.php' ,
			params:{
				Aclass:Aclass ,
				Type: 'getList'
			}
		}).error(function(err){
			alert(err);
		}).success(function(response){
			// console.log(response);
			$scope.result = response;
		});

	}]);
