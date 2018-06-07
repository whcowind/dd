//ContentBorder Enter Animation Function
	function CBEnter() {
		$('.contentBorder1').animate({
			left: '0%'
		} , 1000 , function(){
			// $('.contentBorder1').fadeOut(1000);
		});

		$('.contentBorder2').animate({
			top: '0%'
		} , 1000 , function(){
			// $('.contentBorder2').fadeOut(1000);
		});

		$('.contentBorder3').animate({
			left: '0%'
		} , 1000 , function(){
			// $('.contentBorder3').fadeOut(1000);
		});

		$('.contentBorder4').animate({
			top: '0%'
		} , 1000 , function(){
			// $('.contentBorder4').fadeOut(1000);
		});
		
		$('body').scrollTop($(document).height());
	}

	//ContentBorder Exit Funtion
	function Exit() {
		$('.contentBorder1').animate({
			left: '100%'
		} , 1000);

		$('.contentBorder2').animate({
			top: '-100%'
		} , 1000);

		$('.contentBorder3').animate({
			left: '-100%'
		} , 1000);

		$('.contentBorder4').animate({
			top: '100%'
		} , 1000);
	}
