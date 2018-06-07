	//array
	var selectStudent = [];


	//go to allocate view
	$('.exam').find('.allocate').click(function(){
		newAllocate();
		allocateTableInit();
	});

	//go to select 
	$('.exam').find('.exam-allocate .allocateBtn').click(function(){
		$('.exam').find('.exam-allocate .allocateTable').css('display' , 'block');
		allocateSelect();
	});

	//table cancel
	$('.exam').find('.exam-allocate .allocateTable .allocateCancel').click(function(){
		$('.exam').find('.exam-allocate .allocateTable').css('display' , 'none');
		allocateTableInit();
	});

	//table submit
	$('.exam').find('.exam-allocate .allocateTable .allocateSubmit').click(function(){
		var paperID = getPaperID("selectPaper");
		// var Aclass = $('.exam').find('.exam-allocate .allocateTable .selectPaper').attr('data-temp');
		var check1 = false;
		var check2 = false;
		
		if (paperID == 0){
			check1 = false;
		}
		else{
			check1 = true;
		}

		if (selectStudent.length > 0){
			check2 = true;
		}
		else{
			check2 = false;
		}

		if (check1) {
			if (check2) {
				var Aid = $('.container').find('.account-data .account-name').attr('data-id');

				$.ajax({
					url: 'allocate.php' , 
					type: 'POST' , 
					dataType: 'html' , 
					data:{
						Aid:Aid , 
						paperID: paperID , 
						studentArray: selectStudent
					} , 
					error:function(err){
						// alert(err);
						console.log(error);
					} , 
					success:function(response){
						// console.log(response);
					}
				});

				$(document).ajaxComplete(function(){
					allocateBack();
					allocateTableInit();
					$('.exam').find('.exam-allocate .allocateTable').css('display' , 'none');
					window.location.href = "Amain.php";
				});
			}else{
				alert("請選擇欲分配的學生");
			}
		}else{
			alert("請選擇試卷");
		}

		
	});

	//allocate back
	$('.exam').find('.exam-allocate .allocateBack').click(function(){
		allocateBack();
	});

	function newAllocate() {
		$('.exam').find('.content').css('display' , 'none');
		$('.exam').find('.makeQuestion').css('display' , 'none');
		$('.exam').find('.makePaper').css('display' , 'none');
		$('.exam').find('.exam-allocate').css('display' , 'inline-block');
	}

	function allocateBack() {
		$('.exam').find('.makeQuestion').css('display' , 'none');
		$('.exam').find('.makePaper').css('display' , 'none');
		$('.exam').find('.exam-Paper').css('display' , 'none');
		$('.exam').find('.exam-allocate').css('display' , 'none');
		$('.exam').find('.content').css('display' , 'inline-block');
	}

	function allocateSelect() {
		$('.exam').find('.exam-allocate .allocateBox .allocateTable .studentExist').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var arrayIndex = 0; arrayIndex < selectStudent.length; arrayIndex++){
					if(selectStudent[arrayIndex] == attr){
						selectStudent.splice(arrayIndex,1);
					}
				}
				selectStudent.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				console.log(attr2);
				$(this).css('background-color' , '#F6F3E3');
				for(var arrayIndex = 0; arrayIndex < selectStudent.length; arrayIndex++){
					if(selectStudent[arrayIndex] == attr2){
						selectStudent.splice(arrayIndex,1);
					}
				}
			}
			
		);

		$('.exam').find('.exam-allocate .allocateBox .allocateAll').toggle(
			function() {
				var selectLength = $('.exam').find('.exam-allocate .allocateBox .studentExist').attr('data-length');
				selectStudent = [];
				for (var i = 0; i < selectLength; i++) {
					$('.exam').find('.exam-allocate .allocateBox .studentExist').css('background-color' , '#BEC4EB');
					var attr = $('.exam').find('.exam-allocate .allocateBox #' + i).attr('data-attr');
					selectStudent.push(attr);
				}
			} , 
			function() {
				selectStudent = [];
				$('.exam').find('.exam-allocate .allocateBox .studentExist').css('background-color' , '#F6F3E3');
			}
		);
	}

	function allocateTableInit() {
		selectStudent = [];
		$('.exam').find('.exam-allocate .allocateBox .studentExist').css('background-color' , '#F6F3E3');
	}

	function getPaperID(selectName) {
		var e = document.getElementById(selectName);
		var value = e.options[e.selectedIndex].value;

		return value;
	}