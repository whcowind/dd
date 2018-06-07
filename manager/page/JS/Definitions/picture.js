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

	$('.picture-container').css('display' , 'block');

	//說明
	$('.picture-container .picture-instruction').click(function(){
		BoxInit();
		$('.picture-instruction-mark').css('display' , 'block');
	});

	$('.instruction-btn').click(function(){
		BoxInit();
	});

	// -----------------------------------------------------------------
	// 								共用
	// -----------------------------------------------------------------


	//覆蓋取消
	$('.picture-cover .picture-cancel').click(function(){
		BoxInit();
	});


	//刪除圖片
	$('.picture-ctrl .del-picture').click(function(){
		console.log(imgArr);
		var str = '';
		for (var i = 0; i < imgArr.length; i++) {
			str = str + ' - ' + imgArr[i];
		}

		UIkit.modal.confirm('確定刪除圖片編號 ' + str  + ' 之圖片？', function(){
			$.ajax({
				url: 'picture_exist.php' , 
				type: 'GET' , 
				dataType: 'json' , 
				data:{
					imgArr: imgArr , 
					type: 'del'
				} , 
				error:function(error){
					console.log(error);
					location.reload();
				} , 
				success:function(response){
					console.log(response);
				} , 
				always:function(){
					location.reload();
				}
			});
		});

	});

	//覆蓋圖片
	$('.picture-ctrl .cover-picture').click(function(){
		BoxInit();
		$('.picture-cover').css('display' , 'block');
	});

	var imgArr = [];

	$(document).on('click' , '.picture-exist' , function(){
		var toggle = $(this).attr('data-toggle');

		if (toggle == undefined || toggle == 0) {
			$(this).css('border' , '7px solid #5CB52A');
			$(this).attr('data-toggle' , 1);

			var id = $(this).attr('data-id');	
			for(var arrayindex = 0; arrayindex < imgArr.length; arrayindex++){
				if(imgArr[arrayindex] == id){
					imgArr.splice(arrayindex,1);
				}
			}
			imgArr.push(id);
		}else{
			$(this).css('border' , '7px solid #ECEDF0');
			$(this).attr('data-toggle' , 0);

			var id = $(this).attr('data-id');
			for(var arrayindex = 0; arrayindex < imgArr.length; arrayindex++){
				if(imgArr[arrayindex] == id){
					imgArr.splice(arrayindex,1);
				}
			}
		}
	});

	//覆蓋送出
	$('.picture-cover .picture-upload').click(function(){
		var id = $('.picture-cover .id').val();

		if ($.isNumeric(id)) {

			if ($('.file_picture_cover').val() != "") {
				fileUpload(id);
			}else{
				UIkit.modal.alert('請放入圖片');
			}

		}else{
			UIkit.modal.alert('請輸入圖片編號');
		}
	});


	//file upload
	function fileUpload(id){

	    $.ajaxFileUpload({
	        url:'file_upload.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId:'fileToUpload',
	        dataType:'json',
	        data:{
	        	id: id
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
		$('.picture-cover').css('display' , 'none');
		$('.picture-instruction-mark').css('display' , 'none');
		$('.picture-cover .file_picture_cover').val("");
		$('.picture-cover .id').val("");
	}
});