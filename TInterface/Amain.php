<?php session_start(); ?>
<?php require 'connectdb.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<!-- google font -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>  <!--myproject-->
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>  <!--≡-->
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:700' rel='stylesheet' type='text/css'><!--+ new paper-->
	<!-- google font -->
	<link rel="stylesheet/less" type="text/css" href="CSS/Amain.less"/>
	<script type="text/javascript" src="JS/framework/less.js"></script>
	<title>教師管理頁面</title>
</head>

<body ng-app = 'MyApp' ng-controller = 'QCtrl'>

	<?php
		$exists_id = true;
		$exists_password = true;

		//check id
		if(isset($_SESSION['A_id'])){
			$A_id = $_SESSION['A_id'];
		}
		else{
			$exists_id = false;
		}

		//check password
		if(isset($_SESSION['A_password'])){
			$A_password = $_SESSION['A_password'];
		}
		else{
			$exists_password = false;
		}

		//id or password error
		if(!$exists_id || !$exists_password){
			echo "<script type = 'text/javascript'> window.location.href = '../TLogin.html'; </script>";
		}
	?>

	<?php 
		//get teacher id ,  name 
		$sql = "SELECT Aname FROM admin_data WHERE Aid = '$A_id'";
		$result = mysql_query($sql) or die('error'); 
		$Aname = mysql_result($result, 0);

		$sql = "SELECT Aid FROM admin_data WHERE Aid = '$A_id'";
		$result = mysql_query($sql) or die('error1');
		$Aid = mysql_result($result, 0);

	?>
	<div class = 'container'>
		<div class = 'status_bar'>
			<div class = 'title_bar'>
				<div class = 'title'>首頁</div>
				<!-- <div class = 'control_bar'>≡</div> -->
			</div>
			<div class = 'account-data'>
				<!-- <div class = 'account-photo'></div> -->
				<div class = 'account-name' data-id = '<?php echo $Aid; ?>'>Hi,<?php echo $Aname;?>!</div>
				<!-- <div class = 'account-motion'>▼</div> -->
				<div class = 'logout'>登出</div>
			</div>
		</div>

		<div class = 'content'>
			<div class = 'slide'>
				<div class = 'account-data slide-box'>
					<div class = 'box-shadow'>帳號管理</div>
				</div>
				<div class = 'class-data slide-box'>
					<div class = 'box-shadow'>班級管理</div>
				</div>
				<div class = 'exam-warehouse slide-box'>
					<div class = 'box-shadow'>測驗試卷</div>
				</div>
				<div class = 'paper-grade slide-box'>
					<div class = 'box-shadow'>試卷成績</div>
				</div>
				<div class = 'markSA_Box  slide-box'>
					<div class = 'box-shadow'>簡答題批改</div>
				</div>
				<div class = 'result_Box slide-box'>
					<div class = 'box-shadow'>結果分析</div>
				</div>
				<div class = 'share_Box slide-box'>
					<div class = 'box-shadow'>教學分享區</div>
				</div>
				<div class = 'IMG_Box slide-box'>
					<div class = 'box-shadow'>圖片管理區</div>
				</div>
			</div>
			<div class = 'account' data-id = '<?php echo $Aid; ?>'>
				<div class = 'account-class account-container'>
					<div class="account-class-ctrl account-ctrl">
						<button class="uk-button uk-button-success account-btn new-class">新增班級</button>
					</div>
					<div class="account-class-list account-list">
						<div class="account-class-item account-item" ng-repeat = 'class in class track by $index'>
							<div class="account-class-name account-name">{{class.Aclass}}</div>
							<div class="account-class-delete account-delete-icon account-icon" data-id = '{{class.Aid}}' data-name = '{{class.Aclass}}'></div>
							<div class="account-class-detail account-detail-icon account-icon" data-id = '{{class.Aid}}' data-name = '{{class.Aclass}}'></div>
							<div class="account-class-enter account-enter-icon account-icon" data-id = '{{class.Aid}}' data-name = '{{class.Aclass}}'></div>
						</div>
					</div>
				</div>

				<div class="account-student account-container">
					<div class="account-student-ctrl account-ctrl">
						<button class="uk-button uk-button-success account-btn new-single">單筆新增學生</button>
						<button class="uk-button uk-button-success account-btn new-mult">多筆新增學生</button>
						<img src="image/back.png" class="account-back">
						<a href="ex/student_ex.csv" download="多筆新增學生範例.csv"><button class="account-btn-download">多筆新增範例下載</button></a>
					</div>
					<div class="account-student-list account-list">
						<!-- <div class="account-class-item account-item" data-id = '{{class.Aclass}}' ng-repeat = 'class in class track by $index'> -->
							<!-- <div class="account-class-name account-name">{{class.Aclass}}</div> -->
							<!-- <div class="account-class-delete account-delete-icon account-icon" data-id = '{{class.Aid}}'></div> -->
							<!-- <div class="account-class-detail account-detail-icon account-icon" data-id = '{{class.Aid}}'></div> -->
						<!-- </div> -->
					</div>
				</div>

				<div class="account-class-single account-single-upload">
					<div class="single-text">單筆新增班級</div>
					<hr></hr>
					<div class="single-edit-box">
						*班級名稱：<input type="text" class="account-single-name single-style" />
						<br />
					</div>
					<button class="class-single-submit single-btn">送出</button>
					<button class="single-cancel single-btn">取消</button>
				</div>

				<div class="account-class-edit account-editBox">
					<div class="edit-text">班級資料</div>
					<hr></hr>
					<div class="class-editBox editBox">
						*班級名稱：<input type="text" class="account-class-name edit-style" />
					</div>
					<button class="class-submit edit-btn">送出</button>
					<button class="class-cancel edit-btn">取消</button>
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
					<div class="edit-text">班級資料</div>
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

			</div>

			<div class="IMGManagerBox">
				<input type="hidden" class="AidTemp" value="<?php echo $Aid;?>"></input>
				<div class="content">
					<div class="top_area">
						<div class="topText">圖片管理</div>
						<button class="up">上傳</button>
						<button class="del">刪除</button>
					</div>
					<div class="img_list">
						<div class = 'viewBox'>
							<div class = 'imageExist' data-attr = '{{image.imageID}}' id = '{{image.imageID}}' ng-repeat = 'image in IMG track by $index'>
								<img class = 'img' src = '{{image.imageURL}}' width = '100px' height = '100px'></img><br/><p>{{image.imageID}}</p>
							</div>
						</div>
					</div>

					<div class="upBox">
						<!-- <div class="fileBox">
							<input name="fileToUpload" type="file" id="fileToUpload1" class = 'uk-button-primary file_picture_cover'></input>
						</div>
						<button class="img-upload img-btn">上傳</button>
						<button class="img-cancel img-btn">取消</button> -->
						<form id="multFileupload" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="id" class="MUploadID" value="<?php echo $Aid?>"></input>
							<input type="file" id="multFileupload" name="files" class="file_result uk-button-success" style="cursor:pointer;" multiple/>
							<span class="showPicNum" style="color:red; font-size: 18px;"></span>
							<!-- <button class="uk-button uk-button-primary viewMU" type="button" style="cursor:pointer">查看</button> -->
							<button class="uk-button uk-button-success MUpload" type="button" style="cursor:pointer">上傳</button>
						</form>
					</div>
				</div>
			</div>

			<div class="result">
				<input type="hidden" class="AidTemp" value="<?php echo $Aid;?>"></input>
				<div class="content">
					<div class="top_area">
						<div class="topText">結果分析</div>
						<div class="topBack">返回</div>
					</div>

					<div class="result_list">
						<div class="result_item" ng-repeat = 'result in result track by $index'>
							<img class="item_img" src="image/paper.png"/>
							<div class = 'result_data' data-aid = '{{result.allocateID}}' data-id = '{{result.paperID}}' data-title = '{{result.PTitle}}'>{{result.allocateID  + '. ' + result.PTitle + '(試卷ID:' + result.paperID + ')' }}</div>
						</div>
					</div>

					<div class="result_view">
						<input type="hidden" class="reslutTemp"></input>
						<div class="tableBlock"></div>
					</div>
				</div>
			</div>

			<div class="share">
				<!-- <div class="classTemp"><?php echo $Aclass;?></div> -->
				<input type="hidden" class="AidTemp" value="<?php echo $Aid;?>"></input>
				<div class="content">
					<div class="share_up">
						<input type="hidden" class="IDTemp"></input>
						<div class="upText">*姓名：</div>
						<input type="text" class="upName"></input>
						<div class="upText">*標題：</div>
						<input type="text" class="upTitle"></input>
						<div class="upText">*分類：</div>
						<select id="upSort" class="upSort">
							<option value="1">數學</option>
							<option value="2">科學</option>
							<option value="3">閱讀</option>
							<option value="4">其他</option>
					   </select>
						<div class="upText">密碼：</div>
						<input type="text" class="upPass"></input>
						<div class="upText">
							<input name="fileToUpload" type="file" id="fileToUpload_share"></input>
						</div>
						<img class="upload" src="image/upload.png" height="34" width="34" title="上傳" />
					</div>

					<div class="share_view">
						<!-- <div class="share_item">
							<a href="" download="" class="D1">
								<img class="download" src="image/download.png" title="下載" />
							</a>
						</div> -->
						<!-- <div class="share_item" ng-repeat = 'share in share track by $index'>
							<img class="item_img" src="image/paper.png"/>
							<div class="name">{{share.name}}</div>
							<div class="title">{{share.title}}</div>
							<div class="time">{{share.upTime}}</div>
							<a href="{{share.file_path}}" download="{{share.title}}">
								<img class="download" src="image/download.png" title="下載" />
							</a>
							<img class="del" src="image/cross.png" title="刪除" data-id = '{{share.ID}}' data-Aid = '{{share.Aid}}' />
						</div> -->
					</div>
				</div>
			</div>

			<div class="markSA">
				<div class="content">
					<div class="SA_selector">
						<div class="list">
							<select class = 'SA_list' id = 'SA_list'>
								<option value = '0'>--------------</option>
							</select>
							<div class="list_btn">確定</div>
						</div>
					</div>

					<div class="SA_View">
						
					</div>

					<div class="boot">
						<div class="markSA_submit">送出</div>
					</div>
				</div>
			</div>

			<div class = 'class'>
				<div class = 'content'>
					<div class="classList">
						<div class = 'top-name'>班級清單</div>
						<hr class = 'top-hr'></hr>
						<div class="classListBox">
							<div class="classList-data" data-className = '{{classlist.Aclass}}' data-Aid = '{{classlist.Aid}}' ng-repeat = 'classlist in classlist track by $index'>{{classlist.Aclass}}</div>
							<!-- <hr class = 'class-data-hr'></hr> -->
						</div>
					</div>
					<div class="studentList">
						<div class = 'class-name'></div>
						<hr class = 'class-hr'></hr>
						<div class = 'class-detail'>
							<!-- <div class = 'statusBar'>
								<div class="output">總成績下載</div>
								<div class="output_detailed">詳細成績下載</div>
								<div class = 'closebtn'>關閉</div>
							</div> -->
							<!-- <div class = 'student-data' data-classname = '{{classlist.Sclass}}' data-name = '{{classlist.Sname}}' data-id = '{{classlist.Sid}}' ng-repeat = 'classlist in classlist track by $index'>{{classlist.Sname + ' - (' + classlist.Sid + ')'}}
								<hr class = 'student-data-hr'></hr>
							</div> -->
						</div>
						<div class = 'student-detail'>
							<div class = 'student-table-content'>
								<table class = 'table2excel'>
									<thead>
										<tr class="student-table">
											<th>#</th>
											<th>Column heading</th>
											<th>Column heading</th>
											<th>Column heading</th>
										</tr>
									</thead>
									<tbody>
										<tr><td>data1a</td><td>data1b</td></tr>
										<tr><td>data2a</td><td>data2b</td></tr>
									</tbody>
									<tfoot>
										<tr><td colspan="2">This footer spans 2 cells</td></tr>
									</tfoot>
								</table>
							</div>
							<div class="student-table-detailed" style="display:none;">
								
							</div>
							<!-- <div class = 'student-grade' ng-repeat = 'studentgrade in studentgrade track by $index'>{{studentgrade.Sid}}</div> -->
							<div class = 'statusBar'>
								<!-- <img class = 'output' src = 'image/download.png' width = '30px' height = '30px'/> -->
								<!-- <img class = 'closebtn' src = 'image/cross.png' width = '30px' height = '30px' /> -->
								<div class="output">總成績下載</div>
								<div class="output_detailed">詳細成績下載</div>
								<div class = 'closebtn'>關閉</div>
							</div>
							<div class = 'studentContent'>

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class = 'exam'>
				<div class = 'content'>
					<div class = 'exam-box1 emb'>
						<div class = 'new-paper'>
							新增/修改試卷
						</div>
						<hr></hr>
						<div class = 'allocate'>
							分配試卷
						</div>
						<hr></hr>
					</div>
					<div class = 'exam-box2 emb'>
						<div class = 'TFQuestion'>
							是非題
						</div>
						<hr></hr>
						<div class = 'ChoiceQuestion'>
							選擇題
						</div>
						<hr></hr>
						<div class = 'GroupQuestion'>
							群組題
						</div>
						<hr></hr>
						<div class = 'SAQuestion'>
							簡答題
						</div>
						<hr></hr>
					</div>
				</div>

				<div class = 'exam-allocate'>
					<div class = 'allocateBack'>+</div>
					<div class = 'allocateBox'>
						<div class = 'allocateBtn'>分配試卷</div>
						<hr></hr>
						<div class = 'existBox'>
							<div class = 'allocateID allocateDetail' data-id = '{{allocateExist.allocateID}}' ng-repeat = 'allocateExist in allocateExist track by $index '  >
								<div class = 'ID'>{{allocateExist.allocateID}}</div>
								<div class = 'mainText'>{{allocateExist.PTitle}}</div>
								<div class = 'deleteBtn' ></div>
								<div class = 'EndExamBtn' ng-if="allocateExist.progressing=='1'"></div>
								<div class = 'lookListBtn'></div>
							</div>

							<div class = 'listTable'>
								<div class = 'listTop'>
									<!-- <div class = 'listStatus' data-id = '{{allocateExist.allocateID}}' ng-repeat = 'allocateExist in allocateExist track by $index'>{{allocateExist.allovcateID + '.' + allocateExist.PTitle}}</div> -->
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'listContent'>
									<!-- <div class = 'list' ng-repeat = 'List in List track by $index'>{{List.studentID}}</div> -->
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'listFoot'>
									<div class = 'listClose'>關閉</div>
								</div>
							</div>
						</div>
						<div class = 'allocateTable'>
							<div class = 'allocateTop'>試卷	：
								<select data-temp = '<?php echo $Aclass;?>' class = 'selectPaper' id = 'selectPaper' name = 'selectPaper'>
									<option value = '0'>--------------</option>
									<option data-attr = '{{paperExist.paperID}}' value = '{{paperExist.paperID}}' ng-repeat = 'paperExist in paperExist track by $index'>{{paperExist.paperID + '. ' + paperExist.PTitle}}</option>
								</select>
							</div>
							<hr class = 'QuestionBase-hr'></hr>
							<div class = 'allocateContent'>
								<div data-length = '{{studentExist.length}}' class = 'studentExist' id = '{{$index}}' data-attr = '{{studentExist.Sid}}' ng-repeat = 'studentExist in studentExist track by $index'>{{studentExist.Sname + ' ( ' + studentExist.Sclass + ' ) '}}</div>
							</div>
							<hr class = 'QuestionBase-hr'></hr>
							<div class = 'allocateFoot'>
								<div class = 'allocateSubmit'>送出</div>
								<div class = 'allocateAll'>全選/全消</div>
								<div class = 'allocateCancel'>取消</div>
							</div>
						</div>
					</div>
				</div>

				<div class = 'exam-Paper makePaper'>
					<div class = 'paperBack'>+</div>
					<div class = 'exist MPaper'>
						<div class = 'newPaper'>
							<!-- <+ New Paper> -->
							+ 新增
						</div>
						<hr class = 'QuestionBase-hr'></hr>
						<div class = 'PExist' data-attr = '{{paperExist.paperID}}' data-own = '{{paperExist.own}}' ng-repeat = 'paperExist in paperExist track by $index'>{{paperExist.paperID + '. ' + paperExist.PTitle}}</div>
					</div>
					<div class = 'create MPaper'>
						<!--Paper Preview-->
						<div class = 'paperPreviewBlock'>
							<div class = 'previewContent'></div>
							<div class = 'close'>關閉</div>
						</div>
						<div class = 'paper'>
							<div class = 'paperTitleText PText'>試卷標題：</div>
							<input type = 'text' class = 'PTitle'><div>
							<div class = 'paperExplanText PText'>試卷註解(可不填)：</div>
							<input type = 'text' class = 'PExplan'></div>
							<div class = 'selectTF selectbtn'>
								<div class = 'selectBtnText'>是非題</div>
							</div>
							<div class = 'selectCH selectbtn'>
								<div class = 'selectBtnText'>選擇題</div>
							</div>
							<div class = 'selectGP selectbtn'>
								<div class = 'selectBtnText'>群組題</div>
							</div>
							<div class = 'selectSA selectbtn'>
								<div class = 'selectBtnText'>簡答題</div>
							</div>
							<div class = 'paperSubmit paperTSubmit'>送出</div>
							<div class = 'paperClear paperTClear'>清除</div>
							<div class = 'paperPreview paperTPreview'>預覽</div>

							<!-- Paper True & False -->
							<div class = 'paperTFBlock paperBlock'>
								<div class = 'paperTF paperTop'>
									是非題
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'paperTFContent paperContent'>
									<div class = 'paperTFQuestion paperQuestionText' data-attr = '{{paperTF.TFId}}' ng-repeat = 'paperTF in paperTF track by $index'>{{paperTF.TFId + '. ' + paperTF.TFDetail}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'paperChooseAffirm paperTChooseAffirm'>確認</div>
									<div class = 'paperChooseClear paperTChooseClear' data-type = 'TF'>清空</div>
								</div>
							</div>
							<!-- Paper Choice -->
							<div class = 'paperCHBlock paperBlock'>
								<div class = 'paperCH paperTop'>
									選擇題
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'paperTFContent paperContent'>
									<div class = 'paperCHQuestion paperQuestionText' data-attr = '{{paperCH.ChId}}' ng-repeat = 'paperCH in paperCH track by $index'>{{paperCH.ChId + '. ' + paperCH.ChDetail}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'paperChooseAffirm paperTChooseAffirm'>確認</div>
									<div class = 'paperChooseClear paperTChooseClear' data-type = 'CH'>清空</div>
								</div>
							</div>
							<!-- Paper Group -->
							<div class = 'paperGPBlock paperBlock'>
								<div class = 'paperGP paperTop'>
									群組題
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'paperTFContent paperContent'>
									<div class = 'paperGPQuestion paperQuestionText' data-attr = '{{paperGP.GroupID}}' ng-repeat = 'paperGP in paperGP track by $index'>{{paperGP.GroupID + '. ' + paperGP.GroupTitle}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'paperChooseAffirm paperTChooseAffirm'>確認</div>
									<div class = 'paperChooseClear paperTChooseClear' data-type = 'GP'>清空</div>
								</div>
							</div>
							<!-- Paper Short Ans -->
							<div class = 'paperSABlock paperBlock'>
								<div class = 'paperSA paperTop'>
									簡答題
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'paperSAContent paperContent'>
									<div class = 'paperSAQuestion paperQuestionText' data-attr = '{{paperSA.SAId}}' ng-repeat = 'paperSA in paperSA track by $index'>{{paperSA.SAId + '. ' + paperSA.SADetail}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'paperChooseAffirm paperTChooseAffirm'>確認</div>
									<div class = 'paperChooseClear paperTChooseClear' data-type = 'SA'>清空</div>
								</div>
							</div>
						</div>

						<!-- Paper Update -->

						<div class = 'paperUpdate'>
							<input class = 'PID'></input>
							<div class = 'paperUTitleText PText'>試卷標題：</div>
							<input type = 'text' class = 'PUTitle'></input>
							<div class="permissionBtn">授權</div>
							<div class = 'paperUExplanText PText'>試卷註解(可不填)：</div>
							<input type = 'text' class = 'PUExplan'></input>
							<div class = 'selectUTF selectbtn'>
								<div class = 'selectBtnText'>是非題</div>
							</div>
							<div class = 'selectUCH selectbtn'>
								<div class = 'selectBtnText'>選擇題</div>
							</div>
							<div class = 'selectUGP selectbtn'>
								<div class = 'selectBtnText'>群組題</div>
							</div>
							<div class = 'selectUSA selectbtn'>
								<div class = 'selectBtnText'>簡答題</div>
							</div>
							<div class = 'paperUSubmit paperTSubmit'>送出</div>
							<div class = 'paperUClear paperTClear'>刪除</div>
							<div class = 'paperUPreview paperTPreview'>預覽</div>
							<!--Paper Permission Block-->
							<div class = 'paperPermission paperBlock'>
								<div class = 'PermissionText paperTop'>
									授權
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'teacherList paperContent'>
									<div class = 'teacherItem paperQuestionText' id = '{{paperP.Aid}}' data-attr = '{{paperP.Aid}}' ng-repeat = 'paperP in paperP track by $index'>{{paperP.Aname + ' ( ' + paperP.Aid + ' )'}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'permissionSubmit'>修改授權</div>
									<div class = 'permissionAffirm'>返回</div>
									<div class = 'permissionClear' data-type = 'P'>清空</div>
								</div>
							</div>
							<!-- Paper True & False -->
							<div class = 'paperUTFBlock paperBlock'>
								<div class = 'paperTF paperTop'>
									是非題
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'paperTFContent paperContent'>
									<div class = 'paperTFQuestion paperQuestionText' id = '{{paperTF.TFId}}' data-attr = '{{paperTF.TFId}}' ng-repeat = 'paperTF in paperTF track by $index'>{{paperTF.TFId + '. ' + paperTF.TFDetail}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'paperChooseAffirm paperTChooseAffirm'>確認</div>
									<div class = 'paperChooseClear paperTChooseClear' data-type = 'TF'>清空</div>
								</div>
							</div>
							<!-- Paper Choice -->
							<div class = 'paperUCHBlock paperBlock'>
								<div class = 'paperCH paperTop'>
									選擇題
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'paperCHContent paperContent'>
									<div class = 'paperCHQuestion paperQuestionText' id = '{{paperCH.ChId}}' data-attr = '{{paperCH.ChId}}' ng-repeat = 'paperCH in paperCH track by $index'>{{paperCH.ChId + '. ' + paperCH.ChDetail}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'paperChooseAffirm paperTChooseAffirm'>確認</div>
									<div class = 'paperChooseClear paperTChooseClear' data-type = 'CH'>清空</div>
								</div>
							</div>
							<!-- Paper Group -->
							<div class = 'paperUGPBlock paperBlock'>
								<div class = 'paperGP paperTop'>
									群組題
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'paperGPContent paperContent'>
									<div class = 'paperGPQuestion paperQuestionText' id = '{{paperGP.GroupID}}' data-attr = '{{paperGP.GroupID}}' ng-repeat = 'paperGP in paperGP track by $index'>{{paperGP.GroupID + '. ' + paperGP.GroupTitle}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'paperChooseAffirm paperTChooseAffirm'>確認</div>
									<div class = 'paperChooseClear paperTChooseClear' data-type = 'GP'>清空</div>
								</div>
							</div>
							<!-- Paper Short Ans -->
							<div class = 'paperUSABlock paperBlock'>
								<div class = 'paperSA paperTop'>
									簡答題
								</div>
								<hr class = 'QuestionBase-hr'></hr>
								<div class = 'paperSAContent paperContent'>
									<div class = 'paperSAQuestion paperQuestionText' id = '{{paperSA.SAId}}' data-attr = '{{paperSA.SAId}}' ng-repeat = 'paperSA in paperSA track by $index'>{{paperSA.SAId + '. ' + paperSA.SADetail}}</div>
								</div>
								<div class = 'paperfoot'>
									<hr class = 'QuestionBase-hr'></hr>
									<div class = 'paperChooseAffirm paperTChooseAffirm'>確認</div>
									<div class = 'paperChooseClear paperTChooseClear' data-type = 'SA'>清空</div>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div  class = 'exam-TFQuestion makeQuestion'>
					<div class = 'back'>+</div>
					<div class = 'exist MQuest'>
						<div class = 'new-TFQuestion'>
							<!-- + New TFQuestion -->
							+ 新增
						</div>
						<hr class = 'QuestionBase-hr'></hr>
						<div data-attr = '{{res.TFId}}' class = 'TFExist' ng-repeat = 'res in TF track by $index'>{{res.TFId + '. ' + res.TFDetail}}</div>
					</div>
					<div class ='create MQuest'>

						<div class = 'TFPreviewBlock PreviewBlock PreviewBlock_style'>
							<div class = 'previewContent'></div>
							<div class = 'close'>關閉</div>
						</div>

						<div class = 'TF'>
							<div class = 'setImage'></div>
							<textarea class = 'TFDetail'></textarea>
							<div class = 'AnsTextType'>選項一:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'TAns TFAns'></input>
							<select class = 'score' id = 'TFAns1S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'AnsTextType'>選項二:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'FAns TFAns'></input>
							<select class = 'score' id = 'TFAns2S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'submit'>送出</div>
							<div class = 'TFPreview Preview_style'>預覽</div>

						</div>

						<!--Update-->

						<div class = 'TFUpdate'>
							<div class = 'setImage'></div>
							<textarea class = 'TFId' disabled></textarea>
							<textarea class = 'TFUDetail'></textarea>
							<div class = 'AnsTextType'>選項一:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'TUAns TFUAns'></input>
							<select class = 'score' id = 'TFUAns1S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'AnsTextType'>選項二:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'FUAns TFUAns'></input>
							<select class = 'score' id = 'TFUAns2S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'update'>更新</div>
							<div class = 'delete'>刪除</div>
							<div class = 'TFPreview Preview_style TFUPreview '>預覽</div>

						</div>
					</div>
				</div>
				<div  class = 'exam-ChoiceQuestion makeQuestion'>
					<div class = 'back'>+</div>
					<div class = 'exist MQuest'>
						<div class = 'new-ChoiceQuestion'>
							<!-- + New ChoiceQuestion -->
							+ 新增
						</div>
						<hr class = 'QuestionBase-hr'></hr>
						<div class = 'ChExist' data-attr = '{{chres.ChId}}' ng-repeat = 'chres in CH track by $index'>{{chres.ChId + '.' + chres.ChDetail}}</div>
					</div>
					<div class ='create MQuest'>

						<div class = 'CHPreviewBlock PreviewBlock PreviewBlock_style'>
							<div class = 'previewContent'></div>
							<div class = 'close'>關閉</div>
						</div>
						

						<div class = 'Choice'>
							<div class = 'setImage'></div>
							<textarea class = 'ChoiceDetail'></textarea>
							<div class = 'AnsTextType'>答案1:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'C1Ans ChoiceAns'></input>
							<select class = 'score' id = 'ChAns1S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'AnsTextType'>答案2:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'C2Ans ChoiceAns'></input>
							<select class = 'score' id = 'ChAns2S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'AnsTextType'>答案3:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'C3Ans ChoiceAns'></input>
							<select class = 'score' id = 'ChAns3S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'AnsTextType'>答案4:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'C4Ans ChoiceAns'></input>
							<select class = 'score' id = 'ChAns4S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'submit'>送出</div>
							<div class = 'CHPreview Preview_style' style="left: 80%;">預覽</div>
						</div>

						<!--Update-->

						<div class = 'ChoiceUpdate'>
							<div class = 'setImage'></div>
							<textarea class = 'CHId' disabled></textarea>
							<textarea class = 'ChoiceUDetail'></textarea>
							<div class = 'AnsTextType'>答案1:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'C1UAns ChoiceUAns'></input>
							<select class = 'score' id = 'ChUAns1S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'AnsTextType'>答案2:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'C2UAns ChoiceUAns'></input>
							<select class = 'score' id = 'ChUAns2S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'AnsTextType'>答案3:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'C3UAns ChoiceUAns'></input>
							<select class = 'score' id = 'ChUAns3S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'AnsTextType'>答案4:</div>
							<div class = 'ScoreTextType'>分數:</div>
							<input type = 'text' class = 'C4UAns ChoiceUAns'></input>
							<select class = 'score' id = 'ChUAns4S'>
								<option value = '0' SELECTED>0</option>
								<option value = '1'>1</option>
								<option value = '2'>2</option>
								<option value = '3'>3</option>
								<option value = '4'>4</option>
							</select>
							<div class = 'update'>更新</div>
							<div class = 'delete'>刪除</div>
							<div class = 'CHPreview Preview_style CHUPreview ' style="left: 80%;">預覽</div>

						</div>
					</div>
				</div>
				<div  class = 'exam-GroupQuestion makeQuestion'>
					<div class = 'back'>+</div>
					<div class = 'exist MQuest'>
						<div class = 'new-GroupQuestion'>
							<!-- + New GroupQuestion -->
							+ 新增
						</div>
						<hr class = 'QuestionBase-hr'></hr>
						<div class = 'GroupExist' data-attr = '{{gpres.GroupID}}' ng-repeat = 'gpres in GP track by $index'>{{gpres.GroupID + '.' + gpres.GroupTitle}}</div>
					</div>
					<div class ='create MQuest'>
						<div class = 'GPPreviewBlock PreviewBlock PreviewBlock_style'>
							<div class = 'previewContent'></div>
							<div class = 'close'>關閉</div>
						</div>
						

						<div class = 'Group'>
							<div class = 'setImage'></div>
							<textarea class = 'GroupDetail'></textarea>
							<div class = 'GroupQuestion1 GroupQuestionType'>群組一</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_one' data-number = '1'>設定</div>
								<div class = 'check_subquestion1_val checkval'>
									<img class = 'checkvalimg img1' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion2 GroupQuestionType'>群組二</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_two' data-number = '2'>設定</div>
								<div class = 'check_subquestion2_val checkval'>
									<img class = 'checkvalimg img2' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion3 GroupQuestionType'>群組三</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_three' data-number = '3'>設定</div>
								<div class = 'check_subquestion3_val checkval'>
									<img class = 'checkvalimg img3' src = '/MSR/TInterface/image/Check-icon.png' width = '15px' height = '15px'>
								</div>
							</div>
							<div class = 'GroupQuestion4 GroupQuestionType'>群組四</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_four' data-number = '4'>設定</div>
								<div class = 'check_subquestion4_val checkval'>
									<img class = 'checkvalimg img4' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion5 GroupQuestionType'>群組五</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_five' data-number = '5'>設定</div>
								<div class = 'check_subquestion5_val checkval'>
									<img class = 'checkvalimg img5' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion6 GroupQuestionType'>群組六</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_six' data-number = '6'>設定</div>
								<div class = 'check_subquestion6_val checkval'>
									<img class = 'checkvalimg img6' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion7 GroupQuestionType'>群組七</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_seven' data-number = '7'>設定</div>
								<div class = 'check_subquestion7_val checkval'>
									<img class = 'checkvalimg img7' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion8 GroupQuestionType'>群組八</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_eight' data-number = '8'>設定</div>
								<div class = 'check_subquestion8_val checkval'>
									<img class = 'checkvalimg img8' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion9 GroupQuestionType'>群組九</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_night' data-number = '9'>設定</div>
								<div class = 'check_subquestion9_val checkval'>
									<img class = 'checkvalimg img9' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion10 GroupQuestionType'>群組十</div>
							<div class = 'putbox'>
								<div class = 'GoSet GoSet_ten' data-number = '10'>設定</div>
								<div class = 'check_subquestion10_val checkval'>
									<img class = 'checkvalimg img10' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'Mark'>
								<!--SubQuestion1-->
								<div class = 'GroupSubQ1Type subType'>
									<select class = 'sort' id = 'sort1'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion1 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ1Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ1Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ1Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ1Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ1Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ1Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ1Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ1Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '1'>確認</div>
									<div class = 'cancel_btn' data-number = '1'>清除</div>
								</div>
								<!--subQuestion2-->
								<div class = 'GroupSubQ2Type subType'>
									<select class = 'sort' id = 'sort2'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion2 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ2Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ2Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ2Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ2Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ2Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ2Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ2Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ2Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '2'>確認</div>
									<div class = 'cancel_btn' data-number = '2'>清除</div>
								</div>
								<!--SubQuestion3-->
								<div class = 'GroupSubQ3Type subType'>
									<select class = 'sort' id = 'sort3'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion3 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ3Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ3Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ3Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ3Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ3Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ3Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ3Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ3Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '3'>確認</div>
									<div class = 'cancel_btn' data-number = '3'>清除</div>
								</div>
								<!--SubQuestion4-->
								<div class = 'GroupSubQ4Type subType'>
									<select class = 'sort' id = 'sort4'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion4 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ4Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ4Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ4Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ4Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ4Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ4Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ4Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ4Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '4'>確認</div>
									<div class = 'cancel_btn' data-number = '4'>清除</div>
								</div>
								<!--SubQuestion5-->
								<div class = 'GroupSubQ5Type subType'>
									<select class = 'sort' id = 'sort5'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion5 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ5Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ5Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ5Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ5Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ5Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ5Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ5Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ5Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '5'>確認</div>
									<div class = 'cancel_btn' data-number = '5'>清除</div>
								</div>
								<!--SubQuestion6-->
								<div class = 'GroupSubQ6Type subType'>
									<select class = 'sort' id = 'sort6'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion6 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ6Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ6Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ6Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ6Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ6Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ6Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ6Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ6Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '6'>確認</div>
									<div class = 'cancel_btn' data-number = '6'>清除</div>
								</div>
								<!--SubQuestion7-->
								<div class = 'GroupSubQ7Type subType'>
									<select class = 'sort' id = 'sort7'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion7 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ7Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ7Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ7Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ7Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ7Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ7Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ7Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ7Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '7'>確認</div>
									<div class = 'cancel_btn' data-number = '7'>清除</div>
								</div>
								<!--SubQuestion8-->
								<div class = 'GroupSubQ8Type subType'>
									<select class = 'sort' id = 'sort8'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion8 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ8Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ8Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ8Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ8Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ8Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ8Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ8Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ8Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '8'>確認</div>
									<div class = 'cancel_btn' data-number = '8'>清除</div>
								</div>
								<!--SubQuestion9-->
								<div class = 'GroupSubQ9Type subType'>
									<select class = 'sort' id = 'sort9'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion9 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ9Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ9Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ9Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ9Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ9Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ9Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ9Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ9Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '9'>確認</div>
									<div class = 'cancel_btn' data-number = '9'>清除</div>
								</div>
								<!--SubQuestion10-->
								<div class = 'GroupSubQ10Type subType'>
									<select class = 'sort' id = 'sort10'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'subQuestion10 subQuestion'></textarea>
									<div class = 'subQAnsText'>答案1</div>
									<div class= 'subQScoreText'>分數</div>
									<input type = 'text' class = 'subQ10Ans1 subQAns'></input>
									<select class = 'subScore' id = 'subQ10Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案2</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ10Ans2 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ10Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案3</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ10Ans3 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ10Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subQAnsText2'>答案4</div>
									<div class= 'subQScoreText2'>分數</div>
									<input type = 'text' class = 'subQ10Ans4 subQAnsT2'></input>
									<select class = 'subScore' id = 'subQ10Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirm_btn' data-number = '10'>確認</div>
									<div class = 'cancel_btn' data-number = '10'>清除/取消</div>
								</div>
							</div>
							<div class = 'submit2'>送出</div>
							<div class = 'GPPreview Preview_style'>預覽</div>
						</div>

						<!--Update-->

						<div class = 'GroupUpdate'>
							<div class = 'setImage'></div>
							<textarea class = 'GroupId' disabled style="display:none;"></textarea>
							<textarea class = 'GroupUDetail'></textarea>
							<div class = 'GroupQuestion1 GroupQuestionType'>群組一</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_one' data-number = '1'>設定</div>
								<div class = 'check_subquestion1_val checkval'>
									<img class = 'checkvalimg img1' id = 'img1' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion2 GroupQuestionType'>群組二</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_two' data-number = '2'>設定</div>
								<div class = 'check_subquestion2_val checkval'>
									<img class = 'checkvalimg img2' id = 'img2' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion3 GroupQuestionType'>群組三</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_three' data-number = '3'>設定</div>
								<div class = 'check_subquestion3_val checkval'>
									<img class = 'checkvalimg img3' id = 'img3' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion4 GroupQuestionType'>群組四</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_four' data-number = '4'>設定</div>
								<div class = 'check_subquestion4_val checkval'>
									<img class = 'checkvalimg img4' id = 'img4' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion5 GroupQuestionType'>群組五</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_five' data-number = '5'>設定</div>
								<div class = 'check_subquestion5_val checkval'>
									<img class = 'checkvalimg img5' id = 'img4' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion6 GroupQuestionType'>群組六</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_six' data-number = '6'>設定</div>
								<div class = 'check_subquestion6_val checkval'>
									<img class = 'checkvalimg img6' id = 'img4' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion7 GroupQuestionType'>群組七</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_seven' data-number = '7'>設定</div>
								<div class = 'check_subquestion7_val checkval'>
									<img class = 'checkvalimg img7' id = 'img4' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion8 GroupQuestionType'>群組八</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_eight' data-number = '8'>設定</div>
								<div class = 'check_subquestion8_val checkval'>
									<img class = 'checkvalimg img8' id = 'img4' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion9 GroupQuestionType'>群組九</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_night' data-number = '9'>設定</div>
								<div class = 'check_subquestion9_val checkval'>
									<img class = 'checkvalimg img9' id = 'img4' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'GroupQuestion10 GroupQuestionType'>群組十</div>
							<div class = 'putbox'>
								<div class = 'GoUSet GoSet_ten' data-number = '10'>設定</div>
								<div class = 'check_subquestion10_val checkval'>
									<img class = 'checkvalimg img10' id = 'img4' src = '/MSR/TInterface/image/Check-icon.png'>
								</div>
							</div>
							<div class = 'MarkU'>
								<!--SubQuestion1-->
								<div class = 'GroupSubUQ1Type subUType'>
									<select class = 'Usort' id = 'Usort1'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion1 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ1Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ1Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ1Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ1Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ1Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ1Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ1Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ1Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '1'>確認</div>
									<div class = 'cancelU_btn' data-number = '1'>清除</div>
								</div>
								<!--subQuestion2-->
								<div class = 'GroupSubUQ2Type subUType'>
									<select class = 'Usort' id = 'Usort2'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion2 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ2Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ2Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ2Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ2Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ2Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ2Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ2Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ2Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '2'>確認</div>
									<div class = 'cancelU_btn' data-number = '2'>清除</div>
								</div>
								<!--SubQuestion3-->
								<div class = 'GroupSubUQ3Type subUType'>
									<select class = 'Usort' id = 'Usort3'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion3 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ3Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ3Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ3Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ3Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ3Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ3Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ3Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ3Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '3'>確認</div>
									<div class = 'cancelU_btn' data-number = '3'>清除</div>
								</div>
								<!--SubQuestion4-->
								<div class = 'GroupSubUQ4Type subUType'>
									<select class = 'Usort' id = 'Usort4'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion4 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ4Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ4Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ4Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ4Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ4Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ4Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ4Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ4Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '4'>確認</div>
									<div class = 'cancelU_btn' data-number = '4'>清除</div>
								</div>
								<!--SubQuestion5-->
								<div class = 'GroupSubUQ5Type subUType'>
									<select class = 'Usort' id = 'Usort5'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion5 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ5Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ5Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ5Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ5Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ5Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ5Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ5Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ5Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '5'>確認</div>
									<div class = 'cancelU_btn' data-number = '5'>清除</div>
								</div>
								<!--SubQuestion6-->
								<div class = 'GroupSubUQ6Type subUType'>
									<select class = 'Usort' id = 'Usort6'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion6 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ6Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ6Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ6Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ6Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ6Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ6Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ6Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ6Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '6'>確認</div>
									<div class = 'cancelU_btn' data-number = '6'>清除</div>
								</div>
								<!--SubQuestion7-->
								<div class = 'GroupSubUQ7Type subUType'>
									<select class = 'Usort' id = 'Usort7'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion7 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ7Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ7Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ7Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ7Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ7Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ7Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ7Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ7Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '7'>確認</div>
									<div class = 'cancelU_btn' data-number = '7'>清除</div>
								</div>
								<!--SubQuestion8-->
								<div class = 'GroupSubUQ8Type subUType'>
									<select class = 'Usort' id = 'Usort8'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion8 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ8Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ8Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ8Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ8Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ8Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ8Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ8Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ8Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '8'>確認</div>
									<div class = 'cancelU_btn' data-number = '8'>清除</div>
								</div>
								<!--SubQuestion9-->
								<div class = 'GroupSubUQ9Type subUType'>
									<select class = 'Usort' id = 'Usort9'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion9 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ9Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ9Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ9Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ9Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ9Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ9Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ9Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ9Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '9'>確認</div>
									<div class = 'cancelU_btn' data-number = '9'>清除</div>
								</div>
								<!--SubQuestion10-->
								<div class = 'GroupSubUQ10Type subUType'>
									<select class = 'Usort' id = 'Usort10'>
										<option value = '0' SELECTED>選擇題型式</option>
										<option value = '1'>是非題型式</option>
										<option value = '2'>簡答題型式</option>
									</select>
									<textarea class = 'GroupQId' disabled></textarea>
									<textarea class = 'subUQuestion10 subUQuestion'></textarea>
									<div class = 'subUQAnsText2'>答案1</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ10Ans1 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ10Ans1Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案2</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ10Ans2 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ10Ans2Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案3</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ10Ans3 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ10Ans3Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>
									<div class = 'subUQAnsText2'>答案4</div>
									<div class= 'subUQScoreText2'>分數</div>
									<input type = 'text' class = 'subUQ10Ans4 subUQAnsT2'></input>
									<select class = 'subUScore' id = 'subUQ10Ans4Score'>
										<option value = '0' SELECTED>0</option>
										<option value = '1'>1</option>
										<option value = '2'>2</option>
										<option value = '3'>3</option>
										<option value = '4'>4</option>
									</select>

									<div class = 'confirmU_btn' data-number = '10'>確認</div>
									<div class = 'cancelU_btn' data-number = '10'>清除</div>
								</div>
							</div>
							<div class = 'submitU2'>更新</div>
							<div class = 'deleteU'>刪除</div>
							<div class = 'GPPreview Preview_style GPUPreview '>預覽</div>

						</div>

					</div>
				</div>
				<div  class = 'exam-SAQuestion makeQuestion'>
					<div class = 'back'>+</div>
					<div class = 'exist MQuest'>
						<div class = 'new-SAQuestion'>
							<!-- + New TFQuestion -->
							+ 新增
						</div>
						<hr class = 'QuestionBase-hr'></hr>
						<div data-attr = '{{res.SAId}}' class = 'SAExist' ng-repeat = 'res in SA track by $index'>{{res.SAId + '. ' + res.SADetail}}</div>
					</div>
					<div class ='create MQuest'>
						<div class = 'SAPreviewBlock PreviewBlock PreviewBlock_style'>
							<div class = 'previewContent'></div>
							<div class = 'close'>關閉</div>
						</div>

						<div class = 'SA'>
							<div class = 'setImage'></div>
							<textarea class = 'SADetail'></textarea>
							<div class = 'submit'>送出</div>
							<div class = 'SAPreview Preview_style'>預覽</div>

						</div>

						<!--Update-->

						<div class = 'SAUpdate'>
							<div class = 'setImage'></div>

							<textarea class = 'SAId' disabled></textarea>
							<textarea class = 'SAUDetail'></textarea>
							<div class = 'update'>更新</div>
							<div class = 'delete'>刪除</div>
							<div class = 'SAPreview Preview_style SAUPreview '>預覽</div>

						</div>
					</div>
				</div>
		
				<div class = 'imageBox' data-setimglist="">
					<div class = 'imageContent'>
						<div class = 'imageBack'>+</div>
						<div class = 'uploadBox'>
							<div class = 'imageUploadMark'>
								<input name="giveMeTruth" type="file" id="giveMeTruth" class = 'imageFileUpload'></input>
							</div>
							<div class = 'imageHintText'>請點選圖片<br/>選擇上傳檔案</div>
							<input id="imageupload" type="button" value="上傳" class = 'imageupload'></input>
						</div>
						<div class = 'viewBox'>
							<div class = 'imageExist' data-attr = '{{image.imageID}}' id = '{{image.imageID}}' ng-repeat = 'image in IMG track by $index'>
								<img class = 'img' src = '{{image.imageURL}}' width = '100px' height = '100px'></img><br/><p>{{image.imageID}}</p>
							</div>
						</div>
						<div class = 'imageConfirm'>確認</div>
						<div class = 'imageDelete'>刪除</div>
						<div class = 'imageClear'>重選</div>
					</div>
				</div>
			</div>

			<div class = 'gradeMainContent'>
				<div class = 'content'>
					<div class = 'title'>試卷清單</div>
					<hr class = 'grade-hr'></hr>
					<div class = 'grade-detail'>
						<div class = 'paper-data' data-aid = '{{papergradelist.allocateID}}' data-id = '{{papergradelist.paperID}}' data-title = '{{papergradelist.PTitle}}' ng-repeat = 'papergradelist in papergradelist track by $index'>{{papergradelist.allocateID  + '. ' + papergradelist.PTitle + '(試卷ID:' + papergradelist.paperID + ')' }}
							<hr class = 'paper-data-hr'></hr></div>
					</div>

					<div class = 'paper-student-detail'>
						<div class = 'papertablecontent'>
								
						</div>
						<div class="papertabledetailed">
							
						</div>
						<div class = 'statusBar'>
							<!-- <img class = 'output' src = 'image/download.png' title="成績下載" width = '30px' height = '30px'/> -->
							<div class="output">總成績下載</div>
							<div class="output_detailed">詳細成績下載</div>
							<div class = 'closebtn'>關閉</div>
						</div>
						<div class = 'grade-content'>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>
<!-- framework -->
<script type="text/javascript" src="JS/framework/jquery.js"></script>

<!-- api -->
<script type="text/javascript" src="JS/API/ajaxfileupload.js"></script>
<script type="text/javascript" src="JS/API/jquery.table2excel.js"></script>
<script type="text/javascript" src="JS/API/jquery-ui-1.10.3.custom.js"></script>

<!-- framework -->
<script type="text/javascript" src="JS/framework/angular.js"></script>

<!-- definition -->
<script type="text/javascript" src="JS/ngrepeat.js"></script>
<script type="text/javascript" src="JS/allocatePaper.js"></script>
<script type="text/javascript" src="JS/allocateExist.js"></script>
<script type="text/javascript" src="JS/studentClass.js"></script>

<!-- box_area -->
<script type="text/javascript" src="JS/share.js"></script>
<script type="text/javascript" src="JS/paper.js"></script>
<script type="text/javascript" src="JS/image.js"></script>
<script type="text/javascript" src="JS/account.js"></script>
<script type="text/javascript" src="JS/markSA.js"></script>
<script type="text/javascript" src="JS/result.js"></script>
<script type="text/javascript" src="JS/exampreview.js"></script>

<!-- api -->
<script src="JS/API/multUpload/jquery.iframe-transport.js"></script>
<script src="JS/API/multUpload/jquery.fileupload.js"></script>
<script src="JS/API/multUpload/jquery.ui.widget.js"></script>



<script type="text/javascript">
$(document).ready(function() {

	$('#multFileupload').fileupload({
		// dataType: 'json',
		url: 'multUpload.php' ,
		method: 'POST' , 
		// formData:{
		// 	id: $('.ID_result').val()
		// } , 
		add: function (e, data) {
            $(".MUpload").click(function () {
                data.submit();
            });
        } ,
        done: function (e, data) {
        	// console.log(data);
        	// $.cookie("Guide" , 9);
			location.reload();
        }
	});


	var selectImageIndex = [];

	userPhoto();


	//phone
	// var phoneNow ='0' + '<?php echo $Aphone ;?>';
	// $('.account-now').find('.phone-now').val(phoneNow);


	// var content_height = $(window).height();
	var content_height = $(window).height();
	// console.log(content_height);
	content_height = content_height - 45;
	$('.container').find('.content').css('height' , content_height);

	//logout btn
	// $('.status_bar').find('.account-motion').toggle(function(){
	// 	$('.logout').css('opacity' , '1');
	// 	$('.logout').css('top' , 45 + 'px');

	// }, function() {
	// 	$('.logout').css('opacity' , 0);
	// 	$('.logout').css('top' , 0 + 'px');
	// });

	//home
	$('.title').click(function(){
		window.location.href = "Amain.php";
	});

	//admin logout
	$('.logout').click(function(){
		$.ajax({
			url: 'Alogout.php' , 
			type: 'POST' , 
			dataType: 'html' , 
			data:{
				A_id: "<?php echo $A_id ;?>" , 
				A_password: "<?php echo $A_password ;?>"
			} , 
			error:function(error){
				alert('error');
			} , 
			success:function(response){
				// alert('Logout');
				window.location.href = response;
			}
		});
	});




	//change page
	$('.account-data').click(function(){
		$('.account').css('display' , 'inline-block');
		$('.class').css('display' , 'none');
		$('.exam').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'none');
		$('.markSA').css('display' , 'none');
		$('.share').css('display' , 'none');
		$('.result').css('display' , 'none');
		$('.IMGManagerBox').css('display' , 'none');
		closeMakeQuestion();
	});

	$('.class-data').click(function(){
		$('.account').css('display' , 'none');
		$('.class').css('display' , 'inline-block');
		$('.class').find('.class-detail').css('display' , 'inline-block');
		$('.class').find('.student-detail').css('display' , 'none');
		$('.exam').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'none');
		$('.markSA').css('display' , 'none');
		$('.share').css('display' , 'none');
		$('.result').css('display' , 'none');
		$('.IMGManagerBox').css('display' , 'none');
		closeMakeQuestion();
	});

	$('.exam-warehouse').click(function(){
		$('.account').css('display' , 'none');
		$('.class').css('display' , 'none');
		$('.exam').css('display' , 'inline-block');
		$('.exam').find('.exam-allocate').css('display' , 'none');
		$('.exam').find('.exam-Paper').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'none');
		$('.markSA').css('display' , 'none');
		$('.share').css('display' , 'none');
		$('.result').css('display' , 'none');
		$('.IMGManagerBox').css('display' , 'none');
		closeMakeQuestion();
	});

	$('.paper-grade').click(function(){
		$('.account').css('display' , 'none');
		$('.class').css('display' , 'none');
		$('.exam').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'inline-block');
		$('.gradeMainContent').find('.grade-detail').css('display' , 'inline-block');
		$('.gradeMainContent').find('.paper-student-detail').css('display' , 'none');
		$('.markSA').css('display' , 'none');
		$('.share').css('display' , 'none');
		$('.result').css('display' , 'none');
		$('.IMGManagerBox').css('display' , 'none');
		closeMakeQuestion();
	});

	//file upload
	$('.upload-btn').click(function(){
		ajaxFileUploaded();
		userPhoto();
		
		location.reload();
	});

	function ajaxFileUploaded(){

	    $.ajaxFileUpload({
	        url:'doajaxfileupload1.php', 
	        type:'POST', 
	        secureuri:false,
	        fileElementId:'fileToUpload',
	        dataType:'json',
	        data:{
	        	A_id: "<?php echo $A_id;?>" , 
	        	A_photo_init: "<?php echo $Aphoto;?>" ,
	        	A_photo_url: "upload/" +  "<?php echo $Aphoto;?>" 
	        } , 
	        success: function (data, status){
	            if(typeof(data.error) != 'undefined'){
	                if(data.error != '')
	                {
	                    // alert(data.error);
	                }else
	                {
	                    // alert(data.msg );
	                }
	            }
	        },
	        error: function (data, status, e){
	            alert(e);
	        }
    	});
     
    	return false;
	 
	}

	//edit update
	$('.account').find('.update').click(function(){
		$.ajax({
			url: 'Adata_edit.php' , 
			type: 'POST' , 
			dataType: 'html' , 
			data:{
				A_id: "<?php echo $A_id ;?>" , 
				A_password: "<?php echo $A_password ;?>" , 
				Aname:$('.account-edit').find('.name-edit').val() , 
				Aphone:$('.account-edit').find('.phone-edit').val() , 
				Amail:$('.account-edit').find('.mail-edit').val() , 
				type:"update"
			} , 
			error:function(error){
				alert('error');
			} , 
			success:function(response){
				// alert('Update');

				if($('.account-edit').find('.name-edit').val() != ""){
					$('.account-now').find('.name-now').val($('.account-edit').find('.name-edit').val());
					$('.account-edit').find('.name-edit').val('');
				}

				if($('.account-edit').find('.phone-edit').val() != ""){
					$('.account-now').find('.phone-now').val($('.account-edit').find('.phone-edit').val());
					$('.account-edit').find('.phone-edit').val('');
				}

				if($('.account-edit').find('.mail-edit').val() != ""){
					$('.account-now').find('.mail-now').val($('.account-edit').find('.mail-edit').val());
					$('.account-edit').find('.mail-edit').val('');
				}
				// window.location.href = response;
			}
		});
	});




	//go to TFQuestion warehouse
	$('.exam').find('.TFQuestion').click(function(){
		// alert('go to TFQuestion warehouse');
		newQuestion(0);
	});

	//go to update TFQuestion warehouse

	//go to Choice Question waregouse
	$('.exam').find('.ChoiceQuestion').click(function(){
		// alert('go to ChoiceQuestion warehouse');
		newQuestion(1);
	});

	//go to GroupQuestion
	$('.exam').find('.GroupQuestion').click(function(){
		// alert('go to Group Question');
		newQuestion(2);
	});

	//go to Short Answer Question
	$('.exam').find('.SAQuestion').click(function(){
		// alert('go to Short Answer Question');
		newQuestion(3);
	});

	//close make question
	$('.exam').find('.makeQuestion').find('.back').click(function(){
		closeMakeQuestion();
	});

	//upload image btn
	$('.exam').find('.imageBox .uploadBox .imageupload').click(function(){
		imageAjaxUpload();
		//reOpen();
	});

	//image upload
	function imageAjaxUpload(){
		var f = document.getElementById("giveMeTruth");
		console.log(f.files[0]);
		var teacherID = $('.container').find('.account-data .account-name').attr('data-id');
		$.ajaxFileUpload({
	        url:'doajaxfileupload.php', 
	        type:'POST', 
	        secureuri:false,
	        fileElementId:'giveMeTruth',
	        dataType:'json',
	        data:{
	        	teacherID: teacherID
	        } , 
	        success: function (data, status){
	            if(typeof(data.error) != 'undefined'){
	                if(data.error != '')
	                {
	                    // alert(data.error);
	                }else
	                {
	                    // alert(data.msg );
	                }
	            }

	            //上傳後自動更新
	            $.ajax({
	            	url: 'image.php' ,
	            	type: 'GET' ,
	            	dataType: 'json' ,
	            	error: function(err) {
	            		alert(err);
	            		console.log(err);
	            	} , success: function(res) {
	            		var $scope = angular.element($('body')).scope();
						$scope.$apply(function() {
							$scope.IMG = res;
						});
	            	}
	            })
	        },
	        error: function (data, status, e){
	            alert(e);
	        }
    	});
     	
     	$(document).ajaxComplete(function(){
     		window.location.href = "Amain.php";
     	});
    	return false;
	}



// ----------------------------------
// 			image button
// -----------------------------------



		//TF create go to setimage
	$('.exam').find('.exam-TFQuestion .create .TF .setImage').click(function(){
		createGoImageBox("TF");
	});

	//TF Update go to setimage
	$('.exam').find('.exam-TFQuestion .create .TFUpdate .setImage').click(function(){
		createGoUpdateImageBox("TFUpdate");
	});

	//Choice create go to setimage
	$('.exam').find('.exam-ChoiceQuestion .create .Choice .setImage').click(function(){
		createGoImageBox("Choice");
	});

	//Choice Update go to setimage
	$('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .setImage').click(function(){
		createGoUpdateImageBox("ChoiceUpdate");
	});

	//Group create go to setimage
	$('.exam').find('.exam-GroupQuestion .create .Group .setImage').click(function(){
		createGoImageBox("Group");
	});

	//Group Update go to setimage
	$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .setImage').click(function(){
		createGoUpdateImageBox("GroupUpdate");
	});

	//Group create go to setimage
	$('.exam').find('.exam-SAQuestion .create .SA .setImage').click(function(){
		createGoImageBox("SA");
	});

	//Group Update go to setimage
	$('.exam').find('.exam-SAQuestion .create .SAUpdate .setImage').click(function(){
		createGoUpdateImageBox("SAUpdate");
	});












	// ----------------------------------------------------
	//			True & False Question Base area
	// 					JUMPING
	// -----------------------------------------------------

	//add new TF Question
	$('.exam').find('.exam-TFQuestion').find('.new-TFQuestion').click(function(){
		newTFQuestion();
		imageInit();
	});

	//submit the True & False Question to tfquestionbase
	$('.exam').find('.exam-TFQuestion').find('.create').find('.submit').click(function(){
		var checkTFDetail ;
		var checkTAns ;
		var checkFAns ;
		//check question
		if ($('.exam').find('.exam-TFQuestion').find('.create').find('.TFDetail').val() != "") {
			checkTFDetail = true;
		}else {
			checkTFDetail = false;
			console.log('True & False Detail is null .');
		}

		if ($('.exam').find('.exam-TFQuestion').find('.create').find('.TAns').val() != "") {
			checkTAns = true;
		}else {
			checkTAns = false;
			console.log('True & False TAnswer is null .');
		}

		if ($('.exam').find('.exam-TFQuestion').find('.create').find('.FAns').val() != "") {
			checkFAns = true;
		}else {
			checkFAns = false;
			console.log('True & False FAnswer is null .');
		}


		if (checkTFDetail && checkTAns && checkFAns) {

			var TF1Score = getScore("TFAns1S");
			var TF2Score = getScore("TFAns2S");
			var Aid = $('.container').find('.account-data .account-name').attr('data-id');

			//let TFQuestion content store to database with ajax
			$.ajax({
				url: 'QuestionBase.php' ,
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					Aid: Aid ,
					TFDetail: $('.exam').find('.exam-TFQuestion').find('.create').find('.TFDetail').val() , 
					TContent: $('.exam').find('.exam-TFQuestion').find('.create').find('.TAns').val() , 
					TScore: TF1Score ,
					FContent: $('.exam').find('.exam-TFQuestion').find('.create').find('.FAns').val() , 
					FScore: TF2Score ,
					imageArray: selectImageIndex ,
					QType: 'TFQuestion'
				} , 
				error:function(error){
					// alert('error');
					console.log(error);
				} , 
				success:function(response){
					// console.log(response);
				}
			});
		}
		else{
			alert('請完整填入資料。');
		}

		$(document).ajaxComplete(function(){
			//close add new TFQuestion View
			$('.exam').find('.exam-TFQuestion').find('.create').find('.TF').css('display' , 'none');
			TFInit();
			imageInit();
			window.location.href = 'Amain.php';
		});

	});

	//click existed question to edit (update) 
	$('.TFExist').live('click' , function() {
		imageInit();
		var id = $(this).attr('data-attr');
		// console.log(id);
		$.ajax({
			url: 'QuestionExist.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				TFId: id , 
				Type: 'TFQuestion'
			} , 
			error:function(error) {
				// alert(error);
				console.log(error);
			} , 
			success:function(response) {
				// console.log(response);
				updateTFQuestion();
				imageInit();
				// console.log(response[0]['IMG0'][0]);

				var responseLength = 0;

				//get response object length
				for(var k in response[0]) {
 				  responseLength++;
				}

				for (var i = 0; i < response.length; i++) {
					$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFId').val(response[i].TFId);
					$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFUDetail').val(response[i].TFDetail);
					$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TUAns').val(response[i].TContent);
					$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.FUAns').val(response[i].FContent);
					SetScore("TFUAns1S" , response[i].TScore);
					SetScore("TFUAns2S" , response[i].FScore);
					for (var j = 0; j < (responseLength - 8); j++) {
						$('.exam').find('.imageBox .viewBox #' + response[i]['IMG' + j][0]).css('border' , '3px solid rgb(90,200,90)');
						selectImageIndex.push(response[i]['IMG' + j][0]);
					};
				}
				$('.imageBox').attr("data-setimglist",selectImageIndex);

			}
		});
	});

	//click to update TF Question
	$('.exam').find('.exam-TFQuestion .create .TFUpdate .update').click(function() {
		var checkTFUDetail ;
		var checkTUAns ;
		var checkFUAns ;
		//check question
		if ($('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFUDetail').val() != "") {
			checkTFUDetail = true;
		}else {
			checkTFUDetail = false;
			console.log('True & False Detail is null .');
		}

		if ($('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TUAns').val() != "") {
			checkTUAns = true;
		}else {
			checkTUAns = false;
			console.log('True & False TAnswer is null .');
		}

		if ($('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.FUAns').val() != "") {
			checkFUAns = true;
		}else {
			checkFUAns = false;
			console.log('True & False FAnswer is null .');
		}


		if (checkTFUDetail && checkTUAns && checkFUAns) {

			var TFU1Score = getScore("TFUAns1S");
			var TFU2Score = getScore("TFUAns2S");

			//let TFQuestion content store to database with ajax
			console.log(selectImageIndex);
			$.ajax({
				url: 'QuestionUpdate.php' ,
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					TFId: $('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFId').val() ,
					TFUDetail: $('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFUDetail').val() , 
					TUContent: $('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TUAns').val() , 
					TUScore: TFU1Score ,
					FUContent: $('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.FUAns').val() , 
					FUScore: TFU2Score ,
					imageArray: selectImageIndex ,
					QType: 'TFUQuestion'
				} , 
				error:function(error){
					// alert('error');
					console.log(error);
				} , 
				success:function(response){
					console.log(response);

					if (response > 0) {
						alert('此題目已被作答，無法更新。')
					}else{
						window.location.href = 'Amain.php';
					}
				}
			});
		}
		else{
			alert('請完整填入資料。');
		}

		// $(document).ajaxComplete(function(){
		// 	//close update TFQuestion View
		// 	alert('Update success');
		// 	$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').css('display' , 'none');
		// 	TFInit();
		// 	imageInit();
		// 	window.location.href = 'Amain.php';
		// });
	});

	//click to delete TF Question
	$('.exam').find('.exam-TFQuestion .create .TFUpdate .delete').click(function() {
		var TFDCheck = confirm("請再次確認是否刪除此題目");

		if (TFDCheck == true){
			//Delete TF Question from database with ajax
			$.ajax({
				url: 'QuestionDelete.php' ,
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					TFId: $('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFId').val() ,
					TFUDetail: $('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFUDetail').val() , 
					QType: 'TFDQuestion'
				} , 
				error:function(error){
					// alert('error');
					console.log(error);
				} , 
				success:function(response){
					// console.log(response);

					if (response > 0) {
						alert('此題目已被作答，無法刪除。')
					}else{
						window.location.href = 'Amain.php';
					}
				}
			});
		}
		else{

		}

		// $(document).ajaxComplete(function(){
		// 	//close update TFQuestion View
		// 	alert('Delete success');
		// 	$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').css('display' , 'none');
		// 	TFInit();
		// 	imageInit();
		// 	window.location.href = 'Amain.php';
		// });
	});







	// -----------------------------------------------------------------
	// 				Choice Question area
	// 					JUMPING
	// -----------------------------------------------------------------


	//add new Choice Question
	$('.exam').find('.exam-ChoiceQuestion').find('.new-ChoiceQuestion').click(function(){
		newChoiceQuestion();
		imageInit();
	});

	//Submit Choice Question

	$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.submit').click(function(){
		var checkChoiceDetail ;
		var checkC1Ans ;
		var checkC2Ans ;
		var checkC3Ans ;
		var checkC4Ans ;

		//check question
		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceDetail').val() != "") {
			checkChoiceDetail = true;
		}else {
			checkChoiceDetail = false;
			console.log('ChoiceQuestion Detail is null .');
		}

		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C1Ans').val() != "") {
			checkC1Ans = true;
		}else {
			checkC1Ans = false;
			console.log('ChoiceQuestion C1Answer is null .');
		}

		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C2Ans').val() != "") {
			checkC2Ans = true;
		}else {
			checkC2Ans = false;
			console.log('ChoiceQuestion C2Answer is null .');
		}

		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C3Ans').val() != "") {
			checkC3Ans = true;
		}else {
			checkC3Ans = false;
			console.log('ChoiceQuestion C3Answer is null .');
		}

		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C4Ans').val() != "") {
			checkC4Ans = true;
		}else {
			checkC4Ans = false;
			console.log('ChoiceQuestion C4Answer is null .');
		}

		//get Score

		var C1Score = getScore("ChAns1S");
		var C2Score = getScore("ChAns2S");
		var C3Score = getScore("ChAns3S");
		var C4Score = getScore("ChAns4S");

		if (checkChoiceDetail && checkC1Ans && checkC2Ans && checkC3Ans && checkC4Ans){
			//ajax to update database

			var Aid = $('.container').find('.account-data .account-name').attr('data-id');

			$.ajax({
				url: 'QuestionBase.php' , 
				type: 'POSt' , 
				dataType: 'html' , 
				data:{
					Aid: Aid , 
					ChoiceDetail:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceDetail').val() , 
					C1Ans:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C1Ans').val() , 
					C2Ans:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C2Ans').val() , 
					C3Ans:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C3Ans').val() , 
					C4Ans:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C4Ans').val() , 
					C1Score: C1Score , 
					C2Score: C2Score ,
					C3Score: C3Score ,
					C4Score: C4Score ,
					imageArray: selectImageIndex , 
					QType: 'ChoiceQuestion'
				} , 
				error:function(error){
					// alert(error);
					console.log(error);
				} , 
				success:function(response){
					// alert('sucess');
					// console.log(response);
				}
			});
		}
		else{
			alert('請完整填入資料。');
		}

		$(document).ajaxComplete(function(){
			//close add new ChoiceQuestion View
			$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.Choice').css('display' , 'none');
			CHInit();
			imageInit();
			window.location.href = 'Amain.php';
		});
	});


	//click existed question to edit (update)
	$('.ChExist').live('click' , function() {
		var id = $(this).attr('data-attr');
		// console.log(id);
		$.ajax({
			url: 'QuestionExist.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				ChId: id , 
				Type: 'ChQuestion'
			} , 
			error:function(error) {
				// alert(error);
				console.log(error);
			} , 
			success:function(response) {
				// console.log(response);
				updateCHQuestion();
				imageInit();

				var responseLength = 0;

				//get response object length
				for(var k in response[0]) {
 				  responseLength++;
				}

				for (var i = 0; i < response.length; i++) {
					$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.CHId').val(response[i].ChId);
					$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.ChoiceUDetail').val(response[i].ChDetail);
					$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C1UAns').val(response[i].ChAns1Content);
					$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C2UAns').val(response[i].ChAns2Content);
					$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C3UAns').val(response[i].ChAns3Content);
					$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C4UAns').val(response[i].ChAns4Content);
					SetScore("ChUAns1S" , response[i].ChAns1Score);
					SetScore("ChUAns2S" , response[i].ChAns2Score);
					SetScore("ChUAns3S" , response[i].ChAns3Score);
					SetScore("ChUAns4S" , response[i].ChAns4Score);

					for (var j = 0; j < (responseLength - 12); j++) {
						$('.exam').find('.imageBox .viewBox #' + response[i]['IMG' + j][0]).css('border' , '3px solid rgb(90,200,90)');
						selectImageIndex.push(response[i]['IMG' + j][0]);
					};
					$('.imageBox').attr("data-setimglist",selectImageIndex);
				}
			}
		});
	});

	//click to update Choise Question
	$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.update').click(function(){
		var checkChoiceUDetail ;
		var checkC1UAns ;
		var checkC2UAns ;
		var checkC3UAns ;
		var checkC4UAns ;

		//check question
		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.ChoiceUDetail').val() != "") {
			checkChoiceUDetail = true;
		}else {
			checkChoiceUDetail = false;
			console.log('ChoiceQuestion Detail is null .');
		}

		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C1UAns').val() != "") {
			checkC1UAns = true;
		}else {
			checkC1UAns = false;
			console.log('ChoiceQuestion C1Answer is null .');
		}

		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C2UAns').val() != "") {
			checkC2UAns = true;
		}else {
			checkC2UAns = false;
			console.log('ChoiceQuestion C2UAnswer is null .');
		}

		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C3UAns').val() != "") {
			checkC3UAns = true;
		}else {
			checkC3UAns = false;
			console.log('ChoiceQuestion C3UAnswer is null .');
		}

		if ($('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C4UAns').val() != "") {
			checkC4UAns = true;
		}else {
			checkC4UAns = false;
			console.log('ChoiceQuestion C4Answer is null .');
		}

		//get Score

		var C1UScore = getScore("ChUAns1S");
		var C2UScore = getScore("ChUAns2S");
		var C3UScore = getScore("ChUAns3S");
		var C4UScore = getScore("ChUAns4S");

		if (checkChoiceUDetail && checkC1UAns && checkC2UAns && checkC3UAns && checkC4UAns){
			//ajax to update database
			$.ajax({
				url: 'QuestionUpdate.php' , 
				type: 'POSt' , 
				dataType: 'html' , 
				data:{
					CHId:$('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .CHId').val() , 
					ChoiceUDetail:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.ChoiceUDetail').val() , 
					C1UAns:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C1UAns').val() , 
					C2UAns:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C2UAns').val() , 
					C3UAns:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C3UAns').val() , 
					C4UAns:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C4UAns').val() , 
					C1UScore: C1UScore , 
					C2UScore: C2UScore ,
					C3UScore: C3UScore ,
					C4UScore: C4UScore ,
					imageArray: selectImageIndex ,
					QType: 'ChoiceUQuestion'
				} , 
				error:function(error){
					// alert(error);
					console.log(error);
				} , 
				success:function(response){
					// console.log(response);

					if (response > 0) {
						alert('此題目已被作答，無法更新。')
					}else{
						window.location.href = 'Amain.php';
					}
				}
			});
		}
		else{
			alert('請完整填入資料。');
		}

		// $(document).ajaxComplete(function(){
		// 	//close add new ChoiceQuestion View
		// 	$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').css('display' , 'none');
		// 	CHInit();
		// 	imageInit();
		// 	window.location.href = 'Amain.php';
		// });
	});

	//click to delete choice question
	$('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .delete').click(function(){
		var ChDCheck = confirm('請再次確認是否刪除此試題');

		if(ChDCheck == true) {
			$.ajax({
				url: 'QuestionDelete.php' , 
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					CHId: $('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .CHId').val() , 
					ChoiceUDetail:$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.ChoiceUDetail').val() , 
					QType: 'ChoiceDQuestion'
				} , 
				error:function(err){
					// alert(err);
					console.log(error);
				} , 
				success:function(response){
					if (response > 0) {
						alert('此題目已被作答，無法刪除。')
					}else{
						window.location.href = 'Amain.php';
					}
				}
			});
		}
		else{

		}

		// $(document).ajaxComplete(function(){
		// 	//close add new ChoiceQuestion View
		// 	$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').css('display' , 'none');
		// 	CHInit();
		// 	imageInit();
		// 	window.location.href = 'Amain.php';
		// });
	});

	
	
	// ------------------------------------------
	//				Group Question area
	// 					JUMPING
	// -------------------------------------
	//add new group question
	$('.exam').find('.exam-GroupQuestion .new-GroupQuestion').click(function(){
		newGroupQuestion();
		imageInit();
	});


	//go to Set Group subQuestion
	checkimg_init();

	$('.exam').find('.exam-GroupQuestion').find('.create .Group').find('.GoSet').click(function(){
		var number = $(this).attr('data-number');
		$('.exam').find('.exam-GroupQuestion .create .Group .Mark').css('display' , 'block');
		$('.GroupSubQ' + number + 'Type').css('display' , 'block');
	}); 

	//Clear btn
	$('.exam').find('.exam-GroupQuestion .create .Group .Mark .cancel_btn').click(function(){

		var confirmIndex = $(this).attr('data-number');

		if (checkGroupSQ($(this) , confirmIndex)){		
			//check clear or not
			var checkclear = confirm('請確認是否清除題目');

			if(checkclear == true){

				$('.exam').find('.exam-GroupQuestion .create .Group .Mark').css('display' , 'none');
				$('.exam').find('.exam-GroupQuestion .create .Group .Mark .subType').css('display' , 'none');

				var cancelIndex = $(this).attr('data-number');
				// console.log(cancelIndex);

				//init subQuestion text value
				$(this).closest('.Mark').find('.subQuestion' + cancelIndex).val('');
				$(this).closest('.Mark').find('.subQ' + cancelIndex + 'Ans1').val('');
				$(this).closest('.Mark').find('.subQ' + cancelIndex + 'Ans2').val('');
				$(this).closest('.Mark').find('.subQ' + cancelIndex + 'Ans3').val('');
				$(this).closest('.Mark').find('.subQ' + cancelIndex + 'Ans4').val('');
				//init subQuestion select value
				$(this).closest('.Mark').find('.GroupSubQ' + cancelIndex + 'Type').find('.subScore').val(0);
				//init sort select value
				$(this).closest('.Mark').find('.GroupSubQ' + cancelIndex + 'Type').find('.sort').val(0);
				//hide img
				$('.exam').find('.exam-GroupQuestion .Group .img' + cancelIndex).css('display' , 'none');
				imageInit();
			}
			else{

			}
		}
		else {
			$('.exam').find('.exam-GroupQuestion .create .Group .Mark').css('display' , 'none');
				$('.exam').find('.exam-GroupQuestion .create .Group .Mark .subType').css('display' , 'none');

				var cancelIndex = $(this).attr('data-number');
				// console.log(cancelIndex);

				//init subQuestion text value
				$(this).closest('.Mark').find('.subQuestion' + cancelIndex).val('');
				$(this).closest('.Mark').find('.subQ' + cancelIndex + 'Ans1').val('');
				$(this).closest('.Mark').find('.subQ' + cancelIndex + 'Ans2').val('');
				$(this).closest('.Mark').find('.subQ' + cancelIndex + 'Ans3').val('');
				$(this).closest('.Mark').find('.subQ' + cancelIndex + 'Ans4').val('');
				//init subQuestion select value
				$(this).closest('.Mark').find('.GroupSubQ' + cancelIndex + 'Type').find('.subScore').val(0);
				//init sort select value
				$(this).closest('.Mark').find('.GroupSubQ' + cancelIndex + 'Type').find('.sort').val(0);
				//hide img
				$('.exam').find('.exam-GroupQuestion .Group .img' + cancelIndex).css('display' , 'none');
				imageInit();
		}



	});

	//Confirm btn
	$('.exam').find('.exam-GroupQuestion .Group .Mark .confirm_btn').click(function(){

		var confirmIndex = $(this).attr('data-number');

		if (checkGroupSQ($(this) , confirmIndex)) {
			$('.exam').find('.exam-GroupQuestion .create .Group .Mark').css('display' , 'none');
			$('.GroupSubQ' + confirmIndex + 'Type').css('display' , 'none');
			//show check img
			$('.exam').find('.exam-GroupQuestion .Group .img' + confirmIndex).css('display' , 'block');
		}
		else{
			alert('請輸入資料');
		}

	});

	//Group Submit
	$('.exam').find('.exam-GroupQuestion .create .Group .submit2').click(function(){
		var checkGroupDetail = $('.exam').find('.exam-GroupQuestion .Group .GroupDetail').val();
		var checkGroupQest = $('.exam').find('.exam-GroupQuestion .Group .checkvalimg').css('display');

		if (checkGroupDetail != '' && checkGroupQest == 'block') {

			var GQ1A1Score , GQ1A2Score , GQ1A3Score , GQ1A4Score , GQ2A1Score , GQ2A2Score , GQ2A3Score , GQ2A4Score , GQ3A1Score , GQ3A2Score , GQ3A3Score , GQ3A4Score , GQ4A1Score , GQ4A2Score , GQ4A3Score , GQ4A4Score,GQ5A1Score , GQ5A2Score , GQ5A3Score , GQ5A4Score,GQ6A1Score , GQ6A2Score , GQ6A3Score , GQ6A4Score , GQ7A1Score , GQ7A2Score , GQ7A3Score , GQ7A4Score , GQ8A1Score , GQ8A2Score , GQ8A3Score , GQ8A4Score , GQ9A1Score , GQ9A2Score , GQ9A3Score , GQ9A4Score , GQ10A1Score , GQ10A2Score , GQ10A3Score , GQ10A4Score;
			for (var i = 1; i < 11; i++) {
				for (var j = 1; j < 5; j++) {
					var temp = getScore("subQ" + i + "Ans" + j + "Score");
					eval('GQ' + i + 'A' + j + 'Score=' + temp);
					// console.log(temp);
				}
			}

			var sort1 , sort2 , sort3 , sort4 , sort5 , sort6 , sort7 , sort8 , sort9 , sort10;
			for (var s = 1; s < 11; s++) {
				var temp = getSort("sort" + s);
				eval("sort" + s + "=" + temp);
			}

			var Aid = $('.container').find('.account-data .account-name').attr('data-id');

				$.ajax({
					url: 'QuestionBase.php' , 
					type: 'POST' , 
					dataType: 'html' , 
					data:{
						Aid: Aid ,
						GroupTitle:$('.exam').find('.exam-GroupQuestion .Group .GroupDetail').val() , 
						GroupSubQ1Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion1').val() , 
						GroupSubQ1A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ1Ans1').val() , 
						GQ1A1Score: GQ1A1Score , 
						GroupSubQ1A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ1Ans2').val() , 
						GQ1A2Score: GQ1A2Score , 
						GroupSubQ1A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ1Ans3').val() , 
						GQ1A3Score: GQ1A3Score , 
						GroupSubQ1A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ1Ans4').val() , 
						GQ1A4Score: GQ1A4Score ,
						GroupSubQ2Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion2').val() , 
						GroupSubQ2A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ2Ans1').val() , 
						GQ2A1Score: GQ2A1Score , 
						GroupSubQ2A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ2Ans2').val() , 
						GQ2A2Score: GQ2A2Score , 
						GroupSubQ2A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ2Ans3').val() , 
						GQ2A3Score: GQ2A3Score , 
						GroupSubQ2A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ2Ans4').val() , 
						GQ2A4Score: GQ2A4Score , 
						GroupSubQ3Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion3').val() , 
						GroupSubQ3A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ3Ans1').val() , 
						GQ3A1Score: GQ3A1Score , 
						GroupSubQ3A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ3Ans2').val() , 
						GQ3A2Score: GQ3A2Score , 
						GroupSubQ3A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ3Ans3').val() , 
						GQ3A3Score: GQ3A3Score , 
						GroupSubQ3A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ3Ans4').val() , 
						GQ3A4Score: GQ3A4Score ,
						GroupSubQ4Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion4').val() , 
						GroupSubQ4A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ4Ans1').val() , 
						GQ4A1Score: GQ4A1Score , 
						GroupSubQ4A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ4Ans2').val() , 
						GQ4A2Score: GQ4A2Score , 
						GroupSubQ4A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ4Ans3').val() , 
						GQ4A3Score: GQ4A3Score , 
						GroupSubQ4A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ4Ans4').val() , 
						GQ4A4Score: GQ4A4Score , 
						GroupSubQ5Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion5').val() , 
						GroupSubQ5A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ5Ans1').val() , 
						GQ5A1Score: GQ5A1Score , 
						GroupSubQ5A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ5Ans2').val() , 
						GQ5A2Score: GQ5A2Score , 
						GroupSubQ5A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ5Ans3').val() , 
						GQ5A3Score: GQ5A3Score , 
						GroupSubQ5A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ5Ans4').val() , 
						GQ5A4Score: GQ5A4Score , 
						GroupSubQ6Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion6').val() , 
						GroupSubQ6A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ6Ans1').val() , 
						GQ6A1Score: GQ6A1Score , 
						GroupSubQ6A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ6Ans2').val() , 
						GQ6A2Score: GQ6A2Score , 
						GroupSubQ6A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ6Ans3').val() , 
						GQ6A3Score: GQ6A3Score , 
						GroupSubQ6A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ6Ans4').val() , 
						GQ6A4Score: GQ6A4Score , 
						GroupSubQ7Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion7').val() , 
						GroupSubQ7A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ7Ans1').val() , 
						GQ7A1Score: GQ7A1Score , 
						GroupSubQ7A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ7Ans2').val() , 
						GQ7A2Score: GQ7A2Score , 
						GroupSubQ7A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ7Ans3').val() , 
						GQ7A3Score: GQ7A3Score , 
						GroupSubQ7A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ7Ans4').val() , 
						GQ7A4Score: GQ7A4Score , 
						GroupSubQ8Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion8').val() , 
						GroupSubQ8A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ8Ans1').val() , 
						GQ8A1Score: GQ8A1Score , 
						GroupSubQ8A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ8Ans2').val() , 
						GQ8A2Score: GQ8A2Score , 
						GroupSubQ8A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ8Ans3').val() , 
						GQ8A3Score: GQ8A3Score , 
						GroupSubQ8A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ8Ans4').val() , 
						GQ8A4Score: GQ8A4Score , 
						GroupSubQ9Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion9').val() , 
						GroupSubQ9A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ9Ans1').val() , 
						GQ9A1Score: GQ9A1Score , 
						GroupSubQ9A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ9Ans2').val() , 
						GQ9A2Score: GQ9A2Score , 
						GroupSubQ9A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ9Ans3').val() , 
						GQ9A3Score: GQ9A3Score , 
						GroupSubQ9A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ9Ans4').val() , 
						GQ9A4Score: GQ9A4Score , 
						GroupSubQ10Title:$('.exam').find('.exam-GroupQuestion .Group .subQuestion10').val() , 
						GroupSubQ10A1Content:$('.exam').find('.exam-GroupQuestion .Group .subQ10Ans1').val() , 
						GQ10A1Score: GQ10A1Score , 
						GroupSubQ10A2Content:$('.exam').find('.exam-GroupQuestion .Group .subQ10Ans2').val() , 
						GQ10A2Score: GQ10A2Score , 
						GroupSubQ10A3Content:$('.exam').find('.exam-GroupQuestion .Group .subQ10Ans3').val() , 
						GQ10A3Score: GQ10A3Score , 
						GroupSubQ10A4Content:$('.exam').find('.exam-GroupQuestion .Group .subQ10Ans4').val() , 
						GQ10A4Score: GQ10A4Score , 
						sort1: sort1 , 
						sort2: sort2 , 
						sort3: sort3 , 
						sort4: sort4 , 
						sort5: sort5 , 
						sort6: sort6 , 
						sort7: sort7 , 
						sort8: sort8 , 
						sort9: sort9 , 
						sort10: sort10 , 
						imageArray: selectImageIndex ,
						QType:'Group'
					} , 
					error:function(error){
						// alert(error);
						console.log(error);
					} , 
					success:function(response){
						// console.log(response);
						// alert('sucess');
					}
				});
			}
			else {
				alert('請填入標題及至少一個子題。');
			}

			$(document).ajaxComplete(function(){
				//close add new GroupQuestion View
				$('.exam').find('.exam-GroupQuestion').find('.create').find('.Group').css('display' , 'none');
				window.location.href = 'Amain.php';
				GroupInit();
				imageInit();
			});
		});

	//click existed question to edit (update)
	$('.GroupExist').live('click' , function() {
		var id = $(this).attr('data-attr');
		// console.log(id);
		$.ajax({
			url: 'QuestionExist.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				GpId: id , 
				Type: 'GpQuestion'
			} , 
			error:function(error) {
				// alert(error);
				console.log(error);
			} , 
			success:function(response) {
				// console.log(response);
				GroupInit();
				imageInit();
				updateGPQuestion();

				var responseLength = 0;
				var imgarraylength = 0;
				var s = 0;

				//get response object length
				for(var k in response[0]) {
 				  responseLength++;
				}

				for(var c in response[0]['IMGID'][0]) {
					imgarraylength++;
				}
				
				for (var i = 0; i < response.length; i++) {

					$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .GroupId').val(response[i]['GroupID']);
					$('.exam').find('.exam-GroupQuestion').find('.create').find('.GroupUpdate').find('.GroupUDetail').val(response[i]['GroupTitle']);

					//set check img icon
					for (var imgindex = 0; imgindex < (responseLength-5); imgindex++) {
						
						if (response[i][imgindex].GroupQContent != '') {
							$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .img' + (imgindex+1)).css('display' , 'block');
						}

					}

					//set sub question content
					for (var subindex = 0; subindex < (responseLength-5); subindex++) {
						s += 1;

						$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .GroupSubUQ' + s + 'Type').find('.GroupQId').val(response[i][subindex].GroupQID);//subindex
						$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .GroupSubUQ' + s + 'Type').find('.subUQuestion' + s).val(response[i][subindex].GroupQContent);
						SetScore("Usort" + s , response[i][subindex].sort);

						// set sub Q Ans 
						for (var subAnsIndex = 1; subAnsIndex < 5; subAnsIndex++) {
							
							switch(subAnsIndex){
								case 1:
									$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .GroupSubUQ' + s + 'Type .subUQ' + s + 'Ans' + subAnsIndex).val(response[i][subindex]['GroupA1Content']);
									SetScore("subUQ" + s + "Ans" + subAnsIndex + "Score" , response[i][subindex]['GroupA1Score']);
									break;

								case 2:
									$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .GroupSubUQ' + s + 'Type .subUQ' + s + 'Ans' + subAnsIndex).val(response[i][subindex]['GroupA2Content']);
									SetScore("subUQ" + s + "Ans" + subAnsIndex + "Score" , response[i][subindex]['GroupA2Score']);
									break;

								case 3:
									$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .GroupSubUQ' + s + 'Type .subUQ' + s + 'Ans' + subAnsIndex).val(response[i][subindex]['GroupA3Content']);
									SetScore("subUQ" + s + "Ans" + subAnsIndex + "Score" , response[i][subindex]['GroupA3Score']);
									break;

								case 4:
									$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .GroupSubUQ' + s + 'Type .subUQ' + s + 'Ans' + subAnsIndex).val(response[i][subindex]['GroupA4Content']);
									SetScore("subUQ" + s + "Ans" + subAnsIndex + "Score" , response[i][subindex]['GroupA4Score']);
									break;
							}
						}
					}

					//image Box
					for (var imgIndex = 0; imgIndex < imgarraylength; imgIndex++){
						$('.exam').find('.imageBox .viewBox #' + response[i]['IMGID'][i]['IMG' + imgIndex]).css('border' , '3px solid rgb(90,200,90)');
						var imgid = response[i]['IMGID'][i]['IMG' + imgIndex].pop();
						selectImageIndex.push(imgid);
					}
					$('.imageBox').attr("data-setimglist",selectImageIndex);
				}
			}
		});
	});


	//click to update goset block
	$('.exam').find('.exam-GroupQuestion').find('.create .GroupUpdate').find('.GoUSet').click(function(){

		for (var i = 1; i < 11; i++) {
			$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .GroupSubUQ' + i + 'Type').css('display' , 'none');
		};

		var number = $(this).attr('data-number');
		$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU').css('display' , 'block');
		$('.GroupSubUQ' + number + 'Type').css('display' , 'block');
	}); 

	//update Clear btn
	$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .cancelU_btn').click(function(){

		var confirmIndex = $(this).attr('data-number');

		if (checkGroupSUQ($(this) , confirmIndex)) {
			var checkclear2 = confirm('請確認是否清除題目');

			if(checkclear2 == true){

				$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU').css('display' , 'none');
				$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .subUType').css('display' , 'none');

				var cancelIndex = $(this).attr('data-number');
				// console.log(cancelIndex);

				//init subQuestion text value
				$(this).closest('.MarkU').find('.subUQuestion' + cancelIndex).val('');
				$(this).closest('.MarkU').find('.subUQ' + cancelIndex + 'Ans1').val('');
				$(this).closest('.MarkU').find('.subUQ' + cancelIndex + 'Ans2').val('');
				$(this).closest('.MarkU').find('.subUQ' + cancelIndex + 'Ans3').val('');
				$(this).closest('.MarkU').find('.subUQ' + cancelIndex + 'Ans4').val('');
				//init subQuestion select value
				$(this).closest('.MarkU').find('.GroupSubUQ' + cancelIndex + 'Type').find('.subUScore').val(0);
				//init sort select value
				$(this).closest('.MarkU').find('.GroupSubUQ' + cancelIndex + 'Type').find('.Usort').val(0);
				//hide img
				$('.exam').find('.exam-GroupQuestion .GroupUpdate .img' + cancelIndex).css('display' , 'none');

			}
			else{

			}
		}
		else {
			$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU').css('display' , 'none');
			$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU .subUType').css('display' , 'none');

			var cancelIndex = $(this).attr('data-number');
			// console.log(cancelIndex);

			//init subQuestion text value
			$(this).closest('.MarkU').find('.subUQuestion' + cancelIndex).val('');
			$(this).closest('.MarkU').find('.subUQ' + cancelIndex + 'Ans1').val('');
			$(this).closest('.MarkU').find('.subUQ' + cancelIndex + 'Ans2').val('');
			$(this).closest('.MarkU').find('.subUQ' + cancelIndex + 'Ans3').val('');
			$(this).closest('.MarkU').find('.subUQ' + cancelIndex + 'Ans4').val('');
			//init subQuestion select value
			$(this).closest('.MarkU').find('.GroupSubUQ' + cancelIndex + 'Type').find('.subUScore').val(1);
			//init sort select value
			$(this).closest('.MarkU').find('.GroupSubUQ' + cancelIndex + 'Type').find('.Usort').val(0);
			//hide img
			$('.exam').find('.exam-GroupQuestion .GroupUpdate .img' + cancelIndex).css('display' , 'none');
		}

		


	});

	//update Confirm btn
	$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .confirmU_btn').click(function(){

		var confirmIndex = $(this).attr('data-number');

		if (checkGroupSUQ($(this) , confirmIndex)) {
			$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU').css('display' , 'none');
			$('.GroupSubUQ' + confirmIndex + 'Type').css('display' , 'none');
			//show check img
			$('.exam').find('.exam-GroupQuestion .GroupUpdate .img' + confirmIndex).css('display' , 'block');
		}
		else{
			alert('請填入題目。');
		}

	});

	// update submit
	$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .submitU2').click(function(){
		var checkGroupDetail = $('.exam').find('.exam-GroupQuestion .GroupUpdate .GroupUDetail').val();
		var checkGroupQest = $('.exam').find('.exam-GroupQuestion .GroupUpdate .checkvalimg').css('display');

		if (checkGroupDetail != '' && checkGroupQest == 'block') {

			var GQ1A1UScore , GQ1A2UScore , GQ1A3UScore , GQ1A4UScore , GQ2A1UScore , GQ2A2UScore , GQ2A3UScore , GQ2A4UScore , GQ3A1UScore , GQ3A2UScore , GQ3A3UScore , GQ3A4UScore , GQ4A1UScore , GQ4A2UScore , GQ4A3UScore , GQ4A4UScore , GQ5A1UScore , GQ5A2UScore , GQ5A3UScore , GQ5A4UScore , GQ6A1UScore , GQ6A2UScore , GQ6A3UScore , GQ6A4UScore , GQ7A1UScore , GQ7A2UScore , GQ7A3UScore , GQ7A4UScore , GQ8A1UScore , GQ8A2UScore , GQ8A3UScore , GQ8A4UScore , GQ9A1UScore , GQ9A2UScore , GQ9A3UScore , GQ9A4UScore , GQ10A1UScore , GQ10A2UScore , GQ10A3UScore , GQ10A4UScore;
			for (var i = 1; i < 11; i++) {
				for (var j = 1; j < 5; j++) {
					var tempu = getScore("subUQ" + i + "Ans" + j + "Score");
					eval('GQ' + i + 'A' + j + 'UScore=' + tempu);
					// console.log(tempu);
				}
			}

			var Usort1 , Usort2 , Usort3 , Usort4 , Usort5 , Usort6 , Usort7 , Usort8 , Usort9 , Usort10;
			for (var s = 1; s < 11; s++) {
				var temp = getSort("Usort" + s);
				eval("Usort" + s + "=" + temp);
			}

			$.ajax({
				url: 'QuestionUpdate.php' , 
				type: 'POST' , 
				dataType: 'text' , 
				data:{
					GroupID:$('.exam').find('.exam-GroupQuestion .GroupUpdate .GroupId').val() ,
					GroupQ1Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ1Type .GroupQId').val(),
					GroupQ2Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ2Type .GroupQId').val(),
					GroupQ3Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ3Type .GroupQId').val(),
					GroupQ4Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ4Type .GroupQId').val(),
					GroupQ5Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ5Type .GroupQId').val(),
					GroupQ6Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ6Type .GroupQId').val(),
					GroupQ7Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ7Type .GroupQId').val(),
					GroupQ8Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ8Type .GroupQId').val(),
					GroupQ9Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ9Type .GroupQId').val(),
					GroupQ10Id:$('.exam').find('.exam-GroupQuestion .GroupUpdate .MarkU .GroupSubQ10Type .GroupQId').val(),
					GroupTitle:$('.exam').find('.exam-GroupQuestion .GroupUpdate .GroupUDetail').val() , 
					GroupSubQ1Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion1').val() , 
					GroupSubQ1A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ1Ans1').val() , 
					GQ1A1UScore: GQ1A1UScore , 
					GroupSubQ1A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ1Ans2').val() , 
					GQ1A2UScore: GQ1A2UScore , 
					GroupSubQ1A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ1Ans3').val() , 
					GQ1A3UScore: GQ1A3UScore , 
					GroupSubQ1A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ1Ans4').val() , 
					GQ1A4UScore: GQ1A4UScore ,
					GroupSubQ2Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion2').val() , 
					GroupSubQ2A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ2Ans1').val() , 
					GQ2A1UScore: GQ2A1UScore , 
					GroupSubQ2A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ2Ans2').val() , 
					GQ2A2UScore: GQ2A2UScore , 
					GroupSubQ2A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ2Ans3').val() , 
					GQ2A3UScore: GQ2A3UScore , 
					GroupSubQ2A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ2Ans4').val() , 
					GQ2A4UScore: GQ2A4UScore , 
					GroupSubQ3Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion3').val() , 
					GroupSubQ3A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ3Ans1').val() , 
					GQ3A1UScore: GQ3A1UScore , 
					GroupSubQ3A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ3Ans2').val() , 
					GQ3A2UScore: GQ3A2UScore , 
					GroupSubQ3A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ3Ans3').val() , 
					GQ3A3UScore: GQ3A3UScore , 
					GroupSubQ3A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ3Ans4').val() , 
					GQ3A4UScore: GQ3A4UScore ,
					GroupSubQ4Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion4').val() , 
					GroupSubQ4A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ4Ans1').val() , 
					GQ4A1UScore: GQ4A1UScore , 
					GroupSubQ4A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ4Ans2').val() , 
					GQ4A2UScore: GQ4A2UScore , 
					GroupSubQ4A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ4Ans3').val() , 
					GQ4A3UScore: GQ4A3UScore , 
					GroupSubQ4A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ4Ans4').val() , 
					GQ4A4UScore: GQ4A4UScore ,
					GroupSubQ5Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion5').val() , 
					GroupSubQ5A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ5Ans1').val() , 
					GQ5A1UScore: GQ5A1UScore , 
					GroupSubQ5A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ5Ans2').val() , 
					GQ5A2UScore: GQ5A2UScore , 
					GroupSubQ5A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ5Ans3').val() , 
					GQ5A3UScore: GQ5A3UScore , 
					GroupSubQ5A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ5Ans4').val() , 
					GQ5A4UScore: GQ5A4UScore , 
					GroupSubQ6Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion6').val() , 
					GroupSubQ6A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ6Ans1').val() , 
					GQ6A1UScore: GQ6A1UScore , 
					GroupSubQ6A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ6Ans2').val() , 
					GQ6A2UScore: GQ6A2UScore , 
					GroupSubQ6A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ6Ans3').val() , 
					GQ6A3UScore: GQ6A3UScore , 
					GroupSubQ6A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ6Ans4').val() , 
					GQ6A4UScore: GQ6A4UScore ,
					GroupSubQ7Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion7').val() , 
					GroupSubQ7A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ7Ans1').val() , 
					GQ7A1UScore: GQ7A1UScore , 
					GroupSubQ7A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ7Ans2').val() , 
					GQ7A2UScore: GQ7A2UScore , 
					GroupSubQ7A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ7Ans3').val() , 
					GQ7A3UScore: GQ7A3UScore , 
					GroupSubQ7A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ7Ans4').val() , 
					GQ7A4UScore: GQ7A4UScore ,
					GroupSubQ8Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion8').val() , 
					GroupSubQ8A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ8Ans1').val() , 
					GQ8A1UScore: GQ8A1UScore , 
					GroupSubQ8A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ8Ans2').val() , 
					GQ8A2UScore: GQ8A2UScore , 
					GroupSubQ8A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ8Ans3').val() , 
					GQ8A3UScore: GQ8A3UScore , 
					GroupSubQ8A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ8Ans4').val() , 
					GQ8A4UScore: GQ8A4UScore ,
					GroupSubQ9Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion9').val() , 
					GroupSubQ9A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ9Ans1').val() , 
					GQ9A1UScore: GQ9A1UScore , 
					GroupSubQ9A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ9Ans2').val() , 
					GQ9A2UScore: GQ9A2UScore , 
					GroupSubQ9A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ9Ans3').val() , 
					GQ9A3UScore: GQ9A3UScore , 
					GroupSubQ9A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ9Ans4').val() , 
					GQ9A4UScore: GQ9A4UScore ,
					GroupSubQ10Title:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion10').val() , 
					GroupSubQ10A1Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ10Ans1').val() , 
					GQ10A1UScore: GQ10A1UScore , 
					GroupSubQ10A2Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ10Ans2').val() , 
					GQ10A2UScore: GQ10A2UScore , 
					GroupSubQ10A3Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ10Ans3').val() , 
					GQ10A3UScore: GQ10A3UScore , 
					GroupSubQ10A4Content:$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQ10Ans4').val() , 
					GQ10A4UScore: GQ10A4UScore ,
					Usort1: Usort1 , 
					Usort2: Usort2 , 
					Usort3: Usort3 , 
					Usort4: Usort4 , 
					Usort5: Usort5 , 
					Usort6: Usort6 , 
					Usort7: Usort7 , 
					Usort8: Usort8 , 
					Usort9: Usort9 , 
					Usort10: Usort10 , 
					imageArray: selectImageIndex ,
					QType:'GroupUQuestion'
				} , 
				error:function(error){
					// alert(error);
					console.log(error);
				} , 
				success:function(response){
					// console.log(response);

					if (response > 0) {
						alert('此題目已被作答，無法更新。')
					}else{
						window.location.href = 'Amain.php';
					}
				}
			});
		}
		else {
			alert('請填入標題及至少一個子題。');
		}

		// $(document).ajaxComplete(function(){
		// 	//close add new GroupQuestion View
		// 	$('.exam').find('.exam-GroupQuestion').find('.create').find('.Group').css('display' , 'none');
		// 	window.location.href = 'Amain.php';
		// 	GroupInit();
		// 	imageInit();
		// });
	});


	//delete group
	$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .deleteU').click(function(){
		var checkdelete = confirm("請再次確認是否刪除此試題");

		if(checkdelete == true){
			$.ajax({
				url: 'QuestionDelete.php' , 
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					GroupID: $('.exam').find('.exam-GroupQuestion .create .GroupUpdate .GroupId').val() , 
					GroupUDetail: $('.exam').find('.exam-GroupQuestion .create .GroupUpdate .GroupUDetail').val() ,
					QType: 'GroupDQuestion'
				} ,
				error:function(error){
					// alert(error);
					console.log(error);
				} , 
				success:function(response){
					// alert('success');
					if (response > 0) {
						alert('此題目已被作答，無法刪除。')
					}else{
						window.location.href = 'Amain.php';
					}
				}
			});
		}
		else{

		}

		// $(document).ajaxComplete(function(){
		// 	window.location.href = 'Amain.php';
		// 	GroupInit();
		// 	imageInit();
		// });

	});

	// -------------------------------------------------
	//				Short Ans Area
	// 					JUMPING
	// -------------------------------------------------



	$('.exam .exam-SAQuestion .new-SAQuestion').click(function(){
		newSAQuestion();
		SAInit();
		imageInit();
	});

	//submit the True & False Question to tfquestionbase
	$('.exam').find('.exam-SAQuestion').find('.create').find('.submit').click(function(){
		var checkSADetail ;
		//check question
		if ($('.exam').find('.exam-SAQuestion').find('.create').find('.SADetail').val() != "") {
			checkSADetail = true;
		}else {
			checkSADetail = false;
			console.log('Short Ans Detail is null .');
		}

		if (checkSADetail) {
			//store short ans detail to sql by ajax
			var Aid = $('.container').find('.account-data .account-name').attr('data-id');

			$.ajax({
				url: 'QuestionBase.php' ,
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					Aid: Aid ,
					SADetail: $('.exam').find('.exam-SAQuestion').find('.create').find('.SADetail').val() , 
					QType: 'SAQuestion',
					imageArray: selectImageIndex 
				} , 
				error:function(error){
					// alert('error');
					console.log(error);
					
				} , 
				success:function(response){
					// console.log(response);
				}
			});
		}
		else{
			alert('請完整填入資料。');
		}

		$(document).ajaxComplete(function(){
			//close add new TFQuestion View
			$('.exam').find('.exam-SAQuestion').find('.create').find('.SA').css('display' , 'none');
			SAInit();
			window.location.href = 'Amain.php';
		});

	});

	//click existed question to edit (update) 
	$('.SAExist').live('click' , function() {
		var id = $(this).attr('data-attr');
		console.log(id);
		$.ajax({
			url: 'QuestionExist.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				SAId: id , 
				Type: 'SAQuestion'
			} , 
			error:function(error) {
				// alert(error);
				console.log(error);
			} , 
			success:function(response) {
				console.log("response");
				console.log(response);
				updateSAQuestion();
				imageInit();

				for (var i = 0; i < response.length; i++) {
					$('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAId').val(response[i].SAId);
					$('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAUDetail').val(response[i].SADetail);
				}

				var responseLength = 0;

				//get response object length
				for(var k in response[0]) {
 				  responseLength++;
				}

				for (var j = 0; j < (responseLength - 4); j++) {
					$('.exam').find('.imageBox .viewBox #' + response[0]['IMG' + j][0]).css('border' , '3px solid rgb(90,200,90)');
					selectImageIndex.push(response[0]['IMG' + j][0]);
				};
				$('.imageBox').attr("data-setimglist",selectImageIndex);
			}
		});
	});


	//click to update TF Question
	$('.exam').find('.exam-SAQuestion .create .SAUpdate .update').click(function() {
		var checkSAUDetail ;
		//check question
		if ($('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAUDetail').val() != "") {
			checkSAUDetail = true;
		}else {
			checkSAUDetail = false;
			console.log('SA Detail is null .');
		}

		if (checkSAUDetail) {
			//update short ans
			$.ajax({
				url: 'QuestionUpdate.php' ,
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					SAId: $('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAId').val() ,
					SAUDetail: $('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAUDetail').val() , 
					QType: 'SAUQuestion',
					imageArray: selectImageIndex 
				} , 
				error:function(error){
					// alert('error');
					console.log(error);
				} , 
				success:function(response){
					// console.log(response);

					if (response > 0) {
						alert('此題目已被作答，無法更新。')
					}else{
						window.location.href = 'Amain.php';
					}
				}
			});
		}
		else{
			alert('請完整填入資料。');
		}

		// $(document).ajaxComplete(function(){
		// 	//close update TFQuestion View
		// 	alert('Update success');
		// 	$('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').css('display' , 'none');
		// 	SAInit();
		// 	window.location.href = 'Amain.php';
		// });
	});

	//click to delete SA Question
	$('.exam').find('.exam-SAQuestion .create .SAUpdate .delete').click(function() {
		var SACheck = confirm("請再次確認是否刪除此題目");

		if (SACheck == true){
			//Delete TF Question from database with ajax
			$.ajax({
				url: 'QuestionDelete.php' ,
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					SAId: $('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAId').val() ,
					SAUDetail: $('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAUDetail').val() , 
					QType: 'SADelQuestion'
				} , 
				error:function(error){
					// alert('error');
					console.log(error);
				} , 
				success:function(response){
					// console.log(response);

					if (response > 0) {
						alert('此題目已被作答，無法刪除。')
					}else{
						window.location.href = 'Amain.php';
					}
				}
			});
		}
		else{

		}
	});


	









// --------------------------------------
//           function area
// -----------------------------------





	function userPhoto() {

		//user photo
		var sqlPhoto = '<?php echo $Aphoto ;?>';
		var photoUrl = 'url(upload/' + sqlPhoto + ')';
		// console.log(photoUrl);
		$('.account-now').find('.photo').css("background-image" , photoUrl ); /*************/
	}


	//new question chage page
	function newQuestion(index) {
		$('.exam').find('.content').css('display' , 'none');
		$('.exam').find('.makeQuestion').css('display' , 'none');
		$('.exam').find('.makePaper').css('display' , 'none');
		$('.exam').find('.exam-allocate').css('display' , 'none');


		if(index == 0){
			$('.exam').find('.exam-TFQuestion').css('display' , 'inline-block');	
		}
		else if(index == 1){
			$('.exam').find('.exam-ChoiceQuestion').css('display' , 'inline-block');
		}
		else if(index == 2){
			$('.exam').find('.exam-GroupQuestion').css('display' , 'inline-block');
		}
		else if(index == 3){
			$('.exam').find('.exam-SAQuestion').css('display' , 'inline-block');
		}
		else{
			alert('index error');
		}
	}

	function closeMakeQuestion() {
		$('.exam').find('.makeQuestion').css('display' , 'none');
		$('.exam').find('.content').css('display' , 'inline-block');
		$('.exam').find('.imageBox').css('display' , 'none');

		//close True & False Question create view
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TF').css('display' , 'none');
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').css('display' , 'none');
		//close Choice Question create view
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.Choice').css('display' , 'none');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').css('display' , 'none');
		//close Group Question create view
		$('.exam').find('.exam-GroupQuestion').find('.create').find('.Group').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion').find('.create').find('.GroupUpdate').css('display' , 'none');
		//close Short Ans Question create view
		$('.exam').find('.exam-SAQuestion').find('.create').find('.SA').css('display' , 'none');
		$('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').css('display' , 'none');

		//Init
		TFInit();
		CHInit();
		GroupInit();
		SAInit();
	}


	function newTFQuestion() {
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TF').css('display' , 'block');
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').css('display' , 'none');
	}

	function newChoiceQuestion() {
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.Choice').css('display' , 'block');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').css('display' , 'none');
	}

	function newGroupQuestion() {
		$('.exam').find('.exam-GroupQuestion .create .Group').css('display' , 'block');
		$('.exam').find('.exam-GroupQuestion .create .GroupUpdate').css('display' , 'none');
	}

	function newSAQuestion() {
		$('.exam').find('.exam-SAQuestion .create .SA').css('display' , 'block');
		$('.exam').find('.exam-SAQuestion .create .SAUpdate').css('display' , 'none');
	}

	//update TFQuestion
	function updateTFQuestion() {
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TF').css('display' , 'none');
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').css('display' , 'block');
	}

	//update CHQuestion
	function updateCHQuestion() {
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.Choice').css('display' , 'none');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').css('display' , 'block');
	}

	//update GPQuestion
	function updateGPQuestion() {
		$('.exam').find('.exam-GroupQuestion .create .Group').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .MarkU').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion .create .GroupUpdate').css('display' , 'block');
	}

	//update SAQuestion
	function updateSAQuestion() {
		$('.exam').find('.exam-SAQuestion .create .SA').css('display' , 'none');
		$('.exam').find('.exam-SAQuestion .create .SAUpdate').css('display' , 'block');
	}

	//image view init
	function imageInit() {
		selectImageIndex = [];
		$('.exam').find('.imageBox .viewBox .imageExist').css('border' , '3px solid rgb(242,242,242)');
		$('.imageBox').attr("data-setimglist","");
	}





	//check Group sub question 
	function checkGroupSQ(classname , index) {
		var check0 = classname.closest('.Mark').find('.GroupSubQ' + index + 'Type .subQuestion' + index).val();
		// var check1 = classname.closest('.Mark').find('.GroupSubQ' + index + 'Type .subQ' + index + 'Ans1').val();
		// var check2 = classname.closest('.Mark').find('.GroupSubQ' + index + 'Type .subQ' + index + 'Ans2').val();


		// if (check0 != '' && check1 != '' && check2 != '') {
		if (check0 != '') {
			return true;
		}
		else{
			return false;
		}
	}


	//check Update Group sub question 
	function checkGroupSUQ(classname , index) {
		var check0 = classname.closest('.MarkU').find('.GroupSubUQ' + index + 'Type .subUQuestion' + index).val();
		// var check1 = classname.closest('.MarkU').find('.GroupSubUQ' + index + 'Type .subUQ' + index + 'Ans1').val();
		// var check2 = classname.closest('.MarkU').find('.GroupSubUQ' + index + 'Type .subUQ' + index + 'Ans2').val();


		if (check0 != '') {
			return true;
		}
		else{
			return false;
		}
	}




	//Select Score Value
	function getScore(selectName) {

		var e = document.getElementById(selectName);
		var value = e.options[e.selectedIndex].value;

		return value;
	}

	//Select sort Value
	function getSort(selectName) {

		var e = document.getElementById(selectName);
		var value = e.options[e.selectedIndex].value;

		return value;
	}

	//check value test
	function checkimg_init() {
		$('.exam').find('.exam-GroupQuestion').find('.create').find('.putbox').find('.img1').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion').find('.create').find('.putbox').find('.img2').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion').find('.create').find('.putbox').find('.img3').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion').find('.create').find('.putbox').find('.img4').css('display' , 'none');
	}

	//TF initialization
	function TFInit() {
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TFDetail').val('');
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TAns').val('');
		$('.exam').find('.exam-TFQuestion').find('.create').find('.FAns').val('');
		//---------------------------------------------------------------------------------------
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFId').val('');
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TFUDetail').val('');
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.TUAns').val('');
		$('.exam').find('.exam-TFQuestion').find('.create').find('.TFUpdate').find('.FUAns').val('');
		TFScoreInit();
	}

	//Choice initialization
	function CHInit() {
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceDetail').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C1Ans').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C2Ans').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C3Ans').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.C4Ans').val('');
		//-----------------------------------------------------------------------------------
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.ChId').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.ChoiceUDetail').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C1UAns').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C2UAns').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C3UAns').val('');
		$('.exam').find('.exam-ChoiceQuestion').find('.create').find('.ChoiceUpdate').find('.C4UAns').val('');
		ChScoreInit();
	}

	//Group initialization
	function GroupInit() {
		$('.exam').find('.exam-GroupQuestion .Group .GroupDetail').val('');
		$('.exam').find('.exam-GroupQuestion .Group .subQuestion').val('');
		$('.exam').find('.exam-GroupQuestion .Group .subQAnsT2').val('');
		$('.exam').find('.exam-GroupQuestion .create .Group .checkvalimg').css('display' , 'none');
		//-------------------------------------------------------------------------------------
		$('.exam').find('.exam-GroupQuestion .GroupUpdate .GroupUDetail').val('');
		$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQuestion').val('');
		$('.exam').find('.exam-GroupQuestion .GroupUpdate .subUQAnsT2').val('');
		$('.exam').find('.exam-GroupQuestion .create .GroupUpdate .checkvalimg').css('display' , 'none');
		GroupScoreInit();
		GroupUScoreInit();
	}

	//SA initialization
	function SAInit() {
		$('.exam').find('.exam-SAQuestion').find('.create').find('.SADetail').val('');
		//---------------------------------------------------------------------------------------
		$('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAId').val('');
		$('.exam').find('.exam-SAQuestion').find('.create').find('.SAUpdate').find('.SAUDetail').val('');
	}

	//Score initialization
	function ScoreInit(selectName) {
		document.getElementById(selectName).value = '0';
	}

	//Sort initialization
	function SortInit(selectName) {
		document.getElementById(selectName).value = '0';
	}

	//Setting Score
	function SetScore(selectName , score) {
		var elem = document.getElementById(selectName);
		elem.value = score;
	}

	//Setting Sort
	function SetSort(selectName , score) {
		var elem = document.getElementById(selectName);
		elem.value = score;
	}


	//TF score initialization
	function TFScoreInit() {
		ScoreInit("TFAns1S");
		ScoreInit("TFAns2S");
		//-------------------
		ScoreInit("TFUAns1S");
		ScoreInit("TFUAns2S");
	}

	//Choice score initialization
	function ChScoreInit() {
		ScoreInit("ChAns1S");
		ScoreInit("ChAns2S");
		ScoreInit("ChAns3S");
		ScoreInit("ChAns4S");
		//------------------
		ScoreInit("ChUAns1S");
		ScoreInit("ChUAns2S");
		ScoreInit("ChUAns3S");
		ScoreInit("ChUAns4S");
	}

	//Group score initialization
	function GroupScoreInit() {
		for (var i = 1; i < 11; i++) {
			for (var j = 1; j < 5; j++) {
				ScoreInit("subQ" + i + "Ans" + j + "Score");
			}
		}
	}

	function GroupUScoreInit() {
		for (var i = 1; i < 11; i++) {
			for (var j = 1; j < 5; j++) {
				ScoreInit("subUQ" + i + "Ans" + j + "Score");
			}
		}
	}


//	-------------------------------------
// 				image button
//	-------------------------------------
	
	//image box function
	function createGoImageBox  (type){
		// console.log(type);
		$('.exam').find('.imageBox').css('display' , 'block');
		$('.exam').find('.makeQuestion').css('display' , 'none');

		//toggle change color
		$('.exam').find('.imageBox .viewBox .imageExist').toggle(
			function(){
				var attr = $(this).attr('data-attr');	
				$(this).css('border' , '3px solid rgb(90,200,90)');	
				for(var arrayindex = 0; arrayindex < selectImageIndex.length; arrayindex++){
					if(selectImageIndex[arrayindex] == attr){
						selectImageIndex.splice(arrayindex,1);
					}
				}
				selectImageIndex.push(attr);
			} , 
			function(){
				var attr2 = $(this).attr('data-attr');	
				$(this).css('border' , '3px solid rgb(242,242,242)');
				for(var arrayindex = 0; arrayindex < selectImageIndex.length; arrayindex++){
					// console.log(attr2);
					// console.log(selectImageIndex[arrayindex]);
					if(selectImageIndex[arrayindex] == attr2){
						// console.log('enter');
						selectImageIndex.splice(arrayindex,1);
					}
				}
			}
		);

		//確認
		$('.exam').find('.imageBox .imageConfirm').click(function(){
			$(this).closest('.imageBox').css('display' , 'none');
			closeAllAdd();
			if(type == "TF"){
				$('.exam').find('.exam-TFQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-TFQuestion .create .TF').css('display' , 'block');
			}
			else if(type == "Choice"){
				$('.exam').find('.exam-ChoiceQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-ChoiceQuestion .create .Choice').css('display' , 'block');
			}
			else if(type == "Group"){
				$('.exam').find('.exam-GroupQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-GroupQuestion .create .Group').css('display' , 'block');
			}
			else if(type == "SA"){
				$('.exam').find('.exam-SAQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-SAQuestion .create .SA').css('display' , 'block');
			}

			console.log(selectImageIndex);
			$('.imageBox').attr("data-setimglist",selectImageIndex);
		});

		//刪除 (need competence) (uncompleted)
		// $('.exam').find('.imageBox .imageDelete').click(function(){
		// 	var imgdelcheck = confirm("請再次確認是否刪除圖片，若該圖片有與其他題目鏈結，則會影響該題目。");
		// 	if (imgdelcheck == true) {
		// 		$.ajax({
		// 			url: 'imageDelete.php' ,
		// 			type: 'POST' ,
		// 			dataType: 'html' ,
		// 			data:{
		// 				imageDelete
		// 			} , 
		// 			error:function(error){

		// 			} , 
		// 			success:function(response){

		// 			}
		// 		});
		// 	}
		// });

		//重選
		$('.exam').find('.imageBox .imageClear').click(function(){
			imageInit();
		});

		//back
		$('.exam').find('.imageBox .imageBack').click(function(){
			$(this).closest('.imageBox').css('display' , 'none');
			closeAllAdd();
			if(type == "TF"){
				$('.exam').find('.exam-TFQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-TFQuestion .create .TF').css('display' , 'block');
			}
			else if(type == "Choice"){
				$('.exam').find('.exam-ChoiceQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-ChoiceQuestion .create .Choice').css('display' , 'block');
			}
			else if(type == "Group"){
				$('.exam').find('.exam-GroupQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-GroupQuestion .create .Group').css('display' , 'block');
			}
		});
	}
	function reOpen () {
		$('.exam').find('.imageBox').css('display' , 'none');
		$('.exam').find('.makeQuestion').css('display' , 'block');
		$('.exam').find('.imageBox').css('display' , 'block');
		$('.exam').find('.makeQuestion').css('display' , 'none');
	}
		//update image box function
	function createGoUpdateImageBox (Utype){
		// console.log(Utype);
		$('.exam').find('.imageBox').css('display' , 'block');
		$('.exam').find('.makeQuestion').css('display' , 'none');

		//toggle change color
		$('.exam').find('.imageBox .viewBox .imageExist').toggle(
			function(){
				var attr = $(this).attr('data-attr');	
				$(this).css('border' , '3px solid rgb(90,200,90)');	
				for(var arrayindex = 0; arrayindex < selectImageIndex.length; arrayindex++){
					if(selectImageIndex[arrayindex] == attr){
						selectImageIndex.splice(arrayindex,1);
					}
				}
				selectImageIndex.push(attr);
			} , 
			function(){
				var attr2 = $(this).attr('data-attr');	
				$(this).css('border' , '3px solid rgb(242,242,242)');
				for(var arrayindex = 0; arrayindex < selectImageIndex.length; arrayindex++){
					// console.log(attr2);
					// console.log(selectImageIndex[arrayindex]);
					if(selectImageIndex[arrayindex] == attr2){
						// console.log('enter');
						selectImageIndex.splice(arrayindex,1);
					}
				}
				// console.log(selectImageIndex);
			}
		);

		//確認
		$('.exam').find('.imageBox .imageConfirm').click(function(){
			$(this).closest('.imageBox').css('display' , 'none');
			closeAllAdd();
			if(Utype == "TFUpdate"){
				$('.exam').find('.exam-TFQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-TFQuestion .create .TFUpdate').css('display' , 'block');
			}
			else if(Utype == "ChoiceUpdate"){
				$('.exam').find('.exam-ChoiceQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate').css('display' , 'block');
			}
			else if(Utype == "GroupUpdate"){
				$('.exam').find('.exam-GroupQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-GroupQuestion .create .GroupUpdate').css('display' , 'block');
			}
			else if(Utype == "SAUpdate"){
				$('.exam').find('.exam-SAQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-SAQuestion .create .SAUpdate').css('display' , 'block');
			}
			// imageContent_X
			console.log(selectImageIndex);
			$('.imageBox').attr("data-setimglist",selectImageIndex);
			

		});

		//刪除 (need competence) (uncompleted)
		// $('.exam').find('.imageBox .imageDelete').click(function(){
		// 	var imgdelcheck = confirm("請再次確認是否刪除圖片，若該圖片有與其他題目鏈結，則會影響該題目。");
		// 	if (imgdelcheck == true) {
		// 		$.ajax({
		// 			url: 'imageDelete.php' ,
		// 			type: 'POST' ,
		// 			dataType: 'html' ,
		// 			data:{
		// 				imageDelete
		// 			} , 
		// 			error:function(error){

		// 			} , 
		// 			success:function(response){

		// 			}
		// 		});
		// 	}
		// });

		//重選
		$('.exam').find('.imageBox .imageClear').click(function(){
			imageInit();
		});

		//back
		$('.exam').find('.imageBox .imageBack').click(function(){
			$(this).closest('.imageBox').css('display' , 'none');
			closeAllAdd();
			if(Utype == "TFUpdate"){
				$('.exam').find('.exam-TFQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-TFQuestion .create .TFUpdate').css('display' , 'block');
			}
			else if(Utype == "ChoiceUpdate"){
				$('.exam').find('.exam-ChoiceQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate').css('display' , 'block');
			}
			else if(Utype == "GroupUpdate"){
				$('.exam').find('.exam-GroupQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-GroupQuestion .create .GroupUpdate').css('display' , 'block');
			}
			else if(Utype == "SAUpdate"){
				$('.exam').find('.exam-SAQuestion').css('display' , 'inline-block');
				$('.exam').find('.exam-SAQuestion .create .SAUpdate').css('display' , 'block');
			}
		});
	}

	//close all add
	function closeAllAdd(){
		$('.exam').find('.exam-TFQuestion').css('display' , 'none');
		$('.exam').find('.exam-ChoiceQuestion').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion').css('display' , 'none');
		$('.exam').find('.exam-TFQuestion .create .TF').css('display' , 'none');
		$('.exam').find('.exam-TFQuestion .create .TFUpdate').css('display' , 'none');
		$('.exam').find('.exam-ChoiceQuestion .create .Choice').css('display' , 'none');
		$('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion .create .Group').css('display' , 'none');
		$('.exam').find('.exam-GroupQuestion .create .GroupUpdate').css('display' , 'none');
		$('.exam').find('.exam-SAQuestion .create .SA').css('display' , 'none');
		$('.exam').find('.exam-SAQuestion .create .SAUpdate').css('display' , 'none');
	}

	



	
});
	







</script>

<!-- divier -->
<!-- <script type="text/javascript" src="divider/setImage.js"></script>
<script type="text/javascript" src="divider/setplane.js"></script> -->