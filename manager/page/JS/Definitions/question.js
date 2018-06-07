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

	$('.question-container').css('display' , 'block');

	var imgArr = [];
	var imgInit = [];

	// -----------------------------------------------------------------
	// 								說明管理
	// -----------------------------------------------------------------

	//說明
	$('.question-container .question-instruction').click(function(){
		$('.question-instruction-mark').css('display' , 'block');
	});

	$('.instruction-btn').click(function(){
		$('.question-instruction-mark').css('display' , 'none');
	});

	// -----------------------------------------------------------------
	// 								試題管理
	// -----------------------------------------------------------------

	$('.question-btn').click(function(){
		var questionType = $(this).attr('data-type');
		BoxInit();
		GoQuestion(questionType);
	});

	$(document).on('click' , '.question-list .question-delete-icon' , function(){
		var ID = $(this).attr('data-ID');
		var Qtype = $(this).attr('data-type');
		BoxInit();

		UIkit.modal.confirm("確定刪除該題目？" , function(){
			$.ajax({
				url: 'questionData.php' ,
				method: 'POST' , 
				dataType: 'html' , 
				data:{
					ID: ID , 
					Qtype: Qtype , 
					type: 'delQuestion'
				}
			}).fail(function(error){
				console.log(error);
			}).done(function(response){
				if (response > 0) {
					UIkit.modal.alert("此題目已被作答，無法刪除。")
				}else{
					location.reload();
				}
			}).always(function(){
				// location.reload();
			});
		});
	});


	$(document).on('click' , '.question-list .question-detail-icon' , function(){
		var ID = $(this).attr('data-ID');
		var owner = $(this).attr('data-owner');
		var Qtype = $(this).attr('data-type');
		BoxInit();

		$.ajax({
			url: 'questionData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				ID: ID , 
				Qtype: Qtype , 
				owner: owner ,
				type: 'getQuestionDetail'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			console.log(response);

			switch(response[0].type){
				case 'TF' :
					$('.question-TF-detail').css('display' , 'block');
					$('.question-TF-detail .question-detail-title').val(response[0].TFDetail);
					$('.question-TF-detail .question-detail-Ans1').val(response[0].TContent);
					$('.question-TF-detail .question-detail-Ans2').val(response[0].FContent);
					$('.question-TF-detail #tf-score1').val(response[0].TScore);
					$('.question-TF-detail #tf-score2').val(response[0].FScore);
					$('.question-TF-detail .QID').val(response[0].TFId);
					$('.question-TF-detail .owner').val(response[0].owner);
					$('.question-TF-detail .type').val(response[0].type);

					$('.question-IMG-detail .QID').val(response[0].TFId);
					$('.question-IMG-detail .owner').val(response[0].owner);
					$('.question-IMG-detail .type').val(response[0].type);

					var img_exist = 0;
					var img = 0;

					for (var c in response[0]['img_exist']) {
						img_exist ++ ;
					}

					for (var c in response[0]['IMG']) {
						img ++ ;
					}

					for (var y = 0; y < img_exist; y++) {
						var URL = '../../TInterface/' + response[0]['img_exist'][y].imageURL;
						$('.question-IMG-detail .img-detail-box').append("<div class = 'img-exist " + response[0]['img_exist'][y].imageID + "' data-toggle = '0' data-id = '" + response[0]['img_exist'][y].imageID + "'><img class = 'img-style' src = '" + URL + "'><div class = 'img-intro'>" + response[0]['img_exist'][y].imageID + "</div></div>");
					}

					for (var i = 0; i < img; i++) {
						var ID = response[0]['IMG'][i];
						imgInit.push(ID);
						imgArr.push(ID);
						$('.question-IMG-detail .img-detail-box .' + ID).css('border' , '4px solid #5CB52A');
						$('.question-IMG-detail .img-detail-box .' + ID).attr('data-toggle' , 1);
					}
					break;

				case 'CH' :
					$('.question-CH-detail').css('display' , 'block');
					$('.question-CH-detail .question-detail-title').val(response[0].ChDetail);
					$('.question-CH-detail .question-detail-Ans1').val(response[0].ChAns1Content);
					$('.question-CH-detail .question-detail-Ans2').val(response[0].ChAns2Content);
					$('.question-CH-detail .question-detail-Ans3').val(response[0].ChAns3Content);
					$('.question-CH-detail .question-detail-Ans4').val(response[0].ChAns4Content);
					$('.question-CH-detail #ch-score1').val(response[0].ChAns1Score);
					$('.question-CH-detail #ch-score2').val(response[0].ChAns2Score);
					$('.question-CH-detail #ch-score3').val(response[0].ChAns3Score);
					$('.question-CH-detail #ch-score4').val(response[0].ChAns4Score);
					$('.question-CH-detail .QID').val(response[0].ChId);
					$('.question-CH-detail .owner').val(response[0].owner);
					$('.question-CH-detail .type').val(response[0].type);

					$('.question-IMG-detail .QID').val(response[0].ChId);
					$('.question-IMG-detail .owner').val(response[0].owner);
					$('.question-IMG-detail .type').val(response[0].type);

					var img_exist = 0;
					var img = 0;

					for (var c in response[0]['img_exist']) {
						img_exist ++ ;
					}

					for (var c in response[0]['IMG']) {
						img ++ ;
					}

					for (var y = 0; y < img_exist; y++) {
						var URL = '../../TInterface/' + response[0]['img_exist'][y].imageURL;
						$('.question-IMG-detail .img-detail-box').append("<div class = 'img-exist " + response[0]['img_exist'][y].imageID + "' data-toggle = '0' data-id = '" + response[0]['img_exist'][y].imageID + "'><img class = 'img-style' src = '" + URL + "'><div class = 'img-intro'>" + response[0]['img_exist'][y].imageID + "</div></div>");
					}

					for (var i = 0; i < img; i++) {
						var ID = response[0]['IMG'][i];
						imgInit.push(ID);
						imgArr.push(ID);
						$('.question-IMG-detail .img-detail-box .' + ID).css('border' , '4px solid #5CB52A');
						$('.question-IMG-detail .img-detail-box .' + ID).attr('data-toggle' , 1);
					}
					break;

				case 'GP' :
					$('.question-IMG-detail .QID').val(response[0].GroupID);
					$('.question-IMG-detail .owner').val(response[0].owner);
					$('.question-IMG-detail .type').val(response[0].type);

					var img_exist = 0;
					var img = 0;

					for (var c in response[0]['img_exist']) {
						img_exist ++ ;
					}

					for (var c in response[0]['IMG']) {
						img ++ ;
					}

					for (var y = 0; y < img_exist; y++) {
						var URL = '../../TInterface/' + response[0]['img_exist'][y].imageURL;
						$('.question-IMG-detail .img-detail-box').append("<div class = 'img-exist " + response[0]['img_exist'][y].imageID + "' data-toggle = '0' data-id = '" + response[0]['img_exist'][y].imageID + "'><img class = 'img-style' src = '" + URL + "'><div class = 'img-intro'>" + response[0]['img_exist'][y].imageID + "</div></div>");
					}

					for (var i = 0; i < img; i++) {
						var ID = response[0]['IMG'][i];
						imgInit.push(ID);
						imgArr.push(ID);
						$('.question-IMG-detail .img-detail-box .' + ID).css('border' , '4px solid #5CB52A');
						$('.question-IMG-detail .img-detail-box .' + ID).attr('data-toggle' , 1);
					}

					for (var i = 1; i <= 10; i++) {
						$('body').append("<div class = 'sub" + i + " subBOX'><div class = 'sub-container'><input type = 'hidden' class = 'dataContent' value = '0' /><input type = 'hidden' class = 'subQID" + i + "'/><div style = 'display:block;'>題目：</div><textarea class = 'question-sub-title sub-style subTitle Title" + i + "' disabled></textarea><select class = 'sort' id = 'sort" + i + "' disabled><option value = '0'>選擇題型式</option><option value = '1'>是非題型式</option><option value = '2'>簡答題型式</option></select><br /><div style = 'display:block;'>選項1：</div><input type = 'text' class = 'question-sub" + i + "-Ans1 sub-style' disabled/><select class = 'score' id = 'gp" + i + "-score1' disabled><option value = '0'>0</option><option value = '1'>1</option><option value = '2'>2</option><option value = '3'>3</option><option value = '4'>4</option></select><br /><div style = 'display:block;'>選項2：</div><input type = 'text' class = 'question-sub" + i + "-Ans2 sub-style' disabled/><select class = 'score' id = 'gp" + i + "-score2' disabled><option value = '0'>0</option><option value = '1'>1</option><option value = '2'>2</option><option value = '3'>3</option><option value = '4'>4</option></select><br /><div style = 'display:block;'>選項3：</div><input type = 'text' class = 'question-sub" + i + "-Ans3 sub-style' disabled/><select class = 'score' id = 'gp" + i + "-score3' disabled><option value = '0'>0</option><option value = '1'>1</option><option value = '2'>2</option><option value = '3'>3</option><option value = '4'>4</option></select><br /><div style = 'display:block;'>選項4：</div><input type = 'text' class = 'question-sub" + i + "-Ans4 sub-style' disabled/><select class = 'score' id = 'gp" + i + "-score4' disabled><option value = '0'>0</option><option value = '1'>1</option><option value = '2'>2</option><option value = '3'>3</option><option value = '4'>4</option></select><br /><button class = 'uk-button uk-button-success sub-edit sub-btn' data-index = '" + i + "'>確認</button><button class = 'uk-button uk-button-success sub-clear sub-btn' data-index = '" + i + "'>清除</button></div></div>");
						
						$('.question-GP-detail').find('.detail-sub' + i).removeClass('uk-button-primary');
						$('.question-GP-detail').find('.detail-sub' + i).removeClass('uk-button-success');
						$('.question-GP-detail').find('.detail-sub' + i).addClass('uk-button-primary');
					}

					$('.question-GP-detail').css('display' , 'block');
					subBoxInit();
					var length = 0;
					for (var c in response[0]){
						length ++;
					}
					length -= 7;
					for (var btn = 0; btn < length; btn++) {
						$('.question-GP-detail .GPTitle').val(response[0].GroupTitle);
						$('.question-GP-detail .QID').val(response[0].GroupID);
						$('.question-GP-detail .owner').val(response[0].owner);
						$('.question-GP-detail .type').val(response[0].type);
						$('.question-GP-detail').find('.detail-sub' + (btn + 1)).removeClass('uk-button-primary');
						$('.question-GP-detail').find('.detail-sub' + (btn + 1)).addClass('uk-button-success');
						// $('.question-GP-detail').find('.detail-sub' + (btn + 1)).attr({
						// 	'data-title' : response[0]['Q' + btn][0].GroupQContent , 
						// 	'data-Ans1' : response[0]['Q' + btn][0].GroupA1Content , 
						// 	'data-Ans2' : response[0]['Q' + btn][0].GroupA2Content , 
						// 	'data-Ans3' : response[0]['Q' + btn][0].GroupA3Content , 
						// 	'data-Ans4' : response[0]['Q' + btn][0].GroupA4Content , 
						// 	'data-Score1' : response[0]['Q' + btn][0].GroupA1Score , 
						// 	'data-Score2' : response[0]['Q' + btn][0].GroupA2Score , 
						// 	'data-Score3' : response[0]['Q' + btn][0].GroupA3Score , 
						// 	'data-Score4' : response[0]['Q' + btn][0].GroupA4Score , 
						// 	'data-dataContent' : 1 ,
						// 	'data-QID' : response[0]['Q' + btn][0].GroupQID , 
						// 	'data-sort' : response[0]['Q' + btn][0].sort , 
						// });

						var title = response[0]['Q' + btn][0].GroupQContent;
						var Ans1 = response[0]['Q' + btn][0].GroupA1Content; 
						var Ans2 = response[0]['Q' + btn][0].GroupA2Content; 
						var Ans3 = response[0]['Q' + btn][0].GroupA3Content; 
						var Ans4 = response[0]['Q' + btn][0].GroupA4Content; 
						var Score1 = response[0]['Q' + btn][0].GroupA1Score; 
						var Score2 = response[0]['Q' + btn][0].GroupA2Score; 
						var Score3 = response[0]['Q' + btn][0].GroupA3Score; 
						var Score4 = response[0]['Q' + btn][0].GroupA4Score; 
						var dataContent = 1;
						var QID = response[0]['Q' + btn][0].GroupQID; 
						var sort = response[0]['Q' + btn][0].sort; 


						$('.sub' + (btn + 1) + ' .Title' + (btn + 1)).val(title);
						$('.sub' + (btn + 1) + ' .subQID' + (btn + 1)).val(QID);
						$('.sub' + (btn + 1) + ' #sort' + (btn + 1)).val(sort);
						$('.sub' + (btn + 1) + ' .question-sub' + (btn + 1) + '-Ans1').val(Ans1);
						$('.sub' + (btn + 1) + ' .question-sub' + (btn + 1) + '-Ans2').val(Ans2);
						$('.sub' + (btn + 1) + ' .question-sub' + (btn + 1) + '-Ans3').val(Ans3);
						$('.sub' + (btn + 1) + ' .question-sub' + (btn + 1) + '-Ans4').val(Ans4);
						$('.sub' + (btn + 1) + ' #gp' + (btn + 1) + '-score1').val(Score1);
						$('.sub' + (btn + 1) + ' #gp' + (btn + 1) + '-score2').val(Score2);
						$('.sub' + (btn + 1) + ' #gp' + (btn + 1) + '-score3').val(Score3);
						$('.sub' + (btn + 1) + ' #gp' + (btn + 1) + '-score4').val(Score4);
						$('.sub' + (btn + 1) + ' .dataContent').val(dataContent);
						// $('.sub' + subIndex).find('.initType').val(1);
					}
					
					break;

				case 'SA' :
					$('.question-SA-detail').css('display' , 'block');
					$('.question-detail-title').val(response[0].SADetail);
					$('.question-SA-detail .QID').val(response[0].SAId);
					$('.question-SA-detail .owner').val(response[0].owner);
					$('.question-SA-detail .type').val(response[0].type);
					break;
			}
			
		}).always(function(){
			
		});
	});

	//圖片
	$('.question-detail .img-enter').click(function(){
		var type = $(this).attr('data-type');
		$('.question-detail').css('display' , 'none');
		$('.question-IMG-detail').css('display' , 'block');
		$('.question-IMG-detail .type').val(type);
	});

	$('.question-IMG-detail .IMG-close').click(function(){
		$('.question-IMG-detail').css('display' , 'none');
		var type = $('.question-IMG-detail .type').val();

		$('.question-IMG-detail .img-exist').each(function(){
			$(this).css('border' , '4px solid #ECEDF0');
			$(this).attr('data-toggle' , 0);
		});

		imgArr = [];
		for (var i = 0; i < imgInit.length; i++) {
			var temp = imgInit[i];
			imgArr.push(temp);
		}

		for (var i = 0; i < imgArr.length; i++) {
			$('.question-IMG-detail .' + imgArr[i]).css('border' , '4px solid #5CB52A');
			$('.question-IMG-detail .' + imgArr[i]).attr('data-toggle' , 1);
		}

		$('.question-' + type + '-detail').css('display' , 'block');
	});

	$('.question-IMG-detail .IMG-submit').click(function(){
		$('.question-IMG-detail').css('display' , 'none');
		console.log(imgArr);
		
		var type = $('.question-IMG-detail .type').val();

		$('.question-' + type + '-detail').css('display' , 'block');
	});

	//圖片點選

	$(document).on('click' , '.question-IMG-detail .img-exist' , function(){
		var toggle = $(this).attr('data-toggle');

		if (toggle == undefined || toggle == 0) {
			$(this).css('border' , '4px solid #5CB52A');
			$(this).attr('data-toggle' , 1);

			var id = $(this).attr('data-id');	
			for(var arrayindex = 0; arrayindex < imgArr.length; arrayindex++){
				if(imgArr[arrayindex] == id){
					imgArr.splice(arrayindex,1);
				}
			}
			imgArr.push(id);
			// console.log(imgArr);
			// console.log(imgInit);
		}else{
			$(this).css('border' , '4px solid #ECEDF0');
			$(this).attr('data-toggle' , 0);

			var id = $(this).attr('data-id');
			for(var arrayindex = 0; arrayindex < imgArr.length; arrayindex++){
				if(imgArr[arrayindex] == id){
					imgArr.splice(arrayindex,1);
				}
			}
		}
	});

	//群組子題
	$('.question-GP-detail .detail-enter-btn').click(function(){
		// subBoxInit();

		// var inIndex = $(this).attr('data-in');
		var subIndex = $(this).attr('data-index');

		// if (inIndex == '0') {
		// 	$(this).attr('data-in' , '1');
		// 	var dataContent = $(this).attr('data-dataContent');

		// 	if (dataContent == 1) {
		// 		var title = $(this).attr('data-title');
		// 		var Ans1 = $(this).attr('data-Ans1');
		// 		var Ans2 = $(this).attr('data-Ans2');
		// 		var Ans3 = $(this).attr('data-Ans3');
		// 		var Ans4 = $(this).attr('data-Ans4');
		// 		var Score1 = $(this).attr('data-Score1');
		// 		var Score2 = $(this).attr('data-Score2');
		// 		var Score3 = $(this).attr('data-Score3');
		// 		var Score4 = $(this).attr('data-Score4');
		// 		var QID = $(this).attr('data-QID');
		// 		var sort = $(this).attr('data-sort');


		// 		$('.question-GP-detail').css('display' , 'none');
		// 		$('.sub' + subIndex).css('display' , 'block');
		// 		$('.sub' + subIndex + ' .Title' + subIndex).val(title);
		// 		$('.sub' + subIndex + ' .subQID' + subIndex).val(QID);
		// 		$('.sub' + subIndex + ' #sort' + subIndex).val(sort);
		// 		$('.sub' + subIndex + ' .question-sub' + subIndex + '-Ans1').val(Ans1);
		// 		$('.sub' + subIndex + ' .question-sub' + subIndex + '-Ans2').val(Ans2);
		// 		$('.sub' + subIndex + ' .question-sub' + subIndex + '-Ans3').val(Ans3);
		// 		$('.sub' + subIndex + ' .question-sub' + subIndex + '-Ans4').val(Ans4);
		// 		$('.sub' + subIndex + ' #gp' + subIndex + '-score1').val(Score1);
		// 		$('.sub' + subIndex + ' #gp' + subIndex + '-score2').val(Score2);
		// 		$('.sub' + subIndex + ' #gp' + subIndex + '-score3').val(Score3);
		// 		$('.sub' + subIndex + ' #gp' + subIndex + '-score4').val(Score4);
		// 		$('.sub' + subIndex + ' .dataContent').val(dataContent);
		// 		$('.sub' + subIndex).find('.initType').val(1);
		// 	}else{
		// 		$('.question-GP-detail').css('display' , 'none');
		// 		$('.sub' + subIndex).css('display' , 'block');
		// 	}
		// }else{
			$('.question-GP-detail').css('display' , 'none');
			$('.sub' + subIndex).css('display' , 'block');
		// }

		
	});

	$(document).on('click' , '.subBOX .sub-edit' , function(){
		var index = $(this).attr('data-index');

		if ($('.sub' + index + ' .Title' + index).val() != "") {
			$('.sub' + index + ' .dataContent').val(1);
		}else{
			$('.sub' + index + ' .dataContent').val(0);
		}

		var dataContent =  $('.sub' + index + ' .dataContent').val();

		if ($('.question-GP-detail').find('.detail-sub' + index + ' .uk-button-success') != undefined || $('.question-GP-detail').find('.detail-sub' + index + ' .uk-button-success') != "") {
			$('.question-GP-detail').find('.detail-sub' + index).removeClass('uk-button-success');
		}else if ($('.question-GP-detail').find('.detail-sub' + index + ' .uk-button-primary') != undefined || $('.question-GP-detail').find('.detail-sub' + index + ' .uk-button-primary') != "") {
			$('.question-GP-detail').find('.detail-sub' + index).removeClass('uk-button-primary');
		}

		if (dataContent == 0) {
			$('.question-GP-detail').find('.detail-sub' + index).addClass('uk-button-primary');
			
		}else if(dataContent == 1){
			$('.question-GP-detail').find('.detail-sub' + index).addClass('uk-button-success');
		}
		$('.subBOX').css('display' , 'none');
		$('.question-GP-detail').css('display' , 'block');
		// subBoxInit();
	});

	$(document).on('click' , '.subBOX .sub-clear' , function(){
		var index = $(this).attr('data-index');

		UIkit.modal.confirm("確定刪除該子題目？" , function(){
			$('.sub' + index + ' .Title' + index).val("");
			$('.sub' + index + ' .subQID' + index).val("");
			$('.sub' + index + ' #sort' + index).val(0);
			$('.sub' + index + ' .question-sub' + index + '-Ans1').val("");
			$('.sub' + index + ' .question-sub' + index + '-Ans2').val("");
			$('.sub' + index + ' .question-sub' + index + '-Ans3').val("");
			$('.sub' + index + ' .question-sub' + index + '-Ans4').val("");
			$('.sub' + index + ' #gp' + index + '-score1').val(0);
			$('.sub' + index + ' #gp' + index + '-score2').val(0);
			$('.sub' + index + ' #gp' + index + '-score3').val(0);
			$('.sub' + index + ' #gp' + index + '-score4').val(0);
			$('.sub' + index + ' .dataContent').val(0);

			if ($('.question-GP-detail').find('.detail-sub' + index + ' .uk-button-success') != undefined || $('.question-GP-detail').find('.detail-sub' + index + ' .uk-button-success') != "") {
				$('.question-GP-detail').find('.detail-sub' + index).removeClass('uk-button-success');
			}else if ($('.question-GP-detail').find('.detail-sub' + index + ' .uk-button-primary') != undefined || $('.question-GP-detail').find('.detail-sub' + index + ' .uk-button-primary') != "") {
				$('.question-GP-detail').find('.detail-sub' + index).removeClass('uk-button-primary');
			}
			// $('.question-GP-detail').find('.detail-sub' + index).removeClass('uk-button-success');
			// $('.question-GP-detail').find('.detail-sub' + index).removeClass('uk-button-primary');
			$('.question-GP-detail').find('.detail-sub' + index).addClass('uk-button-primary');
			$('.subBOX').css('display' , 'none');
			$('.question-GP-detail').css('display' , 'block');
		});
	});


	$('.question-detail .detail-close').click(function(){
		BoxInit();
	});

	$('.question-detail .detail-edit').click(function(){
		var toggle = $(this).attr('data-toggle');

		if (toggle == undefined || toggle == "" || toggle == 0) {
			$(this).attr('data-toggle' , 1);
			$('.question-detail .score').prop('disabled' , false);
			$('.question-detail textarea').prop('disabled' , false);
			$('.question-detail input').prop('disabled' , false);
			$('.subBOX .sub-style').prop('disabled' , false);
			$('.subBOX .sort').prop('disabled' , false);
			$('.subBOX .score').prop('disabled' , false);
		}else if(toggle == 1){
			$(this).attr('data-toggle' , 0);
			$('.question-detail .score').prop('disabled' , true);
			$('.question-detail textarea').prop('disabled' , true);
			$('.question-detail input').prop('disabled' , true);
			$('.subBOX .sub-style').prop('disabled' , true);
			$('.subBOX .sort').prop('disabled' , true);
			$('.subBOX .score').prop('disabled' , true);
		}

		
	});

	$('.question-detail .detail-submit').click(function(){
		var type = $(this).attr('data-type');
		
		switch (type) {
			case 'TF' :
				var owner = $('.question-TF-detail .owner').val();
				var QID = $('.question-TF-detail .QID').val();
				var title = $('.question-TF-detail .question-detail-title').val();
				var TContent = $('.question-TF-detail .question-detail-Ans1').val();
				var FContent = $('.question-TF-detail .question-detail-Ans2').val();
				var TScore = $('.question-TF-detail #tf-score1').find(':selected').val();
				var FScore = $('.question-TF-detail #tf-score2').find(':selected').val();

				$.ajax({
					url: 'questionData.php' ,
					method: 'POST' , 
					dataType: 'html' , 
					data:{
						QID: QID , 
						type: type , 
						owner: owner , 
						title: title , 
						TContent: TContent , 
						FContent: FContent , 
						TScore: TScore , 
						FScore: FScore , 
						Qtype: 'TF' , 
						imgArr: imgArr ,
						type: 'update'
					}
				}).fail(function(error){
					console.log(error);
				}).done(function(response){
					if (response > 0) {
						UIkit.modal.alert("此題目已被作答，無法修改。")
					}else{
						location.reload();
					}
				}).always(function(){
					// location.reload();
				});

				break;

			case 'CH' :
				var owner = $('.question-CH-detail .owner').val();
				var QID = $('.question-CH-detail .QID').val();
				var title = $('.question-CH-detail .question-detail-title').val();
				var CH1Content = $('.question-CH-detail .question-detail-Ans1').val();
				var CH2Content = $('.question-CH-detail .question-detail-Ans2').val();
				var CH3Content = $('.question-CH-detail .question-detail-Ans3').val();
				var CH4Content = $('.question-CH-detail .question-detail-Ans4').val();
				var CH1Score = $('.question-CH-detail #ch-score1').find(':selected').val();
				var CH2Score = $('.question-CH-detail #ch-score2').find(':selected').val();
				var CH3Score = $('.question-CH-detail #ch-score3').find(':selected').val();
				var CH4Score = $('.question-CH-detail #ch-score4').find(':selected').val();

				$.ajax({
					url: 'questionData.php' ,
					method: 'POST' , 
					dataType: 'html' , 
					data:{
						QID: QID , 
						type: type , 
						owner: owner , 
						title: title , 
						CH1Content: CH1Content , 
						CH2Content: CH2Content , 
						CH3Content: CH3Content , 
						CH4Content: CH4Content , 
						CH1Score: CH1Score , 
						CH2Score: CH2Score , 
						CH3Score: CH3Score , 
						CH4Score: CH4Score , 
						imgArr: imgArr ,
						Qtype: 'CH' , 
						type: 'update'
					}
				}).fail(function(error){
					console.log(error);
				}).done(function(response){
					if (response > 0) {
						UIkit.modal.alert("此題目已被作答，無法修改。")
					}else{
						location.reload();
					}
				}).always(function(){
					// location.reload();
				});

				break;

			case 'GP' :
				var GPAns = [];

				if ($('.sub1 .dataContent').val() != 1) {
					alert('第一子小題必須有題目');
				}else{
					for (var i = 1; i <= 10; i++) {
						var dataCheck = $('.sub' + i + ' .dataContent').val();

						var title = $('.sub' + i + ' .Title' + i).val();
						var sort = "";
						var Ans1 = "";
						var Ans2 = "";
						var Ans3 = "";
						var Ans4 = "";
						var score1 = "";
						var score2 = "";
						var score3 = "";
						var score4 = "";
						
						if (dataCheck == 1) {
							sort = $('.sub' + i + ' #sort' + i).find(":selected").val();
							Ans1 = $('.sub' + i + ' .question-sub' + i + '-Ans1').val();
							Ans2 = $('.sub' + i + ' .question-sub' + i + '-Ans2').val();
							Ans3 = $('.sub' + i + ' .question-sub' + i + '-Ans3').val();
							Ans4 = $('.sub' + i + ' .question-sub' + i + '-Ans4').val();
							score1 = $('.sub' + i + ' #gp' + i + '-score1').find(":selected").val();
							score2 = $('.sub' + i + ' #gp' + i + '-score2').find(":selected").val();
							score3 = $('.sub' + i + ' #gp' + i + '-score3').find(":selected").val();
							score4 = $('.sub' + i + ' #gp' + i + '-score4').find(":selected").val();
						}

						GPAns.push({"title" : title , "sort" : sort , "Ans1" : Ans1 , "Ans2" : Ans2 , "Ans3" : Ans3 , "Ans4" : Ans4 , "score1" : score1 , "score2" : score2 , "score3" : score3 , "score4" : score4 });
					}
					// console.log(GPAns);
					var GPJSON = JSON.stringify(GPAns);
						
					var QID = $('.question-GP-detail .QID').val();
					var owner = $('.question-GP-detail .owner').val();
					var type = $('.question-GP-detail .type').val();
					var MainTitle = $('.question-GP-detail .GPTitle').val();
					console.log(QID);
					$.ajax({
						url: 'questionData.php' ,
						method: 'POST' , 
						dataType: 'html' , 
						data:{
							QID: QID , 
							type: type , 
							owner: owner , 
							MainTitle: MainTitle , 
							GPJSON: GPJSON ,
							imgArr: imgArr ,
							Qtype: 'GP' , 
							type: 'update'
						}
					}).fail(function(error){
						console.log(error);
					}).done(function(response){
						// console.log(response);
						if (response > 0) {
							UIkit.modal.alert("此題目已被作答，無法修改。")
						}else{
							location.reload();
						}
					}).always(function(){
						// location.reload();
					});
				}
				
				break;

			case 'SA' :
				var QID = $('.question-SA-detail .QID').val();
				var owner = $('.question-SA-detail .owner').val();
				var type = $('.question-SA-detail .type').val();
				var title = $('.question-SA-detail .question-detail-title').val();

				$.ajax({
					url: 'questionData.php' ,
					method: 'POST' , 
					dataType: 'html' , 
					data:{
						QID: QID , 
						type: type , 
						owner: owner , 
						title: title , 
						Qtype: 'SA' , 
						type: 'update'
					}
				}).fail(function(error){
					console.log(error);
				}).done(function(response){
					// console.log(response);
					if (response > 0) {
						UIkit.modal.alert("此題目已被作答，無法修改。")
					}else{
						location.reload();
					}
				}).always(function(){
					// location.reload();
				});

				break;
		}
	});



	function GoQuestion(type) {
		$.ajax({
			url: 'questionData.php' ,
			method: 'POST' , 
			dataType: 'json' , 
			data:{
				Qtype: type , 
				type: 'getQuestionData'
			}
		}).fail(function(error){
			console.log(error);
		}).done(function(response){
			console.log(response);
			$('.question-list').html("");
			for (var i = 0; i < response.length; i++) {
				if (response[i].type == 'GP') {
					$('.question-list').append("<div class='question-item'><div class='question-name'>" + response[i].ID + '. ' + response[i].title + " ...</div><div class='question-delete-icon question-icon' data-type = '" + response[i].type + "' data-ID = '" + response[i].ID + "'></div><div class='question-detail-icon question-icon' data-type = '" + response[i].type + "' data-ID = '" + response[i].ID + "' data-owner = '" + response[i].owner + "'></div></div>");
				}else{
					$('.question-list').append("<div class='question-item'><div class='question-name'>" + response[i].ID + '. ' + response[i].title + "</div><div class='question-delete-icon question-icon' data-type = '" + response[i].type + "' data-ID = '" + response[i].ID + "'></div><div class='question-detail-icon question-icon' data-type = '" + response[i].type + "' data-ID = '" + response[i].ID + "' data-owner = '" + response[i].owner + "'></div></div>");
				}
			}
		}).always(function(){
			containerStatus(type);
		});
	}

	function containerStatus(type) {
		switch(type){
			case 'TF':
				$('.container-status .status').html("首頁 / 試題管理 - 是非題");
				break;

			case 'CH':
				$('.container-status .status').html("首頁 / 試題管理 - 選擇題");
				break;

			case 'GP':
				$('.container-status .status').html("首頁 / 試題管理 - 群組題");
				break;

			case 'SA':
				$('.container-status .status').html("首頁 / 試題管理 - 簡答題");
				break;
		}
	}

	function BoxInit() {
		$('.question-instruction-mark').css('display' , 'none');
		$('.question-detail').css('display' , 'none');
		$('.question-detail .detail-style').val("");
		$('.question-detail .imgTag').val(0);
		// $('.question-detail .detail-enter-btn').prop('disabled' , true);
		$('.question-detail .score').prop('disabled' , true);
		$('.question-detail textarea').prop('disabled' , true);
		$('.question-detail input').prop('disabled' , true);
		$('.question-IMG-detail .detail-box').html("");
		imgInit = [];
		imgArr = [];
		subBoxInit();
	}

	function subBoxInit() {
		$('.subBOX').css('display' , 'none');
		$('.subBOX .sub-style').val("");
	}
});