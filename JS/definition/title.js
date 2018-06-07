	//home button
	$('.home').click(function (){
		// window.location.href = 'index.html';
		$('body').scrollTop(0);
		location.reload();
	});

	$('.homeText').click(function(){
		// window.location.href = 'index.html';
		$('body').scrollTop($(document).height());
		location.reload();
	})


	//dropdown list hover animation
	$('.titleContainer').find('.dropdownList').hover(function() {
		console.log($(this));
		$(this).css('opacity' , '1');
		$(this).css('top' , '0');

		$(this).parent().find('.lchList').css('color' , 'rgba(255,53,154,1)');

		$(this).find('.itemChColor').hover(function() {
			$(this).css('color' , 'rgba(255,255,55,1)');
		} , function() {
			$(this).css('color' , 'white');	
		});

	} , function() {
		var dropDivNum = $(this).children().length;
		var dropheight = $(this).height();
		dropheight = dropheight * (dropDivNum - 1);
		$(this).css('opacity' , '0');
		$(this).css('top' , '-' + dropheight + 'px');	
		$(this).parent().find('.lchList').css('color' , 'white');	
	});

	//exam color
	$('.titleContainer').find('.shareList').hover(function() {
		$(this).css('color' , 'rgba(255,53,154,1)');
	} , function() {
		$(this).css('color' , 'white');
	});

	//homeicon hover
	$('.titleContainer').find('.homeIcon .homeText').hover(function(){
		$(this).css('color' , 'rgba(1,129,79,1)');
	} , function() {
		$(this).css('color' , 'white');
	});

	//檔案
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

			for (var i = 0; i < response.length; i++) {
				var sortTemp  = response[i].sort;
				var sortText = "";
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

				if (response[i].password != "") {
					$('.DPContainBox .DPContain').append("<div class = 'share_item'><a data-check = 'N' class = '" + response[i].ID + "' data-ID = '" + response[i].ID + "'><img class = 'download' src = 'image/lock.png' title = '下載' /></a><div class = 'name'>" + response[i].name + "</div><div class = 'sort'>" + sortText + "</div><div class = 'title'>" + response[i].title + "</div></div>");
				}else if(response[i].password == ""){
					$('.DPContainBox .DPContain').append("<div class = 'share_item'><a href = 'TInterface/" + response[i].file_path + "' download = '" + response[i].title + "'><img class = 'download' src = 'image/download.png' title = '下載' /></a><div class = 'name'>" + response[i].name + "</div><div class = 'sort'>" + sortText + "</div><div class = 'title'>" + response[i].title + "</div></div>");
				}else{
					console.log('share error');
				}
			}
		} , 
		complete:function(){
			
		}
	});

	$('.DPContainBox .DPContain a').live('click' , function(){
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
							$('.DPContainBox .DPContain .' + ID).attr({'href' : 'TInterface/' + response[0].path , 'download' : response[0].title , 'data-check' : 'Y'});
							$('.DPContainBox .DPContain .' + ID).find(".download").attr('src' , 'image/download.png');
						}
					} , 
					complete:function(){

					}
				});
			}

		}
	});