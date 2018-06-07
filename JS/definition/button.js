	var w = window.innerWidth;

	//Go Top Button
	$('.goTop').click(function(){
		$('html , body').animate({scrollTop:0} , 900);
	});

	//down Button
	$('.downIcon').click(function(){
		$('html , body').animate({scrollTop:w} , 900);
	});