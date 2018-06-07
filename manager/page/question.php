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
	<link rel="stylesheet/less" type="text/css" href="CSS/question.less"/>
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
	<script type="text/javascript" src="JS/Definitions/question.js"></script>

	<title>管理介面</title>
</head>

<body>
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
			<span class="status">首頁 / 試題管理</span>
		</div>

		<div class="question-container">
			<div class="question-ctrl">
				<button class="uk-button uk-button-success question-btn" data-type = 'TF'>是非題</button>
				<button class="uk-button uk-button-success question-btn" data-type = 'CH'>選擇題</button>
				<button class="uk-button uk-button-success question-btn" data-type = 'GP'>群組題</button>
				<button class="uk-button uk-button-success question-btn" data-type = 'SA'>簡答題</button>
				<img src="image/instruction.png" class="question-instruction">
			</div>
			<div class="question-list">
				<!-- <div class="account-teacher-item account-item"ng-repeat = 'teacher in teacher track by $index'>
					<div class="account-teacher-name account-name">{{teacher.Aname}}</div>
					<div class="account-teacher-delete account-delete-icon account-icon" data-id = '{{teacher.Aid}}'></div>
					<div class="account-teacher-detail account-detail-icon account-icon" data-id = '{{teacher.Aid}}'></div>
					<div class="account-teacher-enter account-enter-icon account-icon" data-id = '{{teacher.Aid}}' data-name = '{{teacher.Aname}}'></div>
				</div> -->
			</div>
		</div>
	</div>

	<div class="question-instruction-mark">
		<!-- <h2>本區域只提供刪除功能，若要修改題目，請登入特別教師帳號進行修改。</h2> -->
		<button class="uk-button uk-button-danger instruction-btn">關閉</button>
	</div>

	<div class="question-IMG-detail question-detail">
		<div class="detail-text">選擇圖片</div>
		<hr></hr>
		<input type="hidden" class="QID"></input>
		<input type="hidden" class="owner"></input>
		<input type="hidden" class="type"></input>
		<div class="img-detail-box detail-box">
			<!-- <div class = 'img-exist' data-toggle = '0'>
				<img class = 'img-style' src="image/photo.png">
				<div class="img-intro">01</div>
			</div> -->
		</div>
		<button class="uk-button uk-button-primary IMG-submit IMG-btn">確定</button>
		<button class="uk-button uk-button-success IMG-close IMG-btn">還原</button>
	</div>

	<div class="question-TF-detail question-detail">
		<div class="detail-text">是非題</div>
		<hr></hr>
		<div class="detail-box">
			<input type="hidden" class="QID"></input>
			<input type="hidden" class="owner"></input>
			<input type="hidden" class="type"></input>
			<div style="display: block;">題目：</div>
			<textarea class="question-detail-title detail-style" disabled></textarea>
			<div class="img-enter" data-type = 'TF'><img src="image/picture-icon.png" class="img-icon"></div>
			<br />
			<div style="display: block;">選項1：</div>
			<input type="text" class="question-detail-Ans1 detail-style" disabled/>
			<select class = 'score' id = 'tf-score1' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
			<div style="display: block;">選項2：</div>
			<input type="text" class="question-detail-Ans2 detail-style" disabled/>
			<select class = 'score' id = 'tf-score2' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
		</div>
		<button class="uk-button uk-button-primary detail-submit detail-btn" data-type = 'TF'>送出</button>
		<button class="uk-button uk-button-danger detail-edit detail-btn">修改</button>
		<button class="uk-button uk-button-success detail-close detail-btn">關閉</button>
	</div>

	<div class="question-CH-detail question-detail">
		<div class="detail-text">選擇題</div>
		<hr></hr>
		<div class="detail-box">
			<input type="hidden" class="QID"></input>
			<input type="hidden" class="owner"></input>
			<input type="hidden" class="type"></input>
			<div style="display: block;">題目：</div>
			<textarea class="question-detail-title detail-style" disabled></textarea>
			<div class="img-enter" data-type = 'CH'><img src="image/picture-icon.png" class="img-icon"></div>
			<br />
			<div style="display: block;">選項1：</div>
			<input type="text" class="question-detail-Ans1 detail-style" disabled/>
			<select class = 'score' id = 'ch-score1' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
			<div style="display: block;">選項2：</div>
			<input type="text" class="question-detail-Ans2 detail-style" disabled/>
			<select class = 'score' id = 'ch-score2' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
			<div style="display: block;">選項3：</div>
			<input type="text" class="question-detail-Ans3 detail-style" disabled/>
			<select class = 'score' id = 'ch-score3' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
			<div style="display: block;">選項4：</div>
			<input type="text" class="question-detail-Ans4 detail-style" disabled/>
			<select class = 'score' id = 'ch-score4' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
		</div>
		<button class="uk-button uk-button-primary detail-submit detail-btn" data-type = 'CH'>送出</button>
		<button class="uk-button uk-button-danger detail-edit detail-btn">修改</button>
		<button class="uk-button uk-button-success detail-close detail-btn">關閉</button>
	</div>

	<div class="question-GP-detail question-detail">
		<div class="detail-text">群組題</div>
		<hr></hr>
		<div class="detail-box GPBOX">
			<input type="hidden" class="QID"></input>
			<input type="hidden" class="owner"></input>
			<input type="hidden" class="type"></input>
			<div style="display: block;">情境：</div>
			<textarea class="question-detail-title detail-style GPTitle" disabled></textarea>
			<div class="img-enter" data-type = 'GP'><img src="image/picture-icon.png" class="img-icon"></div>
			<br />
			子題1：<button class="uk-button uk-button-primary detail-sub1 detail-enter-btn" data-index = '1' data-in = '0'>進入</button>
			子題2：<button class="uk-button uk-button-primary detail-sub2 detail-enter-btn" data-index = '2' data-in = '0'>進入</button>
			<br />
			子題3：<button class="uk-button uk-button-primary detail-sub3 detail-enter-btn" data-index = '3' data-in = '0'>進入</button>
			子題4：<button class="uk-button uk-button-primary detail-sub4 detail-enter-btn" data-index = '4' data-in = '0'>進入</button>
			<br />
			子題5：<button class="uk-button uk-button-primary detail-sub5 detail-enter-btn" data-index = '5' data-in = '0'>進入</button>
			子題6：<button class="uk-button uk-button-primary detail-sub6 detail-enter-btn" data-index = '6' data-in = '0'>進入</button>
			<br />
			子題7：<button class="uk-button uk-button-primary detail-sub7 detail-enter-btn" data-index = '7' data-in = '0'>進入</button>
			子題8：<button class="uk-button uk-button-primary detail-sub8 detail-enter-btn" data-index = '8' data-in = '0'>進入</button>
			<br />
			子題9：<button class="uk-button uk-button-primary detail-sub9 detail-enter-btn" data-index = '9' data-in = '0'>進入</button>
			子題10：<button class="uk-button uk-button-primary detail-sub10 detail-enter-btn" data-index = '10' data-in = '0'>進入</button>
			<br />
		</div>
		<button class="uk-button uk-button-primary detail-submit detail-btn" data-type = 'GP'>送出</button>
		<button class="uk-button uk-button-danger detail-edit detail-btn">修改</button>
		<button class="uk-button uk-button-success detail-close detail-btn">關閉</button>
	</div>

	<!-- <div class="sub1 subBOX">
		<div class="sub-container">
			<input type="hidden" class="subQID1"></input>
			<div style="display: block;">題目：</div>
			<textarea class="question-sub-title sub-style subTitle1" disabled></textarea>
			<select class = 'sort' id = 'sort1' disabled>
				<option value = '0' SELECTED>選擇題型式</option>
				<option value = '1'>是非題型式</option>
				<option value = '2'>簡答題型式</option>
			</select>
			<br />
			<div style="display: block;">選項1：</div>
			<input type="text" class="question-sub1-Ans1 sub-style" disabled/>
			<select class = 'score' id = 'gp1-score1' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
			<div style="display: block;">選項2：</div>
			<input type="text" class="question-sub1-Ans2 sub-style" disabled/>
			<select class = 'score' id = 'gp1-score2' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
			<div style="display: block;">選項3：</div>
			<input type="text" class="question-sub1-Ans3 sub-style" disabled/>
			<select class = 'score' id = 'gp1-score3' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
			<div style="display: block;">選項4：</div>
			<input type="text" class="question-sub1-Ans4 sub-style" disabled/>
			<select class = 'score' id = 'gp1-score4' disabled>
				<option value = '0'>0</option>
				<option value = '1'>1</option>
				<option value = '2'>2</option>
				<option value = '3'>3</option>
				<option value = '4'>4</option>
			</select>
			<br />
		</div>
		<button class="uk-button uk-button-success sub-edit sub-btn" data-index = '1'>確認</button>
		<button class="uk-button uk-button-danger sub-clear sub-btn" data-index = '1'>清除</button>
	</div> -->

	<div class="question-SA-detail question-detail">
		<div class="detail-text">簡答題</div>
		<hr></hr>
		<div class="detail-box">
			<input type="hidden" class="QID"></input>
			<input type="hidden" class="owner"></input>
			<input type="hidden" class="type"></input>
			<div style="display: block;">題目：</div>
			<textarea class="question-detail-title detail-style" disabled></textarea>
			<br />
		</div>
		<button class="uk-button uk-button-primary detail-submit detail-btn" data-type = 'SA'>送出</button>
		<button class="uk-button uk-button-danger detail-edit detail-btn">修改</button>
		<button class="uk-button uk-button-success detail-close detail-btn">關閉</button>
	</div>

</body>
