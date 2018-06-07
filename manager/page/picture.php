<?php
	session_start();
?>

<?php
	require 'connectdb.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

	<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
											google font link
		 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


	<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
											CSS
		 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<link rel="stylesheet/less" type="text/css" href="CSS/picture.less"/>
	<script type="text/javascript" src="JS/Base/less.js"></script>

	<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
											API CSS
		 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<link rel="stylesheet" href="CSS/API/uikit.min.css"/>
	<link rel="stylesheet" href="CSS/API/uikit.gradient.min.css"/>
	<link rel="stylesheet" href="CSS/API/uikit.almost-flat.min.css"/>
	<link rel="stylesheet" href="CSS/API/autocomplete.almost-flat.min.css"/>
	<link rel="stylesheet" href="CSS/API/autocomplete.gradient.min.css"/>
	<link rel="stylesheet" href="CSS/API/autocomplete.min.css"/>
	<link rel="stylesheet" href="CSS/API/notify.min.css"/>
	<link rel="stylesheet" href="CSS/API/form-select.min.css"/>

	<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
											Base Javascript
	 	 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<script type="text/javascript" src="JS/Base/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="JS/Base/jquery-ui.min.js"></script>
	<script type="text/javascript" src="JS/Base/angular.js"></script>
	<script type="text/javascript" src="JS/Base/jquery.cookie.js"></script>

	<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
											API Javascript
		 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<script src="JS/API/uikit.min.js"></script>
	<script src="JS/API/autocomplete.min.js"></script>
	<script src="JS/API/ajaxfileupload.js"></script>
	<script src="JS/API/notify.min.js"></script>
	<script src="JS/API/form-select.min.js"></script>


	<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
											Definitions Javascript
		 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<script type="text/javascript" src="JS/Definitions/picture.js"></script>
	<script type="text/javascript" src="JS/Definitions/pictureRepeat.js"></script>

	<title>管理介面</title>
</head>

<body ng-app = 'MyApp' ng-controller = 'Ctrl'>
	<?php
		$exists_id = true;
		$exists_password = true;

		//check id
		if(isset($_SESSION['ID'])){
			$ID = $_SESSION['ID'];
		}
		else{
			$exists_id = false;
		}

		//check password
		if(isset($_SESSION['password'])){
			$pass = $_SESSION['password'];
		}
		else{
			$exists_password = false;
		}

		//id or password error
		if(!$exists_id || !$exists_password){
			echo "<script type = 'text/javascript'> window.location.href = '../login.html'; </script>";
		}

	?>
	
	<div class="sidebar">
		<div class="sidebar-header">
			<a href="../manager.php">
				<img src="image/logo.png" class="logo">
			</a>
		</div>
		<div class="sidebar-content">
			<div class="photo">
				<div class="circle">
					<img src="image/photo.png" class="photo-icon">
				</div>
			</div>
			<div class="account item">
				<a href="account.php">
					<div class="itme-text account-icon">帳號管理</div>
				</a>
			</div>
			<div class="question item">
				<a href="question.php">
					<div class="itme-text question-icon">試題管理</div>
				</a>
			</div>
			<div class="paper item">
				<a href="paper.php">
					<div class="itme-text paper-icon">試卷管理</div>
				</a>
			</div>
			<div class="grade item">
				<a href="grade.php">
					<div class="itme-text grade-icon">成績管理</div>
				</a>
			</div>
			<div class="picture item">
				<a href="picture.php">
					<div class="itme-text picture-icon">圖片管理</div>
				</a>
			</div>
			<div class="download item">
				<a href="share.php">
					<div class="itme-text download-icon">分享管理</div>
				</a>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="container-header">
			<div class="logout">登出</div>
		</div>
		<div class="container-status">
			<span class="status">首頁 / 圖片管理</span>
		</div>

		<div class=" picture-container">
			<div class="picture-ctrl">
				<button class="uk-button uk-button-success picture-btn del-picture">刪除選取圖片</button>
				<button class="uk-button uk-button-success picture-btn cover-picture">覆蓋圖片</button>
				<img src="image/instruction.png" class="picture-instruction">
			</div>
			<div class="picture-list">
				<div class="picture-exist" data-toggle = '0' ng-repeat = 'pic in pic track by $index' data-id = '{{pic.imageID}}'>
					<img src="{{pic.imageURL}}">
					<div class="pic-intro">{{pic.imageID + ' - ' + pic.name + '(' + pic.owner + ')'}}</div>
				</div>
				<!-- <div class="account-teacher-item account-item" ng-repeat = 'teacher in teacher track by $index'>
					<div class="account-teacher-name account-name">{{teacher.Aname}}</div>
					<div class="account-teacher-delete account-delete-icon account-icon" data-id = '{{teacher.Aid}}'></div>
					<div class="account-teacher-detail account-detail-icon account-icon" data-id = '{{teacher.Aid}}'></div>
					<div class="account-teacher-enter account-enter-icon account-icon" data-id = '{{teacher.Aid}}' data-name = '{{teacher.Aname}}'></div>
				</div> -->
			</div>
		</div>

	<div class="picture-instruction-mark">
		<h2>覆蓋圖片將會直接取代原圖片，請小心使用。</h2>
		<button class="uk-button uk-button-danger instruction-btn">關閉</button>
	</div>

	<div class="picture-cover">
		<div class="mult-text">覆蓋圖片</div>
		<hr></hr>
		<div class="fileBox">
			圖片編號：<input type="text" class="id"></input>
			<input name="fileToUpload" type="file" id="fileToUpload" class = 'uk-button-primary file_picture_cover'></input>
		</div>
		<button class="uk-button uk-button-success picture-upload picture-cover-btn">上傳</button>
		<button class="uk-button uk-button-danger picture-cancel picture-cover-btn">取消</button>
	</div>
</body>
