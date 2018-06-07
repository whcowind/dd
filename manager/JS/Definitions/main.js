$(document).ready(function(){
	//Title
	$('.top_text').html("<img src='image/icon/home.png' style='margin-right:20px; margin-bottom:10px;'>機器人系系網 - 中文版管理頁面");

	//check cookie
	var cookieVal = $.cookie("Guide");

	if (cookieVal != "") {
		$('.csvbox').css('display' , 'none');
		switch(cookieVal) {
			case '1':
				$('.excution_board').css('display' , 'block');
				$.removeCookie("Guide");
				break;

			case '2':
				$('.excution_departmentIntro').css('display' , 'block');
				get_department_data();
				$.removeCookie("Guide");
				break;

			case '3':
				$('.excution_personnel').css('display' , 'block');
				$.removeCookie("Guide");
				break

			case '4':
				$('.excution_curriculum').css('display' , 'block');
				get_curriculum_data();
				$.removeCookie("Guide");
				break;

			case '5':
				$('.excution_lab').css('display' , 'block');
				$.removeCookie("Guide");
				break;

			case '6':
				$('.excution_law').css('display' , 'block');
				$.removeCookie("Guide");
				break;

			case '7':
				$('.excution_admissionList').css('display' , 'block');
				$.removeCookie("Guide");
				break;

			case '8':
				$('.excution_maplink').css('display' , 'block');
				$.removeCookie("Guide");
				break;

			case '9':
				$('.excution_result').css('display' , 'block');
				$.removeCookie("Guide");
				break;

			default:
			$('.csvbox').css('display' , 'block');
		}
	}

	//home
	$('.top_text').click(function(){
		window.location.href = 'main.php';
	});

	//change page
	$('.sort').click(function(){
		var page_name = $(this).attr('data-page');
		$('.csvbox').css('display' , 'none');
		$('.main_container .page').css('display' , 'none');

		//switch page
		switch(page_name) {
			case 'excution_board':
				$('.excution_board').css('display' , 'block');
				break;

			case 'excution_departmentIntro':
				$('.excution_departmentIntro').css('display' , 'block');
				get_department_data();
				break;

			case 'excution_personnel':
				$('.excution_personnel').css('display' , 'block');
				break;

			case 'excution_curriculum':
				$('.excution_curriculum').css('display' , 'block');
				get_curriculum_data();
				break;

			case 'excution_lab':
				$('.excution_lab').css('display' , 'block');
				break;

			case 'excution_law':
				$('.excution_law').css('display' , 'block');
				break;

			case 'excution_admissionList':
				$('.excution_admissionList').css('display' , 'block');
				break;

			case 'excution_maplink':
				$('.excution_maplink').css('display' , 'block');
				break;

			case 'excution_result':
				$('.excution_result').css('display' , 'block');
				break;

			case 'logout':
				$.ajax({
					url: 'logout.php' ,
					dataType: 'html'
				}).fail(function(err){
					UIkit.modal.alert('error');
				}).done(function(response){
					window.location.href = response;
				});
				break;

			case 'goEn':
				window.location.href = "E_main.php";
				break;

			default:
				UIkit.modal.alert('change page error');
		}
	});

	// -----------------------------------------------------------------
	// 								CSV
	// -----------------------------------------------------------------

	$('.csvbox .submit').click(function(){
		UIkit.notify("<i class = 'uk-icon-upload'></i>   please waite...", {status:'warning'} , {timeout: 500} );
		setTimeout(function(){
			location.reload();
		}, 800);
	});


	// -----------------------------------------------------------------
	// 								Board
	// -----------------------------------------------------------------

	//go to edit new board message
	$('.new_board').click(function(){
		board_init();
		$('.delete_board').css('display' , 'none');
		$('.hint_board').css('display' , 'none');
		$('.download_board').css('display' , 'none');
	});

	//go to update board message
	$(document).on('click' , '.item_board' , function(){
		board_init();
		$('.delete_board').css('display' , 'block');
		$('.hint_board').css('display' , 'block');
		$('.download_board').css('display' , 'block');
		$('.subtype').css('display' , 'inline-block');

		var BID = $(this).attr('id');
		$('.ID_board').val(BID);
		$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_board' ,
				BID: BID
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			console.log(response);
			$('.title_text_board').val(response[0].title);
			$('.content_text_board').val(response[0].content);

			$('.name').each(function(index){
				if (response[0]['file'][index].filename != "") {
					var str = response[0]['file'][index].file_path;
					str = str.split("/");
					str = str[2].split(".");
					str[0] = response[0]['file'][index].filename;
					var sub = str[1];
					var main = str[0];
					str = str[0] + '.' + str[1];
					$(this).val(response[0]['file'][index].filename);
					$(this).attr('data-name' , response[0]['file'][index].filename);
					$('.box_board').find('#' + (index + 1)).css('background-image' , 'url(../department/image/icon/check.png)');
					$('.download_board').find('.download_board' + index).attr({'href':response[0]['file'][index].file_path , 'download':str});
					$(this).parent().find('.subtype').val('.' + sub);
					$(this).parent().find('.board_delbtn').prop('disabled' , false);
					$(this).parent().find('.board_delbtn').css('cursor' , 'pointer');
					$(this).parent().find('.board_delbtn').attr({'data-main':main , 'data-sub':sub , 'data-a':1});
				}
				else{
					$(this).attr('data-name' , '附件' + (index + 1));
				}
			});
		});
	});

	$('.board_delbtn').click(function(){
		var BID = $('.ID_board').val();
		var id = $(this).parent().find('.file_box_board').attr('id');
		var checkSub = $(this).attr('data-a');

		if (BID == "") {
			$(this).parent().find('.file_board').val('');
			$(this).parent().find('.file_box_board').css('background-image' , 'url(image/icon/file-upload.png)');
			$(this).prop('disabled' , 'true');
			$(this).css('cursor' , 'not-allowed');
			$(this).parent().find('.name').val('附件' + id);
		}
		else if(BID != "" && checkSub == '0'){
			$(this).parent().find('.file_board').val('');
			$(this).parent().find('.file_box_board').css('background-image' , 'url(image/icon/file-upload.png)');
			$(this).prop('disabled' , 'true');
			$(this).css('cursor' , 'not-allowed');
			$(this).parent().find('.name').val('附件' + id);
		}
		else{
			var c = parseInt($(this).attr('data-c'));

			if (c) {
				var main = $(this).attr('data-main');
				var sub = $(this).attr('data-sub');
				// $(this).removeClass('uk-active');
				$(this).removeClass('uk-button-success');
				$(this).addClass('uk-button-danger');
				$(this).html('刪除');
				$(this).parent().find('.trash').css('display' , 'none');
				$(this).attr('data-c' , '0');
				$(this).parent().find('.file_box_board').css('background-image' , 'url(image/icon/check.png)');
				$(this).parent().find('.name').val(main);
				$(this).parent().find('.subtype').val(sub);
				$(this).parent().find('.file_board').val('');
			}else{
				// $(this).addClass('uk-active');
				$(this).addClass('uk-button-success');
				$(this).removeClass('uk-button-danger');
				$(this).html('還原');
				$(this).parent().find('.trash').css('display' , 'inline-block');
				$(this).attr('data-c' , '1');
				$(this).parent().find('.file_box_board').css('background-image' , 'url(image/icon/file-upload.png)');
				$(this).parent().find('.name').val('附件' + id);
				$(this).parent().find('.subtype').val('');
			}
		}

	});

	//submit board
	$('.submit_board').click(function(){
		var title = $('.title_text_board').val();
		var content = $('.content_text_board').val();
		var BID = $('.ID_board').val();

		if (BID != "" && title != "" && content != "" ) {
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'update_board' ,
					title: title ,
					content: content ,
					BID: BID
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){

			}).always(function(){
				var id = $('.ID_board').val();

				UIkit.notify("<i class = 'uk-icon-upload'></i>   please waite...", {status:'warning'} , {timeout: 2000} );
				setTimeout(function(){
					$.cookie("Guide" , 1);
					location.reload();
				}, 3000);
				$('.file_board').each(function(index){
					var file = $(this).val();
					var old_name = $('.name' + (index + 1)).attr('data-name');
					var new_name = $('.name' + (index + 1)).val();
					var c = parseInt($(this).parent().parent().find('.board_delbtn').attr('data-c'));

					if (file != "") {
						setTimeout(function(){ upload(id , index); }, 520);
					}
					else if(file == "" && old_name != new_name && c == 0){
						if (new_name != "") {
						}
						else{
							new_name = "附件" + (index + 1);
						}

						$.ajax({
							url: 'edit.php' ,
							method: 'POST' ,
							dataType: 'html' ,
							data:{
								type: 'edit_filename' ,
								BID: id ,
								filename: new_name ,
								index: index
							}
						}).fail(function(err){
							console.log(err);
							UIkit.modal.alert('error');
						}).done(function(response){
							$.cookie("Guide" , 1);
							location.reload();
						});
					}
					else if(file == "" & c == 1){
						$.ajax({
							url: 'edit.php' ,
							method: 'POST' ,
							dataType: 'html' ,
							data:{
								type: 'del_filename' ,
								BID: id ,
								index: index
							}
						}).fail(function(err){
							console.log(err);
							UIkit.modal.alert('error');
						}).done(function(response){
							$.cookie("Guide" , 1);
							location.reload();
						});
					}
					else{

					}
				});
			});
		}
		else if(title == "" || content == ""){
			UIkit.modal.alert('主旨 or 內容 未輸入');
		}
		else{
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'new_board' ,
					title: title ,
					content: content
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){
				$('.ID_board').val(response);
			}).always(function(){
				var id = $('.ID_board').val();

				UIkit.notify("<i class = 'uk-icon-upload'></i>   please waite...", {status:'warning'} , {timeout: 2000} );
				setTimeout(function(){
					$.cookie("Guide" , 1);
					location.reload();
				}, 3000);

				$('.file_board').each(function(index){
					var file = $(this).val();

					if (file != "") {
						setTimeout(function(){ upload(id , index); }, 520);
					}
				});
			});
		}
	});

	//delete board
	$('.delete_board').click(function(){
		UIkit.modal.confirm("確定要刪除公告？" , function(){
			var BID = $('.ID_board').val()
			if (BID != "") {
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'delete_board' ,
						BID: BID
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){
					$.cookie("Guide" , 1);
					location.reload();
				});
			}
			else{
				UIkit.modal.alert('error');
			}
		});
	});

	function upload(id , index) {
		var fileid = index + 1;
		// alert(fileid);
		$.ajaxFileUpload({
	        url:'file_upload_board.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId: 'file_board' + fileid,
	        dataType:'json',
	        data:{
	        	id: id ,
	        	index: index ,
	        	name: $('.name' + fileid).val()
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


	//Board init
	function board_init() {
		$('.title_text_board').val("");
		$('.content_text_board').val("");
		$('.ID_board').val("");
		$('.file_board').val("");
		$('.file_box_board').css('background-image' , 'url(image/icon/file-upload.png)');
		$('.name1').val('附件1');
		$('.name2').val('附件2');
		$('.name3').val('附件3');
		$('.name4').val('附件4');
		$('.name5').val('附件5');
		$('.download_board_link').attr('href' , '');
		$('.download_board_link').attr('download' , '');
		$('.subtype').val('');
		$('.subtype').css('display' , 'none');
		$('.board_delbtn').prop('disabled' , 'true');
		$('.board_delbtn').css('cursor' , 'not-allowed');
		$('.board_delbtn').attr('data-c' , '0');
	}


	// -----------------------------------------------------------------
	// 						Department Introduction
	// -----------------------------------------------------------------

	$('.submit_departmentIntro').click(function(){
		UIkit.modal.confirm("確定修改？" , function(){
			var content = $('.content_text_departmentIntro').val();
			var feature = $('.feature_text_departmentIntro').val();
			var target = $('.target_text_departmentIntro').val();
			var core = $('.core_text_departmentIntro').val();
			var future = $('.future_text_departmentIntro').val();
			var lab = $('.lab_text_departmentIntro').val();

			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'update_departmentIntro' ,
					content: content ,
					feature: feature ,
					target: target ,
					core: core ,
					future: future ,
					lab: lab
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){
				$.cookie("Guide" , 2);
				location.reload();
			});
		});
	});

	function get_department_data(){
		$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_departmentIntro'
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			$('.content_text_departmentIntro').val(response[0].content);
			$('.feature_text_departmentIntro').val(response[0].feature);
			$('.target_text_departmentIntro').val(response[0].target);
			$('.core_text_departmentIntro').val(response[0].core);
			$('.future_text_departmentIntro').val(response[0].future);
			$('.lab_text_departmentIntro').val(response[0].lab);
		});
	}


	// -----------------------------------------------------------------
	// 								Personnel
	// -----------------------------------------------------------------

	//go to edit new personnel
	$('.new_personnel').click(function(){
		personnel_init();
		$('.delete_personnel').css('display' , 'none');
		// $('.picbox_personnel').css('display' , 'none');
	});

	//submit
	$('.submit_personnel').click(function(){
		var name = $('.name_text_personnel').val();
		var office = $('.office_text_personnel').val();
		var educationBG = $('.educationBG_text_personnel').val();
		var mail = $('.mail_text_personnel').val();
		var web = $('.web_text_personnel').val();
		var lab = $('.lab_text_personnel').val();
		var phone = $('.phone_text_personnel').val();
		var source = $('.source_text_personnel').val();
		var specialty = $('.specialty_text_personnel').val();
		var work = $('.work_text_personnel').val();
		var importantDeed = $('.importantDeed_text_personnel').val();
		var research = $('.research_text_personnel').val();
		var TID = $('.ID_personnel').val();
		var photo = $('.file_personnel').val();

		if (TID != "") {
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'update_personnel' ,
					name: name ,
					office: office ,
					educationBG: educationBG ,
					mail: mail ,
					web: web ,
					lab: lab ,
					phone: phone ,
					source: source ,
					specialty: specialty ,
					work: work ,
					importantDeed: importantDeed ,
					research: research ,
					TID: TID
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){

			}).always(function(){
				if (photo != "") {
					personnel_upload(TID);
				}
				else{
					$.cookie("Guide" , 3);
					location.reload();
				}
			});
		}
		else if(name == "" || office == "" || educationBG == "" || mail == "" || specialty == ""){
			UIkit.modal.alert('請確認 * 項目已輸入');
		}
		else{
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'new_personnel' ,
					name: name ,
					office: office ,
					educationBG: educationBG ,
					mail: mail ,
					web: web ,
					lab: lab ,
					phone: phone ,
					source: source ,
					specialty: specialty ,
					work: work ,
					importantDeed: importantDeed ,
					research: research
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){
				$('.ID_personnel').val(response);
			}).always(function(){
				if (photo != "") {
					var id = $('.ID_personnel').val();
					personnel_upload(id);
				}
				else{
					$.cookie("Guide" , 3);
					location.reload();
				}
			});
		}
	});

	//go to update personnel message
	$(document).on('click' , '.item_personnel' , function(){
		personnel_init();
		$('.delete_personnel').css('display' , 'block');
		// $('.picbox_personnel').css('display' , 'block');
		var TID = $(this).attr('id');
		$('.ID_personnel').val(TID);
		$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_personnel' ,
				TID: TID
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			console.log(response);
			$('.name_text_personnel').val(response[0].Tname);
			$('.office_text_personnel').val(response[0].office);
			$('.educationBG_text_personnel').val(response[0].educationBG);
			$('.mail_text_personnel').val(response[0].mail);
			$('.web_text_personnel').val(response[0].web);
			$('.lab_text_personnel').val(response[0].lab);
			$('.phone_text_personnel').val(response[0].phone);
			$('.source_text_personnel').val(response[0].source);
			$('.specialty_text_personnel').val(response[0].specialty);
			$('.work_text_personnel').val(response[0].workBG);
			$('.importantDeed_text_personnel').val(response[0].importantDeed);
			$('.research_text_personnel').val(response[0].research);
			if (response[0].photo_url != 'null') {
				$('.pic_personnel').attr('src' , response[0].photo_url);
			}
		
		});
	});

	//delete personnel
	$('.delete_personnel').click(function(){

		UIkit.modal.confirm("確認刪除該人員？" , function(){
			var TID = $('.ID_personnel').val();
			if (TID != "") {
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'delete_personnel' ,
						TID: TID
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){
					$.cookie("Guide" , 3);
					location.reload();
				});
			}
			else{
				UIkit.modal.alert('error');
			}
		});
	});

	//-------------------------------------
	// 	Personnel head phto file upload
	//-------------------------------------

	function personnel_upload(id) {

		var id = id;

	    $.ajaxFileUpload({
	        url:'personnelUpload.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId:'personnel',
	        dataType:'JSON',
	        data:{
	        	id: id
	        } ,
	        success: function (data, status){
	        	$.cookie("Guide" , 3);
				location.reload();
	            if(typeof(data.error) != 'undefined'){
	                if(data.error != '')
	                {
	                    alert(data.error);
	                }else
	                {
	                    alert(data.msg );
	                }
	            }
	        },
	        error: function (data, status, e){
	            alert(e);
	        }
		});

		return false;
	}

	//personnel init
	function personnel_init() {
		$('.name_text_personnel').val("");
		$('.office_text_personnel').val("");
		$('.educationBG_text_personnel').val("");
		$('.mail_text_personnel').val("");
		$('.web_text_personnel').val("");
		$('.lab_text_personnel').val("");
		$('.phone_text_personnel').val("");
		$('.source_text_personnel').val("");
		$('.specialty_text_personnel').val("");
		$('.work_text_personnel').val("");
		$('.importantDeed_text_personnel').val("");
		$('.research_text_personnel').val("");
		$('.ID_personnel').val("");
		$('.pic_personnel').attr("src" , "../department/image/pic/init_head.jpg");
	}

	// -----------------------------------------------------------------
	// 								Curriculum
	// -----------------------------------------------------------------

	//update plan_text_curriculum
	$('.excution_curriculum .submit_curriculum').click(function(){
		UIkit.modal.confirm("確認修改？" , function(){
			var content = $('.plan_text_curriculum').val();
			if (content == "") {
				UIkit.modal.confirm("內容為空，確定修改？" , function(){
					$.ajax({
						url: 'edit.php' ,
						method: 'POST' ,
						dataType: 'html' ,
						data:{
							type: 'update_plan_curriculum' ,
							content: content
						}
					}).fail(function(err){
						console.log(err);
						UIkit.modal.alert('error');
					}).done(function(response){
						// window.location.href = 'main.php';
						$.cookie("Guide" , 4);
						location.reload();
					});
				});
			}
			else{
				$.ajax({
						url: 'edit.php' ,
						method: 'POST' ,
						dataType: 'html' ,
						data:{
							type: 'update_plan_curriculum' ,
							content: content
						}
					}).fail(function(err){
						console.log(err);
						UIkit.modal.alert('error');
					}).done(function(response){
						// window.location.href = 'main.php';
						$.cookie("Guide" , 4);
						location.reload();
					});
			}
		});
	})

	//edit architecture name
	$('.submit_architecture_curriculum').click(function(){
		var id = $(this).attr('id');
		var text = $('#' + id).val();
		var count = 0;
		var textCheck = false;

		//check duplicate text
		$('.box_text_curriculum').each(function(index){
			if (text == $(this).val()) {
				count++;
			}
		});

		if (count == 1) {
			textCheck = true;
		}else{
			UIkit.modal.alert("請勿輸入相同年度");
		}

		if (textCheck) {
			UIkit.modal.confirm("確定修改？" , function(){
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'update_architecture_curriculum' ,
						id: id ,
						text: text
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){
					$.cookie("Guide" , 4);
					location.reload();
				});
			});
		}
	});


	//-------------------------------------
	// 	Curriculum architecture file upload
	//-------------------------------------

	//upload btn
	$('.upload_architecture_curriculum').click(function(){
		var id = $(this).attr('data-id');
		ar_fileUpload_curriculum(id);
	});

	//file upload
	function ar_fileUpload_curriculum(id){

		var upload_id = $('.architecture' + id).val();
		// UIkit.modal.alert(upload_id);

	    $.ajaxFileUpload({
	        url:'architecture_file_upload_curriculum.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId:'fileToUpload' + id,
	        dataType:'json',
	        data:{
	        	upload_id: upload_id ,
	        	id: id
	        } ,
	        success: function (data, status){
	        	$.cookie("Guide" , 4);
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

	//-------------------------------------
	// 	Curriculum adjustment file upload
	//-------------------------------------

	$('.upload_adjustment_curriculum').click(function(){
		ad_fileUpload_curriculum();
	});

	//file upload
	function ad_fileUpload_curriculum(){

	    $.ajaxFileUpload({
	        url:'adjustment_file_upload_curriculum.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId:'fileToUpload_adjust',
	        dataType:'json',
	        data:{
	        } ,
	        success: function (data, status){
	        	$.cookie("Guide" , 4);
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


	function get_curriculum_data(){
		$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_curriculum'
			}
		}).fail(function(err){
			UIkit.modal.alert(err);
		}).done(function(response){
			$('.plan_text_curriculum').val(response[0].content);

			for (var i = 0; i < 4; i++) {
				var filename = response[0]['architecture'][i].file_path;
				filename = filename.split("/" , 3);

				$('.architecture' + (i + 1)).val(response[0]['architecture'][i].content);
				$('.architecture' + (i + 1)).attr('id' , response[0]['architecture'][i].content);
				$('.excution_curriculum').find('.btn' + (i + 1)).attr('id' , response[0]['architecture'][i].content);
				$('.excution_curriculum').find('.ar' + (i + 1)).attr({href:response[0]['architecture'][i].file_path , download:filename[2]});
			}

			var adjustname = response[0].adjust;
			adjustname = adjustname.split("/" , 3);
			$('.excution_curriculum .ad').attr({href:response[0].adjust , download:adjustname[2]});
		});
	}


	// -----------------------------------------------------------------
	// 								Lab
	// -----------------------------------------------------------------

	//go to edit new lab
	$('.new_lab').click(function(){
		lab_init();
		$('.delete_lab').css('display' , 'none');
	});

	//submit
	$('.submit_lab').click(function(){
		var name = $('.name_text_lab').val();
		var device = $('.device_text_lab').val();
		var issue = $('.issue_text_lab').val();
		var LID = $('.ID_lab').val();

		if (LID != "") {
			if (name == "") {
				UIkit.modal.alert("請輸入名稱");
			}
			else{
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'update_lab' ,
						name: name ,
						device: device ,
						issue: issue ,
						LID: LID
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){
					$.cookie("Guide" , 5);
					location.reload();
				});
			}
		}
		else{
			if (name == "") {
				UIkit.modal.alert("請輸入名稱");
			}
			else{
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'new_lab' ,
						name: name ,
						device: device ,
						issue: issue
					}
				}).fail(function(err){
					UIkit.modal.alert(err);
				}).done(function(response){
					$.cookie("Guide" , 5);
					location.reload();
				});
			}
		}
	});

	//go to update lab message
	$(document).on('click' , '.item_lab' , function(){
		lab_init();
		$('.delete_lab').css('display' , 'block');

		var LID = $(this).attr('id');
		$('.ID_lab').val(LID);
		$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_lab' ,
				LID: LID
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			console.log(response);
			$('.name_text_lab').val(response[0].name);
			$('.device_text_lab').val(response[0].device);
			$('.issue_text_lab').val(response[0].issue);
		});
	});

	//delete lab
	$('.delete_lab').click(function(){

		UIkit.modal.confirm("確認刪除？" , function(){
			var LID = $('.ID_lab').val();
			if (LID != "") {
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'delete_lab' ,
						LID: LID
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){
					$.cookie("Guide" , 5);
					location.reload();
				});
			}
			else{
				UIkit.modal.alert('error');
			}
		});
	});

	function lab_init() {
		$('.name_text_lab').val("");
		$('.device_text_lab').val("");
		$('.issue_text_lab').val("");
		$('.ID_lab').val("");
	}


	// -----------------------------------------------------------------
	// 								Law
	// -----------------------------------------------------------------

	//go to edit new lab
	$('.new_law').click(function(){
		law_init();
		$('.delete_law').css('display' , 'none');
		$('.law_download').css('display' , 'none');
		$('.submit_law').css('cursor' , 'not-allowed');
		$('.submit_law').prop('disabled' , true);
	});

	//submit
	$('.submit_law').click(function(){
		var name = $('.name_text_law').val();
		var caption = $('.caption_text_law').val();
		var file_law = $('.file_law').val();
		var LawID = $('.ID_law').val();
		var select = $('.select_law').find("option:selected").text();
		var selectIndex = $('.select_law').get(0).selectedIndex;


		if (LawID != "") {
			if (name == "" && selectIndex == 0) {
				UIkit.modal.alert("請輸入完整資料");
			}
			else{
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'update_law' ,
						name: name ,
						LawID: LawID ,
						select: select ,
						selectIndex: selectIndex ,
						caption: caption
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){

				}).always(function(){
					if ($('.file_law').val() != "") {
						fileUpload_law();
					}
					else{
						$.cookie("Guide" , 6);
						location.reload();
					}
				});
			}
		}
		else{
			if (name == "" || file_law == "" ||selectIndex == 0) {
				UIkit.modal.alert("請輸入完整資料");
			}
			else{
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'new_law' ,
						name: name ,
						select: select ,
						selectIndex: selectIndex ,
						caption: caption
					}
				}).fail(function(err){
					UIkit.modal.alert(err);
				}).done(function(response){
					$('.ID_law').val(response);
				}).always(function(){
					fileUpload_law();
				});
			}
		}
	});

	//go to update law message
	$(document).on('click' , '.item_law' , function(){
		law_init();
		$('.delete_law').css('display' , 'block');
		$('.law_download').css('display' , 'inline-block');
		$('.submit_law').css('cursor' , 'pointer');
		$('.submit_law').prop('disabled' , false);


		var LawID = $(this).attr('id');
		$('.ID_law').val(LawID);
		$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_law' ,
				LawID: LawID
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			console.log(response);
			var str = response[0].file_path;
			str = str.split("/");
			str = str[2].split(".");
			var filename = response[0].name + '.' + str[1];
			$('.name_text_law').val(response[0].name);
			$('.caption_text_law').val(response[0].caption);
			$('.law_download').attr({'href':response[0].file_path , 'download':filename});
			$('.select_law').val(response[0].selectIndex);
			$('.selectText_law').html(response[0].category);
		});
	});

	//delete law
	$('.delete_law').click(function(){

		UIkit.modal.confirm("確認刪除？" , function(){
			var LawID = $('.ID_law').val();
			if (LawID != "") {
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'delete_law' ,
						LawID: LawID
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){
					$.cookie("Guide" , 6);
					location.reload();
				});
			}
			else{
				UIkit.modal.alert('error');
			}
		});
	});

	//law init
	function law_init() {
		$('.name_text_law').val("");
		$('.caption_text_law').val("");
		$('.file_law').val("");
		$('.ID_law').val("");
		$('.select_law').val('0');
		$('.selectText_law').html('-----------');
	}

	//file upload
	function fileUpload_law(){
		var id = $('.ID_law').val();

	    $.ajaxFileUpload({
	        url:'file_upload_law.php',
	        type:'POST',
	        secureuri:false,
	        fileElementId:'fileToUpload_law',
	        dataType:'json',
	        data:{
	        	id: id
	        } ,
	        success: function (data, status){
	        	$.cookie("Guide" , 6);
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

	// -----------------------------------------------------------------
	// 							AdmissionList
	// -----------------------------------------------------------------

	//new
	$('.new_admissionList').click(function(){
		admission_init();
	});

	//submit
	$('.submit_admissionList').click(function(){
		var year = $('.year_text_admissionList').val();
		var count = 0;
		//確認年份
		if (year) {
			$('.item_admissionList').each(function(){
				if (year == $(this).attr('data-year')) {
					count += 1;
				}
			});

			if (count) {
				UIkit.modal.confirm('已有相同年度，確定要新增？' , function(){
					$('.table_admissionList').find('.content').each(function(index){
						var name = $(this).find('.name').val();
						var school = $(this).find('.school').val();
						var major = $(this).find('.major').val();
						var group = $(this).find('.group').val();
						if ( name != "") {
							admissionSubmit(year , name , school , major , group , 1 , index);
						}
					});
				});
			}else{
				$('.table_admissionList').find('.content').each(function(index){
					var name = $(this).find('.name').val();
					var school = $(this).find('.school').val();
					var major = $(this).find('.major').val();
					var group = $(this).find('.group').val();
					if ( name != "") {
						admissionSubmit(year , name , school , major , group , 0 , index);
					}
				});
			}
		}else{
			UIkit.modal.alert('請輸入年份');
		}
	});

	//edit year
	$('.edit_admissionList').click(function(){
		if ($('.year_text_admissionList').val() != $('.year_text_admissionList').attr('id')) {
			UIkit.modal.confirm('確認修改年份?' , function(){
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'edit_year' ,
						old_year: $('.year_text_admissionList').attr('id') ,
						new_year: $('.year_text_admissionList').val()
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){
					$.cookie("Guide" , 7);
					location.reload();
				});
			});
		}
	});

	//delete year
	$('.delete_admissionList').click(function(){
		UIkit.modal.confirm('確認刪除該年度所有資料?' , function(){
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'delete_year' ,
					year: $('.year_text_admissionList').attr('id')
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){
				$.cookie("Guide" , 7);
				location.reload();
			});
		});
	});

	//go to update law message
	$(document).on('click' , '.item_admissionList' , function(){
		admission_init();
		$('.delete_admissionList').css('display' , 'block');
		$('.tablebox_admissionList').css('display' , 'block');
		$('.edit_admissionList').css('display' , 'block');
		$('.submit_admissionList').css('display' , 'none');
		$('.form_admission').css('display' , 'none');


		var ID = $(this).attr('data-year');
		$('.year_text_admissionList').val(ID);
		$('.year_text_admissionList').attr('id' , ID);
		$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_admission' ,
				ID: ID
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			for (var i = 0; i < response.length; i++) {
				$('.tablebox_admissionList .tbody_ad').append("<tr class = 'resTr' id = '" + i + "'><td class = 'name'>" + response[i].name + "</td><td class = 'school'>" + response[i].school + "</td><td class = 'major'>" + response[i].major + "</td><td class = 'groups'>" + response[i].groups + "</td></tr>");
			};
		});
	});

	$(document).on('click' , '.resTr' , function(){
		$('.excution_admissionList .Mark').css('display' , 'block');
		var name = $(this).find('.name').html();
		var school = $(this).find('.school').html();
		var major = $(this).find('.major').html();
		var groups = $(this).find('.groups').html();

		$('.excution_admissionList .Mark').find('.name').val(name);
		$('.excution_admissionList .Mark').find('.school').val(school);
		$('.excution_admissionList .Mark').find('.major').val(major);
		$('.excution_admissionList .Mark').find('.groups').val(groups);

		$('.excution_admissionList .Mark .backbtn').click(function(){
			$('.excution_admissionList .Mark').css('display' , 'none');
			$('.excution_admissionList .Mark').find('.name').val('');
			$('.excution_admissionList .Mark').find('.school').val('');
			$('.excution_admissionList .Mark').find('.major').val('');
			$('.excution_admissionList .Mark').find('.groups').val('');
		});

		$('.excution_admissionList .Mark .delbtn').click(function(){
			var year = $('.year_text_admissionList').attr('id');
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'delete_personnel_admission' ,
					year: year ,
					name: name ,
					school: school ,
					major: major ,
					groups: groups
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){
				$.cookie("Guide" , 7);
				location.reload();
			});
		});

		$('.excution_admissionList .Mark .editbtn').click(function(){
			var year = $('.year_text_admissionList').attr('id');
			var Nname = $('.Mark .name').val();
			var Nschool = $('.Mark .school').val();
			var Nmajor = $('.Mark .major').val();
			var Ngroups = $('.Mark .groups').val();
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'edit_admission' ,
					year: year ,
					name: name ,
					Nname: Nname ,
					school: school ,
					Nschool: Nschool ,
					major: major ,
					Nmajor: Nmajor ,
					groups: groups ,
					Ngroups: Ngroups ,
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){
				$.cookie("Guide" , 7);
				location.reload();
			});
		});
	});





	function admissionSubmit(year , name , school , major , group , check , index){
		var type = "";
		if (check) {
			type = "add_admission";
		}else{
			type = "new_admission";
		}

		$.ajax({
			url: 'edit.php' ,
			method: 'POST' ,
			dataType: 'html' ,
			data:{
				type:type ,
				year: year ,
				name: name ,
				school: school ,
				major: major ,
				group: group ,
				index: index
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			$.cookie("Guide" , 7);
			location.reload();
		});
	}

	function admission_init() {
		$('.tablebox_admissionList .tbody_ad tr').remove();
		$('.tablebox_admissionList').css('display' , 'none');
		$('.delete_admissionList').css('display' , 'none');
		$('.edit_admissionList').css('display' , 'none');
		$('.submit_admissionList').css('display' , 'block');
		$('.form_admission').css('display' , 'block');
		$('.year_text_admissionList').val("");
		$('.excution_admissionList .Mark').css('display' , 'none');
	}


	// -----------------------------------------------------------------
	// 							  Map Link
	// -----------------------------------------------------------------

	//go to edit new course
	$('.new_maplink').click(function(){
		maplink_init();
		$('.editbox_maplink .Upload_newMap').css('display' , 'block');
		$('.editbox_maplink .edit').css('display' , 'none');
	});

	//edit year
	$('.edit .submit_maplink').click(function(){
		var year = $('.edit .year_maplink .yearID').val();
		var new_year = $('.edit .year_maplink .year_text_maplink').val();

		if (year != new_year) {
			$.ajax({
				url: 'edit.php' , 
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					type: 'update_course_year' , 
					year: year , 
					new_year: new_year
				}
			}).fail(function(err){
				console.log(err);
			}).done(function(response){
				$.cookie("Guide" , 8);
				location.reload();
			});
		}
	});
	//delete all
	$('.edit .delete_maplink').click(function(){
		var year = $('.edit .year_maplink .yearID').val();
		UIkit.modal.confirm("確定刪除？" , function(){
			$.ajax({
				url: 'edit.php' , 
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					type: 'delete_course_year' , 
					year: year
				}
			}).fail(function(err){
				console.log(err);
			}).done(function(response){
				$.cookie("Guide" , 8);
				location.reload();
			});
		});
	});

	//go to edit course
	$(document).on('click' , '.item_maplink' , function(){
		maplink_init();
		$('.editbox_maplink .Upload_newMap').css('display' , 'none');
		$('.editbox_maplink .edit').css('display' , 'block');
		$('.year_text_maplink').val($(this).attr('id'));
		$('.year_maplink .yearID').val($(this).attr('id'));
		$('.edit .ID_maplink').val($(this).attr('id'));
	 	$('.courseBox_maplink').css('display' , 'none');
	 	// $('.edit .courselist').css('display' , 'none');
	 	courseEdit_init();
		$('.edit .courselist').css('display' , 'block');
	 	$('.edit .detail_maplink').css('display' , 'none');

		// var LawID = $(this).attr('id');
		// $('.ID_law').val(LawID);
		// $.ajax({
		// 	url: 'exist.php' ,
		// 	method: 'GET' ,
		// 	dataType: 'json' ,
		// 	data:{
		// 		type: 'get_law' ,
		// 		LawID: LawID
		// 	}
		// }).fail(function(err){
		// 	console.log(err);
		// 	UIkit.modal.alert('error');
		// }).done(function(response){
		// 	console.log(response);
		// 	var str = response[0].file_path;
		// 	str = str.split("/");
		// 	str = str[2].split(".");
		// 	var filename = response[0].name + '.' + str[1];
		// 	$('.name_text_law').val(response[0].name);
		// 	$('.caption_text_law').val(response[0].caption);
		// 	$('.law_download').attr({'href':response[0].file_path , 'download':filename});
		// 	$('.select_law').val(response[0].selectIndex);
		// 	$('.selectText_law').html(response[0].category);
		// });
	});

	$('.courseBox_maplink .close_maplink').click(function(){
		$('.courseBox_maplink').css('display' , 'none');
	});

	$(document).on('click' , '.item_course' , function(){
		// if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
	 //    	$(this).attr('data-toggled','on');
	 //         $(this).css('background-color' , '#F5DA81');
	 //    }
	 //    else if ($(this).attr('data-toggled') == 'on'){
	 //    	$(this).attr('data-toggled','off');
	 //    	$(this).css('background-color' , '#FAFAFA1')
	 //    }

	 	var editYear = $('.edit .ID_maplink').val();
		var gradeID = $(this).attr('id');
		var Cname = $(this).attr('data-name');

	 	$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_course' ,
				year: editYear ,
				name: Cname ,
				grade: gradeID 
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			console.log(response);
	 		courseEdit_init();
			$('.edit .courselist').css('display' , 'none');
		 	$('.edit .detail_maplink').css('display' , 'block');
		 	$('.edit .detail_maplink .tempYear').val(editYear);
		 	$('.edit .detail_maplink .tempGrade').val(gradeID);
		 	$('.edit .detail_maplink .tempName').val(Cname);
		 	$('.edit .detail_maplink .name_maplink').val(response[0].name);
		 	$('.edit .detail_maplink .major_maplink').val(response[0].major);
		 	$('.edit .detail_maplink .info_maplink').val(response[0].infomation);
		 	$('.edit .detail_maplink .target_maplink').val(response[0].target);
		 	$('.edit .detail_maplink .assessment_maplink').val(response[0].assessment);
		 	var VType = response[0].type.split('');
		 	for (var i = 0; i < 9; i++) {
		 		console.log(VType[i]);
		 		if (VType[i].match("1")) {
		 			$('.edit .detail_maplink .C' + i).prop('checked' , true);
		 		}else{
		 			$('.edit .detail_maplink .C' + i).prop('checked' , false);
		 		}
		 	}
		});


	
	 	// alert(editYear + '..' + gradeID + '..' + Cname);
	 	
	});

	$('.edit .courseCancel_maplink').click(function(){
		courseEdit_init();
		$('.edit .courselist').css('display' , 'block');
	 	$('.edit .detail_maplink').css('display' , 'none');
	});

	$('.edit .courseSubmit_maplink').click(function(){
		var editYear = $('.edit .detail_maplink .tempYear').val();
		var gradeID = $('.edit .detail_maplink .tempGrade').val();
		var Cname = $('.edit .detail_maplink .tempName').val();
		var strTemp = "";
		var VType = "";
		for (var i = 0; i < 9; i++) {
			var checkbox = document.getElementById("C" + i);
			if (checkbox.checked) {
				strTemp = "1";
			}else{
				strTemp = "0";
			}
			VType = VType + strTemp;
		}

		$.ajax({
			url: 'edit.php' , 
			method: 'POST' , 
			dataType: 'html' , 
			data:{
				EYear: editYear , 
				EGrade: gradeID , 
				EName: Cname , 
				name: $('.edit .detail_maplink .name_maplink').val() , 
				major: $('.edit .detail_maplink .major_maplink').val() , 
				infomation: $('.edit .detail_maplink .info_maplink').val() ,
				target: $('.edit .detail_maplink .target_maplink').val() ,  
				assessment: $('.edit .detail_maplink .assessment_maplink').val() ,
				VType: VType ,
				type: 'update_course'
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert(err);
		}).done(function(response){
			$.cookie("Guide" , 8);
			location.reload();
		});
	});

	function courseEdit_init() {
		$('.edit .detail_maplink .tempYear').val('');
	 	$('.edit .detail_maplink .tempGrade').val('');
	 	$('.edit .detail_maplink .tempName').val('');
	 	$('.edit .detail_maplink .boxstyle').val('');
	}

	function maplink_init() {
		$('.newyear_text_maplink').val("");
		$('.year_text_maplink').val("");
		$('.courseBox_maplink .tempID').val("");

	}


	// -----------------------------------------------------------------
	// 							  achievement
	// -----------------------------------------------------------------

	//go to edit new achievement
	$('.new_result').click(function(){
		achievement_init();
		$('.delete_result').css('display' , 'none');
		$('.picblock_result').css('display' , 'none');
	});



	//submit
	$('.submit_result').click(function(){
		var time = $('.time_text_result').val();
		var web = $('.web_text_result').val();
		var caption = $('.caption_text_result').val();
		var ID = $('.ID_result').val();
		var picture = $('.file_result').val();

		if (ID != "") {
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'update_achievement' ,
					time: time ,
					web: web ,
					caption: caption ,
					ID: ID
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){

			}).always(function(){


				// if (picture != "") {
				// 	achievement_upload(ID);
				// }
				// else{
				// 	$.cookie("Guide" , 9);
				// 	location.reload();
				// }
			});
		}
		else if(time == ""){ // || web == ""
			UIkit.modal.alert('請確認時間、網址已輸入');
		}
		else{
			$.ajax({
				url: 'edit.php' ,
				method: 'POST' ,
				dataType: 'html' ,
				data:{
					type: 'new_achievement' ,
					time: time ,
					web: web ,
					caption: caption ,
					ID: ID
				}
			}).fail(function(err){
				console.log(err);
				UIkit.modal.alert('error');
			}).done(function(response){
				$('.ID_result').val(response);
			}).always(function(){
				if (picture != "") {
					var id = $('.ID_result').val();
					achievement_upload(id);
				}
				else{
					$.cookie("Guide" , 9);
					location.reload();
				}
			});
		}
	});

	//go to update achievement message
	$(document).on('click' , '.item_result' , function(){
		achievement_init();
		$('.delete_result').css('display' , 'block');
		$('.picblock_result').css('display' , 'block');
		// $('.picbox_personnel').css('display' , 'block');
		var ID = $(this).attr('id');
		$('.ID_result').val(ID);
		$('.MUploadID').val(ID);
		$.ajax({
			url: 'exist.php' ,
			method: 'GET' ,
			dataType: 'json' ,
			data:{
				type: 'get_achievement' ,
				ID: ID
			}
		}).fail(function(err){
			console.log(err);
			UIkit.modal.alert('error');
		}).done(function(response){
			console.log(response);
			$('.time_text_result').val(response[0].timeCell);
			$('.web_text_result').val(response[0].ytubeConnect);
			$('.caption_text_result').val(response[0].caption);
			if (response[0].picture != 'image/pic/init_up_pic.png') {
				$('.pic_result').attr('src' , response[0].picture);
			}
			$.ajax({
				url: 'exist.php' ,
				method: 'GET' ,
				dataType: 'json' ,
				data:{
					type: 'get_picNum' ,
					ID: ID
				}
			}).fail(function(err){
				console.log(err);
			}).done(function(response){
				console.log(response);
				var picNum_count = 0;
				for(var c in response){
					picNum_count++;
				}
				$('.picblock_result .showPicNum').html("");
				$('.picblock_result .showPicNum').html("已存在 " + picNum_count + " 個檔案");
				
				$('.view_photos .view_area').html('');
				for (var i = 0; i < response.length; i++) {
					$('.view_photos .view_area').append("<img class = 'photo_item T" + i + "' src = '" + response[i].file_path + "'/>");
				}
			});
		});
	});

	//view photos
	$('.picblock_result .viewMU').click(function(){
		var id = $('.ID_result').val();
		$('.view_photos').css('display' , 'block');
	});

	$('.view_photos .back_result').click(function(){
		$('.view_photos').css('display' , 'none');
	})

	//delete achievement
	$('.delete_result').click(function(){

		UIkit.modal.confirm("確認刪除該人項目？" , function(){
			var ID = $('.ID_result').val();
			if (ID != "") {
				$.ajax({
					url: 'edit.php' ,
					method: 'POST' ,
					dataType: 'html' ,
					data:{
						type: 'delete_achievement' ,
						ID: ID
					}
				}).fail(function(err){
					console.log(err);
					UIkit.modal.alert('error');
				}).done(function(response){
					$.cookie("Guide" , 9);
					location.reload();
				});
			}
			else{
				UIkit.modal.alert('error');
			}
		});
	});

	//-------------------------------------
	// 	achievement picture file upload
	//-------------------------------------

	$('#multFileupload').fileupload({
		// dataType: 'json',
		url: 'multUpload.php' ,
		method: 'POST' , 
		// formData:{
		// 	id: $('.ID_result').val()
		// } , 
		add: function (e, data) {
            $(".MUpload").on('click',function () {
                data.submit();
            });
        } ,
        done: function (e, data) {
        	$.cookie("Guide" , 9);
			location.reload();
        }
	});

	// function achievement_upload(id) {
	// 	alert('1');
	// 	var id = id;
	// 	// var url = '../multUpload.php';
	// 	$('#multFileupload').fileupload({
	// 		dataType: 'json',
	// 		type: 'POST' , 
	// 		formData:{
	// 			id: id
	// 		} , 
	// 		done: function (e, data){
	// 			// console.log(data);
	// 			alert('2');
	// 		}
	// 	});


	 //    $.ajaxFileUpload({
	 //        url:'achievementUpload.php',
	 //        type:'POST',
	 //        secureuri:false,
	 //        fileElementId:'result',
	 //        dataType:'JSON',
	 //        data:{
	 //        	id: id
	 //        } ,
	 //        success: function (data, status){
	 //        	$.cookie("Guide" , 9);
		// 		location.reload();
	 //            if(typeof(data.error) != 'undefined'){
	 //                if(data.error != '')
	 //                {
	 //                    alert(data.error);
	 //                }else
	 //                {
	 //                    alert(data.msg );
	 //                }
	 //            }
	 //        },
	 //        error: function (data, status, e){
	 //            alert(e);
	 //        }
		// });

		// return false;
	// }

	//achievement init
	function achievement_init() {
		$('.time_text_result').val("");
		$('.web_text_result').val("");
		$('.caption_text_result').val("");
		$('.ID_result').val("");
		$('.MUploadID').val("");
		$('.pic_result').attr("src" , "../department/image/pic/init_up_pic.png");
	}


})

function have(id) {
	$('.upload_architecture_curriculum').each(function(index){
		$(this).css('cursor' , 'not-allowed');
		$(this).prop('disabled' , 'true');
	});
	$('.excution_curriculum .upload_btn' + id).css('cursor' , 'pointer');
	$('.excution_curriculum .upload_btn' + id).prop('disabled' , false);
	$('.excution_curriculum .upload_btn' + id).attr('data-id' , id);
}

function adjust(){
	$('.upload_adjustment_curriculum').css('cursor' , 'pointer');
	$('.upload_adjustment_curriculum').prop('disabled' , false);
}

function law(){
	$('.submit_law').css('cursor' , 'pointer');
	$('.submit_law').prop('disabled' , false);

	var LawID = $('.ID_law').val();
	if (LawID != "") {
		$('.submit_law').attr('data-id' , LawID);
	}
	else{
		$('.submit_law').attr('data-id' , '-1');
	}
}

function board(id) {
	// $('.board_fileId' + id).val('get');
	$('.delbtn' + id).css('cursor' , 'pointer');
	$('.delbtn' + id).prop('disabled' , false);
	$('.delbtn' + id).attr('data-id' , id);
	$('.file_box_board').each(function(index){
		if ($(this).attr('id') == id) {
			$(this).css('background-image' , 'url(image/icon/check.png)');
		}
	});
}

function course(id) {
	//init
	$('.courseBox_maplink .item_course').css('display' , 'none');
	$('.courseBox_maplink .tempID').val("");

	var year = $('.year_maplink .yearID').val();
	$.ajax({
		url: 'exist.php' , 
		method: 'GET' , 
		dataType: 'json' , 
		data:{
			type: 'exist_course' , 
			grade: id , 
			year: year
		}
	}).fail(function(err){
		console.log(err);
		UIkit.modal.alert('err');
	}).done(function(response){
		console.log(response);
		$('.coursebox').html("");
		for (var i = 0; i < response.length; i++) {
			$('.coursebox').append("<div class = 'item_course item_course_style  uk-animation-hover uk-animation-fade' id = '" + response[i].grade +"' data-name = '" + response[i].name + "'>" + response[i].name + "</div>");
		}

		$('.courseBox_maplink').css('display' , 'block');
		$('.courseBox_maplink .tempID').val(id);
		$('.courseBox_maplink .item_course').css('display' , 'block');
		console.log($('.courseBox_maplink .tempID').val());

	});

	

	

}


