	
	$('.share_Box').click(function(){
		$('.account').css('display' , 'none');
		$('.class').css('display' , 'none');
		$('.exam').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'none');
		$('.markSA').css('display' , 'none');
		$('.share').css('display' , 'block');
		$('.result').css('display' , 'none');
		$('share_up').val('');
		closeMakeQuestion();
		shareList();
	});

	$('.share .upload').click(function(){
		var file_check = $('#fileToUpload_share').val();
		var upName = $('.share_up .upName').val();
		var upTitle = $('.share_up .upTitle').val();

		if(file_check == '' || upName == '' || upTitle == ''){
			alert("請確認姓名、標題及檔案。");
		}else{
			var Aclass = $('.share .classTemp').val();
			$.ajax({
				url: 'share.php' , 
				type: 'GET' , 
				dataType: 'json' , 
				data:{
					Aclass: Aclass , 
					upName: upName ,
					upTitle: upTitle ,
					Type: "new_share"
				} , 
				error:function(err){
					console.log(err);
				} , 
				success:function(response){
					$('.share_up .IDTemp').val(response);
				} , 
				complete:function(){
					if ($('#fileToUpload_share').val() != '') {
						share_upload();
					}
					else{
						alert('error');
					}
				}
			});
		}
	});

	$('.share_view .del').live('click' , function(){
		var Aclass = $('.share .classTemp').val();
		var className = $(this).attr('data-className');
		var ID = $(this).attr('data-id');

		if (Aclass == className) {
			var check = confirm("確認刪除?");

			if (check) {
				$.ajax({
					url: 'share.php' , 
					type: 'GET' , 
					dataType: 'json' , 
					data:{
						Aclass: Aclass , 
						ID: ID ,
						Type: "del"
					} , 
					error:function(err){
						console.log(err);
					} , 
					complete:function(){
						location.reload();
					}
				});
			}
		}
		else{
			alert('該檔案為他人上傳，無權刪除。');
		}
	});

	$('.share_view .download').click(function(){
		// $('.download').attr({target: '_blank', href: '/cross.png'});
	});

	function shareList() {
		var className = $('.share .classTemp').val();
	}

	function share_upload(){
		var ID = $('.share_up .IDTemp').val();

	    $.ajaxFileUpload({
	        url:'file_upload_share.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId:'fileToUpload_share',
	        dataType:'json',
	        data:{
	        	ID: ID
	        } ,
	        success: function (data, status){
				location.reload();
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
	}