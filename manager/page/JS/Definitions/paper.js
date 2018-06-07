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

	$('.paper-container').css('display' , 'block');

	// -----------------------------------------------------------------
	// 								帳號管理
	// -----------------------------------------------------------------

	//說明
	$('.paper-container .paper-instruction').click(function(){
		BoxInit();
		$('.paper-instruction-mark').css('display' , 'block');
	});

	$('.instruction-btn').click(function(){
		BoxInit();
	});

	var TFArr = [];
	var TFInit = [];

	var CHArr = [];
	var CHInit = [];

	var GPArr = [];
	var GPInit = [];

	var SAArr = [];
	var SAInit = [];

	var PArr = [];
	var PInit = [];

	// -----------------------------------------------------------------
	// 								試卷
	// -----------------------------------------------------------------

	//試卷詳細資料
	$(document).on('click' , '.paper-list .paper-detail-icon' , function(){
		BoxInit();
		$('.paper-editBox').css('display' , 'block');
		var ID = $(this).attr('data-id');
		var owner = $(this).attr('data-owner');

		$('.paper-editBox .edit-text').html("試卷修改 (" + ID + ")");

		//TF
		$.ajax({
			url: 'paperData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				owner: owner ,
				type: 'paperTF'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			// console.log(response);
			for (var i = 0; i < response.length; i++) {
				$('.paper-TF-BOX .listBox').append("<div class = 'Qitem " + response[i].TFId + "' data-id = '" + response[i].TFId + "' data-type = 'TF' data-toggle = '0'>" + response[i].TFId + ". " + response[i].TFDetail + "</div>");
			}
		}).always(function(){
			//CH
			$.ajax({
				url: 'paperData.php' ,
				method: 'POST' , 
				dataType: 'json' , 
				data:{
					owner: owner ,
					type: 'paperCH'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				// console.log(response);
				for (var i = 0; i < response.length; i++) {
					$('.paper-CH-BOX .listBox').append("<div class = 'Qitem " + response[i].ChId + "' data-id = '" + response[i].ChId + "' data-type = 'CH' data-toggle = '0'>" + response[i].ChId + ". " + response[i].ChDetail + "</div>");
				}
			}).always(function(){
				//GP
				$.ajax({
					url: 'paperData.php' ,
					method: 'POST' , 
					dataType: 'json' , 
					data:{
						owner: owner ,
						type: 'paperGP'
					}
				}).fail(function(error){
					console.log(error);
				}).done(function(response){
					// console.log(response);
					for (var i = 0; i < response.length; i++) {
						$('.paper-GP-BOX .listBox').append("<div class = 'Qitem " + response[i].GroupID + "' data-id = '" + response[i].GroupID + "' data-type = 'GP' data-toggle = '0'>" + response[i].GroupID + ". " + response[i].GroupTitle + "</div>");
					}
				}).always(function(){
					//SA
					$.ajax({
						url: 'paperData.php' ,
						method: 'POST' , 
						dataType: 'json' , 
						data:{
							owner: owner ,
							type: 'paperSA'
						}
					}).fail(function(error){
						console.log(error);
					}).done(function(response){
						// console.log(response);
						for (var i = 0; i < response.length; i++) {
							$('.paper-SA-BOX .listBox').append("<div class = 'Qitem " + response[i].SAId + "' data-id = '" + response[i].SAId + "' data-type = 'SA' data-toggle = '0'>" + response[i].SAId + ". " + response[i].SADetail + "</div>");
						}
					}).always(function(){
						//P
						$.ajax({
							url: 'paperData.php' ,
							method: 'POST' , 
							dataType: 'json' , 
							data:{
								owner: owner ,
								type: 'paperP'
							}
						}).fail(function(error){
							console.log(error);
						}).done(function(response){
							// console.log(response);
							var index = 0;
							for (var c in response) {
								index++ ;
							}
							for (var i = 0; i < response.length; i++) {
								if (response[i].Aid != owner) {
									$('.paper-P-BOX .listBox').append("<div class = 'Qitem " + response[i].Aid + "' data-id = '" + response[i].Aid + "' data-type = 'P' data-toggle = '0'>" + response[i].Aname + " (" + response[i].Aid + ")</div>");
								}
							}
						}).always(function(){
							//exist
							$.ajax({
								url: 'paperData.php' ,
								method: 'POST' , 
								dataType: 'json' , 
								data:{
									ID: ID , 
									owner: owner ,
									type: 'getPaperData'
								}
							}).fail(function(error){
								console.log(error);
							}).done(function(response){
								// console.log(response);
								$('.paper-editBox .paper-edit-title').val(response[0].PTitle);
								$('.paper-editBox .paper-edit-explan').val(response[0].PExplan);
								$('.paper-editBox .paper-submit').attr('data-id' , response[0].paperID);
								$('.paper-editBox .paper-submit').attr('data-owner' , response[0].owner);

								//TF
								var TF = 0;

								for (var c in response[0]['TF'][0]) {
									TF++ ;
								}

								for (var i = 0; i < TF; i++) {
									var ID = response[0]['TF'][0]['Q' + i].QID;
									TFInit.push(ID);
									TFArr.push(ID);
									$('.paper-TF-BOX .' + ID).css('background-color' , '#ABDE9C');
									$('.paper-TF-BOX .' + ID).attr('data-toggle' , 1);
								}

								//CH
								var CH = 0;

								for (var c in response[0]['CH'][0]) {
									CH++ ;
								}

								for (var i = 0; i < CH; i++) {
									var ID = response[0]['CH'][0]['Q' + i].QID;
									CHInit.push(ID);
									CHArr.push(ID);
									$('.paper-CH-BOX .' + ID).css('background-color' , '#ABDE9C');
									$('.paper-CH-BOX .' + ID).attr('data-toggle' , 1);
								}

								//GP
								var GP = 0;

								for (var c in response[0]['GP'][0]) {
									GP++ ;
								}

								for (var i = 0; i < GP; i++) {
									var ID = response[0]['GP'][0]['Q' + i].QID;
									GPInit.push(ID);
									GPArr.push(ID);
									$('.paper-GP-BOX .' + ID).css('background-color' , '#ABDE9C');
									$('.paper-GP-BOX .' + ID).attr('data-toggle' , 1);
								}

								//SA
								var SA = 0;

								for (var c in response[0]['SA'][0]) {
									SA++ ;
								}

								for (var i = 0; i < SA; i++) {
									var ID = response[0]['SA'][0]['Q' + i].QID;
									SAInit.push(ID);
									SAArr.push(ID);
									$('.paper-SA-BOX .' + ID).css('background-color' , '#ABDE9C');
									$('.paper-SA-BOX .' + ID).attr('data-toggle' , 1);
								}

								//P
								var P = 0;

								for (var c in response[0]['P'][0]) {
									P++ ;
								}

								for (var i = 0; i < P; i++) {
									var ID = response[0]['P'][0]['Q' + i].user;
									PInit.push(ID);
									PArr.push(ID);
									$('.paper-P-BOX .' + ID).css('background-color' , '#ABDE9C');
									$('.paper-P-BOX .' + ID).attr('data-toggle' , 1);
								}

							});
						});
					});
				});
			});
		});
	});

	//試卷題型
	$('.paper-editBox .paper-edit-btn').click(function(){
		var type = $(this).attr('data-type');
		$('.paper-editBox').css('display' , 'none');
		$('.paper-' + type + '-BOX').css('display' , 'block');
	});

	//點選
	$(document).on('click' , '.Qitem' , function(){
		var toggle = $(this).attr('data-toggle');
		var type = $(this).attr('data-type');

		if (toggle == undefined || toggle == 0) {
			$(this).css('background-color' , '#ABDE9C');
			$(this).attr('data-toggle' , 1);

			var id = $(this).attr('data-id');	
			switch (type){
				case 'TF':
					for(var arrayindex = 0; arrayindex < TFArr.length; arrayindex++){
						if(TFArr[arrayindex] == id){
							TFArr.splice(arrayindex,1);
						}
					}
					TFArr.push(id);
					break;

				case 'CH':
					for(var arrayindex = 0; arrayindex < CHArr.length; arrayindex++){
						if(CHArr[arrayindex] == id){
							CHArr.splice(arrayindex,1);
						}
					}
					CHArr.push(id);
					break;

				case 'GP':
					for(var arrayindex = 0; arrayindex < GPArr.length; arrayindex++){
						if(GPArr[arrayindex] == id){
							GPArr.splice(arrayindex,1);
						}
					}
					GPArr.push(id);
					break;

				case 'SA':
					for(var arrayindex = 0; arrayindex < SAArr.length; arrayindex++){
						if(SAArr[arrayindex] == id){
							SAArr.splice(arrayindex,1);
						}
					}
					SAArr.push(id);
					break;

				case 'P':
					for(var arrayindex = 0; arrayindex < PArr.length; arrayindex++){
						if(PArr[arrayindex] == id){
							PArr.splice(arrayindex,1);
						}
					}
					PArr.push(id);
					break;
			}
		}else{
			$(this).css('background-color' , '#F6F6F6');
			$(this).attr('data-toggle' , 0);

			var id = $(this).attr('data-id');
			
			switch (type){
				case 'TF':
					for(var arrayindex = 0; arrayindex < TFArr.length; arrayindex++){
						if(TFArr[arrayindex] == id){
							TFArr.splice(arrayindex,1);
						}
					}
					break;

				case 'CH':
					for(var arrayindex = 0; arrayindex < CHArr.length; arrayindex++){
						if(CHArr[arrayindex] == id){
							CHArr.splice(arrayindex,1);
						}
					}
					break;

				case 'GP':
					for(var arrayindex = 0; arrayindex < GPArr.length; arrayindex++){
						if(GPArr[arrayindex] == id){
							GPArr.splice(arrayindex,1);
						}
					}
					break;

				case 'SA':
					for(var arrayindex = 0; arrayindex < SAArr.length; arrayindex++){
						if(SAArr[arrayindex] == id){
							SAArr.splice(arrayindex,1);
						}
					}
					break;

				case 'P':
					for(var arrayindex = 0; arrayindex < PArr.length; arrayindex++){
						if(PArr[arrayindex] == id){
							PArr.splice(arrayindex,1);
						}
					}
					break;
			}
		}
	});

	//是非
	$('.paperBOX .BOX-submit').click(function(){
		$('.paper-editBox').css('display' , 'block');
		$('.paperBOX').css('display' , 'none');
		console.log(TFArr + ' - ' + CHArr + ' - ' + GPArr + ' - ' + SAArr + ' - ' + PArr);
	});

	$('.paper-TF-BOX .TF-cancel').click(function(){
		$('.paper-editBox').css('display' , 'block');
		$('.paper-TF-BOX').css('display' , 'none');

		$('.paper-TF-BOX .Qitem').each(function(){
			$(this).css('background-color' , '#F6F6F6');
			$(this).attr('data-toggle' , 0);
		});

		TFArr = [];
		for (var i = 0; i < TFInit.length; i++) {
			var temp = TFInit[i];
			TFArr.push(temp);
		}

		for (var i = 0; i < TFArr.length; i++) {
			$('.paper-TF-BOX .' + TFArr[i]).css('background-color' , '#ABDE9C');
			$('.paper-TF-BOX .' + TFArr[i]).attr('data-toggle' , 1);
		}
	});

	//選擇
	$('.paper-CH-BOX .CH-cancel').click(function(){
		$('.paper-editBox').css('display' , 'block');
		$('.paper-CH-BOX').css('display' , 'none');

		$('.paper-CH-BOX .Qitem').each(function(){
			$(this).css('background-color' , '#F6F6F6');
			$(this).attr('data-toggle' , 0);
		});

		CHArr = [];
		for (var i = 0; i < CHInit.length; i++) {
			var temp = CHInit[i];
			CHArr.push(temp);
		}

		for (var i = 0; i < CHArr.length; i++) {
			$('.paper-CH-BOX .' + CHArr[i]).css('background-color' , '#ABDE9C');
			$('.paper-CH-BOX .' + CHArr[i]).attr('data-toggle' , 1);
		}
	});

	//群組
	$('.paper-GP-BOX .GP-cancel').click(function(){
		$('.paper-editBox').css('display' , 'block');
		$('.paper-GP-BOX').css('display' , 'none');

		$('.paper-GP-BOX .Qitem').each(function(){
			$(this).css('background-color' , '#F6F6F6');
			$(this).attr('data-toggle' , 0);
		});

		GPArr = [];
		for (var i = 0; i < GPInit.length; i++) {
			var temp = GPInit[i];
			GPArr.push(temp);
		}

		for (var i = 0; i < GPArr.length; i++) {
			$('.paper-GP-BOX .' + GPArr[i]).css('background-color' , '#ABDE9C');
			$('.paper-GP-BOX .' + GPArr[i]).attr('data-toggle' , 1);
		}
	});

	//簡答
	$('.paper-SA-BOX .SA-cancel').click(function(){
		$('.paper-editBox').css('display' , 'block');
		$('.paper-SA-BOX').css('display' , 'none');

		$('.paper-SA-BOX .Qitem').each(function(){
			$(this).css('background-color' , '#F6F6F6');
			$(this).attr('data-toggle' , 0);
		});

		SAArr = [];
		for (var i = 0; i < SAInit.length; i++) {
			var temp = SAInit[i];
			SAArr.push(temp);
		}

		for (var i = 0; i < SAArr.length; i++) {
			$('.paper-SA-BOX .' + SAArr[i]).css('background-color' , '#ABDE9C');
			$('.paper-SA-BOX .' + SAArr[i]).attr('data-toggle' , 1);
		}
	});

	//授權
	$('.paper-P-BOX .P-cancel').click(function(){
		$('.paper-editBox').css('display' , 'block');
		$('.paper-P-BOX').css('display' , 'none');

		$('.paper-P-BOX .Qitem').each(function(){
			$(this).css('background-color' , '#F6F6F6');
			$(this).attr('data-toggle' , 0);
		});

		PArr = [];
		for (var i = 0; i < PInit.length; i++) {
			var temp = PInit[i];
			PArr.push(temp);
		}

		for (var i = 0; i < PArr.length; i++) {
			$('.paper-P-BOX .' + PArr[i]).css('background-color' , '#ABDE9C');
			$('.paper-P-BOX .' + PArr[i]).attr('data-toggle' , 1);
		}
	});

	//試卷詳細資料取消
	$('.paper-editBox .paper-cancel').click(function(){
		BoxInit();
	});

	//試卷詳細資料修改
	$('.paper-editBox .paper-submit').click(function(){
		var id = $(this).attr('data-id');
		var owner = $(this).attr('data-owner');
		var PTitle = $('.paper-editBox .paper-edit-title').val();
		var PExplan = $('.paper-editBox .paper-edit-explan').val();

		if (PTitle != '' && id != '') {

			$.ajax({
				url: 'paperData.php' ,
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					id: id ,
					owner: owner ,
					PTitle: PTitle , 
					PExplan: PExplan , 
					TFArr: TFArr ,
					CHArr: CHArr , 
					GPArr: GPArr ,
					SAArr: SAArr , 
					PArr: PArr ,
					type: 'paperUpdate'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				if (response > 0) {
					UIkit.modal.alert('該試卷已分配，無法修改。');
				}else{
					location.reload();
				}
			}).always(function(){
			});
		}else{
			UIkit.modal.alert('請確認星號項目已完整填寫。');
		}
	});

	//試卷刪除
	$(document).on('click' , '.paper-list .paper-delete-icon' , function(){
		var ID = $(this).attr('data-id');

		UIkit.modal.confirm("確定刪除該試卷? 若該試卷已被作答，將連同記錄一併刪除。" , function(){
			$.ajax({
				url: 'paperData.php' ,
				method: 'POST' , 
				dataType: 'json' , 
				data:{
					ID: ID , 
					type: 'paperDelete'
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
		$('.paper-instruction-mark').css('display' , 'none');
		$('.paper-editBox').css('display' , 'none');
		$('.paper-editBox .edit-text').html("試卷修改");
		$('.paperBOX .listBox').html("");
		TFArr = [];
		TFInit = [];

		CHArr = [];
		CHInit = [];

		GPArr = [];
		GPInit = [];

		SAArr = [];
		SAInit = [];

		PArr = [];
		PInit = [];

		DetailInit();
	}

	function DetailInit() {
		$('.paper-editBox .edit-style').val('');
	}

});