$(document).ready(function(){

	// -----------------------------------------------------------------
	// 								基本功能
	// -----------------------------------------------------------------


	$('.container-header .logout').click(function(){
		$.ajax({
			url: 'logout.php' , 
			type: 'POST' , 
			dataType: 'html' , 
			data:{
			} , 
			error:function(error){
				console.log('error');
			} , 
			success:function(response){
				window.location.href = response;
			}
		});
	});

	$('.sidebar .item').hover(function(){
		$(this).find('a').css('color' , '#fff');
	} , function(){
		$(this).find('a').css('color' , 'rgba(255,255,255,0.6)');
	});

	$('.account-teacher').css('display' , 'block');

	// -----------------------------------------------------------------
	// 								帳號管理
	// -----------------------------------------------------------------

	//說明
	$('.account-container .account-instruction').click(function(){
		BoxInit();
		$('.account-instruction-mark').css('display' , 'block');
	});

	$('.instruction-btn').click(function(){
		BoxInit();
	});

	// -----------------------------------------------------------------
	// 								共用
	// -----------------------------------------------------------------


	//單筆取消
	$('.single-cancel').click(function(){
		BoxInit();
	});

	//多筆取消
	$('.account-mult-upload .mult-cancel').click(function(){
		BoxInit();
	});

	//返回按鈕
	$('.account-back').click(function(){
		var now = $(this).attr('data-now');
		$('.account-container').css('display' , 'none');

		if (now == 'class') {
			containerStatus('teacher');
			$('.account-teacher').css('display' , 'block');
			BoxInit();
		}else if(now == 'student') {
			var teacherName = $('.account-student .studentData').attr('data-teacherName');
			containerStatus('class' , teacherName);
			$('.account-class').css('display' , 'block');
			BoxInit();
		}else if(now == 'grade') {
			var teacherName = $('.account-grade .gradeData').attr('data-teacherName');
			var className = $('.account-grade .gradeData').attr('data-class');
			containerStatus('student' , teacherName , className);
			$('.account-student').css('display' , 'block');
			BoxInit();
		}

	});

	// -----------------------------------------------------------------
	// 								教師
	// -----------------------------------------------------------------

	//單筆新增教師
	$('.account-teacher-ctrl .new-single').click(function(){
		BoxInit();
		$('.account-teacher-single').css('display' , 'block');
	});

	//單筆教師送出
	$('.account-teacher-single .single-submit').click(function(){
		var name = $('.account-teacher-single .account-single-name').val();
		var ID = $('.account-teacher-single .account-single-ID').val();
		var pass = $('.account-teacher-single .account-single-pass').val();
		var mail = $('.account-teacher-single .account-single-mail').val();

		if (name != '' && ID != '' && pass != '') {
			$.ajax({
				url: 'accountEdit.php' ,
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					name: name , 
					ID: ID , 
					pass: pass ,
					mail: mail , 
					type: 'newTeacher'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				if (response > 0) {
					UIkit.modal.alert('該帳號已存在');
				}else{
					location.reload();
				}
			}).always(function(){
			});
		}else{
			UIkit.modal.alert('請確認星號項目已完整填寫');
		}
	});

	//多筆新增
	$('.account-teacher-ctrl .new-mult').click(function(){
		BoxInit();
		$('.account-teacher-mult').css('display' , 'block');
	});

	//教師詳細資料
	$(document).on('click' , '.account-teacher-list .account-teacher-detail' , function(){
		BoxInit();
		$('.account-teacher-edit').css('display' , 'block');
		DetailInit();
		var ID = $(this).attr('data-id');

		$.ajax({
			url: 'accountData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				ID: ID , 
				type: 'getTeacherData'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){

			$('.account-teacher-edit .account-teacher-name').val(response[0].Aname);
			$('.account-teacher-edit .account-teacher-ID').val(response[0].Aid);
			$('.account-teacher-edit .account-teacher-pass').val(response[0].Apassword);
			$('.account-teacher-edit .account-teacher-mail').val(response[0].Amail);
			$('.account-teacher-edit .teacher-submit').attr('data-id' , response[0].Aid);
		});
	});

	//教師詳細資料取消
	$('.account-teacher-edit .teacher-cancel').click(function(){
		BoxInit();
	});

	//教師詳細資料修改
	$('.account-teacher-edit .teacher-submit').click(function(){
		var oldID = $(this).attr('data-id');
		var name = $('.account-teacher-edit .account-teacher-name').val();
		var ID = $('.account-teacher-edit .account-teacher-ID').val();
		var pass = $('.account-teacher-edit .account-teacher-pass').val();
		var mail = $('.account-teacher-edit .account-teacher-mail').val();
		var IDChange = 0;

		if (name != '' && ID != '' && pass != '') {
			if (oldID == ID) {
				IDChange = 0;
			}else{
				IDChange = 1;
			}

			$.ajax({
				url: 'accountEdit.php' ,
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					oldID: oldID ,
					name: name , 
					ID: ID , 
					pass: pass ,
					mail: mail , 
					IDChange: IDChange ,
					type: 'editTeacher'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				if (response > 0) {
					UIkit.modal.alert('該帳號已存在，無法更換。');
				}else{
					location.reload();
				}
			}).always(function(){
			});
		}else{
			UIkit.modal.alert('請確認星號項目已完整填寫');
		}
	});

	//教師刪除
	$(document).on('click' , '.account-teacher-list .account-teacher-delete' , function(){
		var ID = $(this).attr('data-id');

		UIkit.modal.confirm("確定刪除該教師？" , function(){
			$.ajax({
				url: 'accountEdit.php' ,
				method: 'POST' , 
				dataType: 'json' , 
				data:{
					ID: ID , 
					type: 'deleteTeacher'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){

			}).always(function(){
				location.reload();
			});
		});
	});

	//進入教師班級
	$(document).on('click' , '.account-teacher-list .account-teacher-enter' , function(){
		var teacherID = $(this).attr('data-id');
		var teacherName = $(this).attr('data-name');
		BoxInit();

		$.ajax({
			url: 'accountData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				teacherID: teacherID , 
				type: 'getClassData'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			// console.log(response);
			$('.account-container').css('display' , 'none');
			$('.account-class').css('display' , 'block');
			$('.account-class-list').html("");
			$('.account-class .account-class-list').append("<input type = 'hidden' class = 'classData' data-teacherID = '" + teacherID + "' data-teacherName = '" + teacherName + "' />");
			for (var i = 0; i < response.length; i++) {
				$('.account-class .account-class-list').append("<div class='account-class-item account-item' data-class = '" + response[i].Aclass + "' data-teacher = '" + response[i].Aid + "'><div class='account-class-name account-name'>" + response[i].Aclass + "</div><div class='account-class-delete account-delete-icon account-icon' data-class = '" + response[i].Aclass + "'></div><div class='account-class-detail account-detail-icon account-icon' data-class = '" + response[i].Aclass + "'></div><div class='account-class-enter account-enter-icon account-icon' data-teacherID = '" + response[i].Aid + "' data-class = '" + response[i].Aclass + "'></div></div>");
			}
		}).always(function(){
			containerStatus('class' , teacherName);
			$('.account-class-single .single-submit').attr('data-teacherID' , teacherID);
			$('.account-class-mult .teacherID').val(teacherID);
			$('.account-student-mult .teacherID').val(teacherID);
			$('.account-student-single .single-submit').attr('data-teacherID' , teacherID);
		});
	});

	// -----------------------------------------------------------------
	// 								班級
	// -----------------------------------------------------------------

	//單筆新增班級
	$('.account-class-ctrl .new-single').click(function(){
		BoxInit();
		$('.account-class-single').css('display' , 'block');
	});

	//單筆班級送出
	$('.account-class-single .single-submit').click(function(){
		var teacherID = $(this).attr('data-teacherID');
		var name = $('.account-class-single .account-single-name').val();

		if (name != '') {
			$.ajax({
				url: 'accountEdit.php' ,
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					name: name , 
					teacherID: teacherID , 
					type: 'newClass'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				if (response > 0) {
					UIkit.modal.alert('該班級已存在');
				}else{
					location.reload();
				}
			}).always(function(){
			});
		}else{
			UIkit.modal.alert('請確認星號項目已完整填寫');
		}
	});

	//多筆新增
	$('.account-class-ctrl .new-mult').click(function(){
		BoxInit();
		$('.account-class-mult').css('display' , 'block');
	});

	//班級詳細資料
	$(document).on('click' , '.account-class-list .account-class-detail' , function(){
		BoxInit();
		$('.account-class-edit').css('display' , 'block');
		DetailInit();

		var teacherID = $('.account-class .classData').attr('data-teacherID');
		var className = $(this).attr('data-class');

		$.ajax({
			url: 'accountData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				teacherID: teacherID , 
				className: className , 
				type: 'getClassDetail'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			$('.account-class-edit .account-class-name').val(response[0].Aclass);
			$('.account-class-edit .class-submit').attr('data-name' , response[0].Aclass);
		});
	});

	//班級詳細資料取消
	$('.account-class-edit .class-cancel').click(function(){
		BoxInit();
	});

	//班級詳細資料修改
	$('.account-class-edit .class-submit').click(function(){
		var oldName = $(this).attr('data-name');
		var className = $('.account-class-edit .account-class-name').val();
		var teacherID = $('.account-class .classData').attr('data-teacherID');

		if (className != '') {
			if (oldName == className) {
				
			}else{
				$.ajax({
					url: 'accountEdit.php' ,
					method: 'POST' , 
					dataType: 'html' , 
					data:{
						oldName: oldName ,
						className: className , 
						teacherID: teacherID , 
						type: 'editClass'
					}
				}).fail(function(error){
					console.log(error);
				}).done(function(response){
					if (response > 0) {
						UIkit.modal.alert('該班級名稱已存在，無法更換。');
					}else{
						location.reload();
					}
				}).always(function(){
				});
			}
		}else{
			UIkit.modal.alert('請確認星號項目已完整填寫');
		}
	});

	//班級刪除
	$(document).on('click' , '.account-class-list .account-class-delete' , function(){
		var className = $(this).attr('data-class');
		var teacherID = $('.account-class .classData').attr('data-teacherID');

		UIkit.modal.confirm("確定刪除該班級？" , function(){
			$.ajax({
				url: 'accountEdit.php' ,
				method: 'POST' , 
				dataType: 'json' , 
				data:{
					teacherID: teacherID , 
					className: className , 
					type: 'deleteClass'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){

			}).always(function(){
				location.reload();
			});
		});
	});

	//進入班級學生
	$(document).on('click' , '.account-class-list .account-class-enter' , function(){
		var teacherID = $(this).attr('data-teacherID');
		var className = $(this).attr('data-class');
		var teacherName = $('.account-class .classData').attr('data-teacherName');
		BoxInit();

		$.ajax({
			url: 'accountData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				teacherID: teacherID , 
				className: className ,
				type: 'getStudentData'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			$('.account-container').css('display' , 'none');
			$('.account-student').css('display' , 'block');
			$('.account-student-list').html("");
			$('.account-student .account-student-list').append("<input type = 'hidden' class = 'studentData' data-teacherID = '" + teacherID + "' data-teacherName = '" + teacherName + "' data-class = '" + className + "' />");
			for (var i = 0; i < response.length; i++) {
				$('.account-student .account-student-list').append("<div class='account-student-item account-item' data-student = '" + response[i].Sid + "' data-teacher = '" + response[i].Steacher + "'><div class='account-student-name account-name'>" + response[i].Sname + "</div><div class='account-student-delete account-delete-icon account-icon' data-student = '" + response[i].Sid + "'></div><div class='account-student-detail account-detail-icon account-icon' data-student = '" + response[i].Sid + "'></div><div class='account-student-enter account-enter-icon account-icon' data-student = '" + response[i].Sid + "' data-studentName = '" + response[i].Sname + "'></div></div>");
			}
		}).always(function(){
			containerStatus('student' , teacherName , className);
			$('.account-student-single .single-submit').attr('data-teacherID' , teacherID);
			$('.account-student-single .single-submit').attr('data-class' , className);
			$('.account-student-mult .className').val(className);
		});
	});

	// -----------------------------------------------------------------
	// 								學生
	// -----------------------------------------------------------------

	//單筆新增學生
	$('.account-student-ctrl .new-single').click(function(){
		BoxInit();
		$('.account-student-single').css('display' , 'block');
	});

	//單筆學生送出
	$('.account-student-single .single-submit').click(function(){
		var teacherID = $(this).attr('data-teacherID');
		var className = $(this).attr('data-class');
		var name = $('.account-student-single .account-single-name').val();
		var ID = $('.account-student-single .account-single-ID').val();
		var pass = $('.account-student-single .account-single-pass').val();

		if (name != '' && ID != '' && pass != '') {
			$.ajax({
				url: 'accountEdit.php' ,
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					teacherID: teacherID , 
					className: className ,
					name: name , 
					ID: ID , 
					pass: pass , 
					type: 'newStudent'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				if (response > 0) {
					UIkit.modal.alert('該學生帳號已存在');
				}else{
					location.reload();
				}
			}).always(function(){
			});
		}else{
			UIkit.modal.alert('請確認星號項目已完整填寫');
		}
	});

	//多筆新增
	$('.account-student-ctrl .new-mult').click(function(){
		BoxInit();
		$('.account-student-mult').css('display' , 'block');
	});

	//學生詳細資料
	$(document).on('click' , '.account-student-list .account-student-detail' , function(){
		BoxInit();
		$('.account-student-edit').css('display' , 'block');
		DetailInit();

		var teacherID = $('.account-student .studentData').attr('data-teacherID');
		var className = $('.account-student .studentData').attr('data-class');
		var studentID = $(this).attr('data-student');

		$.ajax({
			url: 'accountData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				teacherID: teacherID , 
				className: className , 
				studentID: studentID , 
				type: 'getStudentDetail'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			console.log(response);
			$('.account-student-edit .account-student-name').val(response[0].Sname);
			$('.account-student-edit .account-student-ID').val(response[0].Sid);
			$('.account-student-edit .account-student-pass').val(response[0].Spassword);
			$('.account-student-edit .student-submit').attr('data-studentID' , response[0].Sid);
		});
	});

	//學生詳細資料取消
	$('.account-student-edit .student-cancel').click(function(){
		BoxInit();
	});

	//學生詳細資料修改
	$('.account-student-edit .student-submit').click(function(){
		var oldID = $(this).attr('data-studentID');
		var teacherID = $('.account-student .studentData').attr('data-teacherID');
		var className = $('.account-student .studentData').attr('data-class');
		var name = $('.account-student-edit .account-student-name').val();
		var ID = $('.account-student-edit .account-student-ID').val();
		var pass = $('.account-student-edit .account-student-pass').val();
		var IDChange = 0;

		if (name != '' && ID != '' && pass != '') {
			if (oldID == ID) {
				IDChange = 0;
			}else{
				IDChange = 1;
			}

			$.ajax({
				url: 'accountEdit.php' ,
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					oldID: oldID ,
					className: className , 
					teacherID: teacherID , 
					name: name , 
					ID: ID , 
					pass: pass , 
					IDChange: IDChange , 
					type: 'editStudent'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				if (response > 0) {
					UIkit.modal.alert('該學生帳號已存在，無法更換。');
				}else{
					location.reload();
				}
			}).always(function(){
			});
		}else{
			UIkit.modal.alert('請確認星號項目已完整填寫');
		}
	});

	//學生刪除
	$(document).on('click' , '.account-student-list .account-student-delete' , function(){
		var studentID = $(this).attr('data-student');
		var className = $('.account-student .studentData').attr('data-class');
		var teacherID = $('.account-student .studentData').attr('data-teacherID');

		UIkit.modal.confirm("確定刪除該學生？" , function(){
			$.ajax({
				url: 'accountEdit.php' ,
				method: 'POST' , 
				dataType: 'json' , 
				data:{
					teacherID: teacherID , 
					className: className , 
					studentID: studentID , 
					type: 'deleteStudent'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){

			}).always(function(){
				location.reload();
			});
		});
	});

	//進入學生成績
	$(document).on('click' , '.account-student-list .account-student-enter' , function(){
		var studentID = $(this).attr('data-student');
		var studentName = $(this).attr('data-studentName');
		var className = $('.account-student .studentData').attr('data-class');
		var teacherName = $('.account-student .studentData').attr('data-teacherName');
		var teacherID = $('.account-student .studentData').attr('data-teacherID');
		BoxInit();

		$.ajax({
			url: 'accountData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				studentID: studentID , 
				// teacherID: teacherID , 
				// className: className ,
				type: 'getGradeData'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			console.log(response);
			$('.account-container').css('display' , 'none');
			$('.account-grade').css('display' , 'block');
			$('.account-grade-list').html("");
			$('.account-grade .account-grade-list').append("<input type = 'hidden' class = 'gradeData' data-teacherID = '" + teacherID + "' data-teacherName = '" + teacherName + "' data-class = '" + className + "' />");
			for (var i = 0; i < response.length; i++) {
				if (response[i].Time == "") {
					$('.account-grade .account-grade-list').append("<div class='account-grade-item account-item'><div class='account-student-name account-name'>" + response[i].PTitle  + "</div><div class = 'account-grade'>未作答</div></div>");
				}else{
					$('.account-grade .account-grade-list').append("<div class='account-grade-item account-item'><div class='account-student-name account-name'>" + response[i].PTitle  + "</div><div class = 'account-grade'>" + response[i].grade + "分</div><div class = 'account-time'>測驗時間：" + response[i].Time + "</div></div>");
					// $('.account-grade .account-grade-list').append("<div class='account-grade-item account-item'><div class='account-student-name account-name'>" + response[i].PTitle  + "</div><div class = 'account-grade'>" + response[i].grade + "分</div><div class = 'account-time'>測驗時間：" + response[i].Time + "</div><div class='account-grade-delete account-delete-icon account-icon' data-student = '" + response[i].studentID + "' data-paperID = '" + response[i].paperID + "' data-gradeID = '" + response[i].gradeID + "' data-allocateID = '" + response[i].allocateID + "'></div></div>");
				}
			}
		}).always(function(){
			containerStatus('grade' , teacherName , className , studentName);
			$('.account-student-single .single-submit').attr('data-teacherID' , teacherID);
			$('.account-student-single .single-submit').attr('data-class' , className);
			$('.account-student-mult .className').val(className);
		});
	});


	// -----------------------------------------------------------------
	// 								成績
	// -----------------------------------------------------------------

	// //學生成績刪除
	// $(document).on('click' , '.account-grade-list .account-grade-delete' , function(){
	// 	var studentID = $(this).attr('data-student');
	// 	var paperID = $(this).attr('data-paperID');
	// 	var gradeID = $(this).attr('data-gradeID');
	// 	var allocateID = $(this).attr('data-allocateID');
	// 	var className = $('.account-grade .gradeData').attr('data-class');
	// 	var teacherID = $('.account-grade .gradeData').attr('data-teacherID');

	// 	UIkit.modal.confirm("確定刪除該筆成績？  刪除後學生將可以再次作答。" , function(){
	// 		$.ajax({
	// 			url: 'accountEdit.php' ,
	// 			method: 'POST' , 
	// 			dataType: 'json' , 
	// 			data:{
	// 				paperID: paperID , 
	// 				gradeID: gradeID , 
	// 				allocateID: allocateID , 
	// 				teacherID: teacherID , 
	// 				className: className , 
	// 				studentID: studentID , 
	// 				type: 'deleteGrade'
	// 			}
	// 		}).fail(function(error){
	// 			console.log(error);
	// 		}).done(function(response){

	// 		}).always(function(){
	// 			location.reload();
	// 		});
	// 	});
	// });

	function BoxInit() {
		$('.account-single-upload').css('display' , 'none');
		$('.account-mult-upload').css('display' , 'none');
		$('.account-instruction-mark').css('display' , 'none');
		$('.account-editBox').css('display' , 'none');
		DetailInit();
		SingleInit();
	}

	function SingleInit() {
		$('.single-style').val('');
	}

	function DetailInit() {
		$('.edit-style').val('');
	}

	function containerStatus(site , teacherName , className , studentName) {
		switch(site){
			case 'teacher':
				$('.container-status .status').html("首頁 / 帳號管理 - 教師管理");
				break;

			case 'class':
				$('.container-status .status').html("首頁 / 帳號管理 - 班級管理(" + teacherName + ")");
				break;

			case 'student':
				$('.container-status .status').html("首頁 / 帳號管理 - 學生管理(" + teacherName + " - " + className + ")");
				break;

			case 'grade':
				$('.container-status .status').html("首頁 / 帳號管理 - 學生成績(" + teacherName + " - " + className + " - " + studentName + ")");
				break;
		}
	}
});