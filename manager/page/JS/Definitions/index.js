	//Login
	function login() {
		var ID = $('.ID').val();
		var pass = $('.pass').val();
		if (ID != "" && pass != "") {
			$.ajax({
				url: "login.php" , 
				method: "POST" , 
				dataType: "html" , 
				data:{
					ID: ID , 
					pass: pass
				}
			}).fail(function(err){
				alert(err);
				console.log(err);
			}).done(function(response){
				if (response.match("Success")) {
					window.location.href = "main.php";
				}
				else{
					alert("帳號密碼錯誤");
				}
			});
		}
		else{
			alert('請輸入帳號密碼');
		}
	}

$(document).ready(function(){
	var c = document.getElementById('canv');
	var $ = c.getContext("2d");
	var w = c.width = window.innerWidth;
	var h = c.height = window.innerHeight;
	var arr = [];
	var x = 0, y = 0;

	for(var i = 0; i < 250; i++) arr.push(new part());

	function part(){
	  this.x = Math.random()*w;
	  this.y = Math.random()*h;
	  this.vx = Math.random();
	  this.vy = Math.random();
	  this.col = 'hsla('+Math.random()*360+', 85%, 60%, 1)';
	  this.rad = Math.random()*35;
	}

	function draw(){
	  $.globalCompositeOperation = 'source-over';
	  $.fillStyle = 'hsla(232, 95%, 10%, 1)';
	  $.fillRect(0, 0, w, h);
	  $.globalCompositeOperation = 'lighter';
	  for(var j = 0; j < arr.length; j++){
	    var p = arr[j];
	    $.beginPath();
	    var g = $.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.rad);
	    // var g = $.createRadialGradient(p.x, p.y+ (p.rad/2), 0, p.x, p.y+ (p.rad/2), (p.rad/2));
	    // var g = $.createRadialGradient(p.x, p.y+ (p.rad/2), 0, p.x, p.y+ (p.rad/2), (p.rad/2));
	    g.addColorStop(0, 'hsla(0,0%,0%,.4)');
	    g.addColorStop(0.4, p.col);
	    g.addColorStop(1, 'hsla(0,0%,0%,0)');
	   
	    $.fillStyle = g;
	    $.arc(p.x, p.y, p.rad, Math.PI*2, false);/*true??flase??*/
	    // $.moveTo(p.x , p.y);
	    // $.lineTo(p.x - (p.rad/2) , p.y + (p.rad/2));
	    // $.lineTo(p.x + (p.rad/2) , p.y + (p.rad/2));
	    // $.moveTo(p.x , p.y + p.rad);
	    // $.lineTo(p.x - (p.rad/2) , p.y + (p.rad/2));
	    // $.lineTo(p.x + (p.rad/2) , p.y + (p.rad/2));
	    $.fill();
	    p.x += p.vx;
	    p.y += p.vy; 
	    if(p.x < -50) p.x = w+50;
	    if(p.y < -50) p.y = h+50;
	    if(p.x > w+50) p.x = -50;
	    if(p.y > h+50) p.y = -50;
	  }
	  window.requestAnimationFrame(draw);
	}
	draw();

	window.addEventListener('resize', function(){
	  c.width = w = window.innerWidth;
	  c.height = h = window.innerHeight;
	}, false);
});

