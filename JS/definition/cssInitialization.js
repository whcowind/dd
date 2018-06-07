	var w = window.innerWidth;
	var h = window.innerHeight;

	var themeImgWidth = w * 0.72 ;
	var themeImgHeight = h * 0.18;
	var themeBlank = (w - themeImgWidth) * 0.5;
	var mainHeight = h - (themeImgHeight + 120);
	var textContainWidth = themeImgWidth * 0.8;
	var BGwidth = (2460 / (3490/h));
	console.log(BGwidth);
	
	//Theme image initialization
	// $('.themeImgBox').css('width' , themeImgWidth + 'px');
	// $('.themeImgBox').css('height' , themeImgHeight + 'px');
	// $('.themeImgBox').css('background-size' , themeImgWidth + 'px');
	// $('.themeImgBox').css('left' , themeBlank + 'px');
	// $('.themeImgBox').css('width' , w + 'px');

	$('.themeImgBox').css('height' , (h - 60) + 'px');
	// $('.themeImgBox').css('margin-left' , ((w - BGwidth)/2) + 'px');
	// $('.themeImgBox').css('background-size' , '100%');
	$('.themeImgBox').css('margin-left' , '0');

	//Main Text Area
	$('.contentBox').css('width' , themeImgWidth + 'px');
	$('.contentBox').css('height' , mainHeight + 'px');
	$('.contentBox').css('left' , themeBlank + 'px');

	//Main ContentBox Border
	$('.contentBorder1').css('width' , themeImgWidth + 'px');
	$('.contentBorder2').css('height' , mainHeight + 'px');
	$('.contentBorder3').css('width' , themeImgWidth + 'px');
	$('.contentBorder4').css('height' , mainHeight + 'px');

	//Down btn 
	var downIconLeft = (w - 40)/2;
	$('.downIcon').css('left' , downIconLeft + 'px');

	//Text Contain
	$('.textContain').css('width' , textContainWidth + 'px');

	//HmomePage Contain
	$('.TPContainBox').fadeIn(3000);

	//Enter The Website
	CBEnter();
	SVG();

	//SVG Animation(Velocity)
	function SVG() {
		$('#SVGText')
			.velocity({opacity: 0 } , 0)
			.velocity({opacity: 1 } , {duration: 100 , delay: 10 });

		$('.SVGText1')
			.velocity({'stroke-dashoffset': 2000 } , 0)
			.velocity({'stroke-dashoffset': 0 } , {duration: 4750 , delay: 10 });

		$('.SVGText1Color').velocity({opacity: 1} , {duration: 500 , delay: 2600});

		$('.SVGText2')
			.velocity({'stroke-dashoffset': 2000 } , 0)
			.velocity({'stroke-dashoffset': 0 } , {duration: 5000 , delay: 10});

		$('.SVGText2Color').velocity({opacity: 1} , {duration: 500 , delay: 2600});

		$('.SVGText3')
			.velocity({'stroke-dashoffset': 2000 } , 0)
			.velocity({'stroke-dashoffset': 0 } , {duration: 5000 , delay: 10});

		$('.SVGText3Color').velocity({opacity: 1} , {duration: 500 , delay: 2600});
	} 


	