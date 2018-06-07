	var SA_num = 0;
	var SA = [];

	$('.markSA_Box').click(function(){
		$('.account').css('display' , 'none');
		$('.class').css('display' , 'none');
		$('.exam').css('display' , 'none');
		$('.gradeMainContent').css('display' , 'none');
		$('.markSA').css('display' , 'block');
		$('.share').css('display' , 'none');
		$('.result').css('display' , 'none');
		$('.IMGManagerBox').css('display' , 'none');
		closeMakeQuestion();
		SAList();
	});

	$('.markSA .list_btn').click(function(){
		SA_num = 0;

		SADetail();
	});

	$('.markSA_submit').click(function(){
		var check = 0;
		$('.SA_Score').each(function(){
			if ($(this).val() == "" || isNaN($(this).val())) {
				check++;
			}
		});
		if (check < 1) {
			for (var i = 0; i < SA_num; i++) {
				var SID = $('.markSA .SA_View .BOX' + i).find('.SID').val();
				var QID = $('.markSA .SA_View .BOX' + i).find('.QID').val();
				var PID = $('.markSA .SA_View .BOX' + i).find('.PID').val();
				var AID = $('.markSA .SA_View .BOX' + i).find('.AID').val();
				var GID = $('.markSA .SA_View .BOX' + i).find('.GID').val();
				var Type = $('.markSA .SA_View .BOX' + i).find('.Type').val();
				var Score = $('.markSA .SA_View .BOX' + i).find('.Score').val();
				SA.push({"SID" : SID , "QID" : QID , "PID" : PID , "AID" : AID , "GID" : GID , "Score" : Score , "Type" : Type});
			};
			
			var SAJSON = JSON.stringify(SA);
			// console.log(SAJSON);

			// var teacherID = $('.container').find('.account-data .account-name').attr('data-id');

			$.ajax({
				url: 'markSA.php' , 
				type: 'POST' , 
				dataType: 'html' , 
				data:{
					SAJSON: SAJSON , 
					Type: "finish"
				} , 
				error:function(err){
					// alert(err);
					console.log(err);
				} , 
				success:function(response){
					// console.log(response);
					window.location.href = "Amain.php";
				}
			});
		}else{
			alert("請確認全部批改完畢或輸入正確");
		}
		
	});

	function SADetail() {
		var PID = $('#SA_list').find(':selected').val();
		var AID = $('#SA_list').find(':selected').attr('data-allocateid');
		var teacherID = $('.container').find('.account-data .account-name').attr('data-id');
		//get SA Detail
		$.ajax({
			url: 'markSA.php' , 
			type: 'POST' , 
			dataType: 'json' , 
			data:{
				teacherID: teacherID , 
				PID: PID , 
				AID: AID ,
				Type: "getDetail"
			} , 
			error:function(err){
				// alert(err);
				console.log(err);
			} , 
			success:function(response){
				console.log(response);
				$('.markSA .SA_View').html("");
				SA_num = response.length;

				for (var i = 0; i < response.length; i++) {
					$('.markSA .SA_View').append("<div class = 'SABOX BOX" + i + "'><div class = 'Sname'>學生： " + response[i].Sname + "</div><div class = 'Title'>題目： " + response[i].Title + "</div><div style = 'margin-left: 10px;'>答案：</div><textarea class = 'Ans' disabled>" + response[i].Ans + "</textarea><div class = 'ScoreBox'>分數：<input type = 'text' class = 'Score' value = ''/></div></div>");
					$('.markSA .SA_View .BOX' + i).append("<input type = 'hidden' class = 'SID' value = '" + response[i].SID + "'/>");
					$('.markSA .SA_View .BOX' + i).append("<input type = 'hidden' class = 'PID' value = '" + response[i].PID + "'/>");
					$('.markSA .SA_View .BOX' + i).append("<input type = 'hidden' class = 'AID' value = '" + response[i].AID + "'/>");
					$('.markSA .SA_View .BOX' + i).append("<input type = 'hidden' class = 'GID' value = '" + response[i].GID + "'/>");
					$('.markSA .SA_View .BOX' + i).append("<input type = 'hidden' class = 'QID' value = '" + response[i].QID + "'/>");
					$('.markSA .SA_View .BOX' + i).append("<input type = 'hidden' class = 'Type' value = '" + response[i].Type + "'/>");
					$('.markSA .SA_View .BOX' + i).append("<input type = 'hidden' class = 'Steacher' value = '" + response[i].Steacher + "'/>");
				}

			}
		});
	}

	function SAList(){
		var Aid = $('.container').find('.account-data .account-name').attr('data-id');

		var select = document.getElementById("SA_list");
		var length = select.options.length;
		for (i = 1; i < length; i++) {
		  select.options[i] = null;
		}

		//set select option 
		$.ajax({
			url: 'markSA.php' , 
			type: 'POST' , 
			dataType: 'json' , 
			data:{
				Aid: Aid , 
				Type: "getpaper"
			} , 
			error:function(err){
				// alert(err);
				console.log(err);
			} , 
			success:function(response){
				console.log(response);
				for (var i = 0; i < response.length; i++) {
					 var x = document.getElementById("SA_list");
					 var option = document.createElement("option");
					 option.text = response[i].PTitle;
					 option.value = response[i].paperID;
					 option.setAttribute('id' , response[i].paperID);
					 option.setAttribute('data-allocateid' , response[i].allocateID);
					 option.setAttribute('data-SAID' , response[i].SAID);
					 x.add(option);
				}
			}
		});
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