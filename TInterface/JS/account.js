$(document).ready(function(){
	BoxInit();
	$('.account-student').css('display' , 'none');
	// -----------------------------------------------------------------
	// 								班級區控制
	// -----------------------------------------------------------------

	$('.account .account-ctrl .new-class').click(function(){
		BoxInit();
		$('.account .account-class-single').css('display' , 'block');
	});

	$('.account .account-single-upload .single-cancel').click(function(){
		BoxInit();
	});

	$('.account .account-mult-upload .mult-cancel').click(function(){
		BoxInit();
	});

	$('.account .account-editBox .class-cancel').click(function(){
		BoxInit();
	});

	$('.account .account-editBox .student-cancel').click(function(){
		BoxInit();
	});

	//新增班級
	$('.account .account-class-single .class-single-submit').click(function(){
		var className = $('.account .account-single-name').val();
		var Aid = $('.container .account-data .account-name').attr('data-id');

		if (className != "") {
			$.ajax({
				url: 'AccountEdit.php' , 
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					Aid: Aid , 
					className: className , 
					type: 'newClass'
				} , 
				error:function(error){
					alert(error);
				} , 
				success:function(response){
					console.log(response);
					if (response > 0) {
						alert("該班級已存在");
					}else{
						location.reload();
					}
				}
			});

			$(document).ajaxComplete(function(){
				// location.reload();
			});
		}else{
			alert("請輸入完整資料");
		}
	});

	//修改班級
	$('.account .account-class-item .account-detail-icon').live('click' , function() {
		var Aid = $(this).attr('data-id');
		var className = $(this).attr('data-name');
		BoxInit();

		$('.account .account-class-edit').css('display' , 'block');
		$('.account .account-editBox .account-class-name').val(className);
		$('.account .account-editBox .class-submit').attr({
			'data-id' : Aid , 
			'data-oldName' : className
		});
	});

	//班級修改送出
	$('.account .account-editBox .class-submit').click(function(){
		var Aid = $(this).attr('data-id');
		var oldName = $(this).attr('data-oldname');
		var newName = $('.account .account-editBox .account-class-name').val();

		if (newName != "") {
			if (oldName != newName) {
				$.ajax({
					url: 'AccountEdit.php' , 
					type: 'POST' , 
					dataType: 'html' , 
					data:{
						Aid: Aid , 
						oldName: oldName , 
						newName: newName , 
						type: 'editClass'
					} , 
					error:function(error){
						alert(error);
					} , 
					success:function(response){
						console.log(response);
						if (response > 0) {
							alert("該班級已存在");
						}else{
							location.reload();
						}
					}
				});

				$(document).ajaxComplete(function(){
					// location.reload();
				});
			}
		}else{
			alert("請輸入完整資料");
		}
	});

	//刪除班級
	$('.account .account-class-item .account-class-delete').live('click' , function() {
		var Aid = $(this).attr('data-id');
		var className = $(this).attr('data-name');
		BoxInit();
		var check = confirm("確定刪除改班級?");

		if (check) {
			$.ajax({
				url: 'AccountEdit.php' , 
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					Aid: Aid , 
					className: className , 
					type: 'deleteClass'
				} , 
				error:function(error){
					alert(error);
				} , 
				success:function(response){
				}
			});

			$(document).ajaxComplete(function(){
				location.reload();
			});
		}
	});

	//進入班級
	$('.account .account-class-item .account-enter-icon').live('click' , function() {
		var Aid = $(this).attr('data-id');
		var className = $(this).attr('data-name');
		BoxInit();
		$('.account .account-class').css('display' , 'none');
		$('.account .account-student').css('display' , 'block');

		$.ajax({
			url: 'AccountExist.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				Aid: Aid , 
				className: className , 
				Type: 'studentList'
			} , 
			error:function(error){
				console.log(error);
			} , 
			success:function(response){
				// console.log(response);
				$('.account-container').css('display' , 'none');
				$('.account-student').css('display' , 'block');
				$('.account-student-list').html("");
				$('.account-student .account-student-list').append("<input type = 'hidden' class = 'studentData' data-teacherID = '" + Aid + "' data-class = '" + className + "' />");
				for (var i = 0; i < response.length; i++) {
					$('.account-student .account-student-list').append("<div class='account-student-item account-item' data-student = '" + response[i].Sid + "' data-teacher = '" + response[i].Steacher + "'><div class='account-student-name account-name'>" + response[i].Sname + "</div><div class='account-student-delete account-delete-icon account-icon' data-student = '" + response[i].Sid + "'></div><div class='account-student-detail account-detail-icon account-icon' data-Sid = '" + response[i].Sid + "' data-name = '" + response[i].Sname + "' data-pass = '" + response[i].Spassword + "'></div></div>");
				}
			}
		});

		$(document).ajaxComplete(function(){
			// location.reload();
		});
	});

	$('.account .account-student-ctrl .new-single').click(function(){
		$('.account .account-student-single').css('display' , 'block');
	});

	$('.account .account-student-ctrl .new-mult').click(function(){
		$('.account .account-student-mult').css('display' , 'block');
		var Aid = $('.container .account-data .account-name').attr('data-id');
		var className = $('.account .studentData').attr('data-class');
		$('.account-student-mult .teacherID').val(Aid);
		$('.account-student-mult .className').val(className);
	});

	$('.account .account-student-single .single-submit').click(function(){
		var name = $('.account-student-single .account-single-name').val();
		var ID = $('.account-student-single .account-single-ID').val();
		var pass = $('.account-student-single .account-single-pass').val();
		var className = $('.account .studentData').attr('data-class');
		var Aid = $('.container .account-data .account-name').attr('data-id');

		if (name != "" && ID != "" && pass != "") {
			$.ajax({
				url: 'AccountEdit.php' , 
				type: 'POST' , 
				dataType: 'json' , 
				data:{
					Aid: Aid , 
					className: className , 
					name: name , 
					ID: ID , 
					pass: pass , 
					type: 'newStudent'
				} , 
				error:function(error){
					console.log(error);
				} , 
				success:function(response){
					// console.log(response);
					if (response > 0) {
						alert("該帳號已存在");
					}else{
						location.reload();
					}
				}
			});

			$(document).ajaxComplete(function(){
				location.reload();
			});
		}else{
			alert("請輸入完整資料");
		}
	});

	//返回
	$('.account .account-back').click(function(){
		BoxInit();
		$('.account .account-container').css('display' , 'none');
		$('.account .account-class').css('display' , 'block');
	});

	//修改學生
	$('.account .account-student-item .account-detail-icon').live('click' , function() {
		var Aid = $('.container .account-data .account-name').attr('data-id');
		var className = $('.account .studentData').attr('data-class');
		var name = $(this).attr('data-name');
		var ID = $(this).attr('data-Sid');
		var pass = $(this).attr('data-pass');
		BoxInit();

		$('.account .account-student-edit').css('display' , 'block');
		$('.account .account-editBox .account-student-name').val(name);
		$('.account .account-editBox .account-student-ID').val(ID);
		$('.account .account-editBox .account-student-pass').val(pass);
		$('.account .account-editBox .student-submit').attr({
			'data-id' : Aid , 
			'data-className' : className , 
			'data-oldID' : ID
		});
	});

	//學生修改送出
	$('.account .account-editBox .student-submit').click(function(){
		var Aid = $(this).attr('data-id');
		var className = $(this).attr('data-className');
		var oldID = $(this).attr('data-oldID');
		var name = $('.account .account-editBox .account-student-name').val();
		var ID = $('.account .account-editBox .account-student-ID').val();
		var pass = $('.account .account-editBox .account-student-pass').val();
		var IDChange = 0;

		if (name != "" && ID != "" && pass != "") {
			if (oldID == ID) {
				IDChange = 0;
			}else{
				IDChange = 1;
			}

			$.ajax({
				url: 'AccountEdit.php' , 
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					Aid: Aid , 
					oldID: oldID , 
					className: className , 
					name: name , 
					ID: ID , 
					pass: pass , 
					IDChange: IDChange ,
					type: 'editStudent'
				} , 
				error:function(error){
					console.log(error);
				} , 
				success:function(response){
					console.log(response);
					if (response > 0) {
						alert("該帳號已存在");
					}else{
						location.reload();
					}
				}
			});

			$(document).ajaxComplete(function(){
				// location.reload();
			});
		}else{
			alert("請輸入完整資料");
		}
	});

	//刪除學生
	$('.account .account-student-item .account-student-delete').live('click' , function() {
		var Aid = $('.container .account-data .account-name').attr('data-id');
		var className = $('.account .studentData').attr('data-class');
		var ID = $(this).attr('data-student');
		BoxInit();
		var check = confirm("確定刪除改學生?");

		if (check) {
			$.ajax({
				url: 'AccountEdit.php' , 
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					Aid: Aid , 
					ID: ID , 
					className: className , 
					type: 'deleteStudent'
				} , 
				error:function(error){
					alert(error);
				} , 
				success:function(response){
				}
			});

			$(document).ajaxComplete(function(){
				location.reload();
			});
		}
	});


	function BoxInit() {
		$('.account .account-single-upload').css('display' , 'none');
		$('.account .account-mult-upload').css('display' , 'none');
		$('.account .account-editBox').css('display' , 'none');
		$('.account .account-single-upload .single-style').val("");
		$('.account .account-editBox .edit-style').val("");
	}
});