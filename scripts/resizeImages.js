var orgwith=new Array();
var orgheigh=new Array();
var objCont=new Array();
var objWd = new Array();
var orSizeWin;
var eachone = new Array();


	
$(document).ready(function() {
	var extraSize = 0;
	objectCont = $("imageCont");
	orSizeWin = $(window).width();
	
	$("div.imageCont").each( function(index) {
	objCont.push($(this));
	objWd.push($(objCont[index]).width());
	rezaiseaimg(index);
	 } );
	$(".content").each( function(index) {
		if(orSizeWin <= 1200){
			var diment = {
			  'width' : orSizeWin,
			  'left':extraSize
				}
		}
		else if(orSizeWin > 1200){
			var thefinalwidth= 1200;
			if(eachone.length == 4){
				thefinalwidth= orSizeWin/4;
				extraSize = extraSize-600;
				}
			var diment = {
			  'width' : thefinalwidth,
			  'left':extraSize
				}
			}
	$(this).css(diment);
	$('#alu-wrap').css('width',extraSize + orSizeWin);
	extraSize = orSizeWin + extraSize;
	eachone.push(extraSize + 50);
	
	 });
});

function rezaiseaimg(i){
	
	var conImgWth = objWd[i];
	var ImgWth = $(objCont[i]).find("img").width();
	var ImgHt = $(objCont[i]).find("img").height();	
	orgwith.push(ImgWth);
	orgheigh.push(ImgHt);
	if(conImgWth < ImgWth){
		if(ImgWth > ImgHt){
			var numF = ImgWth/conImgWth;
			var numH = ImgHt/numF;
		}
		else if(ImgWth < ImgHt){
			var numF = ImgWth/conImgWth;		
			var numH = ImgHt/numF;	
			}
		else if(ImgWth == ImgHt){
			var numF = conImgWth;
			var numH = numF;
		}
		$(objCont[i]).find("img").css({
			width: conImgWth,
			height: numH
		});
		}
}

$(window).resize(function() {
	/*var extraSize = 0;
	orSizeWin = $(window).width();
	$(".content").each( function(index) {
	if(orSizeWin <= 1200){
			var diment = {
			  'width' : orSizeWin,
			  'left':extraSize
				}
		}
		else if(orSizeWin > 1200){
			
			var diment = {
			  'width' : 1200,
			  'left':extraSize
				}
			}
	$(this).css(diment);
	extraSize = orSizeWin + extraSize;
	
	 });
	
	$("div.imageCont").each( function(i) {
		var conImgWth = $(this).width();
		var ImgWth = $(this).find("img").width();
		var ImgHt = $(this).find("img").height();	
		if(orgwith[i] > conImgWth){
				var numF = orgwith[i]/conImgWth;
				var numH = orgheigh[i]/numF;
			$(this).find("img").css({
				width: conImgWth,
				height: numH
			});
			}
		 });
		*/
});