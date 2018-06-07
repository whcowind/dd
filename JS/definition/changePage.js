//總計畫-計畫內容
$('.tPSC1').click(function() {
	hideContainBox();
	Exit();
	$('.contentBox').find('.TPContainBox').delay(1000).fadeIn(2000);
	CBEnter();
});

//數學計畫簡介
$('.mSC1').click(function() {
	hideContainBox();
	Exit();
	$('.contentBox').find('.MPContainBox').delay(1000).fadeIn(2000);
	CBEnter();
});

//數學主持人簡介
$('.mSC2').click(function() {
	hideContainBox();
	Exit();
	$('.contentBox').find('.MPHContainBox').delay(1000).fadeIn(2000);
	CBEnter();
});

// //數學教材下載
// $('.mSC3').click(function() {
// 	window.location.href = 'http://mrimri.weebly.com/259452644819979366172356021312.html';
// });

//科學計畫簡介
$('.sSC1').click(function() {
	hideContainBox();
	Exit();
	$('.contentBox').find('.SPContainBox').delay(1000).fadeIn(2000);
	CBEnter();
});

//科學主持人簡介
$('.sSC2').click(function() {
	hideContainBox();
	Exit();
	$('.contentBox').find('.SPHContainBox').delay(1000).fadeIn(2000);
	CBEnter();
});

//閱讀計畫簡介
$('.rSC1').click(function() {
	hideContainBox();
	Exit();
	$('.contentBox').find('.RPContainBox').delay(1000).fadeIn(2000);
	CBEnter();
});

//閱讀主持人簡介
$('.rSC2').click(function() {
	hideContainBox();
	Exit();
	$('.contentBox').find('.RPHContainBox').delay(1000).fadeIn(2000);
	CBEnter();
});

//分享下載
$('.shareList').click(function() {
	hideContainBox();
	Exit();
	$('.contentBox').find('.DPContainBox').delay(1000).fadeIn(2000);
	CBEnter();
});

//學生登入
$('.lSC1').click(function() {
	window.location.href = 'SLogin.html';
});

//教師登入
$('.lSC2').click(function() {
	window.location.href = 'TLogin.html';
});





//hiden all ContainBox
function hideContainBox() {
	// $('.contentBox').find('.TPContainBox').css('display' , 'none');
	$('.contentBox').find('.TPContainBox').fadeOut(100);
	$('.contentBox').find('.MPContainBox').fadeOut(100);
	$('.contentBox').find('.MPHContainBox').fadeOut(100);
	$('.contentBox').find('.SPContainBox').fadeOut(100);
	$('.contentBox').find('.SPHContainBox').fadeOut(100);
	$('.contentBox').find('.RPContainBox').fadeOut(100);
	$('.contentBox').find('.RPHContainBox').fadeOut(100);
	$('.contentBox').find('.DPContainBox').fadeOut(100);
}