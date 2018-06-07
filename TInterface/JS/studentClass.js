	var classNameTemp = '';
	var studentNameTemp = '';
	var PTitleTemp = '';

	//------------------------------
	//	       list
	//------------------------------

	function changeListInit(){
		$('.class .classList').css('display' , 'none');
		$('.class .studentList').css('display' , 'none');
		$('.class .student-detail').css('display' , 'none');
		$('.class .class-detail').css('display' , 'none');
		// $('.class .class-detail').html("");
		// $('.class .student-detail').html("");
		$('.class .class-name').html("");
	}

	// $('.class').find('.classList-data').live({

	// 	mouseenter: function () {
	// 		$(this).css('background-color' , 'rgba(0,0,0,0.3)');
	//     },
	//     mouseleave: function () {
	//     	$(this).css('background-color' , 'rgba(0,0,0,0.1)');
	//     }
	// });

	// $('.class').find('.student-data').live({

	// 	mouseenter: function () {
	// 		$(this).css('background-color' , 'rgba(0,0,0,0.3)');
	//     },
	//     mouseleave: function () {
	//     	$(this).css('background-color' , 'rgba(0,0,0,0.1)');
	//     }
	// });

	$('.class').find('.student-detail .studentContent .main').live({

		mouseenter: function () {
			$(this).css('background-color' , 'rgba(0,0,0,0.3)');
	    },
	    mouseleave: function () {
	    	$(this).css('background-color' , 'rgba(0,0,0,0)');
	    }
	});

	//進入班級
	$('.class').find('.classList-data').live("click" , function(){
		changeListInit();
		$('.class .class-detail').html("");
		$('.class .studentList').css('display' , 'block');
		$('.class .class-detail').css('display' , 'block');

		var className = $(this).attr('data-className');
		var Aid = $(this).attr('data-Aid');

		$('.class .class-name').html(className);

		$.ajax({
			url: 'class_data.php' ,
			type: 'GET' ,
			dataType: 'json' ,
			data:{
				className: className ,
				Aid: Aid , 
				Type: 'studentList'
			} ,
			error:function(err){
				console.log(err);
			} ,
			success:function(response){
				// console.log(response);
				$('.class .class-detail').append("<div class = 'statusBar'><div class = 'classClosebtn'>關閉</div></div>");
				for (var i = 0; i < response.length; i++) {
					$('.class .class-detail').append("<div class = 'student-data' data-classname = '" + response[i].Sclass + "' data-name = '" + response[i].Sname + "' data-id = '" + response[i].Sid + "'>" + response[i].Sname + " ( " + response[i].Sid + " ) </div>");
				}
			}
		});
	});




	$('.class').find('.student-data').live("click" , function(){
		changeListInit();
		$('.class .studentList').css('display' , 'block');
		// $('.class').find('.class-detail').css('display' , 'none');
		$('.class').find('.student-detail').css('display' , 'block');


		var className = $(this).attr('data-classname');
		var studentName = $(this).attr('data-name');
		var studentID = $(this).attr('data-id');

		classNameTemp = className;
		studentNameTemp = studentName;

		$('.class').find('.class-name').text(className + ' - ' + studentName + ' ( ' + studentID + ' ) ');

		//JQ and angularJS 傳值

		// var $scope = angular.element($('body')).scope();
		// $scope.$apply(function() {
		// 	$scope.studentID = studentID;
		// 	$scope.blocks = blocks;
		// });

		$.ajax({
			url: 'class_data.php' ,
			type: 'GET' ,
			dataType: 'json' ,
			data:{
				studentID: studentID ,
				Type: 'student'
			} ,
			error:function(err){
				alert(err);
			} ,
			success:function(response){
				// console.log(response);

				$('.class').find('.student-detail .studentContent').html('');

				for (var i = 0; i < response.length; i++) {
					if (response[i].grade == 0 && response[i].Time == "") {
						$('.class').find('.student-detail .studentContent').append("<div class = 'main' data-id = '" + response[i].studentID + "'><div class = 'paper'>" + response[i].allocateID + " ： " + response[i].PTitle + "(試卷" + response[i].paperID + ")" + "</div><div class = 'time'>" + response[i].Time + "</div><div class = 'grade'>未作答</div></div>");
					}
					else {
						$('.class').find('.student-detail .studentContent').append("<div class = 'main' data-id = '" + response[i].studentID + "'><div class = 'paper'>" + response[i].allocateID + " ： " + response[i].PTitle + "(試卷" + response[i].paperID + ")" + "</div><div class = 'time'>" + response[i].Time + "</div><div class = 'grade'>得分：" + response[i].grade + "</div></div>");
					}
				}

			}
		});



		$.ajax({
			url: 'class_data.php' ,
			type: 'GET' ,
			dataType: 'json' ,
			data:{
				studentID: studentID ,
				studentName: studentNameTemp ,
				Type: 'excel'
			} ,
			error:function(err){
				// alert(err);
				console.log(err);
			} ,
			success:function(response){
				// console.log(response);
				$('.class').find('.student-detail .student-table-content').html("");
				$('.class').find('.student-detail .student-table-content').append("<table class = 'studentexcel'><thead><th>試卷名稱</th><th>得分</th><th>時間</th></thead></table>");

				for (var i = 0; i < response.length; i++) {
					$('.class').find('.student-detail .student-table-content .studentexcel').append("<tbody><tr><td>" + response[i].PTitle + "</td><td>" + response[i].grade + "</td><td>" + response[i].Time + "</td></tr></tbody>");
				}
			}
		});

		$.ajax({
			url: 'class_data.php' ,
			type: 'GET' ,
			dataType: 'json' ,
			data:{
				studentID: studentID ,
				studentName: studentNameTemp ,
				Type: 'excel_detailed'
			} ,
			error:function(err){
				console.log(err);
				// alert(err);
			} ,
			success:function(response){
				// console.log(response);
				$('.class').find('.student-detail .student-table-detailed').html("");
				$('.class').find('.student-detail .student-table-detailed').append("<table class = 'studentexceldetailed'><thead><th>試卷名稱</th><th>得分</th><th>時間</th></thead></table>");
				$('.class .student-detail .studentexceldetailed').append("<tbody class = 'studetailed'></tbody>");

				for (var i = 0; i < response.length; i++) {
					if (response[i].paper == "") {
						$('.class .studentexceldetailed .studetailed').append("<tr><td>" + response[i].paperName + "</td><td>未作答</td></tr>");
					}else{
						$('.class .studentexceldetailed .studetailed').append("<tr class = '" + response[i].aid + "'><td>" + response[i].paperName + "</td><td>成績</td><td>時間</td></tr>");

						var aid = response[i].aid;
						var tcount = 0;
						var gpNum = 0;
						var gpStart = 0;
						var gpEnd = 0;

						for (var c in response[i]['paper']['title']) {
							tcount ++;
						}

						tcount -= 2;
						gpNum = response[i]['paper']['title'].gpcount;
						gpStart = response[i]['paper']['title'].gpstart;
						gpEnd = gpStart + gpNum;

						// console.log(tcount + ' . ' + normalEnd + ' . ' + gpStart);

						for (var j = 0; j < tcount; j++) {
							if (j < gpStart || j >= gpEnd) {
								$('.class .studentexceldetailed .studetailed .' + aid).append("<td>" + response[i]['paper']['title'][j].title + "</td>");
							}else{
								var subcount = response[i]['paper']['title'][j].subcount;
								for (var x = 1; x <= subcount; x++) {
									$('.class .studentexceldetailed .studetailed .' + aid).append("<td>" + response[i]['paper']['title'][j]['sub'][x].content + "</td>");
								}
							}
						}

						$('.class .studentexceldetailed .studetailed').append("<tr class = 's" + response[i].aid + "'><td>" + response[i].paperName + "</td><td>" + response[i].totalGrade + "</td><td>" + response[i].Time + "</td></tr>");

						var gradecount = response[i]['paper']['content'].count;
						var p = response[i]['paper']['content'].grade;

						for (var y = 0; y < gradecount; y++) {
							$('.class .studentexceldetailed .studetailed .s' + aid).append("<td>" + p[y] + "</td>");
						}
					}
					// $('.class').find('.student-detail .student-table-detailed .studentexceldetailed').append("<tbody><tr><td>" + response[i].PTitle + "</td><td>" + response[i].grade + "</td><td>" + response[i].Time + "</td></tr></tbody>");
				}
			}
		});
	});

	$('.class').find('.student-detail .closebtn').click(function(){
		$('.class').find('.class-detail').css('display' , 'block');
		$('.class').find('.student-detail').css('display' , 'none');

		$('.class').find('.class-name').empty();
		$('.class').find('.class-name').text(classNameTemp);
	});

	$('.class .class-detail .classClosebtn').live('click' , function(){
		changeListInit();
		$('.class .classList').css('display' , 'block');
	});

	//-------------------------------------
	//				Paper Grade

	$('.gradeMainContent').find('.paper-data').live({

		mouseenter: function () {
			$(this).css('background-color' , 'rgba(0,0,0,0.3)');
	    },
	    mouseleave: function () {
	    	$(this).css('background-color' , 'rgba(0,0,0,0.1)');
	    }
	});

	$('.gradeMainContent').find('.paper-data').live("click" , function(){


		$(this).closest('.gradeMainContent').find('.grade-detail').css('display' , 'none');
		$(this).closest('.gradeMainContent').find('.paper-student-detail').css('display' , 'inline-block');

		var PTitle = $(this).attr('data-title');
		var paperID = $(this).attr('data-id');
		var aid = $(this).attr('data-aid');

		PTitleTemp = PTitle;

		$('.gradeMainContent').find('.title').empty();
		$('.gradeMainContent').find('.title').text(PTitle);

		$.ajax({
			url: 'papergrade.php' ,
			type: 'GET' ,
			dataType: 'json' ,
			data:{
				paperID: paperID ,
				aid: aid , 
				Type: 'paperDetail'
			} ,
			error:function(err){
				// alert(err);
				console.log(err);
			} ,
			success:function(response){
				// console.log(response);
				$('.gradeMainContent').find('.paper-student-detail .grade-content').html('');

				for (var i = 0; i < response.length; i++) {
					if (response[i].grade == 0 && response[i].Time == "") {
						$('.gradeMainContent').find('.paper-student-detail .grade-content').append("<div class = 'main'><div class = 'student'>" + response[i].Sname + " (" + response[i].studentID + ")</div><div class = 'time'>" + response[i].Time + "</div><div class = 'grade'>未作答</div></div>");
					}
					else {
						$('.gradeMainContent').find('.paper-student-detail .grade-content').append("<div class = 'main'><div class = 'student'>" + response[i].Sname + " (" + response[i].studentID + ")</div><div class = 'time'>" + response[i].Time + "</div><div class = 'grade'>得分：" + response[i].grade + "</div></div>");
					}
				}
			}
		});

		$.ajax({
			url: 'papergrade.php' ,
			type: 'GET' ,
			dataType: 'json' ,
			data:{
				paperID: paperID ,
				aid: aid ,
				Type: 'excel'
			} ,
			error:function(err){
				// alert(err);
				console.log(err);
			} ,
			success:function(response){
				// console.log(response);

				$('.gradeMainContent').find('.paper-student-detail .papertablecontent').html("");
				$('.gradeMainContent').find('.paper-student-detail .papertablecontent').append("<table class = 'paperexcel'><thead><th>學生姓名(學號)</th><th>得分</th><th>時間</th></thead></table>");
				for (var j = 0; j < response.length; j++) {
					if (response[j].grade == 0 && response[j].Time == "") {
						$('.gradeMainContent').find('.paper-student-detail .paperexcel').append("<tbody><tr><td>" + response[j].Sname + "( " + response[j].studentID + " )</td><td>未作答</td><td>" + response[j].Time + "</td></tr></tbody>");
					}else{
						$('.gradeMainContent').find('.paper-student-detail .paperexcel').append("<tbody><tr><td>" + response[j].Sname + "( " + response[j].studentID + " )</td><td>" + response[j].grade + "</td><td>" + response[j].Time + "</td></tr></tbody>");
					}
				}
			}
		});

		$.ajax({
			url: 'papergrade.php' ,
			type: 'GET' ,
			dataType: 'json' ,
			data:{
				paperID: paperID ,
				aid: aid , 
				Type: 'excel_detailed'
			} ,
			error:function(err){
				// alert(err);
			} ,
			success:function(response){
				var tcount = 0;
				var gpStart = response['title'].gpstart;
				var gpcount = response['title'].gpcount;
				
				// var titleidx = 0;
				// console.log(response);

				for (var c in response['title']) {
					tcount++;
					// titleidx++;
				}
				// titleidx -= 2;
				tcount = tcount - 2;
				var gpEnd = gpStart + gpcount;


				$('.gradeMainContent').find('.paper-student-detail .papertabledetailed').html("");
				$('.gradeMainContent').find('.paper-student-detail .papertabledetailed').append("<table class = 'paperexceldetailed'><thead><tr  class = 'th_tag'></tr></thead></table>");
				$('.gradeMainContent .paper-student-detail .th_tag').append("<th>姓名(學號)</th><th>總分</th><th>時間</th>");
				for (var i = 0; i < tcount ; i++) {
					if (i < gpStart || i >= gpEnd) {
						$('.gradeMainContent .paper-student-detail .th_tag').append("<th>" + response['title'][i].title + "</th>");
					}else{
						var subidx = response['title'][i].subcount;
						for (var j = 1; j <= subidx; j++) {
							$('.gradeMainContent .paper-student-detail .th_tag').append("<th>" + response['title'][i]['sub'][j].content + "</th>");
						}
					}
				}

				var studentidx = 0;
				for (var c in response['content']) {
					studentidx++;
				}


				for (var i = 0; i < studentidx; i++) {
					// $('.gradeMainContent .paper-student-detail .paperexceldetailed').append("<tr></tr>");
					$('.gradeMainContent .paper-student-detail .paperexceldetailed').append("<tbody><tr class = '" + response['content'][i].ID + "'><td>" + response['content'][i].name + "(" + response['content'][i].ID + ")</td><td>" + response['content'][i].totalGrade + "</td><td>" + response['content'][i].Time + "</td></tr></tbody>");

					var temp = response['content'][i].count;
					var ID = response['content'][i].ID;
					var p = response['content'][i].grade;

					for (var j = 0; j < temp; j++) {
						$('.gradeMainContent .paper-student-detail .' + ID).append("<td>" + p[j] + "</td>");
					}
				}
				// $('.gradeMainContent').find('.paper-student-detail .papertabledetailed').append("<table class = 'paperexceldetailed'><thead><th>學生姓名(學號)</th><th>得分</th><th>時間</th></thead></table>");
				// for (var j = 0; j < response.length; j++) {
				// 	$('.gradeMainContent').find('.paper-student-detail .paperexceldetailed').append("<tbody><tr><td>" + response[j].Sname + "( " + response[j].studentID + " )</td><td>" + response[j].grade + "</td><td>" + response[j].Time + "</td></tr></tbody>");
				// }
			}
		});
	});

	$('.gradeMainContent').find('.paper-student-detail .closebtn').click(function(){

		$(this).closest('.gradeMainContent').find('.grade-detail').css('display' , 'inline-block');
		$(this).closest('.gradeMainContent').find('.paper-student-detail').css('display' , 'none');

		$('.gradeMainContent').find('.title').empty();
		$('.gradeMainContent').find('.title').text("試卷清單");
	});




	//-----------------------------
	//			Excel下載
	//-----------------------------

	$('.class').find('.student-detail .output').live("click" , function(){

		var studentID = $(this).closest('.student-detail').find('.main').attr('data-id');
		$(".studentexcel").table2excel({
		    // exclude CSS class
		    // exclude: ".student-table",
		    name: "Excel Document Name" ,
		    filename: '學生成績( ' + studentNameTemp +  '-' + studentID + " )"
		});

	});

	$('.class').find('.student-detail .output_detailed').live("click" , function(){

		var studentID = $(this).closest('.student-detail').find('.main').attr('data-id');
		$(".studentexceldetailed").table2excel({
		    // exclude CSS class
		    // exclude: ".student-table",
		    name: "Excel Document Name" ,
		    filename: '學生詳細成績( ' + studentNameTemp +  '-' + studentID + " )"
		});

	});

	$('.gradeMainContent').find('.paper-student-detail .output').live("click" , function(){
		$(".paperexcel").table2excel({
		    // exclude CSS class
		    // exclude: ".student-table",
		    name: "Excel Document Name" ,
		    filename: '試卷成績( ' + PTitleTemp + " )"
		});
	});

	$('.gradeMainContent').find('.paper-student-detail .output_detailed').live("click" , function(){
		$(".paperexceldetailed").table2excel({
		    // exclude CSS class
		    // exclude: ".student-table",
		    name: "Excel Document Name" ,
		    filename: '詳細試卷成績( ' + PTitleTemp + " )"
		});
	});
