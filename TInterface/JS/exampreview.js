// true /false
$('.exam').find('.exam-TFQuestion .create .TFPreview').click(function(){
	$('.exam').find('.exam-TFQuestion .create .PreviewBlock').css('display','block');

	var data = new Object();
	if( $(this).hasClass("TFUPreview") ){

		data.TFDetail = $('.exam').find('.exam-TFQuestion .create .TFUpdate .TFUDetail').val();
		data.TAns = $('.exam').find('.exam-TFQuestion .create .TFUpdate .TUAns').val();
		data.FAns = $('.exam').find('.exam-TFQuestion .create .TFUpdate .FUAns').val();
		
	}else{
		data.TAns = $('.exam').find('.exam-TFQuestion .create .TF .TAns').val();
		data.FAns = $('.exam').find('.exam-TFQuestion .create .TF .FAns').val();
		data.TFDetail = $('.exam').find('.exam-TFQuestion .create .TF .TFDetail').val();

	}
	
	getTF_Preview(data);
});

// choice
$('.exam').find('.exam-ChoiceQuestion .create .CHPreview').click(function(){
	$('.exam').find('.exam-ChoiceQuestion .create .PreviewBlock').css('display','block');

	var data = new Object();
	// data.ans = $('.exam').find('.exam-ChoiceQuestion .create .Choice .ChoiceAns');

	if( $(this).hasClass("CHUPreview") ){
		data.Detail = $('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .ChoiceUDetail').val();
		data.ChAns1Content = $('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .C1UAns').val();
		data.ChAns2Content = $('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .C2UAns').val();
		data.ChAns3Content = $('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .C3UAns').val();
		data.ChAns4Content = $('.exam').find('.exam-ChoiceQuestion .create .ChoiceUpdate .C4UAns').val();
	}else{
		data.Detail = $('.exam').find('.exam-ChoiceQuestion .create .Choice .ChoiceDetail').val();
		data.ChAns1Content = $('.exam').find('.exam-ChoiceQuestion .create .Choice .C1Ans').val();
		data.ChAns2Content = $('.exam').find('.exam-ChoiceQuestion .create .Choice .C2Ans').val();
		data.ChAns3Content = $('.exam').find('.exam-ChoiceQuestion .create .Choice .C3Ans').val();
		data.ChAns4Content = $('.exam').find('.exam-ChoiceQuestion .create .Choice .C4Ans').val();

	}

	getCH_Preview(data);

});






// group
$('.exam').find('.exam-GroupQuestion .create .GPPreview').click(function(){
	$('.exam').find('.exam-GroupQuestion .create .PreviewBlock').css('display','block');


	// 子小提 
	// GroupSubQ1Type 
	// 題目
	// subQuestion1
	// 答案
	// subQ1Ans1 subQ1Ans1 subQ1Ans1 subQ1Ans1

	var data = new Object();
	data.sub = new Array();

	if( $(this).hasClass("GPUPreview") ){
		var group = $('.exam').find('.exam-GroupQuestion .create .GroupUpdate');
		data.Detail = group.find(".GroupUDetail").val();

		for (var i = 1; i <= 10; i++) {
			var tran = new Object();
			var sub = group.find('.GroupSubUQ'+i+'Type');

			tran.Detail =  sub.find(".subUQuestion"+i).val();
			tran.ans1 =  sub.find(".subUQ"+i+"Ans1").val();
			tran.ans2 =  sub.find(".subUQ"+i+"Ans2").val();
			tran.ans3 =  sub.find(".subUQ"+i+"Ans3").val();
			tran.ans4 =  sub.find(".subUQ"+i+"Ans4").val();
			
			data.sub.push(tran);
		}

		// subUQuestion1 subUQuestion
		
	}else{
		var group = $('.exam').find('.exam-GroupQuestion .create .GroupUpdate');
		data.Detail = group.find(".GroupDetail").val();
		for (var i = 1; i <= 10; i++) {
			var tran = new Object();
			var sub = group.find.GroupSubQ('.GroupSubQ'+i+'Type');

			tran.Detail =  sub.find(".subQuestion"+i).val();
			tran.ans1 =  sub.find(".subQ"+i+"Ans1").val();
			tran.ans2 =  sub.find(".subQ"+i+"Ans2").val();
			tran.ans3 =  sub.find(".subQ"+i+"Ans3").val();
			tran.ans4 =  sub.find(".subQ"+i+"Ans4").val();

			data.sub.push(tran);
		}

	}
	
	getGP_Preview(data);
});

// short
$('.exam').find('.exam-SAQuestion .create .SAPreview').click(function(){
	$('.exam').find('.exam-SAQuestion .create .PreviewBlock').css('display','block');

	var data = new Object();
	if( $(this).hasClass("SAUPreview") ){
		data.SADetail = $('.exam').find('.exam-SAQuestion .create .SAUpdate .SAUDetail').val();
	}else{
		data.SADetail = $('.exam').find('.exam-SAQuestion .create .SA .SADetail').val();
	}
	
	getSA_Preview(data);
});


// $('.exam').find('.exam-TFQuestion .create .TFUPreview').click(function(){

// 	$('.exam').find('.exam-TFQuestion .create .PreviewBlock').css('display','block');

// });


async function getTF_Preview(data){
	var selectImageIndex = $('.imageBox').attr("data-setimglist");
	var previewContent = $('.exam').find('.exam-TFQuestion .create .TFPreviewBlock .previewContent');
	previewContent.html("");




	previewContent.append("<div class = 'Content'>" + "1." + data.TFDetail + "</div>");
	
	if(selectImageIndex){
		var imgurl_list = await getPreview_imglist(selectImageIndex);


		for (var c in imgurl_list) {
			previewContent.append("<img src = '" + imgurl_list[c]['IMG'] + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>");
		}
	}
	previewContent.append("<div class = 'sContent'>" + data.TAns + "<br/>" + data.FAns + "</div>");
	
}




async function getCH_Preview(data){
	var selectImageIndex = $('.imageBox').attr("data-setimglist");
	var previewContent = $('.exam').find('.exam-ChoiceQuestion .create .PreviewBlock .previewContent');
	previewContent.html("");



	previewContent.append("<div class = 'Content'>" + "1." + data.Detail + "</div>");
	
	if(selectImageIndex){
		var imgurl_list = await getPreview_imglist(selectImageIndex);

		for (var c in imgurl_list) {
			previewContent.append("<img src = '" + imgurl_list[c]['IMG'] + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>");
		}
	}

	previewContent.append("<div class = 'sContent'>" + data.ChAns1Content + "<br/>" + data.ChAns2Content + "<br/>" + data.ChAns3Content +"<br/>" + data.ChAns4Content + "</div>");
	
}

async function getGP_Preview(data){
	var selectImageIndex = $('.imageBox').attr("data-setimglist");
	var previewContent = $('.exam').find('.exam-GroupQuestion .create .PreviewBlock .previewContent');
	previewContent.html("");

	console.log(data);
	if(selectImageIndex){
		var imgurl_list = await getPreview_imglist(selectImageIndex);
	}

	 
	var remain_img = new Array();
	var str = data.Detail;

	//Group Question Title中若有圖片標籤時，進行圖片插入
	// 格式{img}{18}
	// main title and img
	if(str.indexOf("{img}") >= 0){
		var comparison = [];
		for(var c = 0; c < imgurl_list.length; c++){
			var checkstack = "{img}{" + imgurl_list[c]['ID'] + "}";
			if(str.indexOf(checkstack) >= 0){
				str = str.replace(checkstack , '<br/><img src = ' + imgurl_list[c]['IMG'] +' width = "120" height = "120" onMouseOver="this.width=this.width*1.5;this.height=this.height*1.5" onMouseOut="this.width=this.width/1.5;this.height=this.height/1.5"><br/>');
				continue;
			}
			remain_img.push(c);
		}
		// main title
		previewContent.append("<div class = 'GPTitle Content' height = '350px'>" + 1 + ". " + str + "</div>");
		previewContent.find('.GPTitle').append("<br/>");
		//remain image append in the end
		for (var c = 0; c < remain_img.length; c++) {
			previewContent.append("<img src = '" + imgurl_list[ remain_img[c] ]['IMG'] + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>"); 
		}

	}
	else{

		previewContent.append("<div class = 'GPTitle Content' height = '350px'>" + 1 + ". " + data.Detail + "</div>");
		for (var c in imgurl_list) {
			previewContent.append("<img src = '" + imgurl_list[c]['IMG'] + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>");
		}
	}


	// sub title and content
	for (var index = 0; index < data.sub.length; index++) {
		if(!data.sub[index].Detail){
			continue;
		}
		previewContent.append("<div class = 'subContent sContent'>" + (index+1) + ". " + data.sub[index].Detail + "</div>");
		previewContent.append("<div class = 'subAns sContent'>" + data.sub[index].ans1 + "<br/>" + data.sub[index].ans2 + "<br/>" + data.sub[index].ans3 + "<br/>" + data.sub[index].ans4 + "</div>");
		previewContent.append("<br/>");
	};

	imgReplaceTemp = [];



	
}

async function getSA_Preview(data){
	var selectImageIndex = $('.imageBox').attr("data-setimglist");
	var previewContent = $('.exam').find('.exam-SAQuestion .create .PreviewBlock .previewContent');
	previewContent.html("");


	previewContent.append("<div class = 'Content'>" + "1." + data.SADetail + "</div>");
	
	if(selectImageIndex){
		var imgurl_list = await getPreview_imglist(selectImageIndex);

		for (var c in imgurl_list) {
			previewContent.append("<img src = '" + imgurl_list[c]['IMG'] + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>");
		}
	}
	previewContent.append("<textarea class = 'sContent' Style = 'width:500px; height:150px;'></textarea>");
	
}










$('.close').parent().click(function () {
	// confirm close btn in PreviewBlock
	if($(this).hasClass("PreviewBlock")){
		$(this).css('display','none');
	}
});

function getPreview_imglist(imglist,back){

	return $.ajax({
		url: "preview.php" , 
		type: "POST" , 
		dataType: "json" , 
		data:{
			imgID_list: imglist , 
			Type: "getimgList"
		} , 
		error:function(err){
			alert(err);
		} , 
		success:function(response){	
			console.log(response);
			imgurl_list=response;
			return imgurl_list;
		}
	})
}


// //paper preview
// $('.exam').find('.exam-Paper .paper .paperPreview').click(function(){
// 	$('.exam').find('.exam-Paper .create .paperPreviewBlock').css('display' , 'block');
// 	questionNumber = 0;
// 	$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').html('');
// 	previewBlock();
// });

// //paper update preview
// $('.exam').find('.exam-Paper .paperUpdate .paperUPreview').click(function(){
// 	$('.exam').find('.exam-Paper .create .paperPreviewBlock').css('display' , 'block');
// 	questionNumber = 0;
// 	$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').html('');
// 	previewBlock();
// });



