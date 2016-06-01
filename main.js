$(document).ready(function(){

	findheight();
	
	$(".button-collapse").sideNav();
	
	$(window).resize(function(){
		findheight();
	});
	
	$('#list_type').on("change",function(){
		if(this.value=="sell"){
			$('.pm').css("visibility","hidden");
		}
		else{
			$('.pm').css("visibility","visible");
		}
	});
});

function findheight(){
	var height=$(window).height();
	console.log(height);
	$(".parts").css('min-height',height);
	$(".message_div").css('height',height-(0.2*height));
	$("#popo").css('height',height-(0.2*height));
}