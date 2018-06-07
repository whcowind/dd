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
	<link rel="stylesheet/less" type="text/css" href="CSS/share.less"/>
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
	<script type="text/javascript" src="JS/Definitions/share.js"></script>
	<script type="text/javascript" src="JS/Definitions/shareRepeat.js"></script>

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
				<a href="">
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
			<span class="status">首頁 / 分享管理</span>
		</div>

		<div class="share-container">
			<div class="share-ctrl">
				<button class="uk-button uk-button-success share-btn new-share">新增分享</button>
				<img src="image/instruction.png" class="share-instruction">
			</div>
			<div class="share-list">
				<div class="share-item" ng-repeat = 'share in share track by $index'>
					<div class="share-name">{{share.name}}</div>
					<div class="share-title">{{share.title}}</div>
					<div class="share-sort">{{share.sort}}</div>
					<div class="share-upTime">{{share.upTime}}</div>
					<div class="share-delete-icon share-icon" data-id = '{{share.ID}}'></div>
					<div class="share-detail-icon share-icon" data-id = '{{share.ID}}'></div>
					<a href="{{share.file_path}}" download="{{share.downloadName}}"><div class="share-download-icon share-icon" data-id = '{{share.ID}}'></div></a>
				</div>
			</div>
		</div>
	</div>

	<div class="share-instruction share-instruction-mark">
		<h2>請謹慎修改。</h2>
		<button class="uk-button uk-button-danger instruction-btn">關閉</button>
	</div>

	<div class="share-upload">
		<div class="share-text">新增分享</div>
		<hr></hr>
		<div class="share-upload-box">
			<input type="hidden" class="shareID"></input>
			*姓名：<input type="text" class="share-upload-name upload-style" />
			<br />
			*標題：<input type="text" class="share-upload-title upload-style" />
			<br />
			密碼：<input type="text" class="share-upload-pass upload-style" />
			<br />
			*分類：<select id="share-sort" class="share-sort">
						<option value="1">數學</option>
						<option value="2">科學</option>
						<option value="3">閱讀</option>
						<option value="4">其他</option>
				   </select>
			<br />
			<br />
			<input name="fileToUpload" type="file" id="Upload_share"></input>
		</div>
		<button class="uk-button uk-button-success upload-submit upload-btn">送出</button>
		<button class="uk-button uk-button-danger upload-cancel upload-btn">取消</button>
	</div>

	<div class="share-upload-edit share-editBox">
		<div class="edit-text">分享資料</div>
		<hr></hr>
		<div class="upload-editBox editBox">
			<input type="hidden" class="shareEditID"></input>
			*姓名：<input type="text" class="share-upload-name edit-style" />
			<br />
			*標題：<input type="text" class="share-upload-title edit-style" />
			<br />
			密碼：<input type="text" class="share-upload-pass edit-style" />
			<br />
			*分類：<select id="share-sort" class="share-sort">
						<option value="1">數學</option>
						<option value="2">科學</option>
						<option value="3">閱讀</option>
						<option value="4">其他</option>
				   </select>
			<br />
			<br />
			<input name="fileToUpload" type="file" id="Upload_edit_share"></input>
		</div>
		<button class="uk-button uk-button-success upload-submit edit-btn">送出</button>
		<button class="uk-button uk-button-danger upload-cancel edit-btn">取消</button>
	</div>
</body>
