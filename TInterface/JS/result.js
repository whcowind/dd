	$('.result_Box').click(function(){
		$('.account').css('display' , 'none');
		$('.class').css('display' , 'none');
		$('.exam').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'none');
		$('.markSA').css('display' , 'none');
		$('.share').css('display' , 'none');
		$('.result').css('display' , 'block');
		$('.IMGManagerBox').css('display' , 'none');
		closeMakeQuestion();
	});

	//list item click
	$('.result .result_item').live('click' , function(){
		$('.result .result_list').css('display' , 'none');
		$('.result .result_view').css('display' , 'block');
		$('.result .topBack').css('display' , 'inline-block');

		viewinit();

		var aid = $(this).find('.result_data').attr('data-aid');
		var id = $(this).find('.result_data').attr('data-id');
		var title = $(this).find('.result_data').attr('data-title');

		$('.result .topText').html(title);
		$('.result .result_view .reslutTemp').attr({'data-id' : id , 'data-aid' : aid , 'data-title' : title});

		calculate();
	});

	//back item click
	$('.result .topBack').click(function(){
		$('.result .result_list').css('display' , 'block');
		$('.result .result_view').css('display' , 'none');
		$('.result .topBack').css('display' , 'none');
		$('.result .topText').html('分析結果');

		viewinit();
		// window.location.href = 'Amain.php';
	});


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

	function viewinit(){
		$('.result .result_view .reslutTemp').attr({'data-id' : '' , 'data-aid' : '' , 'data-title' : ''});
		$('.result_view .tableBlock').html("");
	}

	function calculate() {
		var selectLength = $('#TFAns1S option').size();
		var aid = $('.result .reslutTemp').attr('data-aid');
		var id = $('.result .reslutTemp').attr('data-id');
		var title = $('.result .reslutTemp').attr('data-title');

		$.ajax({
			url: 'result.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				aid: aid , 
				id: id ,
				title: title ,
				selectLength: selectLength ,
				Type: "calculate"
			} , 
			error:function(err){
				console.log(err);
			} , 
			success:function(response){
				// console.log(response);
				$('.result_view .tableBlock').html("");

				var resLenth = 0;
				var SA = response['SA'];
				var start = response['start'];
				var end = start + SA;


				for (var x in response) {
					resLenth++;
				}

				$('.result_view .tableBlock').attr('data-lenth' , resLenth);
				
				for (var i = 0; i < (resLenth - 2); i++) {
					// if (i < start || i >= end) {
						var typeCheck = response[i].Type;
						
						switch(typeCheck){
							case 'TF':
								$('.result_view .tableBlock').append("<table class = 'viewTable' rules='all'><tr><th colspan='2'>" + response[i].QTitle + "</th></tr><tr><td width = '70%'>" + response[i].TContent + "</td><td width = '30%'>" + response[i].TPercent + "%</td></tr><tr><td width = '70%'>" + response[i].FContent + "</td><td width = '30%'>" + response[i].FPercent + "%</td></tr></table>");
								break;

							case 'CH':
								$('.result_view .tableBlock').append("<table class = 'viewTable' rules='all'><tr><th colspan='2'>" + response[i].QTitle + "</th></tr><tr><td width = '70%'>" + response[i].C1Content + "</td><td width = '30%'>" + response[i].C1Percent + "%</td></tr><tr><td width = '70%'>" + response[i].C2Content + "</td><td width = '30%'>" + response[i].C2Percent + "%</td></tr><tr><td width = '70%'>" + response[i].C3Content + "</td><td width = '30%'>" + response[i].C3Percent + "%</td></tr><tr><td width = '70%'>" + response[i].C4Content + "</td><td width = '30%'>" + response[i].C4Percent + "%</td></tr></table>");
								break;

							case 'GP':
								var subCount = 0;
								for (var s in response[i]['GP']) {
									subCount++;
								}

								$('.result_view .tableBlock').append("<table class = 'viewTable GP" + i + "' rules='all'><tr><th colspan='2' class = 'GPMain'>" + response[i]['GP'].MainTitle + "...</th></tr></table>");

								for (var sub = 1; sub < subCount; sub++) {
									var sort = response[i]['GP'][sub].sort;
									console.log(sort);
									if (sort == 0) {
										$('.result_view .tableBlock .GP' + i).append("<tr><th colspan='2'>" + response[i]['GP'][sub].subTitle + "</th></tr><tr><td width = '70%'>" + response[i]['GP'][sub].G1Content + "</td><td width = '30%'>" + response[i]['GP'][sub].G1Percent + "%</td></tr><tr><td width = '70%'>" + response[i]['GP'][sub].G2Content + "</td><td width = '30%'>" + response[i]['GP'][sub].G2Percent + "%</td></tr><tr><td width = '70%'>" + response[i]['GP'][sub].G3Content + "</td><td width = '30%'>" + response[i]['GP'][sub].G3Percent + "%</td></tr><tr><td width = '70%'>" + response[i]['GP'][sub].G4Content + "</td><td width = '30%'>" + response[i]['GP'][sub].G4Percent + "%</td></tr>");
									}else if (sort == 1) {
										$('.result_view .tableBlock .GP' + i).append("<tr><th colspan='2'>" + response[i]['GP'][sub].subTitle + "</th></tr><tr><td width = '70%'>" + response[i]['GP'][sub].G1Content + "</td><td width = '30%'>" + response[i]['GP'][sub].G1Percent + "%</td></tr><tr><td width = '70%'>" + response[i]['GP'][sub].G2Content + "</td><td width = '30%'>" + response[i]['GP'][sub].G2Percent + "%</td></tr>");
									}else if (sort == 2) {
										$('.result_view .tableBlock .GP' + i).append("<tr><th colspan='2'>" + response[i]['GP'][sub].subTitle + "</th></tr><tr><td colspan='2'><span style = 'color:red;'>此題為簡答題，無法分析。</span></td></tr>");
									}else{
										console.log('err');
									}
									
								}

								break;
						}
					// }
				}

			} , 
			complete:function(){
				var lenth = $('.result_view .tableBlock').attr('data-lenth');
				if (lenth <= 2) {
					$('.result_view .tableBlock').append("<div class = 'alertText'>簡答題無分析結果</div>");
				}
			}
		});
	}