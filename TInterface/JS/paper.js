
	//Paper Base Area
	var selectPaperTF = [];
	var selectPaperCH = [];
	var selectPaperGP = [];
	var selectPaperSA = [];
	var selectPaperP = [];

	var questionNumber = 0;
	var UquestionNumber = 0;

	//add new exam paper
	$('.exam').find('.new-paper').click(function(){
		newPaper();
	});

	//paper back
	$('.exam').find('.exam-Paper .paperBack').click(function(){
		paperBack();
	});

	//add new Paper
	$('.exam').find('.exam-Paper .newPaper').click(function(){
		paperInit();
		newExamPaper();
	});

	//go paper TF
	$('.exam').find('.exam-Paper .create .paper .selectTF').click(function(){
		chooseQestion(0);
	}); 

	//go paper CH
	$('.exam').find('.exam-Paper .create .paper .selectCH').click(function(){
		chooseQestion(1);
	}); 

	//go paper GP
	$('.exam').find('.exam-Paper .create .paper .selectGP').click(function(){
		chooseQestion(2);
	}); 

	//go paper SA
	$('.exam').find('.exam-Paper .create .paper .selectSA').click(function(){
		chooseQestion(3);
	}); 

	//go to permission block
	$('.exam .exam-Paper .create .paperUpdate .permissionBtn').click(function(){
		chooseUpdateQestion(4);
	});

	//go to paper TF update
	$('.exam').find('.exam-Paper .create .paperUpdate .selectUTF').click(function(){
		chooseUpdateQestion(0);
	});

	//go to paper CH update
	$('.exam').find('.exam-Paper .create .paperUpdate .selectUCH').click(function(){
		chooseUpdateQestion(1);
	});

	//go to paper GP update
	$('.exam').find('.exam-Paper .create .paperUpdate .selectUGP').click(function(){
		chooseUpdateQestion(2);
	});

	//go to paper SA update
	$('.exam').find('.exam-Paper .create .paperUpdate .selectUSA').click(function(){
		chooseUpdateQestion(3);
	});

	//paper choose Affirm click
	$('.exam').find('.exam-Paper .create .paper .paperBlock .paperChooseAffirm').click(function(){
		$('.exam').find('.exam-Paper .create .paper .paperBlock').css('display' , 'none');
	});

	//paper choose clear click
	$('.exam').find('.exam-Paper .create .paper .paperBlock .paperChooseClear').click(function(){
		var type = $(this).attr('data-type');
		paperChooseClear(type);
	});

	//paper Update choose Affirm click
	$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .paperChooseAffirm').click(function(){
		$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock').css('display' , 'none');
	});

	//paper choose clear click
	$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .paperChooseClear').click(function(){
		var type = $(this).attr('data-type');
		// console.log(type);
		paperUpdateChooseClear(type);
	});

	//permission Affirm 
	$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .permissionAffirm').click(function(){
		$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock').css('display' , 'none');
	});

	//permission clear
	$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .permissionClear').click(function(){
		var type = $(this).attr('data-type');
		paperUpdateChooseClear(type);
	});

	//permission submit 
	$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .permissionSubmit').click(function(){
		var Aid = $('.container').find('.account-data .account-name').attr('data-id');
		var PID = $('.exam .exam-Paper .create .PID').val();

		$.ajax({
			url: 'permission.php' , 
			type: 'POST' , 
			dataType: 'html' , 
			data:{
				Aid: Aid , 
				PID: PID ,
				PArray: selectPaperP  
			} , 
			error:function(error){
				// alert(error);
				console.log(error);
			} ,
			success:function(response){
				// console.log(response);
			}
		});

		$(document).ajaxComplete(function(){
			window.location.href = 'Amain.php';
		});
	});

	//paper submit
	$('.exam').find('.exam-Paper .paperSubmit').click(function(){
		var checkPaperTitle ;
		var checkPaperQuestion ;

		if ($('.exam').find('.exam-Paper .create .PTitle').val() != "") {
			checkPaperTitle = true ;
		}else {
			checkPaperTitle = false ;
		}

		if (selectPaperTF.length == 0 && selectPaperCH.length == 0 && selectPaperGP.length == 0 && selectPaperSA.length == 0){
			checkPaperQuestion = false ;
		}else{
			checkPaperQuestion = true;
		}


		if (checkPaperTitle){
			if (checkPaperQuestion){

				function sortNumber(a,b){
					return a - b
				}

				selectPaperTF.sort(sortNumber);
				selectPaperCH.sort(sortNumber);
				selectPaperGP.sort(sortNumber);
				selectPaperSA.sort(sortNumber);

				var Aid = $('.container').find('.account-data .account-name').attr('data-id');

				$.ajax({
					url: 'paperbase.php' , 
					type: 'POST' , 
					dataType: 'html' , 
					data:{
						Aid: Aid ,
						PTitle:$('.exam').find('.exam-Paper .create .PTitle').val() ,
						PExplan:$('.exam').find('.exam-Paper .create .PExplan').val() , 
						PTFArray: selectPaperTF , 
						PCHArray: selectPaperCH , 
						PGPArray: selectPaperGP , 
						PSAArray: selectPaperSA
					} , 
					error:function(error){
						alert(error);
					} ,
					success:function(response){
						console.log(response);
					}
				});
			}else{
				alert('請選擇題目');
			}
		}else{
			alert('請輸入標題')
		}

		$(document).ajaxComplete(function(){
			$('.exam').find('.exam-Paper .create').css('display' , 'none');
			paperInit();
			window.location.href = 'Amain.php';
		});
	});

	//paper clear
	$('.exam').find('.exam-Paper .paperClear').click(function(){
		paperInit();
	});

	//paper update clear
	$('.exam').find('.exam-Paper .paperUClear').click(function(){
		var check = confirm("確定刪除該試卷？");

		if (check) {
			// console.log(id);
			$.ajax({
				url: 'paperDelete.php' , 
				type: 'POST' , 
				dataType: 'json' , 
				data:{
					paperID: $('.exam').find('.exam-Paper .create .PID').val()
				} , 
				error:function(error) {
					// alert(error);
					console.log(error);
					window.location.href = "Amain.php";
				} , 
				success:function(response) {
					console.log(response);
					if (response > 0) {
						alert("已被分配，無法刪除。")
					}else{
						window.location.href = "Amain.php";
					}
				}
			});
		}
	});


	//paper preview
	$('.exam').find('.exam-Paper .paper .paperPreview').click(function(){
		$('.exam').find('.exam-Paper .create .paperPreviewBlock').css('display' , 'block');
		questionNumber = 0;
		$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').html('');
		previewBlock();
	});

	//paper update preview
	$('.exam').find('.exam-Paper .paperUpdate .paperUPreview').click(function(){
		$('.exam').find('.exam-Paper .create .paperPreviewBlock').css('display' , 'block');
		questionNumber = 0;
		$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').html('');
		previewBlock();
	});

	//Paper Update
	$('.PExist').live('click' , function() {
		var id = $(this).attr('data-attr');

		if ($(this).attr('data-own') == 1) {
			$('.exam').find('.exam-Paper .create .paperUpdate .permissionBtn').css('display' , 'inline-block');
		}else{
			$('.exam').find('.exam-Paper .create .paperUpdate .permissionBtn').css('display' , 'none');
		}
		// console.log(id);
		var Aid = $('.container').find('.account-data .account-name').attr('data-id');
		$.ajax({
			url: 'paperExist.php' , 
			type: 'GET' , 
			dataType: 'json' , 
			data:{
				Aid: Aid , 
				paperID: id 
			} , 
			error:function(error) {
				// alert(error);
				console.log(error);
			} , 
			success:function(response) {
				paperUpdate();
				paperInit();
				$('.exam').find('.exam-Paper .create .paper .paperBlock').css('display' , 'none');
				$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock').css('display' , 'none');
				// console.log(response[0]['TF'][0]['Q1'].QID);
				console.log(response);

				var responseLength = 0;
				var TFArrayLengrh = 0
				var CHArrayLengrh = 0
				var GPArrayLengrh = 0
				var SAArrayLengrh = 0
				var PArrayLengrh = 0

				//get response object length
				for(var k in response[0]) {
 				  responseLength++;
				}

				if(response[0]['TF'] != null){
					//TF array length
					for(var tf in response[0]['TF'][0]){
						TFArrayLengrh++;
					}					
				}

				if(response[0]['CH'] != null){
					//CH array Length
					for(var ch in response[0]['CH'][0]){
						CHArrayLengrh++;
					}
				}

				if(response[0]['GP'] != null){
					//GP array length
					for(var gp in response[0]['GP'][0]){
						GPArrayLengrh++;
					}
				}

				if(response[0]['SA'] != null){
					//SA array length
					for(var sa in response[0]['SA'][0]){
						SAArrayLengrh++;
					}
				}

				if(response[0]['P'] != null){
					//SA array length
					for(var p in response[0]['P'][0]){
						PArrayLengrh++;
					}
				}

				for (var i = 0; i < response.length; i++) {
					$('.exam').find('.exam-Paper .create .paperUpdate .PUTitle').val(response[i].PTitle);
					$('.exam').find('.exam-Paper .create .paperUpdate .PUExplan').val(response[i].PExplan);

					//TF Area
					for (var t = 0; t < TFArrayLengrh; t++) {
						selectPaperTF.push(response[i]['TF'][0]['Q' + t].QID);
						var tempTFID = response[i]['TF'][0]['Q' + t].QID ;
						$('.exam').find('.exam-Paper .create .paperUpdate .paperUTFBlock #' + tempTFID).css('background-color' , '#BEC4EB');
						
					}

					//CH Area
					for (var c = 0; c < CHArrayLengrh; c++) {
						selectPaperCH.push(response[i]['CH'][0]['Q' + c].QID);
						var tempCHID = response[i]['CH'][0]['Q' + c].QID ;
						$('.exam').find('.exam-Paper .create .paperUpdate .paperUCHBlock #' + tempCHID).css('background-color' , '#BEC4EB');
					}
					// console.log(CHArrayLengrh);
					//GP Area
					for (var g = 0; g < GPArrayLengrh; g++) {
						selectPaperGP.push(response[i]['GP'][0]['Q' + g].QID);
						var tempGPID = response[i]['GP'][0]['Q' + g].QID ;
						$('.exam').find('.exam-Paper .create .paperUpdate .paperUGPBlock #' + tempGPID).css('background-color' , '#BEC4EB');
					}

					//SA Area
					for (var s = 0; s < SAArrayLengrh; s++) {
						selectPaperSA.push(response[i]['SA'][0]['Q' + s].QID);
						var tempSAID = response[i]['SA'][0]['Q' + s].QID ;
						$('.exam').find('.exam-Paper .create .paperUpdate .paperUSABlock #' + tempSAID).css('background-color' , '#BEC4EB');
						
					}

					//P Area
					for (var p = 0; p < PArrayLengrh; p++) {
						selectPaperP.push(response[i]['P'][0]['Q' + p].user);
						var tempPID = response[i]['P'][0]['Q' + p].user ;
						$('.exam').find('.exam-Paper .create .paperUpdate .paperPermission #' + tempPID).css('background-color' , '#BEC4EB');
						
					}

				}
				var paperID = response[0].paperID;
				$('.exam').find('.exam-Paper .create .paperUpdate .PID').val(paperID);

			}
		});
	});


	//choose question
	function chooseQestion(index) {
		$('.exam').find('.exam-Paper .create .paper .paperBlock').css('display' , 'none');
		if (index == 0){
			$('.exam').find('.exam-Paper .create .paper .paperTFBlock').css('display' , 'inline-block');
			paperTF();
		}
		else if(index == 1) {
			$('.exam').find('.exam-Paper .create .paper .paperCHBlock').css('display' , 'inline-block');	
			paperCH();
		}
		else if (index == 2) {
			$('.exam').find('.exam-Paper .create .paper .paperGPBlock').css('display' , 'inline-block');
			paperGP();
		}
		else if (index == 3) {
			$('.exam').find('.exam-Paper .create .paper .paperSABlock').css('display' , 'inline-block');
			paperSA();
		}
		else {
			alert('Go to choose question error');
		}
	}

	//choose Update question
	function chooseUpdateQestion(index) {
		$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock').css('display' , 'none');
		if (index == 0){
			$('.exam').find('.exam-Paper .create .paperUpdate .paperUTFBlock').css('display' , 'inline-block');
			paperUpdateTF();
		}
		else if(index == 1) {
			$('.exam').find('.exam-Paper .create .paperUpdate .paperUCHBlock').css('display' , 'inline-block');	
			paperUpdateCH();
		}
		else if (index == 2) {
			$('.exam').find('.exam-Paper .create .paperUpdate .paperUGPBlock').css('display' , 'inline-block');
			paperUpdateGP();
		}
		else if (index == 3) {
			$('.exam').find('.exam-Paper .create .paperUpdate .paperUSABlock').css('display' , 'inline-block');
			paperUpdateSA();
		}
		else if (index == 4){
			$('.exam').find('.exam-Paper .create .paperUpdate .paperPermission').css('display' , 'inline-block');
			paperPermission();
		}
		else {
			alert('Go to choose Update question error');
		}
	}

	//new paper change page
	function newPaper() {
		$('.exam').find('.content').css('display' , 'none');
		$('.exam').find('.makeQuestion').css('display' , 'none');
		$('.exam').find('.exam-allocate').css('display' , 'none');
		$('.exam').find('.makePaper').css('display' , 'inline-block');
	}

	function paperTF() {
		// paper TF question click
		$('.exam').find('.exam-Paper .create .paper .paperBlock .paperTFQuestion').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var TFarrayindex = 0; TFarrayindex < selectPaperTF.length; TFarrayindex++){
					if(selectPaperTF[TFarrayindex] == attr){
						selectPaperTF.splice(TFarrayindex,1);
					}
				}
				selectPaperTF.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				// console.log(attr2);
				$(this).css('background-color' , '#F6F3E3');
				for(var TFarrayindex = 0; TFarrayindex < selectPaperTF.length; TFarrayindex++){
					if(selectPaperTF[TFarrayindex] == attr2){
						selectPaperTF.splice(TFarrayindex,1);
					}
				}
			}
			
		);
	}

	function paperCH() {
		// paper CH question click
		$('.exam').find('.exam-Paper .create .paper .paperBlock .paperCHQuestion').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var CHarrayindex = 0; CHarrayindex < selectPaperCH.length; CHarrayindex++){
					if(selectPaperCH[CHarrayindex] == attr){
						selectPaperCH.splice(CHarrayindex,1);
					}
				}
				selectPaperCH.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				$(this).css('background-color' , '#F6F3E3');
				for(var CHarrayindex = 0; CHarrayindex < selectPaperCH.length; CHarrayindex++){
					if(selectPaperCH[CHarrayindex] == attr2){
						selectPaperCH.splice(CHarrayindex,1);
					}
				}
			}
			
		);
	}

	function paperGP() {
		// paper GP question click
		$('.exam').find('.exam-Paper .create .paper .paperBlock .paperGPQuestion').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var GParrayindex = 0; GParrayindex < selectPaperGP.length; GParrayindex++){
					if(selectPaperGP[GParrayindex] == attr){
						selectPaperGP.splice(GParrayindex,1);
					}
				}
				selectPaperGP.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				$(this).css('background-color' , '#F6F3E3');
				for(var GParrayindex = 0; GParrayindex < selectPaperGP.length; GParrayindex++){
					if(selectPaperGP[GParrayindex] == attr2){
						selectPaperGP.splice(GParrayindex,1);
					}
				}
			}
			
		);
	}

	function paperSA() {
		// paper SA question click
		$('.exam').find('.exam-Paper .create .paper .paperBlock .paperSAQuestion').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var SAarrayindex = 0; SAarrayindex < selectPaperSA.length; SAarrayindex++){
					if(selectPaperSA[SAarrayindex] == attr){
						selectPaperSA.splice(SAarrayindex,1);
					}
				}
				selectPaperSA.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				console.log(attr2);
				$(this).css('background-color' , '#F6F3E3');
				for(var SAarrayindex = 0; SAarrayindex < selectPaperSA.length; SAarrayindex++){
					if(selectPaperSA[SAarrayindex] == attr2){
						selectPaperSA.splice(SAarrayindex,1);
					}
				}
			}
			
		);
	}

	//Update
	function paperUpdateTF() {
		// paper TF question click
		$('.exam').find('.exam-Paper .create .paperUpdate .paperUTFBlock .paperTFQuestion').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var TFarrayindex = 0; TFarrayindex < selectPaperTF.length; TFarrayindex++){
					if(selectPaperTF[TFarrayindex] == attr){
						selectPaperTF.splice(TFarrayindex,1);
					}
				}
				selectPaperTF.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				// console.log(attr2);
				$(this).css('background-color' , '#F6F3E3');
				for(var TFarrayindex = 0; TFarrayindex < selectPaperTF.length; TFarrayindex++){
					if(selectPaperTF[TFarrayindex] == attr2){
						selectPaperTF.splice(TFarrayindex,1);
					}
				}
			}
			
		);
	}

	function paperUpdateCH() {
		console.log(selectPaperCH);
		// paper CH question click
		$('.exam').find('.exam-Paper .create .paperUpdate .paperUCHBlock .paperCHQuestion').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var CHarrayindex = 0; CHarrayindex < selectPaperCH.length; CHarrayindex++){
					if(selectPaperCH[CHarrayindex] == attr){
						selectPaperCH.splice(CHarrayindex,1);
					}
				}
				selectPaperCH.push(attr);
				// console.log(selectPaperCH);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				$(this).css('background-color' , '#F6F3E3');
				for(var CHarrayindex = 0; CHarrayindex < selectPaperCH.length; CHarrayindex++){
					if(selectPaperCH[CHarrayindex] == attr2){
						selectPaperCH.splice(CHarrayindex,1);
					}
				}
				// console.log(selectPaperCH);
			}
			
		);
	}

	function paperUpdateGP() {
		// paper GP question click
		$('.exam').find('.exam-Paper .create .paperUpdate .paperUGPBlock .paperGPQuestion').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var GParrayindex = 0; GParrayindex < selectPaperGP.length; GParrayindex++){
					if(selectPaperGP[GParrayindex] == attr){
						selectPaperGP.splice(GParrayindex,1);
					}
				}
				selectPaperGP.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				$(this).css('background-color' , '#F6F3E3');
				for(var GParrayindex = 0; GParrayindex < selectPaperGP.length; GParrayindex++){
					if(selectPaperGP[GParrayindex] == attr2){
						selectPaperGP.splice(GParrayindex,1);
					}
				}
			}
			
		);
	}


	function paperUpdateSA() {
		// paper SA question click
		$('.exam').find('.exam-Paper .create .paperUpdate .paperUSABlock .paperSAQuestion').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var SAarrayindex = 0; SAarrayindex < selectPaperSA.length; SAarrayindex++){
					if(selectPaperSA[SAarrayindex] == attr){
						selectPaperSA.splice(SAarrayindex,1);
					}
				}
				selectPaperSA.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				console.log(attr2);
				$(this).css('background-color' , '#F6F3E3');
				for(var SAarrayindex = 0; SAarrayindex < selectPaperSA.length; SAarrayindex++){
					if(selectPaperSA[SAarrayindex] == attr2){
						selectPaperSA.splice(SAarrayindex,1);
					}
				}
			}
			
		);
	}

	function paperPermission() {
		// paper SA question click
		$('.exam').find('.exam-Paper .create .paperUpdate .paperPermission .teacherItem').toggle(
			function() {
				var attr = $(this).attr('data-attr');
				$(this).css('background-color' , '#BEC4EB');
				for(var Parrayindex = 0; Parrayindex < selectPaperP.length; Parrayindex++){
					if(selectPaperP[Parrayindex] == attr){
						selectPaperP.splice(Parrayindex,1);
					}
				}
				selectPaperP.push(attr);
			} , 
			function() {
				var attr2 = $(this).attr('data-attr');
				$(this).css('background-color' , '#F6F3E3');
				for(var Parrayindex = 0; Parrayindex < selectPaperP.length; Parrayindex++){
					if(selectPaperP[Parrayindex] == attr2){
						selectPaperP.splice(Parrayindex,1);
					}
				}
			}
			
		);
	}


	//paper selectPaperTF Array Init
	function TFArrayInit() {
		selectPaperTF = [];
		$('.exam').find('.exam-Paper .create .paper .paperBlock .paperTFQuestion').css('background-color' , '#F6F3E3');
		$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .paperTFQuestion').css('background-color' , '#F6F3E3');
	}

	//paper selectPaperCH Array Init
	function CHArrayInit() {
		selectPaperCH = [];
		$('.exam').find('.exam-Paper .create .paper .paperBlock .paperCHQuestion').css('background-color' , '#F6F3E3');
		$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .paperCHQuestion').css('background-color' , '#F6F3E3');
	}

	//paper selectPaperGP Array Init
	function GPArrayInit() {
		selectPaperGP = [];
		$('.exam').find('.exam-Paper .create .paper .paperBlock .paperGPQuestion').css('background-color' , '#F6F3E3');
		$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .paperGPQuestion').css('background-color' , '#F6F3E3');
	}

	//paper selectPaperSA Array Init
	function SAArrayInit() {
		selectPaperSA = [];
		$('.exam').find('.exam-Paper .create .paper .paperBlock .paperSAQuestion').css('background-color' , '#F6F3E3');
		$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .paperSAQuestion').css('background-color' , '#F6F3E3');
	}

	//paper permission Array Init
	function PArrayInit() {
		selectPaperP = [];
		$('.exam').find('.exam-Paper .create .paperUpdate .paperBlock .teacherItem').css('background-color' , '#F6F3E3');
	}


	//paper back
	function paperBack() {
		$('.exam').find('.exam-Paper .create .paper').css('display' , 'none');
		$('.exam').find('.exam-Paper .create .paperUpdate').css('display' , 'none');
		$('.exam').find('.makeQuestion').css('display' , 'none');
		$('.exam').find('.makePaper').css('display' , 'none');
		$('.exam').find('.content').css('display' , 'inline-block');
	}

	//create a new paper
	function newExamPaper() {
		$('.exam').find('.exam-Paper .create .paper').css('display' , 'block');
		$('.exam').find('.exam-Paper .create .paperUpdate').css('display' , 'none');
	}

	//Update paper
	function paperUpdate() {
		$('.exam').find('.exam-Paper .create .paper').css('display' , 'none');
		$('.exam').find('.exam-Paper .create .paperUpdate').css('display' , 'block');	
	}

	//paper init
	function paperInit() {
		$('.exam').find('.exam-Paper .create .paper .PTitle').val('');
		$('.exam').find('.exam-Paper .create .paper .PExplan').val('');
		//-------------------Update------------------------------
		$('.exam').find('.exam-Paper .create .paperUpdate .PUTitle').val('');
		$('.exam').find('.exam-Paper .create .paperUpdate .PUExplan').val('');
		$('.exam').find('.exam-Paper .create .paperUpdate .PID').val('');
		//-------------------Array-------------------------------
		TFArrayInit();
		CHArrayInit();
		GPArrayInit();
		SAArrayInit();
	}

	//paper choose clear function 
	function paperChooseClear(type) {
		if(type == "TF"){
			TFArrayInit();
		}
		else if(type == "CH"){
			CHArrayInit();
		}
		else if(type == "GP"){
			GPArrayInit();
		}
		else if(type == "SA"){
			SAArrayInit();
		}
		else{
			alert('paper Choose Clear error');
		}
	}

	//paper Update choose clear function
	function paperUpdateChooseClear(type) {
		if(type == "TF"){
			TFArrayInit();
		}
		else if(type == "CH"){
			CHArrayInit();
		}
		else if(type == "GP"){
			GPArrayInit();
		}
		else if(type == "SA"){
			SAArrayInit();
		}else if (type == "P") {
			PArrayInit();
		}
		else{
			alert('paper Choose Clear error');
		}
	}

	function previewBlock() {
		
		if (selectPaperTF.length > 0){
			$.ajax({
				url: "preview.php" , 
				type: "POST" , 
				dataType: "json" , 
				data:{
					selectPaperTF: selectPaperTF , 
					Type: "createPreviewTF"
				} , 
				error:function(err){
					alert(err);
				} , 
				success:function(response){	

					console.log(response);

					for (var i = 0; i < response.length; i++) {
						questionNumber++;
						var imgindex = 0;

						for(var c in response[i]['IMG']){
							imgindex++;
						}

						$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'TF Content'>" + questionNumber + ". " + response[i].TFDetail + "</div>");
						for (var img = 0; img < imgindex; img++) {
							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<img src = '" + response[i]['IMG'][img].IMGURL + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>");
						}
						$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'TFAns sContent'>" + response[i].TContent + "<br/>" + response[i].FContent + "</div>");
						
					}

					getCHDeatail();
				}
			});	
		}
		else{
			getCHDeatail();
		}

		//close
		$('.exam').find('.exam-Paper .paperPreviewBlock .close').click(function(){
			$('.exam').find('.exam-Paper .paperPreviewBlock').css('display' , 'none');
		});
	}


	function getCHDeatail() {
		if(selectPaperCH.length > 0){
			$.ajax({
				url: "preview.php" , 
				type: "POST" , 
				dataType: "json" , 
				data:{
					selectPaperCH: selectPaperCH ,
					Type: "createPreviewCH"
				} ,
				error:function(err){
					alert(err);
				} , 
				success:function(response){
					console.log(response);
					for (var i = 0; i < response.length; i++) {
						questionNumber++;
						var imgindex = 0;

						for(var c in response[i]['IMG']){
							imgindex++;
						}

						$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'CH Content'>" + questionNumber + ". " + response[i].ChDetail + "</div>");
						for (var img = 0; img < imgindex; img++) {
							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<img src = '" + response[i]['IMG'][img].IMGURL + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>");
						}
						$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'CHAns sContent'>" + response[i].ChAns1Content + "<br/>" + response[i].ChAns2Content + "<br/>" + response[i].ChAns3Content +"<br/>" + response[i].ChAns4Content + "</div>");
						
					}

					getGPDetail();
				}
			});
		}
		else{
			getGPDetail();
		}
	}

	function getGPDetail() {
		if (selectPaperGP.length > 0){
			$.ajax({
				url: "preview.php" , 
				type: "POST" , 
				dataType: "json" , 
				data:{
					selectPaperGP: selectPaperGP , 
					Type: "createPreviewGP"
				} , 
				error:function(err){
					alert(err);
				} , 
				success:function(response){
					console.log(response);
					for (var i = 0; i < response.length; i++) {
						questionNumber++;
						var imgindex = 0;
						var subindex = 0;
						var imgReplaceTemp = [];

						for(var c in response[i]['IMG']){
							imgindex++;
						}

						for(var x in response[i]['sub']){
							subindex++;
						}

						var str = response[i].GroupTitle;

						//Group Question Title中若有圖片標籤時，進行圖片插入
						// 格式{img}{18}
						if(str.indexOf("{img}") >= 0){
							var comparison = [];
							for(var c = 0; c < imgindex; c++){
								var checkstack = "{img}{" + response[i]['IMG'][c].IMGID + "}";
								var imgIDTemp = response[i]['IMG'][c].IMGID;
								comparison.push(imgIDTemp);
								if(str.indexOf(checkstack) >= 0){
									str = str.replace("{img}{" + response[i]['IMG'][c].IMGID + "}" , '<br/><img src = ' + response[i]['IMG'][c].IMGURL +' width = "120" height = "120" onMouseOver="this.width=this.width*1.5;this.height=this.height*1.5" onMouseOut="this.width=this.width/1.5;this.height=this.height/1.5"><br/>');
									imgReplaceTemp.push(imgIDTemp);
									// console.log(checkstack);
								}
							}
							// console.log(imgReplaceTemp);
							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'GPTitle Content' height = '350px'>" + questionNumber + ". " + str + "</div>");
							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent .GPTitle').append("<br/>");
							//get id that what image need append in the end
							for (var c = 0; c < imgindex; c++) {
								removeA(comparison, imgReplaceTemp[c]);
								console.log(imgReplaceTemp);
								// console.log(comparison);
							}

							for (var c = 0; c < comparison.length; c++) {
								var appendInEndID = comparison[c];
								var matchIndex = -1;
								for (var index = 0; index < imgindex; index++) {
									if((response[i]['IMG'][index].IMGID) == appendInEndID){
										matchIndex = index;
									}
								}
								if(matchIndex != -1){
									$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent ').append("<img src = '" + response[i]['IMG'][matchIndex].IMGURL + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>"); 
								}
								console.log(matchIndex);
							}

						}
						else{

							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'GPTitle Content' height = '350px'>" + questionNumber + ". " + response[i].GroupTitle + "</div>");
							for (var img = 0; img < imgindex; img++) {
								$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<img src = '" + response[i]['IMG'][img].IMGURL + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>");
							}

						}

						for (var sub = 0; sub < subindex; sub++) {
							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'subContent sContent'>" + (sub+1) + ". " + response[i]['sub'][sub].GroupQContent + "</div>");
							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'subAns sContent'>" + response[i]['sub'][sub].GroupA1Content + "<br/>" + response[i]['sub'][sub].GroupA2Content + "<br/>" + response[i]['sub'][sub].GroupA3Content + "<br/>" + response[i]['sub'][sub].GroupA4Content + "</div>");
							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<br/>");
						};

						imgReplaceTemp = [];
					}
					getSADetail();
				}
			});
		}else{
			getSADetail();
		}
	}

	function getSADetail() {
		if (selectPaperSA.length > 0){
			$.ajax({
				url: "preview.php" , 
				type: "POST" , 
				dataType: "json" , 
				data:{
					selectPaperSA: selectPaperSA , 
					Type: "createPreviewSA"
				} , 
				error:function(err){
					alert(err);
				} , 
				success:function(response){	

					console.log(response);

					for (var i = 0; i < response.length; i++) {
						questionNumber++;
						var imgindex = 0;

						$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<div class = 'SA Content'>" + questionNumber + ". " + response[i].SADetail + "</div>");

						for(var c in response[i]['IMG']){
							$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<img src = '" + response[i]['IMG'][imgindex].IMGURL + "' width = '120' height = '120' onMouseOver='this.width=this.width*1.5;this.height=this.height*1.5' onMouseOut='this.width=this.width/1.5;this.height=this.height/1.5'>");
							imgindex++;
						}

						$('.exam').find('.exam-Paper .create .paperPreviewBlock .previewContent').append("<textarea class = 'SAAns sContent' Style = 'width:500px; height:150px;'></textarea>");

					}


				}
			});	
		}
		else{
			
		}
	}

	//paper update submit
	$('.exam').find('.exam-Paper .paperUSubmit').click(function(){
		var checkPaperTitle ;
		var checkPaperQuestion ;

		if ($('.exam').find('.exam-Paper .create .PUTitle').val() != "") {
			checkPaperTitle = true ;
		}else {
			checkPaperTitle = false ;
		}

		if (selectPaperTF.length == 0 && selectPaperCH.length == 0 && selectPaperGP.length == 0 && selectPaperSA.length == 0){
			checkPaperQuestion = false ;
		}else{
			checkPaperQuestion = true;
		}


		if (checkPaperTitle){
			if (checkPaperQuestion){

				function sortNumber(a,b){
					return a - b
				}
				
				selectPaperTF.sort(sortNumber);
				selectPaperCH.sort(sortNumber);
				selectPaperGP.sort(sortNumber);
				selectPaperSA.sort(sortNumber);

				$.ajax({
					url: 'paperUpdate.php' , 
					type: 'POST' , 
					dataType: 'html' , 
					data:{
						PTitle:$('.exam').find('.exam-Paper .create .PUTitle').val() ,
						PExplan:$('.exam').find('.exam-Paper .create .PUExplan').val() , 
						PTFArray: selectPaperTF , 
						PCHArray: selectPaperCH , 
						PGPArray: selectPaperGP , 
						PSAArray: selectPaperSA , 
						paperID: $('.exam').find('.exam-Paper .create .PID').val()
					} , 
					error:function(error){
						alert(error);
					} ,
					success:function(response){
						console.log(response);

						if (response.match("T")) {

						}
						else if(response.match("F")){
							alert("試卷已分配，無法修改");
						}
					}
				});
			}else{
				alert('請選擇題目');
			}
		}else{
			alert('請輸入標題')
		}

		$(document).ajaxComplete(function(){
			$('.exam').find('.exam-Paper .create').css('display' , 'none');
			paperInit();
			window.location.href = 'Amain.php';
		});
	});
	
	//remove item from array by value
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
	// var ary = ['three', 'seven', 'eleven'];
	// removeA(ary, 'seven');
	// console.log(ary);