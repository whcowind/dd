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

	$('.share-container').css('display' , 'block');

	//說明
	$('.share-container .share-instruction').click(function(){
		BoxInit();
		$('.share-instruction-mark').css('display' , 'block');
	});

	$('.instruction-btn').click(function(){
		BoxInit();
	});

	//上傳取消
	$('.upload-cancel').click(function(){
		BoxInit();
	});

	//上傳分享
	$('.share-ctrl .new-share').click(function(){
		BoxInit();
		$('.share-upload').css('display' , 'block');
	});

	//上傳分享送出
	$('.share-upload .upload-submit').click(function(){
		var name = $('.share-upload .share-upload-name').val();
		var title = $('.share-upload .share-upload-title').val();
		var pass = $('.share-upload .share-upload-pass').val();
		var sort = $('.share-upload #share-sort').find(":selected").val();
		var fileCheck = $('#Upload_share').val();

		if (name != '' && title != '' && fileCheck != '') {
			$.ajax({
				url: 'shareEdit.php' ,
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					name: name , 
					title: title , 
					pass: pass ,
					sort: sort , 
					type: 'newShare'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				$('.share-upload .shareID').val("");
				$('.share-upload .shareID').val(response);
			}).always(function(){
				if ($('#Upload_share').val() != '') {
					shareUpload();
				}else{
					UIkit.modal.alert("無檔案");
				}
			});
		}else{
			UIkit.modal.alert('請確認星號項目完整填寫並選擇檔案。');
		}
	});

	//分享詳細資料
	$(document).on('click' , '.share-list .share-detail-icon' , function(){
		BoxInit();
		$('.share-upload-edit').css('display' , 'block');
		var ID = $(this).attr('data-id');

		$.ajax({
			url: 'share_exist.php' ,
			method: 'GET' , 
			dataType: 'json' , 
			data:{
				ID: ID , 
				type: 'getShareData'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){

			$('.share-upload-edit .share-upload-name').val(response[0].name);
			$('.share-upload-edit .share-upload-title').val(response[0].title);
			$('.share-upload-edit .share-upload-pass').val(response[0].password);
			$('.share-upload-edit select').val(response[0].sort);
			$('.share-upload-edit .upload-submit').attr('data-id' , response[0].ID);
		});
	});

	//分享詳細資料取消
	$('.share-upload-edit .upload-cancel').click(function(){
		BoxInit();
	});

	//分享詳細資料修改
	$('.share-upload-edit .upload-submit').click(function(){
		var ID = $(this).attr('data-id');
		var name = $('.share-upload-edit .share-upload-name').val();
		var pass = $('.share-upload-edit .share-upload-pass').val();
		var title = $('.share-upload-edit .share-upload-title').val();
		var sort = $('.share-upload-edit .share-sort').val();
		var file = $('.share-upload-edit .Upload_edit_share').val();

		if (name != '' && ID != '') {
			
			if ($('#Upload_edit_share').val() != '') {
				UIkit.modal.confirm("檔案上傳後將覆蓋原檔案" , function(){
					$('.share-upload-edit .shareEditID').val(ID);
					$.ajax({
						url: 'shareEdit.php' ,
						method: 'POST' , 
						dataType: 'html' , 
						data:{
							ID: ID , 
							name: name , 
							pass: pass ,
							title: title , 
							sort: sort ,
							type: 'editShare'
						}
					}).fail(function(error){
						console.log(error);
					}).done(function(response){
						
					}).always(function(){
						if ($('#Upload_edit_share').val() != '') {
							shareEditUpload();
						}else{
							UIkit.modal.alert("無檔案");
						}
					});
				});
			}else{
				$.ajax({
					url: 'shareEdit.php' ,
					method: 'POST' , 
					dataType: 'html' , 
					data:{
						ID: ID , 
						name: name , 
						pass: pass ,
						title: title , 
						sort: sort ,
						type: 'editShare'
					}
				}).fail(function(error){
					console.log(error);
				}).done(function(response){
					location.reload();
				}).always(function(){
				});
			}
		}else{
			UIkit.modal.alert('請確認星號項目已完整填寫');
		}
	});

	//分享刪除
	$(document).on('click' , '.share-list .share-delete-icon' , function(){
		var ID = $(this).attr('data-id');

		UIkit.modal.confirm("確定刪除該分享？" , function(){
			$.ajax({
				url: 'shareEdit.php' ,
				method: 'POST' , 
				dataType: 'json' , 
				data:{
					ID: ID , 
					type: 'deleteShare'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){

			}).always(function(){
				location.reload();
			});
		});
	});


	function shareUpload(){
		var ID = $('.share-upload .shareID').val();
		ID = parseInt(ID);

	    $.ajaxFileUpload({
	        url:'shareUpload.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId:'Upload_share',
	        dataType:'json',
	        data:{
	        	id: ID
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

	function shareEditUpload(){
		var ID = $('.share-upload-edit .shareEditID').val();
		ID = parseInt(ID);

	    $.ajaxFileUpload({
	        url:'shareUpload.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId:'Upload_edit_share',
	        dataType:'json',
	        data:{
	        	id: ID
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

	function BoxInit() {
		$('.share-upload').css('display' , 'none');
		$('.share-instruction-mark').css('display' , 'none');
		$('.share-editBox').css('display' , 'none');
		UploadInit();
		DetailInit();
	}

	function UploadInit() {
		$('.upload-style').val('');
	}

	function DetailInit() {
		$('.edit-style').val('');
	}
});