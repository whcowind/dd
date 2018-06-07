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
	<link rel="stylesheet/less" type="text/css" href="CSS/account.less"/>
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
	<script type="text/javascript" src="JS/Definitions/account.js"></script>
	<script type="text/javascript" src="JS/Definitions/accountRepeat.js"></script>

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
			<span class="status">首頁 / 帳號管理 - 教師</span>
		</div>

		<div class="account-teacher account-container">
			<div class="account-teacher-ctrl account-ctrl">
				<button class="uk-button uk-button-success account-btn new-single">單筆新增教師</button>
				<button class="uk-button uk-button-success account-btn new-mult">多筆新增教師</button>
				<img src="image/instruction.png" class="account-instruction">
				<a href="ex/teacher_ex.csv" download="多筆新增教師範例.csv"><button class="uk-button uk-button-danger account-btn-download">多筆新增範例下載</button></a>
			</div>
			<div class="account-teacher-list account-list">
				<div class="account-teacher-item account-item" ng-repeat = 'teacher in teacher track by $index'>
					<div class="account-teacher-name account-name">{{teacher.Aname}}</div>
					<div class="account-teacher-delete account-delete-icon account-icon" data-id = '{{teacher.Aid}}'></div>
					<div class="account-teacher-detail account-detail-icon account-icon" data-id = '{{teacher.Aid}}'></div>
					<div class="account-teacher-enter account-enter-icon account-icon" data-id = '{{teacher.Aid}}' data-name = '{{teacher.Aname}}'></div>
				</div>
			</div>
		</div>

		<div class="account-class account-container">
			<div class="account-class-ctrl account-ctrl">
				<button class="uk-button uk-button-success account-btn new-single">單筆新增班級</button>
				<button class="uk-button uk-button-success account-btn new-mult">多筆新增班級</button>
				<img src="image/instruction.png" class="account-instruction">
				<img src="image/back.png" class="account-back" data-now = 'class'>
				<a href="ex/class_ex.csv" download="多筆新增班級範例.csv"><button class="uk-button uk-button-danger account-btn-download">多筆新增範例下載</button></a>
			</div>
			<div class="account-class-list account-list">
				<!-- <div class="account-class-item account-item" data-id = '{{class.Aclass}}' ng-repeat = 'class in class track by $index'> -->
					<!-- <div class="account-class-name account-name">{{class.Aclass}}</div> -->
					<!-- <div class="account-class-delete account-delete-icon account-icon" data-id = '{{class.Aid}}'></div> -->
					<!-- <div class="account-class-detail account-detail-icon account-icon" data-id = '{{class.Aid}}'></div> -->
				<!-- </div> -->
			</div>
		</div>

		<div class="account-student account-container">
			<div class="account-student-ctrl account-ctrl">
				<button class="uk-button uk-button-success account-btn new-single">單筆新增學生</button>
				<button class="uk-button uk-button-success account-btn new-mult">多筆新增學生</button>
				<img src="image/instruction.png" class="account-instruction">
				<img src="image/back.png" class="account-back" data-now = 'student'>
				<a href="ex/student_ex.csv" download="多筆新增學生範例.csv"><button class="uk-button uk-button-danger account-btn-download">多筆新增範例下載</button></a>
			</div>
			<div class="account-student-list account-list">
				<!-- <div class="account-class-item account-item" data-id = '{{class.Aclass}}' ng-repeat = 'class in class track by $index'> -->
					<!-- <div class="account-class-name account-name">{{class.Aclass}}</div> -->
					<!-- <div class="account-class-delete account-delete-icon account-icon" data-id = '{{class.Aid}}'></div> -->
					<!-- <div class="account-class-detail account-detail-icon account-icon" data-id = '{{class.Aid}}'></div> -->
				<!-- </div> -->
			</div>
		</div>

		<div class="account-grade account-container">
			<div class="account-grade-ctrl account-ctrl">
				<!-- <button class="uk-button uk-button-success account-btn new-single">單筆新增學生</button> -->
				<!-- <button class="uk-button uk-button-success account-btn new-mult">多筆新增學生</button> -->
				<!-- <img src="image/instruction.png" class="account-instruction"> -->
				<img src="image/back.png" class="account-back" data-now = 'grade'>
				<!-- <a href="ex/grade_ex.xlsx" download="多筆新增範例.xlsx"><button class="uk-button uk-button-danger account-btn-download">多筆新增範例下載</button></a> -->
			</div>
			<div class="account-grade-list account-list">
				<!-- <div class="account-class-item account-item" data-id = '{{class.Aclass}}' ng-repeat = 'class in class track by $index'> -->
					<!-- <div class="account-class-name account-name">{{class.Aclass}}</div> -->
					<!-- <div class="account-class-delete account-delete-icon account-icon" data-id = '{{class.Aid}}'></div> -->
					<!-- <div class="account-class-detail account-detail-icon account-icon" data-id = '{{class.Aid}}'></div> -->
				<!-- </div> -->
			</div>
		</div>
	</div>

	<div class="account-teacher-instruction account-instruction-mark">
		<h2>多筆上傳請下載範例進行修改，資料從第2列開始，上傳時請注意須為CSV檔。</h2>
		<button class="uk-button uk-button-danger instruction-btn">關閉</button>
	</div>

	<div class="account-teacher-single account-single-upload">
		<div class="single-text">單筆新增教師</div>
		<hr></hr>
		<div class="single-edit-box">
			*姓名：<input type="text" class="account-single-name single-style" />
			<br />
			*帳號：<input type="text" class="account-single-ID single-style" />
			<br />
			*密碼：<input type="text" class="account-single-pass single-style" />
			<br />
			信箱：<input type="text" class="account-single-mail single-style" />
			<br />
		</div>
		<button class="uk-button uk-button-success single-submit single-btn">送出</button>
		<button class="uk-button uk-button-danger single-cancel single-btn">取消</button>
	</div>

	<div class="account-teacher-mult account-mult-upload">
		<div class="mult-text">多筆新增教師(CSV)</div>
		<hr></hr>
		<form enctype="multipart/form-data" action="csvTOsql.php" method="POST">
		    <!-- This file type -->
		    <input type="hidden" name="type" value="teacher" />
		    <!-- Name of input element determines name in $_FILES array -->
		    <input name="teacher" id="csv-teacher" type="file" class="uk-button-primary" style="cursor:pointer;" />
		    <input type="submit" value="上傳" class="uk-button-success csv-submit" style="cursor:pointer;"/>
		</form>
		<button class="uk-button uk-button-danger mult-cancel">取消</button>
	</div>

	<div class="account-teacher-edit account-editBox">
		<div class="edit-text">教師資料</div>
		<hr></hr>
		<div class="teacher-editBox editBox">
			*姓名：<input type="text" class="account-teacher-name edit-style" />
			<br />
			*帳號：<input type="text" class="account-teacher-ID edit-style" />
			<br />
			*密碼：<input type="text" class="account-teacher-pass edit-style" />
			<br />
			信箱：<input type="text" class="account-teacher-mail edit-style" />
			<br />
		</div>
		<button class="uk-button uk-button-success teacher-submit edit-btn">送出</button>
		<button class="uk-button uk-button-danger teacher-cancel edit-btn">取消</button>
	</div>

	<div class="account-class-single account-single-upload">
		<div class="single-text">單筆新增班級</div>
		<hr></hr>
		<div class="single-edit-box">
			*班級名稱：<input type="text" class="account-single-name single-style" />
			<br />
		</div>
		<button class="uk-button uk-button-success single-submit single-btn">送出</button>
		<button class="uk-button uk-button-danger single-cancel single-btn">取消</button>
	</div>

	<div class="account-class-mult account-mult-upload">
		<div class="mult-text">多筆新增班級(CSV)</div>
		<hr></hr>
		<form enctype="multipart/form-data" action="csvTOsql.php" method="POST">
		    <!-- This file type -->
		    <input type="hidden" name="type" value="class" />
		    <input type="hidden" name="teacherID" class="teacherID" value="" />
		    <!-- Name of input element determines name in $_FILES array -->
		    <input name="class" id="csv-class" type="file" class="uk-button-primary" style="cursor:pointer;" />
		    <input type="submit" value="上傳" class="uk-button-success csv-submit" style="cursor:pointer;"/>
		</form>
		<button class="uk-button uk-button-danger mult-cancel">取消</button>
	</div>

	<div class="account-class-edit account-editBox">
		<div class="edit-text">班級資料</div>
		<hr></hr>
		<div class="class-editBox editBox">
			*班級名稱：<input type="text" class="account-class-name edit-style" />
		</div>
		<button class="uk-button uk-button-success class-submit edit-btn">送出</button>
		<button class="uk-button uk-button-danger class-cancel edit-btn">取消</button>
	</div>

	<div class="account-student-single account-single-upload">
		<div class="single-text">單筆新增學生</div>
		<hr></hr>
		<div class="single-edit-box">
			*姓名：<input type="text" class="account-single-name single-style" />
			<br />
			*帳號：<input type="text" class="account-single-ID single-style" />
			<br />
			*密碼：<input type="text" class="account-single-pass single-style" />
			<br />
		</div>
		<button class="uk-button uk-button-success single-submit single-btn">送出</button>
		<button class="uk-button uk-button-danger single-cancel single-btn">取消</button>
	</div>

	<div class="account-student-mult account-mult-upload">
		<div class="mult-text">多筆新增學生(CSV)</div>
		<hr></hr>
		<form enctype="multipart/form-data" action="csvTOsql.php" method="POST">
		    <!-- This file type -->
		    <input type="hidden" name="type" value="student" />
		    <input type="hidden" name="teacherID" class="teacherID" value="" />
		    <input type="hidden" name="className" class="className" value="" />
		    <!-- Name of input element determines name in $_FILES array -->
		    <input name="student" id="csv-student" type="file" class="uk-button-primary" style="cursor:pointer;" />
		    <input type="submit" value="上傳" class="uk-button-success csv-submit" style="cursor:pointer;"/>
		</form>
		<button class="uk-button uk-button-danger mult-cancel">取消</button>
	</div>

	<div class="account-student-edit account-editBox">
		<div class="edit-text">學生資料</div>
		<hr></hr>
		<div class="student-editBox editBox">
			*姓名：<input type="text" class="account-student-name edit-style" />
			<br />
			*帳號：<input type="text" class="account-student-ID edit-style" />
			<br />
			*密碼：<input type="text" class="account-student-pass edit-style" />
			<br />
		</div>
		<button class="uk-button uk-button-success student-submit edit-btn">送出</button>
		<button class="uk-button uk-button-danger student-cancel edit-btn">取消</button>
	</div>

</body>
