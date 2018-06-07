	$('.IMG_Box').click(function(){
		$('.account').css('display' , 'none');
		$('.class').css('display' , 'none');
		$('.exam').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'none');
		$('.markSA').css('display' , 'none');
		$('.share').css('display' , 'none');
		$('.result').css('display' , 'none');
		$('.IMGManagerBox').css('display' , 'block');
		closeMakeQuestion();
	});

	$('.IMGManagerBox .top_area .up').click(function(){
		$('.upBox').css('display' , 'block');
	});

	$('.IMGManagerBox .img-cancel').click(function(){
		$('.upBox').css('display' , 'none');
	});

	$('.IMGManagerBox .img-upload').click(function(){
		var id = $('.IMGManagerBox .AidTemp').val();
		ajaxFileUploaded(id);
	});

	var imgArr = [];

	$('.IMGManagerBox .img_list .imageExist').live('click' , function(){
		var toggle = $(this).attr('data-toggle');

		if (toggle == undefined || toggle == 0) {
			$(this).css('border' , '7px solid #5CB52A');
			$(this).attr('data-toggle' , 1);

			var id = $(this).attr('data-attr');	
			for(var arrayindex = 0; arrayindex < imgArr.length; arrayindex++){
				if(imgArr[arrayindex] == id){
					imgArr.splice(arrayindex,1);
				}
			}
			imgArr.push(id);
		}else{
			$(this).css('border' , '7px solid rgb(242,242,242)');
			$(this).attr('data-toggle' , 0);

			var id = $(this).attr('data-attr');
			for(var arrayindex = 0; arrayindex < imgArr.length; arrayindex++){
				if(imgArr[arrayindex] == id){
					imgArr.splice(arrayindex,1);
				}
			}
		}
	});

	//刪除圖片
	$('.IMGManagerBox .top_area .del').click(function(){
		console.log(imgArr);
		var str = '';
		for (var i = 0; i < imgArr.length; i++) {
			str = str + ' - ' + imgArr[i];
		}

		var check = confirm('確定刪除圖片編號 ' + str  + ' 之圖片？');

		if (check) {
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
		}

	});

	function ajaxFileUploaded(id){
	    $.ajaxFileUpload({
	        url:'doajaxfileupload1.php', 
	        type:'POST', 
	        secureuri:false,
	        fileElementId:'fileToUpload1',
	        dataType:'json',
	        data:{
	        	teacherID: id , 
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