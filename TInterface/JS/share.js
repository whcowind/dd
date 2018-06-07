	
	$('.share_Box').click(function(){
		$('.account').css('display' , 'none');
		$('.class').css('display' , 'none');
		$('.exam').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'none');
		$('.markSA').css('display' , 'none');
		$('.share').css('display' , 'block');
		$('.result').css('display' , 'none');
		$('.IMGManagerBox').css('display' , 'none');
		$('share_up').val('');
		closeMakeQuestion();
		shareList();
	});

	$('.share_view .share_item a').live('click' , function(){
		if ($(this).attr('data-check') == 'N') {

			var pass = prompt("請輸入密碼");

			if (pass != "") {
				var ID = $(this).attr('data-ID');
				$.ajax({
					url: 'share.php' , 
					type: 'GET' , 
					dataType: 'json' , 
					data:{
						ID: ID , 
						pass: pass , 
						Type: "passCheck"
					} , 
					error:function(err){
						console.log(err);
					} , 
					success:function(response){
						console.log(response);

						if (response[0].check == '0') {
							alert("密碼錯誤");
						}else{
							$('.share_view .share_item .' + ID).attr({'href' : response[0].path , 'download' : response[0].title , 'data-check' : 'Y'});
							$('.share_view .share_item .' + ID).find(".download").attr('src' , 'image/download.png');
						}
					} , 
					complete:function(){

					}
				});
			}

		}
	});

	$('.share .upload').click(function(){
		var file_check = $('#fileToUpload_share').val();
		var upName = $('.share_up .upName').val();
		var upTitle = $('.share_up .upTitle').val();
		var sort = $('.share_up .upSort').find(":selected").val();
		var pass = $('.share_up .upPass').val();

		if(file_check == '' || upName == '' || upTitle == ''){
			alert("請確認姓名、標題及檔案。");
		}else{
			var teacherID = $('.container').find('.account-data .account-name').attr('data-id');
			$.ajax({
				url: 'share.php' , 
				type: 'GET' , 
				dataType: 'json' , 
				data:{
					teacherID: teacherID , 
					sort: sort ,
					pass: pass ,
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
		var teacherID = $('.container').find('.account-data .account-name').attr('data-id');
		var Aid = $(this).attr('data-Aid');
		var ID = $(this).attr('data-id');

		if (teacherID == Aid) {
			var check = confirm("確認刪除?");

			if (check) {
				$.ajax({
					url: 'share.php' , 
					type: 'GET' , 
					dataType: 'json' , 
					data:{
						teacherID: teacherID , 
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
		// var teacherID = $('.container').find('.account-data .account-name').attr('data-id');
		$.ajax({
			url: 'share.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				Type: "getList"
			} , 
			error:function(err){
				console.log(err);
			} , 
			success:function(response){
				console.log(response);
				var namelist = new Array();

				$('.share .share_view').html("");

				for (var i = 0; i < response.length; i++) {
					var sortTemp  = response[i].sort;
					var sortText = "";

					var group_index = namelist.indexOf(response[i].name);
					if(group_index==-1){
						namelist.push(response[i].name);
						group_index = namelist.length;
						$('.share .share_view').append("<div class = 'share_group_"+group_index+"' style='padding:10px 30px;line'></div>")
					}else{
						// group_index從1開始 array從0
						group_index++;
					}


					switch (sortTemp) {
						case '1' :
							sortText = "數學";
							break;
						case '2' :
							sortText = "科學";
							break;
						case '3' :
							sortText = "閱讀";
							break;
						case '4' :
							sortText = "其他";
							break;
					}

// $('.share .share_view').append("<div class = 'share_group_"+group_index+"'></div>")
					if (response[i].password != "") {
						$('.share .share_view .share_group_'+group_index).append("<div class = 'share_item'  ><img class = 'item_img' src = 'image/downloadimg.png' style = 'width:28px; height:28px;'/><div class = 'name'>" + response[i].name + "</div><div class = 'title'>" + response[i].title + "</div><div class = 'sort'>" + sortText + "</div><div class = 'time'>" + response[i].upTime + "</div><a data-check = 'N' class = '" + response[i].ID + "' data-ID = '" + response[i].ID + "'><img class = 'download' src = 'image/lock.png' title = '下載' /></a><img class = 'del' src = 'image/cross.png' title = '刪除' data-id = '" + response[i].ID + "' data-Aid = '" + response[i].Aid + "' /></div>");
						// $('.share .share_view').append("<div class = 'share_item'><img class = 'item_img' src = 'image/downloadimg.png' style = 'width:28px; height:28px;'/><div class = 'name'>" + response[i].name + "</div><div class = 'title'>" + response[i].title + "</div><div class = 'sort'>" + sortText + "</div><div class = 'time'>" + response[i].upTime + "</div><a data-check = 'N' class = '" + response[i].ID + "' data-ID = '" + response[i].ID + "'><img class = 'download' src = 'image/lock.png' title = '下載' /></a><img class = 'del' src = 'image/cross.png' title = '刪除' data-id = '" + response[i].ID + "' data-Aid = '" + response[i].Aid + "' /></div>");
					}else if(response[i].password == ""){
						$('.share .share_view .share_group_'+group_index).append("<div class = 'share_item'><img class = 'item_img' src = 'image/downloadimg.png' style = 'width:28px; height:28px;'/><div class = 'name'>" + response[i].name + "</div><div class = 'title'>" + response[i].title + "</div><div class = 'sort'>" + sortText + "</div><div class = 'time'>" + response[i].upTime + "</div><a href = '" + response[i].file_path + "' download = '" + response[i].title + "'><img class = 'download' src = 'image/download.png' title = '下載' /></a><img class = 'del' src = 'image/cross.png' title = '刪除' data-id = '" + response[i].ID + "' data-Aid = '" + response[i].Aid + "' /></div>");
						// $('.share .share_view').append("<div class = 'share_item'><img class = 'item_img' src = 'image/downloadimg.png' style = 'width:28px; height:28px;'/><div class = 'name'>" + response[i].name + "</div><div class = 'title'>" + response[i].title + "</div><div class = 'sort'>" + sortText + "</div><div class = 'time'>" + response[i].upTime + "</div><a href = '" + response[i].file_path + "' download = '" + response[i].title + "'><img class = 'download' src = 'image/download.png' title = '下載' /></a><img class = 'del' src = 'image/cross.png' title = '刪除' data-id = '" + response[i].ID + "' data-Aid = '" + response[i].Aid + "' /></div>");
					}else{
						console.log('share error');
					}


				}

				// // 取全部name不重複 然後設click 每次按click就會顯示 display就block
				for (var index in namelist) {
					// group_index從1開始 array從0
					index++;
					var group = $('.share .share_view .share_group_'+index);
					// 數量大於1的才要群組 
					if(group.find('.share_item').length > 1 ){

						group.prepend("<img class = 'group_img' src = 'image/document.png' style = 'width:28px; height:28px;'/><span class = 'group_name' style='margin:0px 50px;line-height:30px;'>" + namelist[index-1] + "</span>");
						group.find('.share_item').css('display','none');

						group.find('img').unbind('click').click(function(){
							var element = $(this).parent().find('.share_item');

							if(element.css('display')=='none')
								{element.css('display','block');}
							else{element.css('display','none');}
							 
						});
					}
					
				}


			} , 
			complete:function(){
				
			}
		});
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