<?php
	session_start();
?>

<?php
	require 'connectdb.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	
	<link rel="stylesheet/less" type="text/css" href="CSS/smain.less"/>
	<link rel="stylesheet" href="CSS/API/uikit.min.css"/>
	<link rel="stylesheet" href="CSS/API/uikit.gradient.min.css"/>
	<link rel="stylesheet" href="CSS/API/uikit.almost-flat.min.css"/>
	<script type="text/javascript" src="JS/less.js"></script>
	<title>測驗</title>
</head>

<body ng-app = 'MyApp' ng-controller = 'Ctrl'>

	<?php
		$exists_id = true;
		$exists_password = true;

		//check id
		if(isset($_SESSION['S_id'])){
			$S_id = $_SESSION['S_id'];
		}
		else{
			$exists_id = false;
		}

		//check password
		if(isset($_SESSION['S_password'])){
			$S_password = $_SESSION['S_password'];
		}
		else{
			$exists_password = false;
		}

		//id or password error
		if(!$exists_id || !$exists_password){
			echo "<script type = 'text/javascript'> window.location.href = 'login.html'; </script>";
		}

	?>

	<div class = 'list'>
		<select class = 'paperlist' id = 'paperlist'>
			<option value = '0'>----------------</option>
		</select>
	</div>

	<div class = 'initBtn'>
		<div class = 'start'>開始測試</div>
		<div class = 'logout'>登出</div>
	</div>

	<div class = 'examBox'>
		<!-- <div class = 'paperDetail'></div>
		<hr></hr> -->
		<div class = 'content'></div>
		<hr></hr>
		<div class = 'controll_region'>
			<!-- <div class="next">下一頁</div> -->
			<!-- <div class="nextQ">下一題</div> -->
			<!-- <div class = 'submit'>送出</div>
			<div class = 'close'>關閉</div> -->
		</div>
	</div>

</body>

<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript" src="JS/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="JS/spaper.js"></script>
<script src="JS/API/uikit.min.js"></script>
<script src="JS/API/lightbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	// Variable Area
	var TF_num = 0;
	var CH_num = 0;
	var GP_num = 0;
	var SA_num = 0;

	var imgReplaceTemp = [];
	var TFAns = [];
	var CHAns = [];
	var GPAns = [];
	var SAAns = [];

	var gp_next = 0;

	//set select option 
	$.ajax({
		url: 'spaperlist.php' , 
		type: 'POST' , 
		dataType: 'json' , 
		data:{
			S_id: "<?php echo $S_id ;?>"
		} , 
		error:function(err){
			alert(err);
		} , 
		success:function(response){

			for (var i = 0; i < response.length; i++) {
				 var x = document.getElementById("paperlist");
				 var option = document.createElement("option");
				 option.text = response[i].PTitle;
				 option.value = response[i].paperID;
				 option.setAttribute('id' , response[i].paperID);
				 option.setAttribute('data-allocateid' , response[i].allocateID);
				 x.add(option);
			}
		}
	});



	//Start Test
	$('.start').click(function(){
		alert("本測驗不提供上一頁功能，請謹慎作答。");
		$('.list').css('display' , 'none');
		$.ajax({
			url: 'papercheck.php' , 
			type: 'POST' , 
			dataType: 'html' , 
			data:{
				S_id: "<?php echo $S_id ;?>" 
			} ,
			error:function(err){
				// alert('error');
				console.log(err);
			} , 
			success:function(response){

				if(response.match("true")){
					$('.initBtn').css('display' , 'none');
					$('.examBox').css('display' , 'block');
					$('.examBox').css('scrollTop' , '0');
					$.ajax({
						url: 'spaper.php' , 
						type: 'POST' , 
						dataType: 'json' , 
						data:{
							// S_id: "<?php echo $S_id ;?>"
							paperID: document.getElementById("paperlist").value 
						} , 
						error:function(error){
							// alert('error');
							console.log(error);
						} , 
						success:function(response){	
							console.log(response);

							//clear array
							// TFAns = [];
							
							// Variable Area
							TF_num = 0;
							CH_num = 0;
							GP_num = 0;
							SA_num = 0;
							imgReplaceTemp = [];
							gp_next = 0;

							if(response[0]['TF'] != null){
								for(var tf in response[0]['TF']){
									TF_num++;
								}
							}

							if(response[0]['CH'] != null){
								for(var ch in response[0]['CH']){
									CH_num++;
								}
							}

							if(response[0]['GP'] != null){
								for(var gp in response[0]['GP']){
									GP_num++;
								}
							}

							if(response[0]['SA'] != null){
								for(var sa in response[0]['SA']){
									SA_num++;
								}
							}

							var paperID = document.getElementById("paperlist").value;
							var allocateID = document.getElementById(paperID).getAttribute('data-allocateid');


							//Paper Title
							$('.examBox').find('.content').append("<div class = 'PaperTitle' data-allocate = '" + allocateID +"' data-temp = '" + response[0].paperID + "'>" + response[0].PTitle + "</div>");
							$('.examBox').find('.content').append("<hr></hr>");
							$('.examBox .controll_region').append("<div class = 'next'>下一頁</div>");
							$('.examBox .controll_region').append("<div class = 'submit'>送出</div>");
							// $('.examBox .controll_region').append("<div class = 'close'>關閉</div>");

							//True False Question Area
							if (TF_num != 0) {
								$('.examBox').find('.content').append("<div class = 'QAreaText'>是非題</div>");
								$('.examBox').find('.content').append("<div class = 'Q_hr'></div>");

								for (var tf = 0; tf < TF_num; tf++){
									var tf_img = 0;

									for(var x in response[0]['TF'][tf]['IMG']){
										tf_img++;
									}

									$('.examBox').find('.content').append("<div class = 'QDetail'>" + (tf+1) + ". " + response[0]['TF'][tf].TFDetail + "</div>");
									for (var img = 0; img < tf_img; img++) {
										// $('.examBox').find('.content').append("<img src = '" + response[0]['TF'][tf]['IMG'][img].IMGURL + "' width = '150px' height = '100px' onMouseOver='this.width=this.width*3.2;this.height=this.height*2.5' onMouseOut='this.width=this.width/3.2;this.height=this.height/2.5'>");
										$('.examBox').find('.content').append("<a data-uk-lightbox href = '" + response[0]['TF'][tf]['IMG'][img].IMGURL + "'><img src = '" + response[0]['TF'][tf]['IMG'][img].IMGURL + "' width = '150px' height = '100px' /></a>");
									}
									$('.examBox').find('.content').append("<form><input type = 'radio' class = 'QAnsText' name = 'TF" + tf + "' data-id = '" + response[0]['TF'][tf].TFID + "' id = 'T" + tf + "' value = '" + response[0]['TF'][tf].TContent + "'/><label for = 'T" + tf + "'>" + response[0]['TF'][tf].TContent + "</label><br><input type = 'radio' class = 'QAnsText' name = 'TF" + tf + "' id = 'F" + tf + "' data-id = '" + response[0]['TF'][tf].TFID + "' value = '" + response[0]['TF'][tf].FContent + "'/><label for = 'F" + tf + "'>" + response[0]['TF'][tf].FContent + "</label><br></form>");
									$('.examBox').find('.content').append("<br/>");
								}
							}

							if (CH_num != 0) {
								//Choice Question Area
								$('.examBox').find('.content').append("<div class = 'QAreaText'>選擇題</div>");
								$('.examBox').find('.content').append("<hr class = 'Q_hr'></hr>");

								for (var ch = 0; ch < CH_num; ch++) {
									var ch_img = 0;

									for (var x in response[0]['CH'][ch]['IMG']) {
										ch_img++;
									}
									// console.log(ch_img);

									$('.examBox').find('.content').append("<div class = 'QDetail'>" + (ch+1) + ". " + response[0]['CH'][ch].CHDetail + "</div>");
									for (var img = 0; img < ch_img; img++) {
										// $('.examBox').find('.content').append("<img src = '" + response[0]['CH'][ch]['IMG'][img].IMGURL + "' width = '150px' height = '100px' onMouseOver='this.width=this.width*3.2;this.height=this.height*2.5' onMouseOut='this.width=this.width/3.2;this.height=this.height/2.5'>");
										$('.examBox').find('.content').append("<a data-uk-lightbox href = '" + response[0]['CH'][ch]['IMG'][img].IMGURL + "'><img src = '" + response[0]['CH'][ch]['IMG'][img].IMGURL + "' width = '150px' height = '100px'/></a>");
									}
									$('.examBox').find('.content').append("<form><input type = 'radio' class = 'QAnsText' name = 'CH" + ch + "' data-id = '" + response[0]['CH'][ch].CHID + "' id = 'A" + ch + "' value = '" + response[0]['CH'][ch].CHAns1 + "'/><label for = 'A" + ch + "'>" + response[0]['CH'][ch].CHAns1 + "</label><br><input type = 'radio' class = 'QAnsText' name = 'CH" + ch + "' data-id = '" + response[0]['CH'][ch].CHID + "' id = 'B" + ch + "' value = '" + response[0]['CH'][ch].CHAns2 + "'/><label for = 'B" + ch + "'>" + response[0]['CH'][ch].CHAns2 + "</label><br><input type = 'radio' class = 'QAnsText' name = 'CH" + ch + "' data-id = '" + response[0]['CH'][ch].CHID + "' id = 'C" + ch + "' value = '" + response[0]['CH'][ch].CHAns3 + "'/><label for = 'C" + ch + "'>" + response[0]['CH'][ch].CHAns3 + "</label><br><input type = 'radio' class = 'QAnsText' name = 'CH" + ch + "' data-id = '" + response[0]['CH'][ch].CHID + "' id = 'D" + ch + "' value = '" + response[0]['CH'][ch].CHAns4 + "'/><label for = 'D" + ch + "'>" + response[0]['CH'][ch].CHAns4 + "</label><br></form>");
									$('.examBox').find('.content').append("<br/>");
								}
							}

							if (GP_num == 0 && SA_num == 0) {
								$('.examBox .submit').css('display' , 'block');
								$('.examBox .next').css('display' , 'none');
							}else{
								$('.examBox .next').css('display' , 'block');
								$('.examBox .submit').css('display' , 'none');
							}

							if (GP_num != 0) {
								//Group Question Area

								// $('.ForGP').find('.content').append("<div class = 'QAreaText'>群組題</div>");
								// $('.ForGP').find('.content').append("<hr class = 'Q_hr'></hr>");

								for (var gp = 0; gp < GP_num; gp++) {
									// console.log(GP_num + '...' + SA_num);
									$('body').append("<div class = 'ForGP GP" + gp + "'><div class = 'content'></div><div class = 'controll_region'></div></div>");
									// $('body').append("<div class = 'ForSub Sub" + gp + "'><div class = 'content'></div><div class = 'controll_region'></div></div>");
									// $('body').append("<div class = 'ForSub Sub" + gp + "'><div class = 'content'></div><div class = 'controll_region'></div></div>");
									// $('.ForSub .controll_region').append("<div class = 'next'>下一頁</div>");
									// $('.ForSub .controll_region').append("<div class = 'nextQ'>下一題</div>");
									// $('.ForSub .controll_region').append("<div class = 'submit'>送出</div>");
									// $('.ForSub .controll_region').append("<div class = 'close'>關閉</div>");
									// $('.GP' + gp).css('display' , 'block');
									// $('.Sub' + gp).css('display' , 'block');

									// if ((gp+1) != GP_num || ((gp+1) == GP_num && SA_num != 0)) {
									// 	$('.Sub' + gp).find('.next').css('display' , 'block');
									// 	$('.Sub' + gp).find('.submit').css('display' , 'none');
									// }else if((gp+1) == GP_num && SA_num == 0){
									// 	$('.Sub' + gp).find('.next').css('display' , 'none');
									// 	$('.Sub' + gp).find('.submit').css('display' , 'block');
									// }

									var GP_img_num = 0;
									var GP_sub_num = 0;
									for (var a in response[0]['GP'][gp]['IMG']) {
										GP_img_num++;
									}

									for(var b in response[0]['GP'][gp]['sub']){
										GP_sub_num++;
									}

									var str = response[0]['GP'][gp].GPTitle;
									if(str.indexOf("{img}") >= 0){
										var comparison = [];
										for (var c = 0; c < GP_img_num; c++) {
											console.log('---');
											var checkstack = "{img}{" + response[0]['GP'][gp]['IMG'][c].IMGID + "}";
											var imgIDTemp = response[0]['GP'][gp]['IMG'][c].IMGID;
											comparison.push(imgIDTemp);
											if(str.indexOf(checkstack) >= 0){
												str = str.replace("{img}{" + response[0]['GP'][gp]['IMG'][c].IMGID + "}" , "<br/><a data-uk-lightbox href = '" + response[0]['GP'][gp]['IMG'][c].IMGURL + "'><img src = '" + response[0]['GP'][gp]['IMG'][c].IMGURL + "' width = '200px' height = '150px'/></a><br/>");
												imgReplaceTemp.push(imgIDTemp);
											}
										}


										$('.GP' + gp).find('.content').append("<div class = 'GPBOX'><div class = 'GPDetail'>" + (gp+1) + ". " + str + "</div></div>");
										$('.GP' + gp).find('.content .QDetail').append("<br/>");
										for (var d = 0; d < GP_img_num; d++) {
											removeA(comparison , imgReplaceTemp[d]);
										}
										for (var e = 0; e < comparison.length; e++) {
											var appendInEndID = comparison[e];
											var matchIndex = -1;

											for (var index = 0; index < GP_img_num; index++) {
												if((response[0]['GP'][gp]['IMG'][index].IMGID) == appendInEndID){
													matchIndex = index;
												}
											}
											if(matchIndex != -1){
												$('.GP' + gp).find('.content').append("<a data-uk-lightbox href = '" + response[0]['GP'][gp]['IMG'][matchIndex].IMGURL +"'><img src = '" + response[0]['GP'][gp]['IMG'][matchIndex].IMGURL +"' width = '200px' height = '150px'/></a>");
												$('.GP' + gp).find('.content .GPBOX').append("<br/>");
											}
										};
									}
									else{
										$('.GP' + gp).find('.content').append("<div class = 'GPBOX'><div class = 'GPDetail'>" + (gp+1) + ". " + response[0]['GP'][gp].GPTitle + "</div></div>");
										for (var no_insert_img = 0; no_insert_img < GP_img_num; no_insert_img++) {
											$('.GP' + gp).find('.content .GPBOX').append("<a data-uk-lightbox href = '" + response[0]['GP'][gp]['IMG'][no_insert_img].IMGURL + "'><img src = '" + response[0]['GP'][gp]['IMG'][no_insert_img].IMGURL + "' width = '300px' height = '200px'/></a>");
										}
									}

									//gp sub

									$('body').append("<div class = 'ForSub Sub" + gp + "'></div>");
									for (var s = 0; s < GP_sub_num; s++) {
										$('body .Sub' + gp).append("<div class = 'GPSBlock GPSBlock" + gp + s + "'><div class = 'content'></div><div class = 'controll_region'></div></div>");
										if ((s+1) != GP_sub_num) {
											$('.GPSBlock' + gp + s).find('.controll_region').append("<div class = 'nextQ' data-now = '" + s + "' data-all = '" + GP_sub_num + "' data-gp = '" + gp + "' data-sanum = '" + SA_num + "'>下一題</div>");
										}else if((s+1) == GP_sub_num && (gp+1) == GP_num && SA_num == 0){
											$('.GPSBlock' + gp + s).find('.controll_region').append("<div class = 'submit' data-gp = '" + gp + "' data-now = '" + s + "'>送出</div>");
										}else{
											$('.GPSBlock' + gp + s).find('.controll_region').append("<div class = 'next' data-gp = '" + gp + "' data-now = '" + s + "'>下一頁</div>");
										}

										$('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<br/>");
										$('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<div class = 'QDetail' id = '" + gp + "' data-sub = '" + GP_sub_num + "' data-now = '" + s + "'>(" + (s+1) + ")" + response[0]['GP'][gp]['sub'][s].GroupQContent + "<div>");
										
										if (response[0]['GP'][gp]['sub'][s].sort == 0) {
											$('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<form class = 'GP" + gp + "S" + s + "Sort' data-sort = '" + response[0]['GP'][gp]['sub'][s].sort + "'><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "A' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA1Content + "' /><label for = 'GP" + gp + "S" + s + "A'>" + response[0]['GP'][gp]['sub'][s].GroupA1Content + "</label><br/><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "B' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA2Content + "' /><label for = 'GP" + gp + "S" + s + "B'>" + response[0]['GP'][gp]['sub'][s].GroupA2Content + "</label><br/><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "C' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA3Content + "' /><label for = 'GP" + gp + "S" + s + "C'>" + response[0]['GP'][gp]['sub'][s].GroupA3Content + "</label><br/><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "D' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA4Content + "' /><label for = 'GP" + gp + "S" + s + "D'>" + response[0]['GP'][gp]['sub'][s].GroupA4Content + "</label><br/></form>");
											$('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<br/>");
										}else if (response[0]['GP'][gp]['sub'][s].sort == 1) {
											$('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<form class = 'GP" + gp + "S" + s + "Sort' data-sort = '" + response[0]['GP'][gp]['sub'][s].sort + "'><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "A' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA1Content + "' /><label for = 'GP" + gp + "S" + s + "A'>" + response[0]['GP'][gp]['sub'][s].GroupA1Content + "</label><br/><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "B' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA2Content + "' /><label for = 'GP" + gp + "S" + s + "B'>" + response[0]['GP'][gp]['sub'][s].GroupA2Content + "</label><br/></form>");
											$('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<br/>");
										}else if(response[0]['GP'][gp]['sub'][s].sort == 2) {
											$('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<div style = 'padding-left:2%;' class = 'GP" + gp + "S" + s + "Sort' data-sort = '" + response[0]['GP'][gp]['sub'][s].sort + "'><textarea class = 'GPSA' id = 'GP" + gp + "SA" + s + "' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "'></textarea></div>");
											// $('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<form><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "A' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA1Content + "' /><label for = 'GP" + gp + "S" + s + "A'>" + response[0]['GP'][gp]['sub'][s].GroupA1Content + "</label><br/><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "B' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA2Content + "' /><br/></form>");
											$('.Sub' + gp).find('.GPSBlock' + gp + s).find('.content').append("<br/>");
										}
									}

									// $('body').append("<div class = 'ForSub Sub" + gp + "'><div class = 'content'></div><div class = 'controll_region'></div></div>");
									// $('.ForSub .controll_region').append("<div class = 'next'>下一頁</div>");
									// $('.ForSub .controll_region').append("<div class = 'nextQ'>下一題</div>");
									// $('.ForSub .controll_region').append("<div class = 'submit'>送出</div>");
									
									// if ((gp+1) != GP_num || ((gp+1) == GP_num && SA_num != 0)) {
									// 	$('.Sub' + gp).find('.next').css('display' , 'block');
									// 	$('.Sub' + gp).find('.submit').css('display' , 'none');
									// }else if((gp+1) == GP_num && SA_num == 0){
									// 	$('.Sub' + gp).find('.next').css('display' , 'none');
									// 	$('.Sub' + gp).find('.submit').css('display' , 'block');
									// }

									// for (var s = 0; s < GP_sub_num; s++) {
									// 	$('.Sub' + gp).find('.content').append("<br/>");
									// 	$('.Sub' + gp).find('.content').append("<div class = 'QDetail' id = '" + gp + "' data-sub = '" + GP_sub_num + "'>(" + (s+1) + ")" + response[0]['GP'][gp]['sub'][s].GroupQContent + "<div>");
										
									// 	$('.Sub' + gp).find('.content').append("<form><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "A' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA1Content + "' /><label for = 'GP" + gp + "S" + s + "A'>" + response[0]['GP'][gp]['sub'][s].GroupA1Content + "</label><br/><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "B' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA2Content + "' /><label for = 'GP" + gp + "S" + s + "B'>" + response[0]['GP'][gp]['sub'][s].GroupA2Content + "</label><br/><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "C' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA3Content + "' /><label for = 'GP" + gp + "S" + s + "C'>" + response[0]['GP'][gp]['sub'][s].GroupA3Content + "</label><br/><input type = 'radio' class = 'QAnsText' data-gps = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' name = 'GP" + gp + "S" + s + "' id = 'GP" + gp + "S" + s + "D' data-id = '" + response[0]['GP'][gp]['sub'][s].GPSID + "' value = '" + response[0]['GP'][gp]['sub'][s].GroupA4Content + "' /><label for = 'GP" + gp + "S" + s + "D'>" + response[0]['GP'][gp]['sub'][s].GroupA4Content + "</label><br/></form>");
									// 	$('.Sub' + gp).find('.content').append("<br/>");
									// }

									// $('.GP' + gp).find('.content').append
								}
							}

							if (SA_num != 0) {
								$('body').append("<div class = 'ForSA'><div class = 'content'></div><div class = 'controll_region'></div></div>");
								$('.ForSA').find('.content').append("<div class = 'QAreaText'>簡答題</div>");
								$('.ForSA').find('.content').append("<div class = 'Q_hr'></div>");
								$('.ForSA .controll_region').append("<div class = 'submit'>送出</div>");
								$('.ForSA .submit').css('display' , 'block');

								for (var sa = 0; sa < SA_num; sa++){
									var sa_img = 0;

									for(var x in response[0]['SA'][sa]['IMG']){
										sa_img++;
									}

									

									$('.ForSA').find('.content').append("<div class = 'QDetail'>" + response[0]['SA'][sa].SADetail + "</div>");
									for (var img = 0; img < sa_img; img++) {
										// $('.examBox').find('.content').append("<img src = '" + response[0]['TF'][tf]['IMG'][img].IMGURL + "' width = '150px' height = '100px' onMouseOver='this.width=this.width*3.2;this.height=this.height*2.5' onMouseOut='this.width=this.width/3.2;this.height=this.height/2.5'>");
										$('.ForSA').find('.content').append("<a data-uk-lightbox href = '" + response[0]['SA'][sa]['IMG'][img].IMGURL + "'><img src = '" + response[0]['SA'][sa]['IMG'][img].IMGURL + "' width = '150px' height = '100px' /></a>");
									}
									$('.ForSA').find('.content').append("<br/>");
									$('.ForSA').find('.content').append("<textarea class = 'AnsArea SA" + sa + "' data-id = '" + response[0]['SA'][sa].SAID + "'></textarea>");
									$('.ForSA').find('.content').append("<br/>");
								}
							}

							if (TF_num == 0 && CH_num ==0) {
								$('.examBox').css('display' , 'none');
								if (GP_num != 0) {
									$('.GP0').css('display' , 'block');
									$('.Sub0').css('display' , 'block');
									$('.GPSBlock00').css('display' , 'block');
									$('.GPSBlock00 .nextQ').css('display' , 'block');
								}else{
									$('.ForSA').css('display' , 'block');
								}
							}
						}
					});
				}
				else if(response.match("false")){
					alert('目前沒有試題');
				}
				else{
					console.log('error');
				}
			}
		});
	});
	
	//first page next (just tf and choice)
	$('.examBox .next').live('click' , function(){
		var tf_double_check = 0;
		var ch_double_check = 0;
		console.log("examBox .next");
		//True False Check
		for (var tf_radio_check = 0; tf_radio_check < TF_num; tf_radio_check++) {
			if(!$("input[name = 'TF" + tf_radio_check + "']:checked").val() && tf_double_check < 1){
				alert('請確認本頁題目作答完畢。');
				tf_double_check++;
			}
		}

		//Choice
		for(var ch_radio_check = 0; ch_radio_check < CH_num; ch_radio_check++){
			if(!$("input[name = 'CH" + ch_radio_check + "']:checked").val() && ch_double_check < 1){
				alert('請確認本頁題目作答完畢。');
				ch_double_check++;
			}
		}

		if (tf_double_check < 1 && ch_double_check < 1) {
			// var first_check = confirm("下一頁後無法返回，請確認作答完畢。");

			// if (first_check) {
				$('.examBox').css('display' , 'none');
				if (GP_num !=0 ) {
					$('.GP0').css('display' , 'block');
					$('.Sub0').css('display' , 'block');
					$('.GPSBlock00').css('display' , 'block');
					$('.GPSBlock00 .nextQ').css('display' , 'block');
				}else{
					$('.ForSA').css('display' , 'block');
				}
			// }
		}
	});
	// group next
	$('.ForSub .nextQ').live('click' , function(){
		var now  = $(this).attr('data-now');
		var gpnow = $(this).attr('data-gp');
		var subAll = $(this).attr('data-all');

		if ($('#GP' + gpnow + "S" + now + "A").length > 0) {
			// group choice && true false
			if(!$("input[name = 'GP" + gpnow + "S" + now + "']:checked").val()) {
				alert('請確認本頁題目作答完畢。');
			}else{
				group_nextQ(subAll,gpnow,now);
			}
 
		}else if ($('#GP' + gpnow + "SA" + now).val() == "" ) {
			
			alert('請確認本頁題目作答完畢。');

		}else{
			group_nextQ(subAll,gpnow,now);
		}

		// if(!$("input[name = 'GP" + gpnow + "S" + now + "']:checked").val()) {
		// 	alert('請確認本頁題目作答完畢。');
		// }else{
		// 	if(subAll - now <= 2) {
		// 		var sanum = $(this).attr('data-sanum');
		// 		console.log(sanum);
		// 		if (sanum != '0') {
		// 			$('.GPSBlock' + gpnow + now).find('.nextQ').css('display' , 'none');
		// 			$('.GPSBlock' + gpnow + now).css('display' , 'none');

		// 			now = parseInt(now) + 1;

		// 			$('.GPSBlock' + gpnow + now).find(".next").css('display' , 'block');
		// 			$('.GPSBlock' + gpnow + now).css('display' , 'block');
		// 		}else{
		// 			$('.GPSBlock' + gpnow + now).find('.nextQ').css('display' , 'none');
		// 			$('.GPSBlock' + gpnow + now).css('display' , 'none');

		// 			now = parseInt(now) + 1;
					
		// 			$('.GPSBlock' + gpnow + now).find(".next").css('display' , 'block');
		// 			$('.GPSBlock' + gpnow + now).find(".submit").css('display' , 'block');
		// 			$('.GPSBlock' + gpnow + now).css('display' , 'block');
		// 		}
				
		// 	}else{
		// 		$('.GPSBlock' + gpnow + now).find('.nextQ').css('display' , 'none');
		// 		$('.GPSBlock' + gpnow + now).css('display' , 'none');

		// 		now = parseInt(now) + 1;
		// 		// $('.Sub' + gpnow).find('.GPSBlock' + gpnow + now).css('display' , 'block');
		// 		// console.log($('.Sub' + gpnow).find('.GPSBlock' + gpnow + now).css('display' , 'block'));
		// 		$('.GPSBlock' + gpnow + now).find(".nextQ").css('display' , 'block');
		// 		$('.GPSBlock' + gpnow + now).css('display' , 'block');
		// 	}
		// }
	});

	function group_nextQ (subAll,gpnow,now) {

		$('.GPSBlock' + gpnow + now).find('.nextQ').css('display' , 'none');
		$('.GPSBlock' + gpnow + now).css('display' , 'none');
		var sanum = $('.GPSBlock' + gpnow + now).find('.nextQ').attr('data-sanum');
		now = parseInt(now) + 1;

		if(subAll - now <= 2) {
			if (sanum != '0') {
				// 換下一個子小題(之後有簡答題)
				$('.GPSBlock' + gpnow + now).find(".next").css('display' , 'block');
				$('.GPSBlock' + gpnow + now).css('display' , 'block');
			}else{
				// 換下一個子小題(最終送出)
				$('.GPSBlock' + gpnow + now).find(".next").css('display' , 'block');
				$('.GPSBlock' + gpnow + now).find(".submit").css('display' , 'block');
				$('.GPSBlock' + gpnow + now).css('display' , 'block');
			}
			
		}else{
			// 子小題替換
			// $('.Sub' + gpnow).find('.GPSBlock' + gpnow + now).css('display' , 'block');
			// console.log($('.Sub' + gpnow).find('.GPSBlock' + gpnow + now).css('display' , 'block'));
			$('.GPSBlock' + gpnow + now).find(".nextQ").css('display' , 'block');
			$('.GPSBlock' + gpnow + now).css('display' , 'block');
		}
	}





	// second next(just gourp and sa)
	$('.ForSub .next').live('click' , function(){
		var now = $(this).attr('data-now');
		var gpnow = $(this).attr('data-gp');

		console.log('#GP' + gpnow + "S" + now + "A");
		if ($('#GP' + gpnow + "S" + now + "A").length > 0) {
		
			if (!$("input[name = 'GP" + gpnow + "S" + now + "']:checked").val()) {
				alert('請確認本頁題目作答完畢。');
			}else{
				group_next(gpnow);
			}
		}else if ($('#GP' + gpnow + "SA" + now).val() == "") {
			
			alert('請確認本頁題目作答完畢。');

		}else{
			group_next(gpnow);
		}

		// if (!$("input[name = 'GP" + gpnow + "S" + now + "']:checked").val()) {
		// 	alert('請確認本頁題目作答完畢。');
		// }else{
		// 	$('.ForGP').css('display' , 'none');
		// 	$('.ForSub').css('display' , 'none');

		// 	gpnow = parseInt(gpnow) + 1;

		// 	if (gpnow < GP_num) {
		// 		var newnow = 0;
		// 		$('.GP' + gpnow).css('display' , 'block');
		// 		$('.Sub' + gpnow).css('display' , 'block');
		// 		$('.GPSBlock' + gpnow + newnow).css('display' , 'block');
		// 		$('.GPSBlock' + gpnow + newnow).find('.nextQ').css('display' , 'block');
		// 	}else{
		// 		$('.ForGP').css('display' , 'none');
		// 		$('.ForSub').css('display' , 'none');
		// 		$('.ForSA').css('display' , 'block');
		// 	}
		// }
		
		// var gp_double_check = 0;

		// //Group
		// var sub_num = $('.Sub' + gp_next).find('.content #' + gp_next).attr('data-sub');
		// for (var x = 0; x < sub_num; x++) {
		// 	if(!$("input[name = 'GP" + gp_next + "S" + x + "']:checked").val() && gp_double_check < 1){
		// 		alert('請確認本頁題目作答完畢。');
		// 		gp_double_check++;
		// 	}
		// }

		// if (gp_double_check < 1) {
		// 	var gp_check = confirm("下一頁後無法返回，請確認作答完畢。");
		// 	if (gp_check) {
		// 		if ((gp_next + 1) < GP_num) {
		// 			gp_next++;
		// 			$('.ForGP').css('display' , 'none');
		// 			$('.ForSub').css('display' , 'none');
		// 			$('.GP' + gp_next).css('display' , 'block');
		// 			$('.Sub' + gp_next).css('display' , 'block');
		// 		}else{
		// 			$('.ForGP').css('display' , 'none');
		// 			$('.ForSub').css('display' , 'none');
		// 			$('.ForSA').css('display' , 'block');
		// 		}
		// 	}
		// }

	});
	
	function group_next (gpnow) {
		// GP_num all region
		$('.ForGP').css('display' , 'none');
		$('.ForSub').css('display' , 'none');

			gpnow = parseInt(gpnow) + 1;

			if (gpnow < GP_num) {
				// 換下一個群組題
				var newnow = 0;
				$('.GP' + gpnow).css('display' , 'block');
				$('.Sub' + gpnow).css('display' , 'block');
				$('.GPSBlock' + gpnow + newnow).css('display' , 'block');
				$('.GPSBlock' + gpnow + newnow).find('.nextQ').css('display' , 'block');
			}else{
				// 換成簡答題
				$('.ForSA').css('display' , 'block');
			}
	}

	//Submit
	$('.submit').live('click' , function(){
		var tf_double_check = 0;
		var ch_double_check = 0;
		var gp_double_check = 0;
		var allansCheck=true;
		// var sa_double_check = 0;
		// TFAns = [];
		// CHAns = [];
		// GPAns = [];
		// SAAns = [];

		// //True False Check
		for (var tf_radio_check = 0; tf_radio_check < TF_num; tf_radio_check++) {
			if(!$("input[name = 'TF" + tf_radio_check + "']:checked").val() && tf_double_check < 1){
				alert('是非題有尚未作答完成的題目。');
				tf_double_check++;
			}
		}

		// //Choice
		for(var ch_radio_check = 0; ch_radio_check < CH_num; ch_radio_check++){
			if(!$("input[name = 'CH" + ch_radio_check + "']:checked").val() && ch_double_check < 1){
				alert('選擇題有尚未作答完的題目。');
				ch_double_check++;
			}
		}

		// //Group
		// for (var gp_radio_check = 0; gp_radio_check < GP_num; gp_radio_check++) {
		// 	var newnow = 0;
		// 	var sub_num = $('.Sub' + gp_radio_check).find('.GPSBlock' + gp_radio_check + newnow).find('.QDetail').attr('data-sub');
		// 	for (var x = 0; x < sub_num; x++) {
		// 		if(!$("input[name = 'GP" + gp_radio_check + "S" + x + "']:checked").val() && gp_double_check < 1){
		// 			alert('題組題有尚未作答完的題目。');
		// 			gp_double_check++;
		// 		}
		// 	}
		// }

		// if ($(this).attr('data-gp') != '') {
		// 	var gpnow = $(this).attr('data-gp');
		// 	var now = $(this).attr('data-now');
		// 	if (!$("input[name = 'GP" + gpnow + "S" + now + "']:checked").val()) {
		// 		alert('題組題有尚未作答完的題目。');
		// 		gp_double_check++;
		// 	}
		// }




		//collection Ans
		if(tf_double_check < 1 && ch_double_check < 1 && gp_double_check < 1){
			for (var get_tf_value = 0; get_tf_value < TF_num; get_tf_value++) {
				var TFID_Temp = $("input[name = 'TF" + get_tf_value + "']:checked").attr('data-id');
				var TFAns_Temp = $("input[name = 'TF" + get_tf_value + "']:checked").val();
				TFAns.push({"TFID" : TFID_Temp , "Ans" : TFAns_Temp});
			}

			var TFJSON = JSON.stringify(TFAns);

			for (var get_ch_value = 0; get_ch_value < CH_num; get_ch_value++) {
				var CHID_Temp = $("input[name = 'CH" + get_ch_value + "']:checked").attr('data-id');
				var CHAns_Temp = $("input[name = 'CH" + get_ch_value + "']:checked").val();
				CHAns.push({"CHID" : CHID_Temp , "Ans" : CHAns_Temp});
			}

			var CHJSON = JSON.stringify(CHAns);

			for (var get_gp_value = 0; get_gp_value < GP_num; get_gp_value++) {
				var sub_num = $('.Sub' + get_gp_value).find('.content #' + get_gp_value).attr('data-sub');
				for (var get_sub_value = 0; get_sub_value < sub_num; get_sub_value++) {
					if ($('#GP' + get_gp_value + "S" + get_sub_value + "A").length > 0) {
						var GPSID_Temp = $("input[name = 'GP" + get_gp_value + "S" + get_sub_value + "']:checked").attr('data-gps');
						var GPSAns_Temp = $("input[name = 'GP" + get_gp_value + "S" + get_sub_value + "']:checked").val();
						var sortTemp = $('.GP' + get_gp_value + "S" + get_sub_value + "Sort").attr('data-sort');
					}else{
						var GPSID_Temp = $('#GP' + get_gp_value + "SA" + get_sub_value).attr('data-gps');
						var GPSAns_Temp = $('#GP' + get_gp_value + "SA" + get_sub_value).val();
						var sortTemp = $('.GP' + get_gp_value + "S" + get_sub_value + "Sort").attr('data-sort');
					}
					GPAns.push({"GPSID" : GPSID_Temp , "Ans" : GPSAns_Temp , "sort" : sortTemp});
				}
			}

			var GPJSON = JSON.stringify(GPAns);

			for (var get_sa_value = 0; get_sa_value < SA_num; get_sa_value++) {
				var SAID_Temp = $(".SA" + get_sa_value).attr('data-id');
				var SAAns_Temp = $(".SA" + get_sa_value).val();
				SAAns.push({"SAID" : SAID_Temp , "Ans" : SAAns_Temp});
				if(SAAns_Temp==""){
					allansCheck=false;
					alert('簡答題有尚未作答完的題目。')
					return false;
				}
			}

			var SAJSON = JSON.stringify(SAAns);

			var PID = $('.examBox').find('.content .PaperTitle').attr('data-temp');
			var allocateID = $('.examBox').find('.content .PaperTitle').attr('data-allocate');

			console.log(TFJSON);
			console.log(CHJSON);
			console.log(GPJSON);
			console.log(SAJSON);

			var lastCheck = confirm("確認是否交卷");
			
			console.log($('.AnsArea').val());
			if(lastCheck == true && allansCheck ==true){
				$.ajax({
					url: 'finish.php' , 
					type: 'POST' , 
					dataType: 'html' , 
					data:{
						S_id: "<?php echo $S_id ;?>" ,
						PID: PID ,
						allocateID: allocateID ,
						TFJSON: TFJSON , 
						CHJSON: CHJSON , 
						GPJSON: GPJSON , 
						SAJSON: SAJSON
					} , 
					error:function(err){
						// alert(err);
						console.log(err);
					} , 
					success:function(response){
						// console.log(response);
						window.location.href = "Smain.php";
					}
				});
			}
		}
	});

	

	//Close
	$('.examBox').find('.close').click(function(){
		$('.list').css('display' , 'block');
		$('.initBtn').css('display' , 'block');
		$('.examBox').css('display' , 'none');
		$('.examBox').find('.content').html('');
	});

	
	//Logout
	$('.logout').click(function(){
		$.ajax({
			url: 'Slogout.php' , 
			type: 'POST' , 
			dataType: 'html' , 
			data:{
				S_id: "<?php echo $S_id ;?>" , 
				S_password: "<?php echo $S_password ;?>"
			} , 
			error:function(error){
				alert('error');
			} , 
			success:function(response){
				// alert('Logout');
				window.location.href = response;
			}
		});
	});

	function removeA(arr) {
	    var what, a = arguments, L = a.length, ax;
	    while (L > 1 && arr.length) {
	        what = a[--L];
	        while ((ax= arr.indexOf(what)) !== -1) {
	            arr.splice(ax, 1);
	        }
	    }
	    return arr;
	}

});
</script>