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

	$('.grade-container').css('display' , 'block');

	// -----------------------------------------------------------------
	// 								帳號管理
	// -----------------------------------------------------------------

	//說明
	$('.grade-container .grade-instruction').click(function(){
		BoxInit();
		$('.grade-instruction-mark').css('display' , 'block');
	});

	$('.instruction-btn').click(function(){
		BoxInit();
	});



	// -----------------------------------------------------------------
	// 								試卷
	// -----------------------------------------------------------------

	//試卷詳細資料
	$(document).on('click' , '.grade-list .grade-detail-icon' , function(){
		BoxInit();
		$('.grade-editBox').css('display' , 'block');

		var aid = $(this).attr('data-aid');
		var pid = $(this).attr('data-pid');
		var teacherID = $(this).attr('data-teacherID');
		var PTitle = $(this).attr('data-PTitle');
		var Aname = $(this).attr('data-Aname');

		$.ajax({
			url: 'grade_exist.php' ,
			method: 'GET' , 
			dataType: 'json' , 
			data:{
				paperID: pid , 
				aid: aid ,
				type: 'grade_detail'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			console.log(response);

			$('.grade-editBox .edit-text').html("");
			$('.grade-editBox .edit-text').html(aid + '. ' + PTitle + ' (' + Aname + ') ');
			$('.grade-editBox .editBox').html("");

			for (var i = 0; i < response.length; i++) {

				if (response[i].Time == "") {
					$('.grade-editBox .editBox').append("<div class = 'edit-style'><div class = 'edit-name'>" + response[i].Sname + "</div><div class = 'edit-grade'>未作答</div></div>");
				}else{
					$('.grade-editBox .editBox').append("<div class = 'edit-style'><div class = 'edit-name'>" + response[i].Sname + "</div><div class = 'edit-grade'>" + response[i].grade + "分</div><div class = 'edit-time'>" + response[i].Time + "</div></div>");
				}
			}
			
		});
	});

	//試卷詳細資料取消
	$('.grade-editBox .grade-cancel').click(function(){
		BoxInit();
	});

	//試卷刪除
	$(document).on('click' , '.grade-list .grade-delete-icon' , function(){
		var aid = $(this).attr('data-aid');

		UIkit.modal.confirm("確定刪除該份成績？" , function(){
			$.ajax({
				url: 'grade_exist.php' ,
				method: 'GET' , 
				dataType: 'json' , 
				data:{
					aid: aid , 
					type: 'del'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){

			}).always(function(){
				location.reload();
			});
		});
	});

	function BoxInit() {
		$('.grade-instruction-mark').css('display' , 'none');
		$('.grade-editBox').css('display' , 'none');
		DetailInit();
	}

	function DetailInit() {
		$('.grade-editBox .edit-style').val('');
	}

});