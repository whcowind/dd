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
	<link rel="stylesheet/less" type="text/css" href="CSS/paper.less"/>
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
	<script type="text/javascript" src="JS/Definitions/paper.js"></script>
	<script type="text/javascript" src="JS/Definitions/paperRepeat.js"></script>

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
			<span class="status">首頁 / 試卷管理</span>
		</div>

		<div class="paper-container">
			<div class="paper-ctrl">
				<!-- <button class="uk-button uk-button-success account-btn new-single">單筆新增教師</button>
				<button class="uk-button uk-button-success account-btn new-mult">多筆新增教師</button>
 -->				<img src="image/instruction.png" class="paper-instruction">
				<!-- <a href="ex/teacher_ex.xlsx" download="多筆新增範例.xlsx"><button class="uk-button uk-button-danger account-btn-download">多筆新增範例下載</button></a> -->
			</div>
			<div class="paper-list">
				<div class="paper-item" ng-repeat = 'paper in paper track by $index'>
					<div class="paper-name">{{paper.paperID + '. ' + paper.PTitle + ' ( ' + paper.Aname + ' - ' + paper.owner + ' ) '}}</div>
					<div class="paper-delete-icon paper-icon" data-id = '{{paper.paperID}}'></div>
					<div class="paper-detail-icon paper-icon" data-id = '{{paper.paperID}}' data-owner = '{{paper.owner}}'></div>
				</div>
			</div>
		</div>

	<div class="paper-instruction-mark">
		<h2>多筆上傳請下載範例進行修改，資料從第2列開始，上傳時請注意須為CSV檔。</h2>
		<button class="uk-button uk-button-danger instruction-btn">關閉</button>
	</div>


	<div class="paper-editBox">
		<div class="edit-text">試卷修改</div>
		<hr></hr>
		<div class="editBox">
			*試卷名稱：<input type="text" class="paper-edit-title edit-style" />
			<br />
			試卷註解：<input type="text" class="paper-edit-explan edit-style" />
			<br />
		</div>
		<button class="uk-button uk-button-primary paper-TF paper-edit-btn" data-type = 'TF'>是非題</button>
		<button class="uk-button uk-button-primary paper-CH paper-edit-btn" data-type = 'CH'>選擇題</button>
		<button class="uk-button uk-button-primary paper-GP paper-edit-btn" data-type = 'GP'>群組題</button>
		<button class="uk-button uk-button-primary paper-SA paper-edit-btn" data-type = 'SA'>簡答題</button>
		<button class="uk-button uk-button-primary paper-P paper-edit-btn" data-type = 'P'>授權</button>
		<br />
		<button class="uk-button uk-button-success paper-submit edit-btn">送出</button>
		<button class="uk-button uk-button-danger paper-cancel edit-btn">取消</button>
	</div>

	<div class="paper-TF-BOX paperBOX">
		<div class="BOX-text">是非題</div>
		<hr></hr>
		<div class="listBox">
			<!-- <div class="Qitem">
				123456789
			</div>
			<div class="Qitem">
				332211
			</div> -->
		</div>
		<button class="uk-button uk-button-success TF-submit BOX-btn BOX-submit" data-type = 'TF'>確定</button>
		<button class="uk-button uk-button-danger TF-cancel BOX-btn">還原</button>
	</div>

	<div class="paper-CH-BOX paperBOX">
		<div class="BOX-text">選擇題</div>
		<hr></hr>
		<div class="listBox">
		</div>
		<button class="uk-button uk-button-success CH-submit BOX-btn BOX-submit" data-type = 'CH'>確定</button>
		<button class="uk-button uk-button-danger CH-cancel BOX-btn">還原</button>
	</div>

	<div class="paper-GP-BOX paperBOX">
		<div class="BOX-text">群組題</div>
		<hr></hr>
		<div class="listBox">
		</div>
		<button class="uk-button uk-button-success GP-submit BOX-btn BOX-submit" data-type = 'GP'>確定</button>
		<button class="uk-button uk-button-danger GP-cancel BOX-btn">還原</button>
	</div>

	<div class="paper-SA-BOX paperBOX">
		<div class="BOX-text">簡答題</div>
		<hr></hr>
		<div class="listBox">
		</div>
		<button class="uk-button uk-button-success SA-submit BOX-btn BOX-submit" data-type = 'SA'>確定</button>
		<button class="uk-button uk-button-danger SA-cancel BOX-btn">還原</button>
	</div>

	<div class="paper-P-BOX paperBOX">
		<div class="BOX-text">授權</div>
		<hr></hr>
		<div class="listBox">
		</div>
		<button class="uk-button uk-button-success P-submit BOX-btn BOX-submit" data-type = 'P'>確定</button>
		<button class="uk-button uk-button-danger P-cancel BOX-btn">還原</button>
	</div>


</body>
