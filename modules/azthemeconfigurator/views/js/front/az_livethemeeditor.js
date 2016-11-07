 
$(document).ready(function(){
	 /* Begin: Show hide cpanel */  
	var ua = navigator.userAgent,
    event = (ua.match(/iPad/i)) ? "touchstart" : "click";
	widthC = $('#live-editor').width()+82; 
	
	$("#live-editor_btn").bind(event, function(event) {
		$(this).animate({left:"-50px"},function(){
			$("#live-editor").animate({left:"0px"},400);
		  });
	});
	
	$(".close-editor").bind(event, function(event) {
		$("#live-editor").animate({left:-widthC},400,function(){
			$("#live-editor_btn").animate({left:"0px"},850);
		 });
	});
	
	//Layout Box
	$('[name*="layoutOption"]').on('change', function (){
		var $typelayout = $(this).val();
		addLayoutBox($typelayout);
	});
	
	//Pattern Box
	$('.img-pattern').on('click', function (){
		var $pattern = $(this).data('pattern');
		addPattern($pattern);
		
	});
});

function addPattern($pattern){
	$('body').stripClass('pattern').addClass('pattern'+$pattern);
}

function addLayoutBox($layoutbox){
	$('body').stripClass('layout-').addClass($layoutbox);
}

$.fn.stripClass = function (partialMatch, endOrBegin) {
	// <summary>
	// The way removeClass should have been implemented -- accepts a partialMatch (like "btn-") to search on and remove
	// </summary>
	var x = new RegExp((!endOrBegin ? "\\b" : "\\S+") + partialMatch + "\\S*", 'g');
	// http://stackoverflow.com/a/2644364/1037948
	this.attr('class', function (i, c) {
		if (!c) return;
		return c.replace(x, '');
	});
	return this;
};