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
	<link rel="stylesheet/less" type="text/css" href="CSS/grade.less"/>
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
	<script type="text/javascript" src="JS/Definitions/grade.js"></script>
	<script type="text/javascript" src="JS/Definitions/gradeRepeat.js"></script>

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
			<span class="status">首頁 / 成績管理</span>
		</div>

		<div class="grade-container">
			<div class="grade-ctrl">
				<img src="image/instruction.png" class="grade-instruction">
			</div>
			<div class="grade-list">
				<div class="grade-item" ng-repeat = 'grade in grade track by $index'>
					<div class="grade-name">{{grade.allocateID + '. ' + grade.PTitle + ' (' + grade.Aname + ') '}}</div>
					<div class="grade-delete-icon grade-icon" data-aid = '{{grade.allocateID}}' data-pid = '{{grade.paperID}}' data-teacher = '{{grade.Steacher}}'></div>
					<div class="grade-detail-icon grade-icon" data-PTitle = '{{grade.PTitle}}' data-Aname = '{{grade.Aname}}' data-aid = '{{grade.allocateID}}' data-pid = '{{grade.paperID}}' data-teacherID = '{{grade.Steacher}}'></div>
					<!-- <div class="grade-enter-icon grade-icon" data-id = '' data-name = ''></div> -->
				</div>
			</div>
		</div>

	<div class="grade-instruction-mark">
		<h2>在此可看到各試卷作答後成績。</h2>
		<button class="uk-button uk-button-danger instruction-btn">關閉</button>
	</div>

	<div class="grade-editBox">
		<div class="edit-text">試卷成績</div>
		<hr></hr>
		<div class="editBox">
			<div class="edit-style">
				<div class="edit-name">姓名</div>
				<div class="edit-grade">成績</div>
				<div class="edit-time">時間</div>
			</div>
		</div>
		<button class="uk-button uk-button-danger grade-cancel edit-btn">關閉</button>
	</div>

</body>
