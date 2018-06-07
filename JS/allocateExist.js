	//查看該測驗學生
	$('.exam').find('.exam-allocate .existBox .lookListBtn').live('click' , function(){
		$('.exam').find('.exam-allocate .existBox .listTable').css('display' , 'inline-block');
		lisiInit();
	});

	//關閉查看視窗
	$('.exam').find('.exam-allocate .existBox .listClose').click(function(){
		$('.exam').find('.exam-allocate .existBox .listTable').css('display' , 'none');
		lisiInit();
	});

	//終止測驗
	$('.exam').find('.exam-allocate .existBox .EndExamBtn').live('click' , function(){
		var check = confirm("是否終止測驗?");

		if(check) {
			var ID = $(this).closest('.allocateID').attr('data-id');

			$.ajax({
				url: 'allocatePaper.php' , 
				type: 'GET' , 
				dataType: 'html' , 
				data:{
					ID: ID , 
					Type: 'End'
				} , 
				error:function(err){
					alert(err);
				} , 
				success:function(response){

				}
			});

			$(document).ajaxComplete(function(){
				lisiInit();
				$('.exam').find('.exam-allocate .existBox .listTable').css('display' , 'none');
				window.location.href = "Amain.php";
			});
		}
	});


	//刪除測驗
	$('.exam').find('.exam-allocate .existBox .deleteBtn').live('click' , function(){
		var check = confirm('是否刪除此測驗?');

		if(check) {
			var ID = $(this).closest('.allocateID').attr('data-id');

			$.ajax({
				url: 'allocatePaper.php' , 
				type: 'GET' , 
				dataType: 'html' , 
				data:{
					ID: ID ,
					Type: 'Delete'
				} , 
				error:function(err){
					alert(err);
				} , 
				success:function(response){

				}
			});

			$(document).ajaxComplete(function(){
				lisiInit();
				$('.exam').find('.exam-allocate .existBox .listTable').css('display' , 'none');
				window.location.href = "Amain.php";
			});
		}
	});


	$('.lookListBtn').live('click' , function(){
		var ID = $(this).closest('.allocateID').attr('data-id');

		$.ajax({
			url: 'allocatePaper.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				ID: ID ,
				Type: 'List'
			} ,
			error:function(err){
				alert(err);
			} , 
			success:function(response){
				lisiInit();
				for (var i = 0; i < response.length; i++) {
					if(response[i].allocateID == ID){
						$('.exam').find('.exam-allocate .existBox .listTop').html('');
						$('.exam').find('.exam-allocate .listTop').append("<div>" + response[i].allocateID + " . " + response[i].PTitle + "</div>");
					}

					if(response[i].allocateID == ID) {
						$('.exam').find('.exam-allocate .listContent').append("<div class = 'list'>" + response[i].studentID + "</div>");
					}
				}
			}
		});

	});



	function lisiInit() {
		$('.exam').find('.exam-allocate .existBox .listTop').html('');
		$('.exam').find('.exam-allocate .listContent').html('');
	}